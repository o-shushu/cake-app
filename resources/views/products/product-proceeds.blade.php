@extends('layouts.app')
@section('content')
<content>
<!-- 商品売上-->
    <div class="w-2/3 m-auto">
        <h2 class="pb-3 ">
            <span class="font-bold border-t-2 border-yellow-400 text-2xl">商品売上</span>  
        </h2>
        <p class="mb-3"><a href="{{route('output.pdf')}}" class="bg-green-300 hover:bg-green-500 rounded">PDF出力</a></p>
        <div class="">
            <table class="w-full border border-gray-900 overflow-scroll">
                <tr class="border border-gray-900">
                    <th>番号</th>
                    <th>商品名</th>
                    <th>サイズ</th>
                    <th>価格</th>
                    <th>販売量</th>
                    <th>小計</th>
                </tr>
                @foreach($carts as $cart)
                    @php
                    $amount = $proceed->amount($cart->size,$cart->cake_id);
                    $subtotal = $proceed->subtotal($cart->size,$cart->cake_id);
                    @endphp
                    <tr class="text-center">
                        <td>{{$loop->iteration}}</td>
                        <td>{{$cart->cake->cake_name}}</td>
                        <td>{{$cart->size}}</td>
                        <td>{{$cart->price}}</td>
                        <td>{{$amount}}</td>
                        <td>{{$subtotal}}</td>
                    </tr>
                @endforeach
            </table>
            @if(isset($tax) && isset($total))
            <div class="text-right">
                <p>税金:{{$tax}}円</p>
                <p>総計:{{$total}}円</p>
            </div>
            @endif
        </div>
    </div>
</content>
@endsection