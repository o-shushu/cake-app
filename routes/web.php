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

//権限がない、誰でもアクセスできる
Route::prefix('home')->group(function(){
    //店舗内商品を表示
    Route::get('/{shopId}', [ProductController::class, 'showShopProductPage'])->name('home.Product');
    //店舗内商品の詳細を表示
    Route::get('/product/detail/{cakeId}', [ProductController::class, 'showShopProductDetail'])
    ->name('home.ProductDetail');
});

//会員ユーザー機能
Route::prefix('user')->group(function(){
    //商品詳細ページからカートに入れる
    Route::post('/inputCart', [UserController::class, 'inputCart'])->name('inputCart');
    //商品詳細ではないページからカートに入れる
    Route::post('/shopsInputCart', [UserController::class, 'shopsInputCart'])->name('shopsInputCart');
    //カート一覧ページ
    Route::get('/indexCart', [UserController::class, 'indexCartPage'])->name('indexCart');
    //カート内の商品を編集
    Route::post('/editCart', [UserController::class, 'editCart'])->name('edit.Cart');
    //カートから商品を削除
    Route::get('/deleteCart/{cartId}', [UserController::class, 'deleteCart'])->name('deleteCart');
    //注文の支払う、またorder生成
    Route::post('/orderPay', [UserController::class, 'orderPay'])->name('orderPay');
    //会員ユーザーの購入記録ページ
    Route::get('/buyCode', [UserController::class, 'buyCodeIndex'])->name('buyCode.Index');
    //会員ユーザーの購入記録削除
    Route::get('/buyCodeDelete/{orderId}', [UserController::class, 'buyCodeDelete'])->name('buyCode.Delete');
    //会員ユーザーの購入記録詳細
    Route::get('/buyCodeDetail/{orderId}', [UserController::class, 'buyCodeDetail'])->name('buyCode.Detail');
});

//管理者機能
Route::prefix('manage')->group(function(){
    //会員ユーザー一覧
    Route::get('/consumers', [ManageController::class, 'consumersIndexPage'])->name('consumers.Index');
    //全てのユーザー編集
    Route::get('/consumersUpdate/{userId}', [ManageController::class, 'consumersUpdatePage'])->name('consumers.update');
    //営業ユーザー一覧
    Route::get('/shopkeepers', [ManageController::class, 'shopkeepersIndexPage'])->name('shopkeepers.Index');
    //ユーザー削除
    Route::get('/delete/{userId}', [ManageController::class, 'deleteUser'])->name('delete.User');
    //店舗いいね一覧
    Route::get('/shop/likes', [ManageController::class, 'shopLikesIndex'])->name('shopLikes.index');
    //商品いいね一覧
    Route::get('/cake/likes', [ManageController::class, 'cakeLikesIndex'])->name('cakeLikes.index');
});

//ログインと登録機能
Route::group(['middleware' => ['guest']], function() {
    // ログインページ
    Route::get('/login', [LoginController::class, 'showLoginPage'])->name('login.show');
    // ログイン処理
    Route::post('/login', [LoginController::class, 'actionLogin'])->name('login.action');
    // 新規登録ページ
    Route::get('/register', [LoginController::class, 'showRegisterPage'])->name('register.show');
    // 新規処理
    Route::post('/register', [LoginController::class, 'storeRegister'])->name('register.store');
});

//パスワードリセット機能
Route::prefix('password_reset')->name('password_reset.')->group(function () {
    Route::prefix('email')->name('email.')->group(function () {
        // メール送信ページ
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

//営業ユーザー機能
Route::group(['middleware' => ['auth', 'shop.check']], function() {
    //商品新規ページ
    Route::get('upload', [ProductController::class, 'index'])->name('upload.index');
    //新規商品の画像を確認
    Route::post('upload', [ProductController::class, 'confirm'])->name('upload.confirm');
    //新規商品処理
    Route::post('upload/store', [ProductController::class, 'store'])->name('upload.store');

    //商品詳細ページ
    Route::get('product/detail/{cakeId}', [ProductController::class, 'showProductDetail'])->name('product.detail');
    //商品編集ページ
    Route::get('product/detail/update/{cake}', [ProductController::class, 'updateIndexPage'])->name('update.index');
    //商品編集画像確認
    Route::post('update/{cake}', [ProductController::class, 'updateConfirm'])->name('update.confirm');
    //商品編集処理
    Route::post('store/{cake}', [ProductController::class, 'updateStore'])->name('update.store');
    //価格とサイズ削除
    Route::post('price_size/delete', [ProductController::class, 'priceSizeDelete'])->name('priceSize.Delete');
    //商品削除
    Route::delete('product/detail/delete/{cakeId}', [ProductController::class, 'destroy'])->name('product.delete');
    //商品明細ページ
    Route::get('ordersIndex', [ProductController::class, 'ordersIndex'])->name('orders.index');
    //店舗によっての注文された商品内容を表示
    Route::get('ordersDetailIndex/{orderNo}', [ProductController::class, 'ordersDetailIndex'])->name('orders.detailIndex');
    //売上報告ページ
    Route::get('proceeds', [ProductController::class, 'proceedsIndex'])->name('proceeds.index');
    //商品明細ページに注文状態処理
    Route::post('orderStatus', [ProductController::class, 'orderStatus'])->name('order.status');
    //営業ユーザの売上報告PDF出力
    Route::get('output_pdf', [PdfOutputController::class, 'output_pdf'])->name('output.pdf');
});

//営業ユーザの店内の商品を表示するページ
Route::get('/product', [ProductController::class, 'showProductPage'])->name('product.show');

Route::prefix('shop')->group(function(){
    //店舗情報登録ページ
    Route::get('index', [ShopController::class, 'shopIndex'])->name('shop.index')->middleware('ShopIndex.check');
    //店舗登録画像確認
    Route::post('upload', [ShopController::class, 'shopConfirm'])->name('shop.confirm');
    //店舗情報処理
    Route::get('upload', [ShopController::class, 'shopUpload'])->name('shop.upload');
    
    //店舗情報詳細
    Route::get('detail/{userId}', [ShopController::class, 'shopDetail'])->name('shop.detail');
    //店舗情報編集
    Route::get('update/{shopId}', [ShopController::class, 'shopsUpdate'])->name('shop.Update');
    //店舗情報編集確認
    Route::post('confirm', [ShopController::class, 'shopUpdateConfirm'])->name('shop.Confirm');
    //店舗情報編集処理
    Route::post('store', [ShopController::class, 'shopUpdateStore'])->name('shop.Store');
});

//全てのユーザーの機能
Route::prefix('user')->group(function(){
    //ユーザー情報表示
    Route::get('detail', [UserController::class, 'userDetail'])->name('user.detail');
    //ユーザー情報更新
    Route::get('update', [UserController::class, 'userUpdate'])->name('user.Update');
    //ユーザー情報処理
    Route::post('store', [UserController::class, 'userStore'])->name('user.Store');
});

//いいね
//ログイン中のユーザーのみアクセス可能
Route::group(['middleware' => ['auth']], function () {
    //店舗にいいねを付け
    Route::post('shop/like', [LikeController::class, 'shopLike'])->name('shop.like');
    //商品にいいねを付け
    Route::post('cake/like', [LikeController::class, 'cakeLike'])->name('cake.like');
});