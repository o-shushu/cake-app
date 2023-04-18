@extends('layouts.app')
@section('content')
<content>
<!-- 店舗変更-->
            <div class="w-2/3 m-auto">
                <h2 class="pb-3 ">
                    <span class="font-bold border-t-2 border-yellow-400 text-2xl">店舗変更</span>  
                </h2>
                <div class="block sm:flex mb-3 text-center">
                    <div class="w-4/5 sm:w-1/2 m-auto">
                        @if(isset($image_path))
                        <img class="w-4/5 mx-auto" src="{{asset($image_path)}}">
                        @endif
                        <form method="POST" action="{{ route('shop.Confirm') }}" enctype="multipart/form-data">
                            @csrf
                            <input class="mt-2 w-full sm:w-2/3" type="file" name="image">
                            <input class="mt-2"type="hidden" name="shopId" value="{{$shopId}}">
                            <div class="m-auto">
                                <button  type="submit" class="mt-2 h-10 bg-blue-400 hover:bg-blue-500 rounded ">アップロード</button>
                            </div>
                        </form>
                    </div>
                    <form method="POST" action="{{ route('shop.Store') }}" class="mt-3">
                        @csrf
                        <div class="max-w-lg mx-auto bg-gray-300 border border-black-500 p-6 rounded-xl text-left">
                        @if(isset($image_path) && isset($image_name))
                            <input type="hidden" name="image_path" value=" {{ $image_path }}">
                            <input type="hidden" name="image_name" value=" {{ $image_name }}">
                            <input type="hidden" name="image_type" value=" {{ $image_type }}">
                        @endif
                        @foreach($information as $item)
                            <div class="p-2">
                                <label for="">店舗ネーム:</label></br>
                                <p class="text-red-500">{{ $errors->first('shop_name') }}</p>
                                <input type="text" name="shop_name" value="{{ $item->shop_name }}" class="h-10 w-full">
                            </div>

                            <div class="p-2"> 
                                <label for="">アドレス:</label></br>
                                <p class="text-red-500">{{ $errors->first('residence') }}</p>
                                <input type="text" name="residence" value="{{ $item->residence }}" class="h-10 w-full">
                            </div>

                            <div class="p-2"> 
                                <label for="">電話番号:</label></br>
                                <p class="text-red-500">{{ $errors->first('tel') }}</p>
                                <input type="text" name="tel" value="{{ $item->tel }}" class="h-10 w-full">
                            </div>

                            <div class="p-2"> 
                                <label for="">概要:</label></br>
                                <p class="text-red-500">{{ $errors->first('remark') }}</p>
                                <textarea id="story" name="remark" rows="5" cols="48" maxlength="512" value="{{ $item->remark }}" class="h-20 w-full">{{ $item->remark }}
                                </textarea>
                            </div>
                            <input class="m-6" type="hidden" name="shopId" value="{{$shopId}}">
                            @endforeach
                            <div class="mt-3 flex justify-around gap-10">
                                <a href="{{ route('shop.detail',$item->user_id) }}" class="bg-blue-400 text-white rounded py-2.5 px-6 hover:bg-blue-500">
                                    戻る
                                </a>
                                <button class="bg-blue-400 text-white rounded py-2.5 px-6 hover:bg-blue-500" type="submit">送る</button>
                            </div>
                        </div>
                    </form>
               </div>
            </div>

    </content>
    
    <footer class="bg-yellow-300 ">

    </footer>
@endsection