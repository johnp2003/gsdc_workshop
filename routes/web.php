<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});

Route::get('/about-us', function () {
    return view('about-us');
});

Route::get('/contact-us', function () {
    return view('contact-us');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//make sure cant go to that page without login
Route::middleware(['auth'])->group(function () {
    Route::resource('customers', App\Http\Controllers\CustomerController::class);
});