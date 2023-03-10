<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Shop;

class ShopController extends Controller
{
    public function shopIndex(){
        return view('shops/shop-index');
    }

    public function shopConfirm(Request $request){
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

    public function shopUpload(Request $request){
        
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
        $shop->remark = $request->input('remark');
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

    //店舗情報詳細
    public function shopDetail(){
        $information = Shop::all()->where('user_id', auth()->user()->id);
        foreach($information as $item){
            $shopId = $item->id;
        }
        
        $image_path = Image::all()->where('shop_id', $shopId)->where('cake_id', 0);
        foreach($image_path as $item){
            $image_path = $item->tmp_name;
        }

        return view('shops/shop-detail', compact('information', 'image_path'));
    }

    public function shopUpdate(){
        $information = Shop::all()->where('user_id', auth()->user()->id);
        foreach($information as $item){
            $shopId = $item->id;
        }
        
        $image_path = Image::all()->where('shop_id', $shopId)->where('cake_id', 0);
        foreach($image_path as $item){
            $image_path = $item->tmp_name;
            $image_name = $item->image_name;
            $image_type = $item->tmp_name;
        }

        return view('shops/shop-update', compact('information', 'image_path', 'image_name', 'image_type'));
    }

    public function shopUpdateConfirm(Request $request){

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
        $information = Shop::all()->where('user_id', auth()->user()->id);
        return view('shops/shop-update', compact('information', 'image_path', 'image_name', 'image_type'));
    }
    
    public function shopUpdateStore(Request $request){
        $tmp_name = $request->input('image_path');
        $image_name = $request->input('image_name');
        $image_type = $request->input('image_type');
        $shop_name = $request->input('shop_name');
        $residence = $request->input('residence');
        $tel = $request->input('tel');
        $remark = $request->input('remark');
        Shop::where('user_id', auth()->user()->id)
        ->update(['shop_name'=>$shop_name, 'residence'=>$residence, 'tel'=>$tel, 'remark'=>$remark]) ;
        $value = Shop::all()->where('user_id', auth()->user()->id);
        foreach($value as $val){
            $shop_id = $val->id;
        }
        Image::where('cake_id',0)->where('shop_id',$shop_id)
        ->update(['tmp_name'=>$tmp_name, 'image_name'=>$image_name, 'image_type'=>$image_type]) ;
        return redirect('shop/detail');

    }

        //店一覧
        public function home(){  

        $shopImages = Image::where('cake_id', 0)->paginate(4);
        return view('welcome', compact('shopImages'));

        }
}
