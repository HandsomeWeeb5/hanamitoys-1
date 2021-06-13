<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return view('welcome');
})->name('user.page');

Route::prefix('admin')->middleware('role:admin')->group(function () {

  // Dashboard
  Route::get('/', [DashboardController::class, 'index'])->name('admin.page');
  Route::get('dashboard', [DashboardController::class, 'index']);

  // Categories
  Route::resource('categories', CategoryController::class);

  // Products
  Route::resource('products', ProductController::class);
  Route::get('products/{productID}/images', [ProductController::class, 'images'])->name('products.images');
  Route::get('products/{productID}/add-image', [ProductController::class, 'add_image'])->name('products.add_image');
  Route::post('products/images/{productID}', [ProductController::class, 'upload_image'])->name('products.upload_image');
  Route::delete('products/images/{imageID}', [ProductController::class, 'remove_image'])->name('products.remove_image');

  // Attributes
  Route::resource('attributes', AttributeController::class);
  Route::get('attributes/{attributeID}/options', [AttributeController::class, 'options'])->name('attributes.options');
  Route::get('attributes/{attributeID}/add-option', [AttributeController::class, 'add_option'])->name('attributes.add_option');
  Route::post('attributes/options/{attributeID}', 'AttributeController@store_option')->name('attributes.store_option');
  Route::delete('attributes/options/{optionID}', 'AttributeController@remove_option')->name('attributes.remove_option');
  Route::get('attributes/options/{optionID}/edit', 'AttributeController@edit_option')->name('attributes.edit_option');
  Route::put('attributes/options/{optionID}', 'AttributeController@update_option')->name('attributes.update_option');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
