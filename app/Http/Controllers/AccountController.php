<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $user = Auth::user();

    $favorites = Favorite::all()->where('user_id', $user->id);

    $this->data['provinces'] = $this->getProvinces();
    $this->data['cities'] = isset(Auth::user()->province_id) ? $this->getCities(Auth::user()->province_id) : [];
    $this->data['user'] = $user;
    $this->data['favorites'] = $favorites;

    return view('customer.account.index', $this->data);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $this->validate($request, [
      'first_name' => 'bail|required|min:2',
      'last_name' => 'bail|required|min:2',
    ]);

    // Get the user
    $user = Auth::user();

    // Update user
    $user->fill($request->except('password'));

    // check for password change
    if ($request->get('password')) {
      $user->password = bcrypt($request->get('password'));
    }

    $user->update();

    Toastr::success('Profil telah di update', 'Sukses');
    return redirect()->back();
  }
}
