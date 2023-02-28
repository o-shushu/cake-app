<?php
use App\Http\Controllers\Auth\ProductController;
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
})->name('home')->middleware('role.check');

Route::group(['middleware' => ['guest']], function() {
    Route::get('/login', [LoginController::class, 'showLoginPage'])->name('login.show');
    Route::post('/login', [LoginController::class, 'actionLogin'])->name('login.action');

    Route::get('/register', [LoginController::class, 'showRegisterPage'])->name('register.show');
    Route::post('/register', [LoginController::class, 'storeRegister'])->name('register.store');

    
    Route::get('/reset-password', [LoginController::class, 'showResetPasswordPage'])->name('reset-password.show');
});
Route::group(['middleware' => ['auth']], function() {
    Route::get('/logout', [LoginController::class, 'actionLogout'])->name('logout.action');
});

Route::resource('upload',ProductController::class);

    Route::get('/product', [ProductController::class, 'showProductPage'])->name('product.show');
    
