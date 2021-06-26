<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Product;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FavoriteController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    parent::__construct();

    $this->middleware('auth');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request request params
   *
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $user = User::all()->find(Auth::id());

    if ($user->getRoleNames()[0] == 'Admin') {
      return response('Admin tidak bisa menambahkan Favorite', 200);
    } else {
      $request->validate(['product_slug' => 'required']);

      $product = Product::where('slug', $request->get('product_slug'))->firstOrFail();

      $favorite = Favorite::where('user_id', Auth::user()->id)
        ->where('product_id', $product->id)
        ->first();
      if ($favorite) {
        return response('Kamu telah menambahkan produk ini sebelumnya kedalam favorite', 422);
      }

      Favorite::create(
        [
          'user_id' => Auth::user()->id,
          'product_id' => $product->id,
        ]
      );

      return response('Produk telah ditambahkan kedalam favorite', 200);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id favorite id
   *
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $favorite = Favorite::findOrFail($id);
    $favorite->delete();

    Toastr::success('Favorite telah dihapus', 'Sukses');

    return redirect()->back();
  }
}
