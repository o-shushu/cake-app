@extends('layouts.app')
@section('content')
<content>
<!-- 店舗変更-->
            <div class="w-4/5 m-auto pt-20">
                <h2 class="pb-10">店舗変更</h2>
                <div  class="shopTable">
                    @if(isset($image_path))
                    <img class="w-1/2 mx-auto" src="{{asset($image_path)}}">
                    @endif
                <form method="POST" action="{{ route('shop.Confirm') }}" enctype="multipart/form-data" class="text-center">
                    @csrf
                    <input class="m-6" type="file" name="image">
                    <button class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500 mr-20">アップロード</button>
                </form>

                <form method="POST" action="{{ route('shop.Store') }}">
                    @csrf
                    <div class="max-w-lg mx-auto mt-10 bg-gray-300 border border-black-500 p-6 rounded-xl text-center">
                    @if(isset($image_path) && isset($image_name))
                        <input type="hidden" name="image_path" value=" {{ $image_path }}">
                        <input type="hidden" name="image_name" value=" {{ $image_name }}">
                        <input type="hidden" name="image_type" value=" {{ $image_type }}">
                    @endif
                    @foreach($information as $item)
                        <div class="p-6 text-center"> 
                            <label for="">店舗ネーム</label>
                            <input type="text" name="shop_name" value="{{ $item->shop_name }}">
                        </div>

                        <div class="p-6 text-center"> 
                            <label for="">アドレス</label>
                            <input type="text" name="residence" value="{{ $item->residence }}">
                        </div>

                        <div class="p-6 text-center"> 
                            <label for="">電話番号</label>
                            <input type="text" name="tel" value="{{ $item->tel }}">
                        </div>

                        <div class="p-6 text-center"> 
                            <label for="">概要</label>
                            <textarea id="story" name="remark" rows="5" cols="48" maxlength="512" value="{{ $item->remark }}">
                            {{ $item->remark }}
                            </textarea>
                        </div>
                    @endforeach
                    <div class="text-center mt-5">
                    <a href="{{ route('shop.detail') }}" class="bg-blue-400 text-white rounded py-2.5 px-6 hover:bg-blue-500">
                    戻る
                    </a>
                    <button class="bg-blue-400 text-white rounded py-2.5 px-6 hover:bg-blue-500" type="submit">送る</button>
                    </div>
                </form>
            </div>

    </content>
    
    <footer class="bg-yellow-300 ">

    </footer>
@endsection