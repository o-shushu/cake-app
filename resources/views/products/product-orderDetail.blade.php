@extends('layouts.app')
@section('content')
<content>
<!-- 商品注文詳細-->
            <div class="w-2/3 m-auto pt-20">
                <h2 class="pb-10">商品注文詳細</h2>
                <div class="">
                    <table class="w-full border border-gray-900">
                        <tr>
                            <th class="border-b-2 border-indigo-300 ">番号</th>
                            <th class="border-b-2 border-indigo-300">商品名</th>
                            <th class="border-b-2 border-indigo-300">サイズ</th>
                            <th class="border-b-2 border-indigo-300">価格</th>
                            <th class="border-b-2 border-indigo-300">個数</th>
                            <th class="border-b-2 border-indigo-300">小計</th>
                        </tr>
                        @foreach($carts as $cart)
                        <tr class="text-center">
                            <td class="border-b-2 border-indigo-300">{{$cart->count()}}</td>
                            <td class="border-b-2 border-indigo-300">{{$cart->cake->cake_name}}</td>
                            <td class="border-b-2 border-indigo-300">{{$cart->size}}</td>
                            <td class="border-b-2 border-indigo-300">{{$cart->price}}</td>
                            <td class="border-b-2 border-indigo-300">{{$cart->amount}}</td>
                            <td class="border-b-2 border-indigo-300">{{$cart->subtotal}}</td>
                        </tr>
                        @endforeach
                    </table>
                    <div class="text-right">
                        @if(isset($subtotal) && isset($tax) && isset($total))
                        <div>
                            <label for="">小計:</label>
                            <span>{{$subtotal}}円</span>
                        </div>
                        <div>
                            <label for="">税金:</label>
                            <span>{{$tax}}円</span>
                        </div>
                        <div>
                            <label for="">総計:</label>
                            <span>{{$total}}円</span>
                        </div>
                        @endif 
                    </div> 
                </div>
            </div>

    </content>
    
    <footer class="bg-yellow-300 ">

    </footer>
@endsection