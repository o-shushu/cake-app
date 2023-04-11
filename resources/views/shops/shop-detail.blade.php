@extends('layouts.app')
@section('content')
<content>
<!-- 店舗情報-->
    <div class="flex flex-col w-4/5 sm:w-1/2 mx-auto mb-5">
        <h2 class="pb-3 ">
            <span class="font-bold border-t-2 border-yellow-400 text-2xl">店舗情報</span>  
        </h2>
        <div  class="flex flex-col">
            @if(isset($image_path))
            <img class="w-full m-auto sm:w-1/2 sm:first-letter:mx-auto mb-4" src="{{asset($image_path)}}">
            @endif
            @foreach($information as $item)
                <div class="border border-gray-700">
                    店舗ネーム:<span>{{ $item->shop_name }}</span>
                </div>
                <div class="border border-gray-700">
                    アドレス:<span>{{ $item->residence }}</span>
                </div>
                <div class="border border-gray-700">
                    電話番号:<span>{{ $item->tel }}</span>
                </div>
                <div class="border border-gray-700">
                    <label for="">概要:</label>
                    <textarea id="story" name="remark" rows="5" cols="48" maxlength="512" value="{{ $item->remark }}" class="h-20 w-full">{{ $item->remark }}
                    </textarea>
                </div>
        </div>
            <div class="mt-5 flex gap-2 justify-around">
                <a href="{{ url()->previous() }}" class="bg-blue-400 text-white rounded py-2.5 px-6 hover:bg-blue-500">
                    戻る
                </a>
                <a href="{{ route('shop.Update',$item->id) }}" class="bg-blue-400 text-white rounded py-2.5 px-6 hover:bg-blue-500">
                    変更
                </a>
            </div>
            @endforeach
    </div>

</content>

<footer class="bg-yellow-300 ">

</footer>
@endsection