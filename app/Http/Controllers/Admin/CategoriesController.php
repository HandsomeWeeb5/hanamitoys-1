<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriesRequest;
use App\Models\Categories;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $this->data['categories'] = Categories::all();
    return view('admin.categories.index', $this->data);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $categories = Categories::all();

    $this->data['categories'] = $categories;
    $this->data['category'] = null;

    return view('admin.categories.create', $this->data);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(CategoriesRequest $request)
  {
    $params = $request->except('_token');
    $params['slug'] = Str::slug($params['name']);
    $params['parent_id'] = (int)$params['parent_id'];

    if (Categories::create($params)) {
      Session::flash('success', 'Category has been saved');
    }
    return redirect('admin/categories');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Categories  $categories
   * @return \Illuminate\Http\Response
   */
  public function show(Categories $categories)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Categories  $categories
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $category = Categories::findOrFail($id);
    $categories = Categories::orderBy('name', 'asc')->get();

    $this->data['categories'] = $categories->toArray();
    $this->data['category'] = $category;
    return view('admin.categories.form', $this->data);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Categories  $categories
   * @return \Illuminate\Http\Response
   */
  public function update(CategoriesRequest $request, $id)
  {
    $params = $request->except('_token');
    $params['slug'] = Str::slug($params['name']);
    $params['parent_id'] = (int)$params['parent_id'];

    $category = Categories::findOrFail($id);
    if ($category->update($params)) {
      Session::flash('success', 'Category has been updated.');
    }

    return redirect('admin/categories');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Categories  $categories
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $category  = Categories::findOrFail($id);

    if ($category->delete()) {
      Session::flash('success', 'Category has been deleted');
    }

    return redirect('admin/categories');
  }
}
