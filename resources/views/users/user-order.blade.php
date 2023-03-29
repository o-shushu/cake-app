@extends('layouts.app')
@section('content')
<content>
<!-- 商品詳細-->
            <div class="w-2/3 m-auto pt-20">
                <h2 class="pb-10">商品詳細</h2>
                <div class="flex">
                    <div class="w-1/3" >
                        @if(isset($cakeImagePath))
                            <img src="{{asset($cakeImagePath)}}">
                        @endif
                    </div>
                    <div>
                        @foreach ($products as $product)
                        <div class="p-6"> 
                            <label for="">詳細</label><br/>
                            <p>{{ $product->cake_content}}</p>
                        </div>
                        
                        <div class="flex">
                            <div class="text-center mx-10"> 
                                <label for="">ネーム</label>
                                <p>{{ $product->cake_name}}</p>
                            </div>

                            <div class="text-center mx-10"> 
                                <label for="">カテゴリー</label>
                                <p>{{ $product->cake_category}}</p>
                            </div>

                            <div class="text-center mx-10"> 
                                <label for="">価格</label>
                                <p id="price">price</p>
                            </div>
                            
                            <div>
                                <label for="">サイズ</label>
                                <select id="size" class="border border-gray-400 p-2 w-full">
                                @foreach($product->cakecontent as $value)
                                    <option value="{{ $value->cake_price }}">{{ $value->cake_size }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        @endforeach
                        <div>
                            <label for="">個数</label>
                            <i class="fa-solid fa-circle-minus"></i>
                            <span id="edit_area">1</span>
                            <i class="fa-solid fa-circle-plus"></i>
                        </div>
                    </div>
                </div>
                <div class="flex text-center mt-5">
                    <div>
                        <a href="{{ url()->previous() }}" class="bg-blue-400 text-white rounded py-2.5 px-6 hover:bg-blue-500">
                        戻る
                        </a>
                    </div>
                    <div>
                        <a data-cake-id="{{$product->id}}" data-shop-id="{{$product->shop_id}}" class="cart-input bg-blue-400 text-white rounded py-2.5 px-6 hover:bg-blue-500">
                        カートに入れる
                        </a>
                    </div>
                    <div>
                        <a href="{{ route('update.index', $product->id) }}" class="bg-blue-400 text-white rounded py-2.5 px-6 hover:bg-blue-500">
                            予約
                        </a>
                    </div>
                </div>
            </div>
    </content>

<script>
$('.fa-circle-plus').click(function(){
    var amount = $("#edit_area").text();
    amount++;
    document.getElementById('edit_area').innerHTML = amount ;

});
$('.fa-circle-minus').click(function(){
    var amount = $("#edit_area").text();
    amount--;
    if(amount >= 1){
        document.getElementById('edit_area').innerHTML = amount ;
    }
    if(amount < 1){
        var amount = 1;
        document.getElementById('edit_area').innerHTML = amount ;
    }
});

</script>
@endsection