@extends('layouts.app')
@section('content')
<content>
<!-- カートページ-->
            <div class="w-4/5 m-auto">
                <h2 class="pb-10"> カートページ</h2>
                <div class="w-full h-40 overflow-scroll">
                    <table class="w-full">
                        <tr class="text-center">
                            <th class="border-b-2 border-indigo-300 ">番号</th>
                            <th class="border-b-2 border-indigo-300 ">店舗名</th>
                            <th class="border-b-2 border-indigo-300">商品名</th>
                            <th class="border-b-2 border-indigo-300">サイズ</th>
                            <th class="border-b-2 border-indigo-300">価格</th>
                            <th class="border-b-2 border-indigo-300">個数</th>
                            <th class="border-b-2 border-indigo-300">小計</th>
                            <th class="border-b-2 border-indigo-300">操作</th>
                        </tr>
                        @foreach($carts as $cart)
                                    
                        <tr class="text-center">
                            <td class="border-b-2 border-indigo-300">{{$loop->iteration}}</td>
                            <td class="border-b-2 border-indigo-300">{{$cart->shop->shop_name}}</td>
                            <td class="border-b-2 border-indigo-300">{{$cart->cake->cake_name}}</td>
                            <td class="border-b-2 border-indigo-300">{{$cart->size}}</td>
                            <td id="price{{$cart->id}}" class="border-b-2 border-indigo-300">{{$cart->price}}</td>
                            <td class="border-b-2 border-indigo-300">
                                <i class="fa-solid fa-circle-minus cursor-pointer" data-cart-id="{{$cart->id}}"></i>
                                <span id="edit{{$cart->id}}">{{$cart->amount}}</span>
                                <i class="fa-solid fa-circle-plus cursor-pointer" data-cart-id="{{$cart->id}}"></i>
                            </td>
                            <td class="border-b-2 border-indigo-300">{{$cart->subtotal}}</td>
                            <td class="border-b-2 border-indigo-300" ><a class="bg-blue-400 rounded hover:bg-blue-500" href="{{ route('deleteCart', $cart->id) }}">削除</a></td>
                        </tr>
                        @endforeach 
                    </table>
                </div>
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
                <div class="my-5">
                    <a href="{{ url()->previous() }}" class="bg-blue-400 text-white rounded py-2.5 px-6 hover:bg-blue-500">
                    戻る
                    </a>
                </div>                 
                <div class="z-10">
                    <form method="POST" action="{{route('orderPay')}}">
                    @csrf    
                        <div>
                            <div class="flex text-left">
                                <div>
                                    <label for="">到着予定日:</label> 
                                    <input type="date" min="{{$date}}" name="appointment_time" class="form-control sale" value="">
                                </div>
                                <div>
                                    <label for="">配達地:</label> 
                                    <input type="text" name="delivery_place">
                                </div>
                                @error('delivery_place')
                                <p style = 'color:red;'> {{ $message }}</p>
                                @enderror
                                <div>
                                    <label for="">支払方法:</label> 
                                    <select name="payment_method" id="">
                                        <option value="クレジットカード">クレジットカード</option>
                                        <option value="PayPay">PayPay</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <p>備考:</p>
                                <textarea name="content" id="" cols="80" rows=""></textarea>
                                <input type="text" name="total_price" value="{{$total}}" class="text-right w-20 hidden" >
                                <button type="submit" class="bg-blue-400 text-white rounded py-2.5 px-6 hover:bg-blue-500 h-10" onclick=" return confirm('本当に支払いますか？')">
                                支払
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </content>
<script>
    $('.fa-circle-plus').click(function(){
        var cartId = $(this).data('cart-id');
        var amount = $("#edit"+cartId).text();
        var price = $("#price"+cartId).text();
        amount++;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/cake-app/public/user/editCart',
            type: 'POST',
            data:{
                'cake_amount': amount,
                'cartId': cartId,
                'price': price
            }
        }).done(function(data){
            location.reload();
        }).fail(function(data, xhr, err){
            console.log('error');
        })

    });
    $('.fa-circle-minus').click(function(){
        var cartId = $(this).data('cart-id');
        var amount = $("#edit"+cartId).text();
        var price = $("#price"+cartId).text();
        console.log(amount);
        if(amount == 1){
            document.getElementById('edit_amount').innerHTML = amount ;
        }else{
            amount--;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/cake-app/public/user/editCart',
                type: 'POST',
                data:{
                    'cake_amount': amount,
                    'cartId': cartId,
                    'price': price
                }
            }).done(function(data){
                location.reload();
            }).fail(function(data, xhr, err){
                console.log('error');
            })
        }
        
    });

</script>
    <footer class="bg-yellow-300 ">

    </footer>
@endsection