@extends('layouts.app')
@section('content')
<content>
<!-- 商品詳細-->
            <div class="w-2/3 m-auto pt-20">
                <h2 class="pb-10">商品詳細</h2>
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
                                    <label for="">カテゴリー</label>
                                    <p>{{ $product->cake_category}}</p>
                                </div>

                                <div class="text-center mx-10"> 
                                    <label for="">価格</label>
                                    <p id="price">price</p>
                                </div>
                                <div>
                                    <label for="">サイズ</label>
                                    <select id="size" class="border border-gray-400 p-2 w-full">
                                    @foreach($product->cakecontent as $value)
                                        <option value="{{ $value->cake_price }}">{{ $value->cake_size }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div> 
                        @endforeach
                    </div>
                </div>
                <div class="text-center mt-5">
                    <a href="{{ route('product.show') }}" class="bg-blue-400 text-white rounded py-2.5 px-6 hover:bg-blue-500">
                        戻る
                    </a>
                    <a href="{{ route('update.index', ['cake' => $product->id]) }}" class="bg-blue-400 text-white rounded py-2.5 px-6 hover:bg-blue-500">
                        編集
                    </a>
                </div>
                <form onsubmit="return deleteTask();" action="delete/{{ $product->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="bg-blue-400 text-white rounded py-2.5 px-6 hover:bg-blue-500" type="submit">削除</button>
                </form>
    </content>
    
    <footer class="bg-yellow-300 ">

    </footer>
<script>
    function deleteTask() {
        if (confirm('本当に商品を削除しますか？')) {
            return true;
        } else {
            return false;
        }
    }


</script>
@endsection