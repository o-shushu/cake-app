<?php
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Shop\ShopController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\LikeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\ManageController;
use App\Http\Controllers\Pdf\PdfOutputController;

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

//ホームページ
Route::get('/', [ShopController::class, 'home'])->name('home')->middleware('role.check');

//誰でもアクセスできる
Route::prefix('home')->group(function(){
    Route::get('/{shopId}', [ProductController::class, 'showShopProductPage'])->name('home.Product');
    Route::get('/product/detail/{cakeId}', [ProductController::class, 'showShopProductDetail'])
    ->name('home.ProductDetail');
});

//会員ユーザー
Route::prefix('user')->group(function(){
    // Route::get('/orderPage', [UserController::class, 'userOrderPage'])->name('Order');
    Route::post('/inputCart', [UserController::class, 'inputCart'])->name('inputCart');
    Route::post('/shopsInputCart', [UserController::class, 'shopsInputCart'])->name('shopsInputCart');
    Route::get('/indexCart', [UserController::class, 'indexCartPage'])->name('indexCart');
    Route::post('/editCart', [UserController::class, 'editCart'])->name('edit.Cart');
    Route::get('/deleteCart/{cartId}', [UserController::class, 'deleteCart'])->name('deleteCart');
    Route::post('/orderPay', [UserController::class, 'orderPay'])->name('orderPay');
    Route::get('/buyCode', [UserController::class, 'buyCodeIndex'])->name('buyCode.Index');
    Route::get('/buyCodeDetail/{orderId}', [UserController::class, 'buyCodeDetail'])->name('buyCode.Detail');
});

//管理者
Route::prefix('manage')->group(function(){
    Route::get('/consumers', [ManageController::class, 'consumersIndexPage'])->name('consumers.Index');
    Route::get('/consumersUpdate/{userId}', [ManageController::class, 'consumersUpdatePage'])->name('consumers.update');

    Route::get('/shopkeepers', [ManageController::class, 'shopkeepersIndexPage'])->name('shopkeepers.Index');
    Route::get('/delete/{userId}', [ManageController::class, 'deleteUser'])->name('delete.User');
    //いいね一覧
    Route::get('/shop/likes', [ManageController::class, 'shopLikesIndex'])->name('shopLikes.index');
    Route::get('/cake/likes', [ManageController::class, 'cakeLikesIndex'])->name('cakeLikes.index');
});

//ログイン、登録
Route::group(['middleware' => ['guest']], function() {
    Route::get('/login', [LoginController::class, 'showLoginPage'])->name('login.show');
    Route::post('/login', [LoginController::class, 'actionLogin'])->name('login.action');

    Route::get('/register', [LoginController::class, 'showRegisterPage'])->name('register.show');
    Route::post('/register', [LoginController::class, 'storeRegister'])->name('register.store');
});

//パスワードリセット機能
Route::prefix('password_reset')->name('password_reset.')->group(function () {
    Route::prefix('email')->name('email.')->group(function () {
        // パスワードリセットメール送信フォームページ
        Route::get('/', [PasswordController::class, 'emailFormResetPassword'])->name('form');
        // メール送信処理
        Route::post('/', [PasswordController::class, 'sendEmailResetPassword'])->name('send');
        // メール送信完了ページ
        Route::get('/send_complete', [PasswordController::class, 'sendComplete'])->name('send_complete');
    });

    // パスワード再設定ページ
    Route::get('/edit', [PasswordController::class, 'edit'])->name('edit');
    // パスワード更新処理
    Route::post('/update', [PasswordController::class, 'update'])->name('update');
    // パスワード更新終了ページ
    Route::get('/edited', [PasswordController::class, 'edited'])->name('edited');
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
    Route::get('product/detail/update/{cake}', [ProductController::class, 'updateIndexPage'])->name('update.index');
    Route::post('update/{cake}', [ProductController::class, 'updateConfirm'])->name('update.confirm');
    Route::post('store/{cake}', [ProductController::class, 'updateStore'])->name('update.store');
    Route::delete('product/detail/delete/{cakeId}', [ProductController::class, 'destroy']);
    //商品明細
    Route::get('ordersIndex', [ProductController::class, 'ordersIndex'])->name('orders.index');
    Route::get('ordersDetailIndex/{orderNo}', [ProductController::class, 'ordersDetailIndex'])->name('orders.detailIndex');
    Route::get('proceeds', [ProductController::class, 'proceedsIndex'])->name('proceeds.index');
    Route::post('orderStatus', [ProductController::class, 'orderStatus'])->name('order.status');
});

//PDF出力
Route::get('output_pdf', [PdfOutputController::class, 'output_pdf'])->name('output.pdf');

//営業ユーザの店内の商品を表示するページ
Route::get('/product', [ProductController::class, 'showProductPage'])->name('product.show');

Route::prefix('shop')->group(function(){
    //店舗情報登録
    Route::get('index', [ShopController::class, 'shopIndex'])->name('shop.index')->middleware('ShopIndex.check');
    Route::post('upload', [ShopController::class, 'shopConfirm'])->name('shop.confirm');
    Route::get('upload', [ShopController::class, 'shopUpload'])->name('shop.upload');
    Route::post('upload/store', [ShopController::class, 'shopStore'])->name('shop.store');
    
    //店舗情報表示、詳細、変更、保存
    Route::get('detail/{userId}', [ShopController::class, 'shopDetail'])->name('shop.detail');
    Route::get('update/{shopId}', [ShopController::class, 'shopsUpdate'])->name('shop.Update');
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

//いいね
//ログイン中のユーザーのみアクセス可能
Route::group(['middleware' => ['auth']], function () {
    Route::post('shop/like', [LikeController::class, 'shopLike'])->name('shop.like');
    Route::post('cake/like', [LikeController::class, 'cakeLike'])->name('cake.like');
});