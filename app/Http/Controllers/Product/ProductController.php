<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Cake;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;
use App\Models\Cakecontent;

class ProductController extends Controller
{
    
// 商品一覧
    public function showProductPage()
    {
        $model = new Shop();
        $shopId = $model->checkShopId();
        if($shopId == true){
            $shopId = Shop::all()->where('user_id', auth()->user()->id);
            foreach($shopId as $val){
                $shopId = $val->id;
            }
            $cakeImages = Image::where('cake_id', '!=', 0)->where('shop_id',$shopId)->paginate(4);

            return view('products/product', compact('cakeImages','shopId'));
        }
        $shopId = 2 ;
        $cakeImages = Image::where('cake_id', '!=', 0)->where('shop_id',$shopId)->paginate(4);
        return view('products/product', compact('cakeImages'));
    }
    //誰でもアクセスできる
    public function homeProductPage($shopId)
    {
        $cakeImages = Image::where('cake_id', '!=', 0)->where('shop_id',$shopId)->paginate(4);
        return view('products/product', compact('cakeImages'));
    }

    public function homeProductDetail($cakeId)
    {
        
        $products = Cake::get()->where('id', $cakeId);
        $cakeImages = Image::get()->where('cake_id', $cakeId);
        foreach($cakeImages as $cakeImage){
            $cakeImagePath = $cakeImage->tmp_name;
        }
        return view('products/product-detail', compact('products', 'cakeImagePath'));
        
    }
// upload商品新規
    public function index()
    {

        return view('products/product-insert');
    }

    public function confirm(Request $request)
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

            // $FileType = $request->file('image')->getClientOriginalExtension();获取文件后缀

            // 選択した画像を確認するため、イメージを表示
            $image_name = $file_name;
            $image_path = 'storage/' . $dir . '/' . $file_name;
        
            return view('products/product-insert', compact('image_path', 'image_name'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cake_content' => 'required|max:512',
            'cake_name' => 'required|max:32',
            'cakecontent.*.cake_price' => 'required|numeric',
            'cakecontent.*.cake_size' => 'required',
        ]);
        // DB::beginTransaction();
        try{
            //店舗
            $shop = Shop::where('user_id', auth()->user()->id)->first();
            
            $cake = new Cake($request->get('cakes',[
                'shop_id' => $shop->id,
                'cake_name' => $request->cake_name,
                'cake_content' => $request->cake_content,
            ]));
            
            $cake->save();
            
            
            // $cake = new Cake();
            // $cake->shop_id = $shopId;
            // $cake->cake_name = $request->input('cake_name');
            // $cake->cake_content = $request->input('cake_content');
            // $cake->cake_price = $request->input('cake_price');
            // $cake->cake_size = $request->input('cake_size');
            // $cake->save();

                $image = new Image();
                $image->cake_id = $cake->id;
                $image->shop_id = $shop->id;
                $image->image_name = $request->input('image_name');
                $image->tmp_name = $request->input('image_path');
                $image->save();
                $cakecontents = $request->input('cakecontent');
                foreach ($cakecontents as $cakecontent) {
                    $data = [
                        'cake_id' => $cake->id,
                        'cake_price' => $cakecontent['cake_price'],
                        'cake_size' => $cakecontent['cake_size'],
                    ];
                    
                    $tmp = Cakecontent::make($data);
                    $tmp->save();
                    // DB::commit();
                }
                    
            // ここまでを記述
        
        }catch(\Exception $e){
            
            // DB::rollback();
            return back()->withInput();
        }
        
        return redirect()->to('/product');

    }
// 商品詳細

    public function showProductDetail($cakeId)
    {
        $products = Cake::get()->where('id', $cakeId);
        $cakeImages = Image::get()->where('cake_id', $cakeId);
        foreach($cakeImages as $cakeImage){
            $cakeImagePath = $cakeImage->tmp_name;
        }
        return view('products/product-detail', compact('products', 'cakeImagePath'));
        
    }

// 商品編集

    public function updateIndexPage($cakeId)
    {
        $products = Cake::get()->where('id', $cakeId);
        $cakeImages = Image::get()->where('cake_id', $cakeId);
        foreach($cakeImages as $cakeImage){
            $cakeImagePath = $cakeImage->tmp_name;
            $image_name = $cakeImage->image_name;
        }
        return view('products/product-update', compact('cakeId', 'products', 'cakeImagePath', 'cakeId', 'image_name'));
    }

    public function updateConfirm(Request $request)
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
       
        // 選択した画像を確認するため、イメージを表示
        $image_name = $file_name;
        $cakeImagePath = 'storage/' . $dir . '/' . $file_name;
        $cakeId = $request->input('cake_id');
        $products = Cake::get()->where('id', $cakeId);
        return view('products/product-update', compact('cakeImagePath', 'image_name', 'products', 'cakeId'));
    }

    public function updateStore(Request $request)
    {
        $tmp_name = $request->input('image_path');
        $image_name = $request->input('image_name');
        $cake_content = $request->input('cake_content');
        $cake_name = $request->input('cake_name');
        $cake_price = $request->input('cake_price');
        $cake_size = $request->input('cake_size');
        Image::where('cake_id',$request->input('cake_id'))->update(['tmp_name'=>$tmp_name, 'image_name'=>$image_name]) ;
        Cake::where('id',$request->input('cake_id'))
        ->update(['cake_content'=>$cake_content, 'cake_name'=>$cake_name, 'cake_price'=>$cake_price, 'cake_size'=>$cake_size]) ;
        return redirect('/product');
    }

// 商品削除
    public function destroy($cakeId)
    {
        Cake::where('id', $cakeId)->delete();
        Image::where('cake_id', $cakeId)->delete();
        return redirect('/product');
    }

//商品明細

    public function ordersIndex()
    {
        return view('products/product-order');
    }

    public function proceedsIndex()
    {
        return view('products/product-proceeds');
    }
}
