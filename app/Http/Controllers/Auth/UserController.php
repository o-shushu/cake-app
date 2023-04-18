<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Residence;
use Illuminate\Http\Request;
use App\Models\Cakecontent;
use App\Models\Cart;
use Carbon\Carbon;
use App\Models\Order;

class UserController extends Controller
{
//ユーザー情報表示
    public function userDetail()
    {
        $userInformation = User::all()->where('id', auth()->user()->id);
        foreach($userInformation as $item){
            $residence_id = $item->residence_id;
        }
        $residence = Residence::all()->where('id', $residence_id);

        return view('users/user-detail', compact('userInformation', 'residence'));
    }

//ユーザー情報更新
    public function userUpdate()
    {
        $residences = Residence::all();
        $userInformation = User::all()->where('id', auth()->user()->id);
        foreach($userInformation as $item){
            $residence_id = $item->residence_id;
        }
        
        $residence = Residence::all()->where('id', $residence_id);
        return view('users/user-update', compact('userInformation', 'residence', 'residences'));
    }

//ユーザー情報処理
    public function userStore(Request $request)
    {
        
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|string',
            'tel' => 'required|numeric|digits_between:10,11',
            'residence' => 'required',
            'userId' => 'required',
        ]);

        $user_id = $request->input('userId');
        $user_name = $request->input('name');
        $user_email = $request->input('email');
        $user_tel = $request->input('tel');
        $user_residence = $request->input('residence');
       
        if(auth()->user()->type !== '0'){
            User::where('id', auth()->user()->id)
            ->update(['name'=>$user_name, 'email'=>$user_email, 'tel'=>$user_tel, 'residence_id'=>$user_residence]) ;
            return redirect('user/detail');
        }

        User::where('id', $user_id)
        ->update(['name'=>$user_name, 'email'=>$user_email, 'tel'=>$user_tel, 'residence_id'=>$user_residence]) ;
    
        $userInformation = User::where('id', $user_id)->first();
        $type = $userInformation->type;
        
        if($type == 2){
            $user = 'shopkeepers';
            $users = User::where('type',2)->paginate(10);
            return view('manager/manage-users',compact('users','user'));
        }

        $users = User::where('type',1)->paginate(10);
        return view('manager/manage-users',compact('users'));
    }

//商品詳細ページからカートに入れる
    public function inputCart(Request $request)
    {
        if(!isset(auth()->user()->id)){
            return response('noLogin', 200);
        }

        $data = $request->validate([
            'cake_id' => 'required',
            'amount'=> 'required',
            'price'=> 'required',
            'shop_id'=> 'required'
        ]);

        $cakecontent = Cakecontent::where('cake_id', $data['cake_id'])->where('cake_price',$data['price'])->first();

        $cart = new Cart;
        $cart->user_id = auth()->id();
        $cart->cake_id = $data['cake_id'];
        $cart->shop_id = $data['shop_id'];
        $cart->size = $cakecontent->cake_size;
        $cart->price = $data['price'];
        $cart->amount = $data['amount'];
        $cart->subtotal = $data['amount'] * $data['price'];
        $cart->order_id = 0;//订单未成立
        $cart->pay_status = 0;//0为未支付，1为已支付
        $cart->save();

        $haved = Cart::where('user_id', auth()->id())->where('cake_id',$data['cake_id'])->first();
        //カートに入れるかどうかチェック
        if(!is_null($haved)){
            return response('Success', 200);
        }
        
        return response('Error', 200);
    }

//商品詳細ではないページからカートに入れる
    public function shopsInputCart(Request $request)
    {
        if(!isset(auth()->user()->id)){
            return response('noLogin', 200);
        }
        
        $data = $request->validate([
            'cake_id' => 'required',
            'shop_id'=> 'required'
        ]);
        $cakecontent = Cakecontent::where('cake_id', $data['cake_id'])->first();

        $cart = new Cart;
        $cart->user_id = auth()->id();
        $cart->cake_id = $data['cake_id'];
        $cart->shop_id = $data['shop_id'];
        $cart->size = $cakecontent->cake_size;
        $cart->price = $cakecontent->cake_price;
        $cart->amount = 1;
        $cart->subtotal = 1 * $cakecontent->cake_price;
        $cart->order_id = 0;//订单未成立
        $cart->pay_status = 0;//0为未支付，1为已支付
        $cart->save();

        $haved = Cart::where('user_id', auth()->id())->where('cake_id',$data['cake_id'])->first();
    
        if(!is_null($haved)){
            return response('Success', 200);
        }

        return response('Error', 200);
    }

//カート一覧ページ
    public function indexCartPage()
    {
        $carts = Cart::with('cake')->with('shop')->where('user_id',auth()->user()->id)->where('pay_status',0)->paginate(3);
        $products = User::find(auth()->user()->id)->carts->where('pay_status',0);

        $subtotal = 0;
        foreach($products as $product){
           $x = $product->subtotal;
           $subtotal = $x + $subtotal;
        }
        $tax = $subtotal * 0.08;
        $total = $tax + $subtotal;
        $dt = new Carbon();
        $date = $dt->addDays(3)->toDateString(); // 2018-08-11
        $pay_model = new Cart;

        return view('users/user-cart', compact('carts','tax','total','subtotal','date','pay_model'));
    }

//カートから削除
    public function deleteCart($cartId)
    {
        Cart::where('id',$cartId)->delete();
        return redirect('user/indexCart');
    }

//カート内の商品を編集
    public function editCart(Request $request)
    {
        $data = $request->validate([
            'cartId' => 'required',
            'cake_amount'=> 'required',
            'price'=> 'required'
        ]);
        $subtotal = $data['cake_amount'] * $data['price'];

        Cart::where('id',$data['cartId'])->update(
            ['amount' => $data['cake_amount'],
             'subtotal' => $subtotal,
            ]
        );
      
        return response('Success', 200);
    }

//注文の支払う、またorder生成
    public function orderPay(Request $request)
    {
        $rules = [
            'delivery_place' => 'required',
        ];
        
        $messages = [ 'required' => '配達地は必須項目です。'];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        };


        $dt = new Carbon();
        $date = $dt->format('YmdHis');
        $orderNo = $date.auth()->id();

        $order = new Order;
        $order->user_id = auth()->id();
        $order->orderNo = $orderNo;
        $order->appointment_time = $request->input('appointment_time');
        $order->total_price = $request->input('total_price');
        $order->payment_method = $request->input('payment_method');
        $order->delivery_place = $request->input('delivery_place');
        $order->content = $request->input('content');   
        $order->flag = 1;//１理論存在、０理論削除
        $order->save();

        $order = Order::where('orderNo',$orderNo)->first();
        $orderId = $order->id;
        Cart::with('cake')->with('shop')->where('user_id',auth()->user()->id)->where('pay_status',0)
        ->update(['order_id'=>$orderId]);
        Cart::with('cake')->with('shop')->where('order_id',$orderId)->update(['pay_status'=>1]);
        
        return redirect('user/indexCart');
        
    }

//会員ユーザーの購入記録ページ
    public function buyCodeIndex()
    {
        $orders = Order::where('user_id',auth()->id())->where('flag',1)->get();
        return view('users/user-code',compact('orders'));
    }

//会員ユーザーの購入記録削除
    public function buyCodeDelete($orderId)
    {

        Order::where('id',$orderId)->update(['flag'=>0]);
        $orders = Order::where('user_id',auth()->id())->where('flag',1)->get();
        return view('users/user-code',compact('orders'));
    }

//会員ユーザーの購入記録詳細
    public function buyCodeDetail($orderId)
    {
        $carts = Cart::with('shop')->where('order_id',$orderId)->select('shop_id','order_id','order_status')
        ->groupBy('shop_id','order_id','order_status')->get();
        $model = Cart::with('cake')->get();

        return view('users/user-codedetail',compact('carts','model'));
    }

}