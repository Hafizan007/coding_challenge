<?php

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
});


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('admin/home', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');
Route::get('payment', [App\Http\Controllers\PaymentController::class, 'index'])->name('payment.index');
Route::POST('payment', [App\Http\Controllers\PaymentController::class, 'store'])->name('payment.store');
Route::DELETE('payment/{payment}', [App\Http\Controllers\PaymentController::class, 'destroy'])->name('payment.destroy')->middleware('is_admin');
Route::PATCH('payment/{payment}', [App\Http\Controllers\PaymentController::class, 'edit'])->name('payment.edit')->middleware('is_admin');
Route::get('payment/{payment}', [App\Http\Controllers\PaymentController::class, 'update'])->name('payment.update')->middleware('is_admin');
Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
