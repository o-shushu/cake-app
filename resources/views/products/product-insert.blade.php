@extends('layouts.app')
@section('content')
<content>
<!-- 商品新規 -->
    <div class="w-2/3 m-auto">
        <h2 class="pb-3 ">
            <span class="font-bold border-t-2 border-yellow-400 text-2xl">商品新規</span>  
        </h2>
        <p class="text-red-600">*画像必要です。</p>
        <div class="block sm:flex mb-3 text-center">
            <div class="w-4/5 sm:w-1/2 m-auto">
                @if(isset($image_path))
                    <img class="w-4/5 mx-auto" src="{{asset($image_path)}}">
                @endif
                <p class="text-red-500">{{ $errors->first('image_name') }}</p>
                <form method="POST" action="{{ route('upload.confirm') }}" enctype="multipart/form-data">
                    @csrf
                    <input class="text-xs w-full my-6" type="file" name="image">
                    <div class="m-auto">
                        <button class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500 mr-20">アップロード</button>
                    </div>
                </form>
            </div>
            <div class="max-w-lg mx-auto mt-10 bg-gray-300 border border-black-500 p-6 rounded-xl text-center">
                <form method="POST" action="{{ route('upload.store') }}">
                    @csrf
                    @if(isset($image_path) && isset($image_name))
                    <input type="hidden" name="image_path" value="{{ $image_path }}">
                    <input type="hidden" name="image_name" value="{{ $image_name }}">

                    @endif
                    <div class="p-2 text-left"> 
                        <p class="text-red-500">{{ $errors->first('cake_content') }}</p> 
                        <label for="">詳細:</label><br/>
                        <textarea id="story" name="cake_content" rows="5" cols="48" maxlength="512" class="h-10 w-full">{{old('cake_content')}}</textarea>
                    </div>
                    
                    <div class="p-2 text-left">                                
                        <p class="text-red-500">{{ $errors->first('cake_name') }}</p> 
                        <label for="">商品名:</label>
                        <input type="text" name="cake_name" class="h-10 w-full" value="{{old('cake_name')}}">
                    </div>

                    <div class="p-2 text-left">
                        <p class="text-red-500">{{ $errors->first('cake_category') }}</p> 
                        <label for="">カテゴリー:</label>
                        <input type="text" name="cake_category" class="h-10 w-full" value="{{old('cake_category')}}">
                    </div>
        
                    <div id="form_area">
                        <div class="p-2 text-left">
                            <p class="text-red-500">{{ $errors->first('cakecontent.*.cake_size') }}</p>
                            <p class="text-red-500">{{ $errors->first('cakecontent.*.cake_price') }}</p>
                        </div>
                        <div class="p-2 text-left">価格とサイズ:</div>
                        <input type="text" id="inputprice_0" name="cakecontent[0][cake_price]" class="rounded" placeholder="価格-0">
                        <input type="text" id="inputsize_0" name="cakecontent[0][cake_size]" class="rounded" placeholder="サイズ-0">
                        <button id="0" onclick="deleteBtn(this)" class="bg-red-300 hover:bg-red-500 rounded">削除</button>
                    </div>
                    <div class="flex justify-between mt-3">
                        <input type="button" value="フォーム追加" onclick="addForm()" class="w-1/3 bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500">
                        <button class="w-1/3 bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500">新規</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</content>
<script>
    var i = 1 ;
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