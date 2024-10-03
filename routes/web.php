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

Route::get('/events', [EventsController::class, 'index'])->name("events.index")
    ->middleware('auth');

Route::get('/product/{product_id}', [ProductPageController::class, 'index']);

Route::get('/profile', [ProfileController::class, 'index'])->name("profile.index")
    ->middleware('auth');

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
 


