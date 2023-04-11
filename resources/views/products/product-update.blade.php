@extends('layouts.app')
@section('content')
<content>
<!-- 商品編集 -->
    <div class="w-2/3 m-auto">
        <h2 class="pb-3 ">
            <span class="font-bold border-t-2 border-yellow-400 text-2xl">商品編集</span>  
        </h2>
        <div class="block sm:flex mb-3 text-center">
            <div class="w-4/5 sm:w-1/2 m-auto">
                @if(isset($cakeImagePath))
                <img class="w-4/5 mx-auto" src="{{asset($cakeImagePath)}}">
                @endif
                <form method="POST" action="{{ route('update.confirm', ['cake' => $cake->id]) }}" enctype="multipart/form-data" class="text-center">
                    @csrf
                    <input class="text-xs w-full my-6" type="file" name="image">
                    <button class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500 mr-20">アップロード</button>
                </form>
            </div>
            <div class="max-w-lg mx-auto mt-10 bg-gray-300 border border-black-500 p-6 rounded-xl text-center">
                <form method="POST" action="{{ route('update.store', ['cake' => $cake->id]) }}">
                    @csrf
                    @if(isset($cakeImagePath) && isset($image_name))
                        <input type="hidden" name="image_path" value=" {{ $cakeImagePath }}">
                        <input type="hidden" name="image_name" value=" {{ $image_name }}">
                    @endif
                    <div class="p-2 text-left"> 
                        <label for="">詳細</label><br/>
                        <textarea id="story" name="cake_content" rows="5" cols="48" maxlength="512" value="{{ $cake->cake_content }}" class="h-10 w-full">
                        {{ $cake->cake_content }}
                        </textarea>
                    </div>
                    
                    <div class="p-2 text-left">
                        @error('cake_name')
                        <p class="text-red-500"> {{ $message }}</p>
                        @enderror  
                        <label for="">商品名:</label>
                        <input type="text" name="cake_name" value="{{ $cake->cake_name }}" class="h-10 w-full">
                    </div>

                    <div class="p-2 text-left">
                        @error('cake_category')
                        <p class="text-red-500"> {{ $message }}</p>
                        @enderror   
                        <label for="">カテゴリー:</label>
                        <input type="text" name="cake_category" value="{{ $cake->cake_category}}" class="h-10 w-full">
                    </div>

                    <div id="form_area" class="p-2 text-left">
                        @error('cakecontent.*.cake_size')
                        <p class="text-red-500"> {{ $message }}</p>
                        @enderror  
                        <div>価格とサイズ:</div>
                        @foreach($cake->cakecontent as $value)
                            <input type="hidden" name ="cakecontent[{{$loop->index}}][cakecontent_id]" value="{{$value->id}}">
                            <input type="text" id="inputprice_{{$loop->index}}" name="cakecontent[{{$loop->index}}][cake_price]" class="rounded" placeholder="価格" value="{{ $value->cake_price }}">
                            <input type="text" id="inputsize_{{$loop->index}}" name="cakecontent[{{$loop->index}}][cake_size]" class="rounded" placeholder="サイズ" value="{{ $value->cake_size }}">
                            <button id="0" onclick="deleteBtn(this)" class="bg-red-300 hover:bg-red-500 rounded">削除</button>
                        @endforeach
                    </div>
                    <div class="flex justify-between">
                        <input type="button" value="フォーム追加" onclick="addForm()" class="w-1/2 sm:w-1/3 bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500">                   
                        <button class="w-1/2 sm:w-1/3 bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500" type="submit">送る</button>
                    </div>
                </form>
            </div>
    </div>       
</content>
<script>
    const inputprice_list = document.querySelectorAll('[id^=inputprice_]')
    let i = inputprice_list.length ;
    function addForm() {
    var input_price = document.createElement('input');
    input_price.type = 'text';
    input_price.name = 'cakecontent['+i+'][cake_price]';
    input_price.style = 'margin-right: 5px;margin-top: 10px;border-radius: 4px';
    input_price.id = 'inputprice_' + i;
    input_price.placeholder = '価格-' + i;
    var parent = document.getElementById('form_area');
    parent.appendChild(input_price);

    var input_size = document.createElement('input');
    input_size.type = 'text';
    input_size.name = 'cakecontent['+i+'][cake_size]';
    input_size.style = 'margin-right: 5px;border-radius: 4px';
    input_size.id = 'inputsize_' + i;
    input_size.placeholder = 'サイズ-' + i;
    var parent = document.getElementById('form_area');
    parent.appendChild(input_size);

    var button_data = document.createElement('button');
    button_data.id = i;
    button_data.onclick = function(){deleteBtn(this);}
    button_data.innerHTML = '<span class="bg-red-300 hover:bg-red-500 my-3 rounded">削除</span>';
    var input_area = document.getElementById(input_price.id);
    var input_area = document.getElementById(input_size.id);
    parent.appendChild(button_data);

    i++ ;
    }

    function deleteBtn(target) {
    var target_id = target.id;
    var parent = document.getElementById('form_area');
    var price_id = document.getElementById('inputprice_' + target_id);
    var size_id = document.getElementById('inputsize_' + target_id);
    var tgt_id = document.getElementById(target_id);
    parent.removeChild(price_id);
    parent.removeChild(size_id);
    parent.removeChild(tgt_id);	
    }
</script>
@endsection