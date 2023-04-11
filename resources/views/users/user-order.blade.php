@extends('layouts.app')
@section('content')
<content>
<!-- 商品詳細-->
            <div class="w-2/3 m-auto">
                <h2 class="pb-3 ">
                  <span class="font-bold border-t-2 border-yellow-400 text-2xl">商品詳細</span>  
                </h2>
                <div class="block sm:flex gap-10">
                    <div class="w-full sm:w-1/2 h-40 mb-3" >
                    @if(isset($cakeImagePath))
                        <img class="h-40" src="{{asset($cakeImagePath)}}">
                    @endif
                    </div>
                @foreach ($products as $product)
                    <div class="w-full sm:w-1/2 border border-gray-300 h-40"> 
                        <label class="font-bold">詳細:</label><br/>
                        <p>{{ $product->cake_content}}</p>
                    </div>
                </div>
                <div class="block gap-5 sm:flex sm:gap-10 justify-around mt-3 text-left">
                    <div> 
                        <label class="font-bold">商品名:</label>
                        <p>{{ $product->cake_name}}</p>
                    </div>

                    <div> 
                        <label class="font-bold">カテゴリー:</label>
                        <p>{{ $product->cake_category}}</p>
                    </div>

                    <div> 
                        <label class="font-bold">価格:</label>
                        <p id="price">price</p>
                    </div>        
                    <div>
                        <label class="font-bold">サイズ:</label>
                        <select id="size" class="border border-gray-400 p-2 w-full">
                        @foreach($product->cakecontent as $value)
                            <option value="{{ $value->cake_price }}">{{ $value->cake_size }}</option>
                        @endforeach
                        </select>
                    </div>
                
                @endforeach
                    <div>
                        <label for="">個数</label>
                        <i class="fa-solid fa-circle-minus"></i>
                        <span id="edit_area">1</span>
                        <i class="fa-solid fa-circle-plus"></i>
                    </div>
                </div>
                <div class="block sm:flex justify-around mt-8 text-center mb-3">
                @if(isset(auth()->user()->type) && auth()->user()->type === '0')
                    <div class="my-10">
                        <a href="{{ url()->previous() }}" class="bg-blue-400 text-white rounded py-2.5 px-6 my-5 hover:bg-blue-500">
                        戻る
                        </a>
                    </div>
                @else
                    <div class="my-10">
                        <a href="{{ url()->previous() }}" class="bg-blue-400 text-white rounded py-2.5 px-6 my-5 hover:bg-blue-500">
                        戻る
                        </a>
                    </div>    
                    <div class="my-10">
                        <a data-cake-id="{{$product->id}}" data-shop-id="{{$product->shop_id}}" class="cart-input bg-blue-400 text-white rounded py-2.5 px-6 my-5 hover:bg-blue-500 cursor-pointer">
                        カートに入れる
                        </a>
                    </div>
                @endif
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