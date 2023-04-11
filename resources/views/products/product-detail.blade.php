@extends('layouts.app')
@section('content')
<content>
<!-- 商品詳細-->
    <div class="w-2/3 m-auto">
        <h2 class="pb-3 ">
            <span class="font-bold border-t-2 border-yellow-400 text-2xl">商品詳細</span>  
        </h2>
        <div class="block sm:flex gap-10">
            <div class="w-full sm:w-1/2 h-40 mb-3" >
                @if(isset($cakeImagePath))
                    <img class="h-40" src="{{asset($cakeImagePath)}}">
                @endif
            </div>
        @foreach ($products as $product)
            <div class="w-full sm:w-1/2 border border-gray-300 h-40"> 
                <label class="font-bold">詳細:</label><br/>
                <p>{{ $product->cake_content}}</p>
            </div>
        </div>
        <div class="block gap-5 sm:flex sm:gap-10 justify-around mt-3 text-left">
            <div> 
                <label class="font-bold">商品名:</label>
                <p>{{ $product->cake_name}}</p>
            </div>

            <div> 
                <label class="font-bold">カテゴリー:</label>
                <p>{{ $product->cake_category}}</p>
            </div>

            <div> 
                <label class="font-bold">価格:</label>
                <p id="price">price</p>
            </div>
            <div>
                <label class="font-bold">サイズ:</label>
                <select id="size" class="border border-gray-400 p-2 w-full">
                @foreach($product->cakecontent as $value)
                    <option value="{{ $value->cake_price }}">{{ $value->cake_size }}</option>
                @endforeach
                </select>
            </div>
        </div>
        @endforeach             
        <div class="block sm:flex justify-around mt-8 text-center mb-3">
            <a href="{{ url()->previous() }}" class="bg-blue-400 text-white rounded py-2.5 px-6 my-5 hover:bg-blue-500">
                戻る
            </a>
            <form onsubmit="return deleteTask();" action="{{ route('product.delete',$product->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="bg-blue-400 text-white rounded py-2.5 px-6 my-5 hover:bg-blue-500" type="submit">削除</button>
            </form>
            <a href="{{ route('update.index', ['cake' => $product->id]) }}" class="bg-blue-400 text-white rounded py-2.5 px-6 my-5 hover:bg-blue-500">
                編集
            </a>
        </div>
    </div>                
</content>
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