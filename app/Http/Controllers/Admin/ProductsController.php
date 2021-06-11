<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductsRequest;
use App\Models\Categories;
use App\Models\Products;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
  public function __construct()
  {
    $this->data['statuses'] = Products::statuses();
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $this->data['products'] = Products::all();
    return view('admin.products.index', $this->data);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $categories = Categories::orderBy('name', 'ASC')->get();

    $this->data['categories'] = $categories->toArray();
    $this->data['product'] = null;
    $this->data['categoryIDs'] = [];

    return view('admin.products.form', $this->data);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(ProductsRequest $request)
  {
    $params = $request->except('_token');
    $params['slug'] = Str::slug($params['name']);
    $params['user_id'] = Auth::user()->id;

    $saved = false;
    $saved = DB::transaction(function () use ($params) {
      $product = Products::create($params);
      $product->categories()->sync($params['category_ids']);

      return true;
    });

    if ($saved) {
      Session::flash('success', 'Product has been saved');
    } else {
      Session::flash('error', 'Product could not be saved');
    }

    return redirect('admin/products');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Products  $products
   * @return \Illuminate\Http\Response
   */
  public function show(Products $products)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Products  $products
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $product = Products::findOrFail($id);
    $categories = Categories::orderBy('name', 'ASC')->get();

    $this->data['categories'] = $categories->toArray();
    $this->data['product'] = $product;
    $this->data['categoryIDs'] = $product->categories->pluck('id')->toArray();

    return view('admin.products.form', $this->data);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Products  $products
   * @return \Illuminate\Http\Response
   */
  public function update(ProductsRequest $request, $id)
  {
    $params = $request->except('_token');
    $params['slug'] = Str::slug($params['name']);

    $product = Products::findOrFail($id);

    $saved = false;
    $saved = DB::transaction(function () use ($product, $params) {
      $product->update($params);
      $product->categories()->sync($params['category_ids']);

      return true;
    });

    if ($saved) {
      Session::flash('success', 'Product has been saved');
    } else {
      Session::flash('error', 'Product could not be saved');
    }

    return redirect('admin/products');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Products  $products
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $product  = Products::findOrFail($id);

    if ($product->delete()) {
      Session::flash('success', 'Product has been deleted');
    }

    return redirect('admin/products');
  }
}
