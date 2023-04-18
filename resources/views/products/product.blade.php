@extends('layouts.app')
@section('content')
<content>
<!-- 商品一覧 -->
    <div class="pb-10 w-3/4 m-auto text-justify">
        <h2 class="pb-3 ">
            <span class="font-bold border-t-2 border-yellow-400 text-2xl">商品一覧</span>  
        </h2>
        <div class="text-center">
            @if(session('alert'))
                <div class="alert alert-info text-red">{{ session('alert') }}</div>
            @else
                @if(isset($message))
                    <p style = 'color:red;'>{{$message}}</p>
                @endif
            @endif
        </div>
        @if(isset($cakes)) 
        <div class="grid-cols-1 md:gap-x-20 sm:grid-cols-2 grid justify-between lg:gap-x-40">
            @foreach ($cakes as $cake)
            <div class="mt-5 bg-gray-100 border border-gray-200 p-2 rounded-xl text-center">
                @foreach($cake->images as $cakeImage)
                <div class="h-4/5">
                    <a class="h-3/4 w-3/4 mx-0" href="{{ route('home.ProductDetail', $cake->id) }}">
                        <img class="h-[90%] w-full mx-auto rounded" src="{{ asset($cakeImage->tmp_name) }}">
                    </a>
                    <div class="mt-4">{{$cake->cake_name}}</div>
                </div>
                @endforeach
                <div class="flex justify-around w-full h-1/5">
                    @auth
                        @if($likeCake_model->like_exist(Auth::user()->id,$cake->id))
                        <div class="text-2xl m-auto">
                            <a class="cake-like-toggle text-red-500 cursor-pointer" data-cake-id="{{$cake->id}}"><i class="fas fa-heart"></i></a>
                            <span class="likesCount">{{$cake->likes_count}}</span>
                        </div>
                        @else
                        <div class="text-2xl m-auto">
                            <a class="cake-like-toggle cursor-pointer" data-cake-id="{{$cake->id}}"><i class="fas fa-heart"></i></a>
                            <span class="likesCount">{{$cake->likes_count}}</span>
                        </div>
                        @endif 
                    @endauth
                    @guest
                        <div class="text-2xl m-auto">
                            <i class="fas fa-heart"></i>
                            <span class="likesCount">{{$cake->likes_count}}</span>
                        </div>
                    @endguest
                    @if(isset(auth()->user()->type) && (auth()->user()->type === '0' || auth()->user()->type === '2'))
                    <div class="m-auto">
                        <a href="{{ route('home.ProductDetail', $cake->id) }}">
                           詳細
                        </a>
                    </div>
                    @else
                    <div class="text-2xl m-auto">
                        <a data-cake-id="{{$cake->id}}" data-shop-id="{{$cake->shop_id}}" class="shopsInputCart cursor-pointer text-xs lg:text-xl text-white font-semibold bg-emerald-500 hover:bg-emerald-700 px-4 py-3 rounded-lg shadow-sm">
                        カートに入れる
                        </a>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        <div class="justify-center mt-3">{{ $cakes->onEachSide(2)->links() }}</div>
        @endif  
    </div>
</content>
@endsection