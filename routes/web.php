<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\ProductPageController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SignInController;
use App\Http\Controllers\ProfileController;
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

Route::get('/categories', [CategoriesController::class, 'index'])->name("categories.index");

Route::get('/categories/{category_id_hierarchy}', [CategoriesController::class, 'show'])
    ->where('category_id_hierarchy', '^\d+(\/\d+)*$')
    ->name("categories.show");

Route::get('/events', [EventsController::class, 'index'])->name("events.index")
    ->middleware('auth');

 Route::get('/events/{event_id}', [EventsController::class, 'show'])->name("events.show")//TODO in controller - if not event with this id - redirect to home
    ->middleware('auth')
    ->where('event_id', '^\d+$');

Route::get('/product/{product_id}', [ProductPageController::class, 'index'])->name("product.index")
    ->where('product_id', '^\d+$');

Route::post('/product/{product_id}', [ProductPageController::class, 'store'])->name("product.store")
    ->middleware('auth')
    ->where('product_id', '^\d+$');

Route::get('/profile/{user_id}', [ProfileController::class, 'index'])->name("profile.index")
    ->middleware('auth')
    ->where('user_id', '^\d+$');

Route::patch('/profile/{user_id}', [ProfileController::class, 'edit'])->name("profile.edit")
    ->middleware('auth')
    ->where('user_id', '^\d+$');

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
 



