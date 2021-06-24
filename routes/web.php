<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
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

// Customer
// Index or Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Product
Route::get('products', [ProductController::class, 'index'])->name('cproducts.index');
Route::get('products/categories', [ProductController::class, 'categories']);
Route::get('products/{slug}', [ProductController::class, 'show'])->name('cproducts.show');

// Cart
Route::get('carts', [CartController::class, 'index']);
Route::get('carts/remove/{cartID}', [CartController::class, 'destroy']);
Route::post('carts', [CartController::class, 'store']);
Route::post('carts/update', [CartController::class, 'update']);

// Order
Route::get('orders/checkout', [OrderController::class, 'checkout']);
Route::post('orders/checkout', [OrderController::class, 'doCheckout']);
Route::post('orders/shipping-cost', [OrderController::class, 'shippingCost']);
Route::post('orders/set-shipping', [OrderController::class, 'setShipping']);
Route::get('orders/received/{orderID}', [OrderController::class, 'received']);
Route::get('orders/cities', [OrderController::class, 'cities']);

// Payment
Route::post('payments/notification', [PaymentController::class, 'notification']);
Route::get('payments/completed', [PaymentController::class, 'completed']);
Route::get('payments/failed', [PaymentController::class, 'failed']);
Route::get('payments/unfinish', [PaymentController::class, 'unfinish']);

// About
Route::get('about', [AboutController::class, 'index'])->name('about');

// Contact
Route::get('contact', [ContactController::class, 'index'])->name('contact');

// Account
Route::get('account', [AccountController::class, 'index'])->name('account')->middleware('auth');

// Admin
Route::prefix('admin')->middleware('auth', 'role:Admin')->group(function () {

  // Dashboard
  Route::get('/', [DashboardController::class, 'index'])->name('admin.page');
  Route::get('dashboard', [DashboardController::class, 'index']);

  // Categories
  Route::resource('categories', CategoryController::class);

  // Products
  Route::resource('products', AdminProductController::class);
  Route::get('products/{productID}/images', [AdminProductController::class, 'images'])->name('products.images');
  Route::get('products/{productID}/add-image', [AdminProductController::class, 'add_image'])->name('products.add_image');
  Route::post('products/images/{productID}', [AdminProductController::class, 'upload_image'])->name('products.upload_image');
  Route::delete('products/images/{imageID}', [AdminProductController::class, 'remove_image'])->name('products.remove_image');

  // Attributes
  Route::resource('attributes', AttributeController::class);
  Route::get('attributes/{attributeID}/options', [AttributeController::class, 'options'])->name('attributes.options');
  Route::get('attributes/{attributeID}/add-option', [AttributeController::class, 'add_option'])->name('attributes.add_option');
  Route::post('attributes/options/{attributeID}', [AttributeController::class, 'store_option'])->name('attributes.store_option');
  Route::delete('attributes/options/{optionID}', [AttributeController::class, 'remove_option'])->name('attributes.remove_option');
  Route::get('attributes/options/{optionID}/edit', [AttributeController::class, 'edit_option'])->name('attributes.edit_option');
  Route::put('attributes/options/{optionID}', [AttributeController::class, 'update_option'])->name('attributes.update_option');

  // Roles
  Route::resource('roles', RoleController::class);

  // Users
  Route::resource('users', UserController::class);
});

Auth::routes();
