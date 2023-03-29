@extends('layouts.app')
@section('content')
<content>
<!-- 購入詳細-->
    <div class="w-2/3 m-auto pt-20">
        <h2 class="pb-10">購入詳細</h2>
        @foreach($carts as $item)
        
        @php
            $products = $model->where('shop_id',$item->shop->id)->where('order_id',$item->order_id);
        @endphp
       
        <p>店舗:{{$item->shop->shop_name}}</p>
        @if($item->order_status == null)
            <p>注文状態：未開始</p>
        @else
            <p>注文状態：{{$item->order_status}}</p>
        @endif
        <table class="w-full border border-gray-900 text-left">
                        <tr>
                            <th>番号</th>
                            <th>商品名</th>
                            <th>サイズ</th>
                            <th>価格</th>
                            <th>個数</th>
                            <th>小計</th>
                            <th>備考</th>
                        </tr>
                        @foreach($products as $product)
                        <tr>
                             <td>{{$loop->iteration}}</td>
                             <td>{{$product->cake->cake_name}}</td>
                             <td>{{$product->size}}</td>
                             <td>{{$product->price}}</td>
                             <td>{{$product->amount}}</td>
                             <td>{{$product->subtotal}}</td>
                             <td>{{$product->remark}}</td>   
                        </tr>
                        @endforeach
                    </table>
        @endforeach
    </div>  
@endsection