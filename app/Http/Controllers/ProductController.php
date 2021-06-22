<?php

namespace App\Http\Controllers;

use App\Models\AttributeOption;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
  public function __construct()
  {
    $this->data['q'] = null;
    $this->data['as'] = null;
    $this->data['cn'] = null;
    $this->data['tf'] = null;

    $this->data['categories'] = Category::parentCategories()
      ->orderBy('name', 'asc')
      ->get();

    $this->data['minPrice'] = Product::min('price');
    $this->data['maxPrice'] = Product::max('price');

    $this->data['types'] = AttributeOption::whereHas('attribute', function ($query) {
      $query->where('code', 'type')
        ->where('is_filterable', 1);
    })->orderBy('name', 'asc')->get();

    $this->data['sorts'] = [
      url('products') => 'Default',
      url('products?sort=price-asc') => 'Price - Low to High',
      url('products?sort=price-desc') => 'Price - High to Low',
      url('products?sort=created_at-desc') => 'Newest to Oldest',
      url('products?sort=created_at-asc') => 'Oldest to Newest',
    ];

    $this->data['selectedSort'] = url('products');
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $products = Product::active();

    $products = $this->searchProducts($products, $request);
    $products = $this->filterProductsByPriceRange($products, $request);
    $products = $this->filterProductsByAttribute($products, $request);
    $products = $this->sortProducts($products, $request);

    $this->data['products'] = $products->paginate(12);
    return view('customer.products.index', $this->data);
  }

  private function searchProducts($products, $request)
  {
    if ($q = $request->query('q')) {
      $q = str_replace('-', ' ', Str::slug($q));

      $products = $products->whereRaw('MATCH(name, slug, short_description, description) AGAINST (? IN NATURAL LANGUAGE MODE)', [$q]);

      $this->data['q'] = $q;
    }

    if ($categorySlug = $request->query('as')) {
      $category = Category::where('slug', $categorySlug)->firstOrFail();

      $childIds = Category::childIds($category->id);
      $categoryIds = array_merge([$category->id], $childIds);

      $products = $products->whereHas('categories', function ($query) use ($categoryIds) {
        $query->whereIn('categories.id', $categoryIds);
      });

      $this->data['as'] = $categorySlug;
    }

    if ($categorySlug = $request->query('cn')) {
      $category = Category::where('slug', $categorySlug)->firstOrFail();

      $childIds = Category::childIds($category->id);
      $categoryIds = array_merge([$category->id], $childIds);

      $products = $products->whereHas('categories', function ($query) use ($categoryIds) {
        $query->whereIn('categories.id', $categoryIds);
      });

      $this->data['cn'] = $categorySlug;
    }

    return $products;
  }

  private function filterProductsByPriceRange($products, $request)
  {
    $lowPrice = null;
    $highPrice = null;

    if ($priceSlider = $request->query('price')) {
      $prices = explode('-', $priceSlider);

      $lowPrice = !empty($prices[0]) ? (float)$prices[0] : $this->data['minPrice'];
      $highPrice = !empty($prices[1]) ? (float)$prices[1] : $this->data['maxPrice'];

      if ($lowPrice && $highPrice) {
        $products = $products->where('price', '>=', $lowPrice)
          ->where('price', '<=', $highPrice)
          ->orWhereHas('variants', function ($query) use ($lowPrice, $highPrice) {
            $query->where('price', '>=', $lowPrice)
              ->where('price', '<=', $highPrice);
          });

        $this->data['minPrice'] = $lowPrice;
        $this->data['maxPrice'] = $highPrice;
      }
    }

    return $products;
  }

  private function filterProductsByAttribute($products, $request)
  {
    if ($attributeOptionID = $request->query('tf')) {
      $attributeOption = AttributeOption::findOrFail($attributeOptionID);

      $products = $products->whereHas('ProductAttributeValues', function ($query) use ($attributeOption) {
        $query->where('attribute_id', $attributeOption->attribute_id)
          ->where('text_value', $attributeOption->name);
      });

      $this->data['tf'] = $attributeOptionID;
    }

    return $products;
  }

  private function sortProducts($products, $request)
  {
    if ($sort = preg_replace('/\s+/', '', $request->query('sort'))) {
      $availableSorts = ['price', 'created_at'];
      $availableOrder = ['asc', 'desc'];
      $sortAndOrder = explode('-', $sort);

      $sortBy = strtolower($sortAndOrder[0]);
      $orderBy = strtolower($sortAndOrder[1]);

      if (in_array($sortBy, $availableSorts) && in_array($orderBy, $availableOrder)) {
        $products = $products->orderBy($sortBy, $orderBy);
      }

      $this->data['selectedSort'] = url('products?sort=' . $sort);
    }

    return $products;
  }

  /**
   * Display the specified resource.
   *
   * @param  string  $slug
   * @return \Illuminate\Http\Response
   */
  public function show($slug)
  {
    $product = Product::active()->where('slug', $slug)->first();

    if (!$product) {
      return redirect('products');
    }

    if ($product->type == 'configurable') {
      $this->data['types'] = ProductAttributeValue::getAttributeOptions($product, 'type')->pluck('text_value', 'text_value');
    }

    $this->data['product'] = $product;

    return view('customer.products.show', $this->data);
  }

  public function getCharacterName($slug)
  {
    $character['data'] = Category::orderBy('name')->select('slug', 'name')->where('slug', $slug)->get();

    return response()->json($character);
  }
}
