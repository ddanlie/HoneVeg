<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\ProductPageController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SignInController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
/*
| Web Routes
|--------------------------------------------------------------------------
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/home', [HomeController::class, 'index'])->name("home.index");

//categories
Route::get('/categories', [CategoriesController::class, 'index'])->name("categories.index");
 
Route::get('/categories/{category_id_hierarchy}', [CategoriesController::class, 'show'])
    ->where('category_id_hierarchy', '^\d+(\/\d+)*$')
    ->name("categories.show");

//events
Route::get('/events', [EventsController::class, 'index'])->name("events.index")
    ->middleware('auth');

Route::get('/events/{event_id}', [EventsController::class, 'show'])->name("events.show")//TODO in controller - if not event with this id - redirect to home
    ->middleware('auth')
    ->where('event_id', '^\d+$');

//orders
Route::get('/order/{order_id}', [OrderController::class, 'index'])->name("order.index")
    ->middleware('auth')
    ->where('event_id', '^\d+$');

Route::post('/order/{order_id}/create', [OrderController::class, 'create'])->name("order.create")
    ->middleware('auth')
    ->where('event_id', '^\d+$');

Route::patch('/order/{order_id}/edit', [OrderController::class, 'edit'])->name("order.edit")
    ->middleware('auth')
    ->where('event_id', '^\d+$');


//products
Route::get('/product/{product_id}', [ProductPageController::class, 'index'])->name("product.index")
    ->where('product_id', '^\d+$');

Route::post('/product/{product_id}', [ProductPageController::class, 'store'])->name("product.store")
    ->middleware('auth')
    ->where('product_id', '^\d+$');

Route::get('/product/{product_id}/edit', [ProductPageController::class, 'edit'])->name("product.edit")//routes to MANAGER page
    ->middleware('auth')
    ->where('product_id', '^\d+$');

Route::post('/product/{product_id}/edit', [ProductPageController::class, 'saveEditedProductData'])->name("product.saveEditedProductData")//routes to MANAGER page
    ->middleware('auth')
    ->where('product_id', '^\d+$');

Route::get('/product/create-in/{category_id}', [ProductPageController::class, 'createIn'])->name("product.createIn")//routes to MANAGER page
    ->middleware('auth')
    ->where('category_id', '^\d+$');

Route::post('/product/create-in/{category_id}', [ProductPageController::class, 'createProductData'])->name("product.createProductData")//routes to MANAGER page
    ->middleware('auth')
    ->where('category_id', '^\d+$');

//user
Route::get('/profile/{user_id}', [ProfileController::class, 'index'])->name("profile.index")
    ->middleware('auth')
    ->where('user_id', '^\d+$');

Route::patch('/profile/{user_id}', [ProfileController::class, 'edit'])->name("profile.edit")
    ->middleware('auth')
    ->where('user_id', '^\d+$');


//authentication
Route::get('/register', [RegistrationController::class, 'index'])->name("register.index")
    ->middleware('guest');
Route::post('/register', [RegistrationController::class, 'store'])->name("register.store")  
    ->middleware('guest');

Route::get('/signin', [SignInController::class, 'index'])->name("login")
    ->middleware('guest');
Route::post('/signin', [SignInController::class, 'signin'])
    ->middleware('guest');
Route::patch('/signin', [SignInController::class, 'logout'])
    ->middleware('auth');
 



