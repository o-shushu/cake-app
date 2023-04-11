@extends('layouts.app')
@section('content')
<content class="">
 <!-- 人気店 -->    
   <div class="w-2/3 m-auto">
        <div class="text-center mb-3">
            <span class="font-bold border-t-2 border-yellow-400 text-2xl">人気店</span>
        </div>
        <div id="banner" class="relative w-full mx-auto mt-10 p-2 bg-white shadow-2xl border-2">
            <ul id="slider-wrapper" class="relative w-full h-[50vh] md:h-[60vh] flex overflow-hidden">
                @if(isset($chunkShopLike))
                @foreach($chunkShopLike[0] as $item)
                <li>
                    <a href="{{ route('home.Product', $item->shop->id) }}">
                    <img class="absolute w-full h-full object-cover transition-transform duration-1000" src="{{asset($item->shop->images->first()->tmp_name)}}" alt="exp1">
                    </a>
                </li>
                @endforeach
                @endif
                <div class="absolute px-4 top-[50%] flex justify-between w-full">
                    <div class="px-2 py-1 rounded-full bg-white/70 hover:bg-white" id="prev"><i class="fas fa-backward"></i></div>
                    <div class="px-2 py-1 rounded-full bg-white/70 hover:bg-white" id="next"><i class="fas fa-forward"></i></div>
                </div>
            </ul>            
        </div>
    </div> 
<!-- 人気商品のおすすめ -->               
    <div id="products" class="w-2/3 m-auto pt-20">
        <div class="text-center mb-3">
            <span class="font-bold border-t-2 border-yellow-400 text-2xl">おすすめ商品</span>
        </div>
        <button id="moreLook" class="bg-yellow-400 rounded h-8 mb-3">もっと見る</button>
        <div class="block sm:flex relative">
            @if(isset($chunkCakeLike))
            @foreach($chunkCakeLike[0] as $item)
                <div class="border h-60 m-auto">
                    <a href="{{ route('home.ProductDetail', $item->cake->id) }}">
                        <img class="h-3/4 w-60 mx-auto rounded" src="{{ asset($item->cake->images->first()->tmp_name) }}">
                    </a>
                    <h3 class="text-center">{{$item->cake->cake_name}}</h3>
                    @auth
                        @if($likeCake_model->like_exist(Auth::user()->id,$item->cake->id))
                            <div class="m-auto">
                                <a class="cake-like-toggle text-red-500 cursor-pointer" data-cake-id="{{$item->cake->id}}"><i class="fas fa-heart"></i></a>
                                <span class="likesCount">{{$item->total}}</span>
                            </div>
                        @else
                            <div class="m-auto">
                                <a class="cake-like-toggle cursor-pointer" data-cake-id="{{$item->cake->id}}"><i class="fas fa-heart"></i></a>
                                <span class="likesCount">{{$item->total}}</span>
                            </div>
                        @endif 
                    @endauth
                    @guest
                        <div class="m-auto">
                            <i class="fas fa-heart"></i>
                            <span class="likesCount">{{$item->total}}</span>
                        </div>
                    @endguest
                </div>
            @endforeach
            @endif
        </div>
<!-- もっと見る -->
        <div class="lookMoreProducts fixed z-10 bg-gray-200 w-2/3 h-screen top-0 overflow-scroll hidden">
            <div class="text-center mb-3">
                <span class="font-bold border-t-2 border-yellow-400 text-2xl">おすすめ商品</span>
            </div>
            <div class="float-right">
                <div class="grid-cols-1 md:gap-x-20 sm:grid-cols-2 grid justify-between lg:gap-x-40">
                    @if(isset($cakesLike)) 
                    @foreach ($cakesLike as $item)                 
                        <div class="h-4/5 mt-5 bg-gray-100 border border-gray-200 p-2 rounded-xl text-center">
                            <div class="h-4/5">
                            <a class="h-3/4 w-3/4 mx-0" href="{{ route('home.ProductDetail', $item->cake->id) }}">
                                <img class="h-3/4 w-full mx-auto rounded" src="{{ asset($item->cake->images->first()->tmp_name) }}">
                            </a>
                            <div class="mt-4">{{$item->cake->cake_name}}</div>
                        </div>
                        <div class="flex justify-around w-full h-1/5 bg-yellow-400 rounded hover:bg-yellow-500">
                            @auth
                                @if($likeCake_model->like_exist(Auth::user()->id,$item->cake->id))
                                <div class="m-auto">
                                    <a class="cake-like-toggle text-red-500 cursor-pointer" data-cake-id="{{$item->cake->id}}"><i id="click{{$item->cake->id}}" class="fas fa-heart"></i></a>
                                    <span class="likesCount">{{$item->total}}</span>
                                </div>
                                @else
                                <div class="m-auto">
                                    <a class="cake-like-toggle cursor-pointer" data-cake-id="{{$item->cake->id}}"><i id="click{{$item->cake->id}}" class="fas fa-heart"></i></a>
                                    <span class="likesCount">{{$item->total}}</span>
                                </div>
                                @endif 
                            @endauth
                            @guest
                                <div class="m-auto">
                                    <i class="fas fa-heart"></i>
                                    <span class="likesCount">{{$item->total}}</span>
                                </div>
                            @endguest
                            @if(isset(auth()->user()->type) && auth()->user()->type === '0')

                            @else
                            <div class="m-auto">
                                <a data-cake-id="{{$item->cake->id}}" data-shop-id="{{$item->cake->shop->id}}" class="shopsInputCart cursor-pointer">
                                カートに入れる
                                </a>
                            </div>

                            @endif
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
<!-- 商店一覧 -->
    <div id="shops" class="w-2/3 m-auto pt-20">
        <div class="text-center mb-3">
            <span class="font-bold border-t-2 border-yellow-400 text-2xl">店舗一覧</span>
        </div>      
        <div class="grid-cols-1 gap-x-5 sm:gap-x-10 md:gap-x-20 sm:grid-cols-2 grid justify-between lg:gap-x-40">
            @if(isset($shops)) 
            @foreach ($shops as $shop)
            @php
                $shopImages = $shop->images()->shopImages()->get();
            @endphp
            <div class="h-4/5 mt-5 bg-gray-100 border border-gray-200 p-2 rounded-xl text-center shadow-lg">
                @foreach($shopImages as $shopImage)
                <a href="{{ route('home.Product', $shopImage->shop_id) }}">
                    <img class="h-3/4 w-full mx-auto rounded" src="{{ asset($shopImage->tmp_name) }}" alt="">
                </a>
                @endforeach
                <div class="flex justify-around mt-2">
                    <p class="">{{$shop->shop_name}}</p>                           
                    @auth
                        @if($likeShop_model->like_exist(Auth::user()->id,$shop->id))
                        <div>
                            <a id="js-like-toggle" class="js-like-toggle text-red-500 cursor-pointer" data-shop-id="{{$shop->id}}"><i class="fas fa-heart"></i></a>
                            <span class="likesCount">{{$shop->likes_count}}</span>
                        </div>
                        @else
                        <div>
                            <a class="js-like-toggle cursor-pointer" data-shop-id="{{$shop->id}}"><i class="fas fa-heart"></i></a>
                            <span class="likesCount">{{$shop->likes_count}}</span>
                        </div>
                        @endif 
                    @endauth
                    @guest
                        <div>
                            <i class="fas fa-heart"></i>
                            <span class="likesCount">{{$shop->likes_count}}</span>
                        </div>
                    @endguest
                </div>
            </div>
            @endforeach
            @endif  
        </div>
        <div class="mb-3">
            <div class="justify-center">{{ $shops->links() }}</div>
        </div>
    </div>
</content>
@endsection