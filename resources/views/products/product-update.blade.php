@extends('layouts.app')
@section('content')
<content>
<!-- 商品編集 -->
            <div class="w-2/3 m-auto pt-20">
                <h2 class="pb-10">商品編集</h2>
                @if(isset($cakeImagePath))
                    <img class="w-1/2 mx-auto" src="{{asset($cakeImagePath)}}">
                @endif
                <form method="POST" action="{{ route('update.confirm', ['cake' => $cake->id]) }}" enctype="multipart/form-data" class="text-center">
                    @csrf
                    <input class="m-6" type="file" name="image">
                    <button class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500 mr-20">アップロード</button>
                </form>

                <form method="POST" action="{{ route('update.store', ['cake' => $cake->id]) }}">
                    @csrf
                    <div class="max-w-lg mx-auto mt-10 bg-gray-300 border border-black-500 p-6 rounded-xl text-center">
                    @if(isset($cakeImagePath) && isset($image_name))
                        <input type="hidden" name="image_path" value=" {{ $cakeImagePath }}">
                        <input type="hidden" name="image_name" value=" {{ $image_name }}">
                    @endif
                   
                        <div class="p-6"> 
                            <label for="">詳細</label><br/>
                            <textarea id="story" name="cake_content" rows="5" cols="48" maxlength="512" value="{{ $cake->cake_content }}">
                            {{ $cake->cake_content }}
                            </textarea>
                        </div>
                        
                        <div class="p-6 text-center"> 
                            <label for="">ネーム</label>
                            <input type="text" name="cake_name" value="{{ $cake->cake_name }}">
                        </div>

                        <div class="p-6 text-center"> 
                            <label for="">カテゴリー</label>
                            <input type="text" name="cake_category" value="{{ $cake->cake_category}}">
                        </div>

                        <div id="form_area" class="p-6 text-center">
                            <div>価格とサイズ</div>
                            @foreach($cake->cakecontent as $value)
                                <input type="hidden" name ="cakecontent[{{$loop->index}}][cakecontent_id]" value="{{$value->id}}">
                                <input type="text" id="inputprice_{{$loop->index}}" name="cakecontent[{{$loop->index}}][cake_price]" class="rounded" placeholder="価格" value="{{ $value->cake_price }}">
                                @error('cakecontent.*.cake_price')
                                    {{$message}}
                                @enderror
                                <input type="text" id="inputsize_{{$loop->index}}" name="cakecontent[{{$loop->index}}][cake_size]" class="rounded" placeholder="サイズ" value="{{ $value->cake_size }}">
                                @error('cakecontent.*.cake_size')
                                    {{$message}}
                                @enderror
                                <button id="0" onclick="deleteBtn(this)">削除</button>
                            @endforeach
                        </div>
                        <input type="button" value="フォーム追加" onclick="addForm()">                   
                    <div class="text-center mt-5">
                    <button class="bg-blue-400 text-white rounded py-2.5 px-6 hover:bg-blue-500" type="submit">送る</button>
                    </div>
                </form>
            </div>
        
    </content>
    
    <footer class="bg-yellow-300 ">

    </footer>
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
        button_data.innerHTML = '削除';
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