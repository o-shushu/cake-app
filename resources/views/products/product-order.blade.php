@extends('layouts.app')
@section('content')
<content>
<!-- 商品注文明細-->
    <div class="w-2/3 m-auto">
        <h2 class="pb-3 ">
            <span class="font-bold border-t-2 border-yellow-400 text-2xl">商品注文明細</span>  
        </h2>
        <div class="mb-3">
            <select name="" id="detail" onchange="location.href= document.getElementById('detail').value;" class="border border-gray-400 cursor-pointer">
                <option value="{{route('orders.index')}}">商品注文明細</option>
                <option value="{{route('orders.index', ['reserved' => true])}}" @if($is_reserved) selected @endif>商品予約明細</option>
            </select>
        </div>
        <div class="">
            <table class="w-full border border-gray-900">
                <tr>
                    <th>番号</th>
                    <th>ユーザー名</th>
                    <th>到着予定</th>
                    <th>支払方法</th>
                    <th>配達地</th>
                    <th>備考</th>
                    <th>生成時間</th>
                    <th>注文状態</th>
                    <th>操作</th>
                </tr>
                @foreach($carts as $cart)
                @if(isset($cart) && !is_null($cart->order))
                <tr>
                    <td>{{$cart->order->orderNo}}</td>
                    <td>{{$cart->order->user->name}}</td>
                    <td>{{$cart->order->appointment_time}}</td>
                    <td>{{$cart->order->payment_method}}</td>
                    <td>{{$cart->order->delivery_place}}</td>
                    <td>{{$cart->order->content}}</td>
                    <td>{{$cart->order->created_at}}</td>
                    <td>
                        <select name="" id="orderStatus" data-shop-id="{{$shop->id}}" data-order-id="{{$cart->order->id}}" class="border border-gray-400 cursor-pointer">
                            @foreach($orderStatus as $val)
                            @if($cart->order_status == $val['status'])
                                <option value="{{$val['status']}}" selected>{{$val['status']}}</option>
                            @else
                                <option value="{{$val['status']}}">{{$val['status']}}</option>
                            @endif
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <a href="{{route('orders.detailIndex',$cart->order->orderNo)}}" class="bg-blue-400 rounded hover:bg-blue-500">詳細</a>
                    </td>
                </tr>
                @endif
                @endforeach
            </table>
        </div>
    </div>
</content>
@endsection