@extends('layouts.app')
@section('content')
<content>
<!-- 購入詳細-->
    <div class="w-2/3 m-auto">
        <h2 class="pb-3 ">
            <span class="font-bold border-t-2 border-yellow-400 text-2xl">購入詳細</span>  
        </h2>
        @foreach($carts as $item)     
            @php
                $products = $model->where('shop_id',$item->shop->id)->where('order_id',$item->order_id);
            @endphp

            <p class="text-lg">店舗名:{{$item->shop->shop_name}}</p>
            @if($item->order_status == null)
                <p class="text-lg">注文状態：<span class="bg-red-300 rounded">未開始</span></p>
            @else
                <p class="text-lg">注文状態：<span class="bg-red-300 rounded">{{$item->order_status}}</span></p>
            @endif
            <table class="w-full border border-gray-900 text-left text-xs sm:text-base">
                <tr>
                    <th>番号</th>
                    <th>商品名</th>
                    <th>サイズ</th>
                    <th>価格</th>
                    <th>個数</th>
                    <th>小計</th>
                </tr>
                @foreach($products as $product)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$product->cake->cake_name}}</td>
                    <td>{{$product->size}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->amount}}</td>
                    <td>{{$product->subtotal}}</td> 
                </tr>
                @endforeach
            </table>
        @endforeach
        <div class="mt-10">
            <a href="{{ url()->previous() }}" class="bg-blue-400 text-white rounded py-2.5 px-6 hover:bg-blue-500">
            戻る
            </a>
        </div> 
    </div>  
@endsection