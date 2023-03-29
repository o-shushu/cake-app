@extends('layouts.app')
@section('content')
<content>
<!-- 商品一覧 -->
    <div class="pb-10 w-3/4 m-auto pt-20 text-justify">
        <h2>商品一覧</h2>
        <div class="text-center">
            @if(session('alert'))
                <div class="alert alert-info text-red">{{ session('alert') }}</div>
            @else
                @if(isset($message))
                    <p style = 'color:red;'>{{$message}}</p>
                @endif
            @endif
        </div>
        <div class="flex  flex-wrap justify-between">
        @if(isset($cakes)) 
            @foreach ($cakes as $cake)
            <div class="w-1/2 mt-5 bg-gray-100 border border-gray-200 p-2 rounded-xl">
                @foreach($cake->images as $cakeImage)
                    <img class="h-3/5 w-4/5 mx-auto rounded" src="{{ asset($cakeImage->tmp_name) }}">
                @endforeach
                <div class="w-4/5">
                    <p>{{$cake->cake_name}}</p>
                    <div class="flex justify-center mt-5">
                        <a href="{{ route('home.ProductDetail', $cake->id) }}" class="bg-yellow-400 text-white rounded py-2.5 px-4 hover:bg-yellow-500 mr-20">
                            詳細
                        </a>
                        @auth
                            @if($like_model->like_exist(Auth::user()->id,$cake->id))
                            <p class="bg-yellow-400 rounded py-2.5 px-4 hover:bg-yellow-500 mr-20">
                                <a class="cake-like-toggle text-red-500 cursor-pointer" data-cake-id="{{$cake->id}}"><i class="fas fa-heart"></i></a>
                                <span class="likesCount">{{$cake->likes_count}}</span>
                            </p>
                            @else
                            <p class="bg-yellow-400 rounded py-2.5 px-4 hover:bg-yellow-500 mr-20">
                                <a class="cake-like-toggle cursor-pointer" data-cake-id="{{$cake->id}}"><i class="fas fa-heart"></i></a>
                                <span class="likesCount">{{$cake->likes_count}}</span>
                            </p>
                            @endif 
                        @endauth
                        @guest
                        <p class="bg-yellow-400 rounded py-2.5 px-4 hover:bg-yellow-500 mr-20">
                            <i class="fas fa-heart"></i>
                            <span class="likesCount">{{$cake->likes_count}}</span>
                        </p>
                        @endguest
                    </div>
                    @if(isset(auth()->user()->type) && auth()->user()->type === '2')

                    @else
                        <div class="mt-5">
                            <a data-cake-id="{{$cake->id}}" data-shop-id="{{$cake->shop_id}}" class="shopsInputCart bg-blue-400 text-white rounded py-2.5 px-6 hover:bg-blue-500">
                            カートに入れる
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        <div >
            <div class="justify-center">{{ $cakes->onEachSide(2)->links() }}</div>
        </div>
        @endif  
    </div>
</content>

  
<footer class="bg-yellow-300 ">

</footer>
@endsection