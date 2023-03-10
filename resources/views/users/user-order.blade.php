@extends('layouts.app')
@section('content')
<content>
<!-- 商品詳細-->
            <div class="w-2/3 m-auto pt-20">
                <h2 class="pb-10">商品詳細</h2>
                <form action="">
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
                                        <label for="">価格</label>
                                        <p>{{ $product->cake_price}}</p>
                                    </div>

                                    <div class="text-center mx-10"> 
                                        <label for="">サイズ</label>
                                        <input type="text">
                                        <p>{{ $product->cake_size}}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="text-center mt-5">
                        <a href="{{ url()->previous() }}" class="bg-blue-400 text-white rounded py-2.5 px-6 hover:bg-blue-500">
                        戻る
                        </a>
                        <button class="bg-blue-400 text-white rounded py-2.5 px-6 hover:bg-blue-500">order</button>
                        <a href="{{ route('update.index', $product->id) }}" class="bg-blue-400 text-white rounded py-2.5 px-6 hover:bg-blue-500">
                            予約
                        </a>
                    </div>
                </form>
    </content>
@endsection