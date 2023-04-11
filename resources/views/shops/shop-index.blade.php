@extends('layouts.app')
@section('content')
<content>
<!-- 店舗情報登録-->
            <div class="w-4/5 m-auto pt-20">
                <h2 class="pb-10">店舗情報登録</h2>
                <div  class="flex">
                    <div class="w-1/3">
                        @if(isset($image_path))
                            <img src="{{asset($image_path)}}">
                        @endif
                        <form method="POST" action="{{ route('shop.confirm') }}" enctype="multipart/form-data" class="text-center">
                            @csrf
                            <input class="my-6" type="file" name="image">
                            <button class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500">アップロード</button>
                        </form>
                    </div>
                    <div class="w-4/5 ml-5 bg-blue-100 border border-yellow-200 p-6 rounded-xl ">
                        <form action="{{ route('shop.upload') }}" class="text-right ">
                            @if(isset($image_path) && isset($image_name))
                                <input type="hidden" name="image_path" value=" {{ $image_path }}">
                                <input type="hidden" name="image_name" value=" {{ $image_name }}">
                                <input type="hidden" name="image_type" value=" {{ $image_type }}">
                            @endif
                            <div>
                                <label for="">店舗ネーム</label>
                                <input type="text" name="shop_name" class="w-4/5 h-10 my-4 rounded">
                            </div>

                            <div>
                                <label for="">店舗アドレス</label>
                                <input type="text" name="residence" placeholder="○○県○○市○○区○○町" class="w-4/5 h-10 my-4 rounded" >
                            </div>

                            <div>
                                <label for="">電話番号</label>
                                <input type="text" name="tel" class="w-4/5 h-10 my-4 rounded">
                            </div>

                            <div>
                                <label for="">備考</label>
                                <textarea name="remark" id="" cols="30" rows="10" placeholder="店舗紹介" class="w-4/5 my-4 rounded"></textarea>
                            </div>
                            <div class="text-center bg-blue-500 rounded h-8">
                                <button class="w-full h-8">登録</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

    </content>
    
    <footer class="bg-yellow-300 ">

    </footer>
@endsection