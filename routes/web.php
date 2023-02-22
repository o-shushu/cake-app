<?php

use App\Http\Controllers\Auth\LoginController;
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
})->name('home');

Route::get('/login', [LoginController::class, 'showLoginPage'])->name('login.show');
Route::get('/register', [LoginController::class, 'showRegisterPage'])->name('register.show');
Route::get('/reset-password', [LoginController::class, 'showResetPasswordPage'])->name('reset-password.show');
Route::get('/product', [LoginController::class, 'showProductPage'])->name('product.show');
