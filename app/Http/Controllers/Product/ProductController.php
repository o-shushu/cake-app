<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Cake;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;
use App\Models\Cakecontent;
use App\Models\Cart;
use App\Models\Order;


class ProductController extends Controller
{   
//営業ユーザの店内の商品を表示するページ
    public function showProductPage()
    {
        $model = new Shop();
        $shopId = $model->checkShopId();
        //店舗を登録した方
        if($shopId == true){
            $shop = Shop::where('user_id', auth()->user()->id)->first();
            $shopId = $shop->id;

            $cakes = Cake::withCount('likes')->where('shop_id',$shopId)->orderBy('created_at', 'desc')->paginate(4);
            $likeCake_model = new Cake;

            return view('products/product', compact('cakes','shopId', 'likeCake_model'));
        }
        //店舗を登録しない方
        $message = "店舗情報を登録してください。";
        return view('products/product', compact('message'));
    }

//誰でもアクセスできる
    //店舗内商品を表示
    public function showShopProductPage($shopId)
    {
        $cakes = Cake::withCount('likes')->where('shop_id',$shopId)->orderBy('created_at', 'desc')->paginate(4);
        $likeCake_model = new Cake;
        return view('products/product', compact('cakes', 'likeCake_model','shopId'));
    }

    //店舗内商品の詳細を表示
    public function showShopProductDetail(Request $request, $cakeId)
    {
        if(isset(auth()->user()->type) && auth()->user()->type === '2')
        {
            $cakePrice = $request->cake_price;
            $products = Cake::get()->where('id', $cakeId);
            $cakeImages = Image::where('cake_id', $cakeId)->first();
            $cakeImagePath = $cakeImages->tmp_name;
    
            return view('products/product-detail', compact('products', 'cakeImagePath', 'cakePrice'));
        }

        $cakePrice = $request->cake_price;
        $products = Cake::get()->where('id', $cakeId);
        $cakeImages = Image::where('cake_id', $cakeId)->first();
        $cakeImagePath = $cakeImages->tmp_name;

        return view('users/user-order', compact('products', 'cakeImagePath', 'cakePrice'));
    }

//営業ユーザの商品新規ページ
    public function index()
    {
        return view('products/product-insert');
    }

//新規商品の画像を確認
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

//新規商品を保存
    public function store(Request $request)
    {
        $request->validate([
            'cake_name' => 'required|max:32',
            'cake_category' => 'required|max:32',
            'cake_content' => 'required|max:512',
            'cakecontent.*.cake_price' => 'required|numeric',
            'cakecontent.*.cake_size' => 'required',
            'image_name' => 'required',
        ]);
        
        DB::beginTransaction();
        try{
            $shop = Shop::where('user_id', auth()->user()->id)->first();
            
            $cake = new Cake($request->get('cakes',[
                'shop_id' => $shop->id,
                'cake_name' => $request->cake_name,
                'cake_category' => $request->cake_category,
                'cake_content' => $request->cake_content,
            ]));
            $cake->save();
            
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
                Cakecontent::create($data);
                
            }       
        // ここまでを記述
        DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            return back()->withInput();
        }
      
        return redirect()->to('/product');

    }

// 商品詳細ページ
    public function showProductDetail($cakeId)
    {
        $products = Cake::get()->where('id', $cakeId);
        $cakeImages = Image::get()->where('cake_id', $cakeId);
        foreach($cakeImages as $cakeImage){
            $cakeImagePath = $cakeImage->tmp_name;
        }
       
        return view('products/product-detail', compact('products', 'cakeImagePath'));
        
    }

// 商品編集ページ
    public function updateIndexPage(Cake $cake)
    {
        $cakeImagePath = $cake->images()->first()->tmp_name;
        $image_name = $cake->images()->first()->image_name;
        return view('products/product-update', compact('cake', 'cakeImagePath', 'image_name'));
    }

// 商品編集画像を確認
    public function updateConfirm(Request $request, Cake $cake)
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
    
        return view('products/product-update', compact('cakeImagePath', 'cake', 'image_name'));
    }
// 商品編集処理
    public function updateStore(Request $request, Cake $cake)
    {
        // dd($request->input('cakecontent'));
        $request->validate([
            'cake_name' => 'required|max:32',
            'cake_category' => 'required|max:32',
            'cake_content' => 'required|max:512',
            'cakecontent.*.cake_price' => 'required|numeric',
            'cakecontent.*.cake_size' => 'required',
        ]);
        
      
        DB::beginTransaction();
        try{
            
            $tmp_name = $request->input('image_path');
            $image_name = $request->input('image_name');
            $image = Image::where('cake_id',$cake->id)->first();
            $image->update(['tmp_name'=>$tmp_name, 'image_name'=>$image_name]) ;
       
            $cake_content = $request->input('cake_content');
            $cake_name = $request->input('cake_name');
            $cake_category = $request->input('cake_category');
            $cake->update(['cake_content'=>$cake_content, 'cake_name'=>$cake_name, 'cake_category'=>$cake_category]) ;

            $cakecontents = $request->input('cakecontent');
            foreach ($cakecontents as $cakecontent) {
                $data = [
                    'cake_id' => $cake->id,
                    'cake_price' => $cakecontent['cake_price'],
                    'cake_size' => $cakecontent['cake_size'],
                ];
                if(array_key_exists('cakecontent_id', $cakecontent)){
                    if($cakecontent['cakecontent_id'] == $cakecontent['cake_price'] || $cake->id == $cakecontent['cake_size']){
                        Cakecontent::where('id',$cakecontent['cakecontent_id'])->delete();
                    }else{
                        Cakecontent::where('id',$cakecontent['cakecontent_id'])->first()->update($data);
                    }
                    
                }else{
                    Cakecontent::create($data);
                }
                
            }
            DB::commit();
            // ここまでを記述
        }catch(\Exception $e){ 
            DB::rollback();
            return back()->withInput();
        }
      
        return redirect('/product');
    }

// 商品削除
    public function destroy($cakeId)
    {
        Cake::where('id', $cakeId)->delete();
        // Image::where('cake_id', $cakeId)->delete();
        // return view('products/product');
        return redirect('/product');
    }

//営業ユーザ商品明細ページ
    public function ordersIndex(Request $request)
    { 
        $is_reserved = $request->reserved;
        $shop = Shop::where('user_id',auth()->id())->first();
        
        $carts = Cart::where('shop_id',$shop->id)->select('order_id','order_status', Cart::raw('count(*) as total'))
        ->groupBy('order_id','order_status')->with(['order' => function($query) use($is_reserved){
              if($is_reserved){
                return $query->whereNotNull('appointment_time');
            }else
                return $query->whereNull('appointment_time');
        }
        ,'order.user'])->get();
        $orderStatus = [
            ['status' => '未開始'],
            ['status' => '作る中'],
            ['status' => '配達中'],
            ['status' => '到着済み']
        ];

        return view('products/product-order',compact('carts', 'is_reserved','shop','orderStatus'));

    }

//営業ユーザ商品明細ページにorderの状態を操作
    public function orderStatus(Request $request)
    {
        $data = $request->validate([
            'shop_id' => 'required',
            'order_id' => 'required',
            'order_status' => 'required',
        ]);

        $carts = Cart::where('shop_id',$data['shop_id'])->where('order_id',$data['order_id'])->get();
        foreach($carts as $cart){
            Cart::where('id',$cart->id)->update(['order_status' => $data['order_status']]);
        }
        
        $orderStatus = Cart::where('shop_id',$data['shop_id'])->where('order_id',$data['order_id'])->first();

        if($orderStatus->order_status == $data['order_status']){
            return response('Success', 200);
        }
        return response('Error', 200);
    }

//orderから営業ユーザの店舗としての注文された商品内容を表示
    public function ordersDetailIndex($orderNo)
    { 
        $shop = Shop::where('user_id',auth()->id())->first();
        $order = Order::where('orderNo',$orderNo)->first();
        $carts = Cart::with('cake')->where('order_id',$order->id)->where('shop_id',$shop->id)->get();

        $subtotal = 0;
        foreach($carts as $cart){
           $x = $cart->subtotal;
           $subtotal = $x + $subtotal;
        }
        $tax = $subtotal * 0.08;
        $total = $tax + $subtotal;
        return view('products/product-orderDetail',compact('carts','tax','total','subtotal'));
    }

//営業ユーザの売上報告ページ
    public function proceedsIndex()
    {
        $shop = Shop::where('user_id',auth()->id())->first();
        $carts = Cart::where('shop_id',$shop->id)->select('cake_id','size','price', Cart::raw('count(*) as total'))
        ->groupBy('cake_id','size','price')->with('cake')
       ->get();
        $total =0;
        foreach($carts as $cart){
            $subtotal = Cart::where('size',$cart->size)->where('cake_id',$cart->cake_id)->sum('subtotal');
            $total = $total+$subtotal;
        }
        $tax = $total * 0.08;
        $total = $tax + $total;
        $proceed = new Cart;

        return view('products/product-proceeds',compact('carts','proceed','tax','total'));
    }
}
