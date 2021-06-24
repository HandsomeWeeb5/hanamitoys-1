<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    $products = Product::all();

    if (count($products) == 4) {
      $this->data['products'] = Product::active()->get()->random(4);
    } else {
      $this->data['products'] = Product::all();
    }

    return view('customer.home.index', $this->data);
  }
}
