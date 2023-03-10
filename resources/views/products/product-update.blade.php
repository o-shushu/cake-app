@extends('layouts.app')
@section('content')
<content>
<!-- 商品編集 -->
            <div class="w-2/3 m-auto pt-20">
                <h2 class="pb-10">商品編集</h2>
                @if(isset($cakeImagePath))
                    <img class="w-1/2 mx-auto" src="{{asset($cakeImagePath)}}">
                @endif
                <form method="POST" action="{{ route('update.confirm') }}" enctype="multipart/form-data" class="text-center">
                    @csrf
                    <input class="m-6" type="file" name="image">
                    <input type="hidden" name="cake_id" value=" {{ $cakeId }}">
                    <button class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500 mr-20">アップロード</button>
                </form>

                <form method="POST" action="{{ route('update.store') }}">
                    @csrf
                    <div class="max-w-lg mx-auto mt-10 bg-gray-300 border border-black-500 p-6 rounded-xl text-center">
                    @if(isset($cakeImagePath) && isset($image_name))
                        <input type="hidden" name="image_path" value=" {{ $cakeImagePath }}">
                        <input type="hidden" name="image_name" value=" {{ $image_name }}">
                    @endif
                    @foreach ($products as $product)
                        <div class="p-6"> 
                            <label for="">詳細</label><br/>
                            <textarea id="story" name="cake_content" rows="5" cols="48" maxlength="512" value="{{ $product->cake_content }}">
                            {{ $product->cake_content }}
                            </textarea>
                        </div>
                        
                        <div class="p-6 text-center"> 
                            <label for="">ネーム</label>
                            <input type="text" name="cake_name" value="{{ $product->cake_name }}">
                        </div>

                        <div class="p-6 text-center"> 
                            <label for="">価格</label>
                            <input type="text" name="cake_price" value="{{ $product->cake_price }}">
                        </div>

                        <div class="p-6 text-center"> 
                            <label for="">サイズ</label>
                            <select name="cake_size" class="border border-gray-400 p-2 w-2/5">
                                <option value="0">サイズなし</option>
                                <option value="4">4号（12cm）</option>
                                <option value="5">5号（15cm）</option>
                                <option value="6">6号（18cm）</option>
                                <option value="7">7号（21cm）</option>
                                <option value="8">8号（24cm）</option>
                                <option value="9">9号（27cm）</option>
                                <option value="10">10号（30cm）</option>
                            </select>
                        </div>
                        <input type="hidden" name="cake_id" value=" {{ $product->id }}">
                    @endforeach
                    <div class="text-center mt-5">
                    <button class="bg-blue-400 text-white rounded py-2.5 px-6 hover:bg-blue-500" type="submit">送る</button>
                    </div>
                </form>
            </div>
        
    </content>
    
    <footer class="bg-yellow-300 ">

    </footer>

@endsection