@extends('layouts.app')
@section('content')
<content>
<!-- 商品売上-->
            <div class="w-2/3 m-auto pt-20">
                <h2 class="pb-10">商品売上</h2>
                <p><a href="{{route('output.pdf')}}">PDF出力</a></p>
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
                        <p>税金:{{$tax}}</p>
                        <p>総計:{{$total}}</p>
                    </div>
                    @endif
                </div>
            </div>

    </content>
    
    <footer class="bg-yellow-300 ">

    </footer>
@endsection