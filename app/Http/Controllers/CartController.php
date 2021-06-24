<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $items = \Cart::getContent();
    $this->data['items'] =  $items;

    return view('customer.carts.index', $this->data);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $params = $request->except('_token');

    $product = Product::findOrFail($params['product_id']);
    // $slug = $product->slug;

    $attributes = [];
    if ($product->configurable()) {
      $product = Product::from('products as p')
        ->whereRaw("p.parent_id = :parent_product_id
							and (select pav.text_value 
									from product_attribute_values pav
									join attributes a on a.id = pav.attribute_id
									where a.code = :type_code
									and pav.product_id = p.id
									limit 1
								) = :type_value
								", [
          'parent_product_id' => $product->id,
          'type_code' => 'type',
          'type_value' => $params['type'],
        ])->firstOrFail();

      $attributes['type'] = $params['type'];
    }

    $item = [
      'id' => md5($product->id),
      'name' => $product->name,
      'price' => $product->price,
      'quantity' => $params['qty'],
      'attributes' => $attributes,
      'associatedModel' => $product,
    ];

    \Cart::add($item);

    Session::flash('success', 'Product ' . $item['name'] . ' has been added to cart');
    return redirect()->back();
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request)
  {
    $params = $request->except('_token');

    if ($items = $params['items']) {
      foreach ($items as $cartID => $item) {
        \Cart::update($cartID, [
          'quantity' => [
            'relative' => false,
            'value' => $item['quantity'],
          ],
        ]);
      }

      Session::flash('success', 'The cart has been updated');
      return redirect('carts');
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    \Cart::remove($id);

    return redirect('carts');
  }
}
