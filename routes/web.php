<?php
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Shop\ShopController;
use App\Http\Controllers\Auth\UserController;
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

Route::get('/', [ShopController::class, 'home'])->name('home')->middleware('role.check');
//誰でもアクセスできる
Route::prefix('home')->group(function(){
    Route::get('/{shopId}', [ProductController::class, 'homeProductPage'])->name('home.Product');
    Route::get('/product/detail/{cakeId}', [ProductController::class, 'homeProductDetail'])->name('home.ProductDetail');
});

Route::prefix('user')->group(function(){
    
    Route::get('/order/{cakeId}', [UserController::class, 'userOrderPage'])->name('userOrder');
    Route::get('/order', [UserController::class, 'userOrderPage'])->name('Order')->middleware('auth');
});
//ログイン、登録、パスワードリセット機能
Route::group(['middleware' => ['guest']], function() {
    Route::get('/login', [LoginController::class, 'showLoginPage'])->name('login.show');
    Route::post('/login', [LoginController::class, 'actionLogin'])->name('login.action');

    Route::get('/register', [LoginController::class, 'showRegisterPage'])->name('register.show');
    Route::post('/register', [LoginController::class, 'storeRegister'])->name('register.store');

    Route::get('/reset-password', [LoginController::class, 'showResetPasswordPage'])->name('reset-password.show');


});

//ログアウト機能
Route::group(['middleware' => ['auth']], function() {
    Route::get('/logout', [LoginController::class, 'actionLogout'])->name('logout.action');
});
//営業ユーザーの機能
Route::group(['middleware' => ['auth', 'shop.check']], function() {
    //画像処理
    Route::get('upload', [ProductController::class, 'index'])->name('upload.index');
    Route::post('upload', [ProductController::class, 'confirm'])->name('upload.confirm');
    Route::post('upload/store', [ProductController::class, 'store'])->name('upload.store');

    //商品新規処理
    Route::get('product/detail/{cakeId}', [ProductController::class, 'showProductDetail'])->name('product.detail');
    Route::get('product/detail/update/{cakeId}', [ProductController::class, 'updateIndexPage'])->name('update.index');
    Route::post('update', [ProductController::class, 'updateConfirm'])->name('update.confirm');
    Route::post('store', [ProductController::class, 'updateStore'])->name('update.store');
    Route::delete('product/detail/delete/{cakeId}', [ProductController::class, 'destroy']);
    //注文．予約
    Route::get('ordersIndex', [ProductController::class, 'ordersIndex'])->name('orders.index');
    Route::get('proceeds', [ProductController::class, 'proceedsIndex'])->name('proceeds.index');

});
Route::get('/product', [ProductController::class, 'showProductPage'])->name('product.show');

Route::prefix('shop')->group(function(){
    //店舗情報登録
    Route::get('index', [ShopController::class, 'shopIndex'])->name('shop.index')->middleware('ShopIndex.check');
    Route::post('upload', [ShopController::class, 'shopConfirm'])->name('shop.confirm');
    Route::get('upload', [ShopController::class, 'shopUpload'])->name('shop.upload');
    Route::post('upload/store', [ShopController::class, 'shopStore'])->name('shop.store');
    
    //店舗情報表示、詳細、変更、保存
    Route::get('detail', [ShopController::class, 'shopDetail'])->name('shop.detail');
    Route::get('update', [ShopController::class, 'shopUpdate'])->name('shop.Update');
    Route::post('confirm', [ShopController::class, 'shopUpdateConfirm'])->name('shop.Confirm');
    Route::post('store', [ShopController::class, 'shopUpdateStore'])->name('shop.Store');
});

//全てのユーザーの機能
Route::prefix('user')->group(function(){
    //ユーザー情報表示、詳細、変更、保存
    Route::get('detail', [UserController::class, 'userDetail'])->name('user.detail');
    Route::get('update', [UserController::class, 'userUpdate'])->name('user.Update');
    Route::post('store', [UserController::class, 'userStore'])->name('user.Store');
});

Route::prefix('consumer')->group(function(){
  
});