<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Shop;
use App\Models\Like;
use App\Models\Cake;
use GrahamCampbell\ResultType\Success;

class ShopController extends Controller
{
//店舗情報登録ページ
    public function shopIndex()
    {
        return view('shops/shop-index');
    }

//店舗情報登録の画像を確認
    public function shopConfirm(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);
        // ディレクトリ名,app>storage>app>public>sample
        $dir = 'insertProducts';

        // アップロードされたファイル名を取得
        $file_name = $request->file('image')->getClientOriginalName();
        
        // 取得したファイル名で保存
        $request->file('image')->storeAs('public/' . $dir, $file_name);

        //获取文件后缀
        $image_type = $request->file('image')->getClientOriginalExtension();

        // 選択した画像を確認するため、イメージを表示
        $image_name = $file_name;
        $image_path = 'storage/' . $dir . '/' . $file_name;
        return view('shops/shop-index', compact('image_path', 'image_name', 'image_type'));
    }

//店舗情報処理
    public function shopUpload(Request $request)
    {
        $request->validate([
            'shop_name' => 'required|max:512',
            'residence' => 'required|max:32',
            'tel' => 'required|numeric',
            'remark' => 'required',
        ]);

        $shop = new Shop();
        $shop->user_id = auth()->user()->id;
        $shop->residence = $request->input('residence');
        $shop->shop_name = $request->input('shop_name');
        $shop->tel = $request->input('tel');
        $shop->remark = nl2br($request->input('remark'));
        $shop->save();

        $value = Shop::all()->where('user_id', $shop->user_id);
        foreach($value as $val){
            $shop_id = $val->id;
        }
        $image = new Image();
        $image->cake_id = 0;
        $image->shop_id = $shop_id;
        $image->image_name = $request->input('image_name');
        $image->image_type = $request->input('image_type');
        $image->tmp_name = $request->input('image_path');
        $image->save();
        return redirect()->to('/product');

    }

//店舗情報詳細を表示
    public function shopDetail($userId)
    {
        $information = Shop::all()->where('user_id', $userId);
        foreach($information as $item){
            $shopId = $item->id;
        }
        
        $image_path = Image::all()->where('shop_id', $shopId)->where('cake_id', 0);
        foreach($image_path as $item){
            $image_path = $item->tmp_name;
        }

        return view('shops/shop-detail', compact('information', 'image_path'));
    }

//店舗情報編集
    public function shopsUpdate($shopId)
    {
        $information = Shop::where('id',$shopId)->get();
        $image_path = Image::all()->where('shop_id', $shopId)->where('cake_id', 0);
        foreach($image_path as $item){
            $image_path = $item->tmp_name;
            $image_name = $item->image_name;
            $image_type = $item->tmp_name;
        }

        return view('shops/shop-update', compact('information', 'image_path', 'image_name', 'image_type','shopId'));
    }

//店舗情報編集の確認
    public function shopUpdateConfirm(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $dir = 'insertProducts';

        $file_name = $request->file('image')->getClientOriginalName();

        $request->file('image')->storeAs('public/' . $dir, $file_name);

        $image_type = $request->file('image')->getClientOriginalExtension();

        $image_name = $file_name;
        $image_path = 'storage/' . $dir . '/' . $file_name;
        $shopId = $request->input('shopId');
        $information = Shop::where('id', $shopId)->get();
        return view('shops/shop-update', compact('information', 'image_path', 'image_name', 'image_type','shopId'));
    }

//店舗情報編集処理
    public function shopUpdateStore(Request $request)
    {
        $tmp_name = $request->input('image_path');
        $image_name = $request->input('image_name');
        $image_type = $request->input('image_type');
        $shop_name = $request->input('shop_name');
        $residence = $request->input('residence');
        $shopId = $request->input('shopId');
        $tel = $request->input('tel');
        $remark = nl2br($request->input('remark'));

        Shop::where('id',$shopId)->update(
            ['shop_name'=>$shop_name,
             'residence'=>$residence,
             'tel'=>$tel,
             'remark'=>nl2br($remark)
            ]);
        Image::where('cake_id',0)->where('shop_id',$shopId)->update(
            ['tmp_name'=>$tmp_name,
             'image_name'=>$image_name,
             'image_type'=>$image_type
            ]);
        $userId = Shop::where('id',$shopId)->first()->user_id;

        return redirect('shop/detail/'.$userId);

    }

//ホームページの店一覧
    public function home()
    {
        $cakesLike = Like::select(Like::raw('cake_id, count(*) as total'))
                            ->whereNotNull('cake_id')
                            ->orderBy('total', 'desc')->groupBy('cake_id')
                            ->with('cake','cake.shop','cake.images')->get();
        $chunkCakeLike = $cakesLike->chunk(3);//三個ずつ分けて

        $shops = Shop::withCount('likes')->orderBy('created_at', 'desc')->paginate(4);
        

        $shopsLike = Like::select(Like::raw('shop_id, count(*) as total'))->whereNotNull('shop_id')
                            ->orderBy('total', 'desc')->groupBy('shop_id')
                            ->with(['shop','shop.images' => function($query){
                                $query->where('cake_id',0); 
                            }])->get();
        $chunkShopLike = $shopsLike->chunk(3);
        $likeShop_model = new Shop;
        $likeCake_model = new Cake;

        return view('welcome', compact('shops','likeShop_model','likeCake_model','cakesLike','chunkCakeLike','chunkShopLike'));

    }
}
