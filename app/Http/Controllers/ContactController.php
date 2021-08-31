<?php

namespace App\Http\Controllers;

use App\Models\Appoinment;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('customer.contact.index');
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

    Appoinment::create($params);

    Toastr::success('Appoinment Telah Dikirim, Terima Kasih!', 'Sukses');
    return redirect()->back();
  }
}
