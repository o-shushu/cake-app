@extends('layouts.app')
@section('content')
<content>
<!-- カートページ-->
            <div class="w-4/5 m-auto">
                <h2 class="pb-3 ">
                    <span class="font-bold border-t-2 border-yellow-400 text-2xl">カートページ</span>  
                </h2>
                <div>
                    <table class="w-full ">
                        <tr class="text-center text-xs sm:text-lg">
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
                                    
                        <tr class="text-center text-xs sm:text-lg">
                            <td class="border-b-2 border-indigo-300">{{$loop->iteration}}</td>
                            <td class="border-b-2 border-indigo-300">{{$cart->shop->shop_name}}</td>
                            <td class="border-b-2 border-indigo-300">{{$cart->cake->cake_name}}</td>
                            <td class="border-b-2 border-indigo-300">{{$cart->size}}</td>
                            <td id="price{{$cart->id}}" class="border-b-2 border-indigo-300">{{$cart->price}}</td>
                            <td class="border-b-2 border-indigo-300 w-3">
                                <i class="fa-solid fa-circle-minus cursor-pointer" data-cart-id="{{$cart->id}}"></i>
                                <span id="edit{{$cart->id}}">{{$cart->amount}}</span>
                                <i class="fa-solid fa-circle-plus cursor-pointer" data-cart-id="{{$cart->id}}"></i>
                            </td>
                            <td class="border-b-2 border-indigo-300">{{$cart->subtotal}}</td>
                            <td class="border-b-2 border-indigo-300" ><a class="bg-blue-400 rounded hover:bg-blue-500" href="{{ route('deleteCart', $cart->id) }}" onclick=" return confirm('本当に削除しますか？')">削除</a></td>
                        </tr>
                        @endforeach 
                    </table>
                    <div>
                        <div class="justify-center mt-6">{{ $carts->links() }}</div>
                    </div>
                </div>
                <div>
                    <div class="justify-between flex">
                        <div>
                            <p style = 'color:red;'>*到着予定日を指定されない場合は当日に配達します。</p>
                        </div>
                        <div>
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
                    <div>
                        <form method="POST" action="{{route('orderPay')}}">
                        @csrf    
                            <div>
                                <div class="block sm:flex text-left">
                                    <div>
                                        <label for="">到着予定日:</label></br>  
                                        <input type="date" min="{{$date}}" name="appointment_time" class="form-control sale border border-gray-500 h-8 w-40 sm:w-full" value="">
                                    </div>
                                    <div>
                                        <label for="">支払方法:</label></br> 
                                        <select name="payment_method" class="border border-gray-500 h-8 w-40 sm:w-full">
                                            <option value="クレジットカード">クレジットカード</option>
                                            <option value="PayPay">PayPay</option>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <label for="">配達地:</label> 
                                    @error('delivery_place')
                                    <span style = 'color:red;'> {{ $message }}</span>
                                    @enderror
                                    <input type="text" name="delivery_place" placeholder="○○県○○市○○町○○丁目○○部屋番号" class="border border-gray-500 h-8 w-full text-sm">
                                </div>
                                
                                <div>
                                    <p>備考:</p>
                                    <textarea class="w-full border border-gray-500" name="content" id="" cols="80" rows=""></textarea>
                                    <input type="text" name="total_price" value="{{$total}}" class="text-right w-20 hidden" >
                                </div>
                                <div class="my-5 w-full flex text-center gap-4">
                                    <a href="{{ url()->previous() }}"class="bg-blue-400 text-white rounded py-2.5 px-6 hover:bg-blue-500 w-1/2 h-10 cursor-pointer">戻る</a>
                                    <button type="submit" class="bg-blue-400 text-white rounded py-2.5 px-6 hover:bg-blue-500 h-10 w-1/2" onclick=" return confirm('本当に支払いますか？')">
                                    支払
                                    </button>
                                </div> 
                            </div>
                        </form>
                    </div>
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
@endsection