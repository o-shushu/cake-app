@extends('layouts.app')
@section('content')
<content>
<!-- 店舗情報-->
    <div class="flex flex-col w-1/2 mx-auto mb-5">
        <h2 class="font-bold my-5 border-b border-gray-400">店舗情報</h2>
        <div  class="flex flex-col">
            @if(isset($image_path))
            <img class="w-1/2 mx-auto mb-4" src="{{asset($image_path)}}">
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
                    概要
                    <p>{{ $item->remark }}</p>
                </div>
            @endforeach
        </div>
        <div class="mt-5 flex gap-2">
        <a href="{{ route('product.show') }}" class="bg-blue-400 text-white rounded py-2.5 px-6 hover:bg-blue-500">
        戻る
        </a>
        <a href="{{ route('shop.Update') }}" class="bg-blue-400 text-white rounded py-2.5 px-6 hover:bg-blue-500">
        変更
        </a>
        </div>
    </div>

</content>

<footer class="bg-yellow-300 ">

</footer>
@endsection