<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
  public function index()
  {
    return view('admin.dashboard.index', $this->data);
  }
}
