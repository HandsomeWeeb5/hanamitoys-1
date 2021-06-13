<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
  public function index()
  {
    $this->data['users'] = DB::table('model_has_roles')
      ->join('users', 'model_has_roles.model_id', '=', 'users.id')
      ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
      ->select('roles.name')
      ->where('roles.name', 'customer')
      ->get();
    return view('admin.dashboard.index', $this->data);
  }
}
