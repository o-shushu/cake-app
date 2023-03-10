@extends('layouts.app')
@section('content')
<content>
<!-- 商品一覧 -->
<div class="pb-10 w-3/4 m-auto pt-20 text-justify">
        <h2>商品一覧</h2>
        @if(session('alert'))
            <div class="alert alert-info">{{ session('alert') }}</div>
        @endif
        <div class="flex  flex-wrap justify-between">
            @if(isset($cakeImages))   
            @foreach ($cakeImages as $cakeImage)
                <div class="w-1/2 max-w-lg  mt-10 bg-gray-100 border border-gray-200 p-6 rounded-xl">
                <img class="w-4/5 h-4/5 m-auto"src="{{ asset($cakeImage->tmp_name) }}" alt="">
                <div class="flex justify-center mt-5">
                        @if(isset(auth()->user()->type) && auth()->user()->type == 1)
                            <a href="{{ route('userOrder', $cakeImage->cake_id) }}" class="w-1/4 text-center bg-yellow-400 text-white rounded py-2.5 px-4 hover:bg-yellow-500 mr-20">
                            GO
                            </a>
                        @else
                            <a href="{{ route('home.ProductDetail', $cakeImage->cake_id) }}" class="w-1/4 text-center bg-yellow-400 text-white rounded py-2.5 px-4 hover:bg-yellow-500 mr-20">
                            GO
                            </a>
                        @endif
                        <button type="submit" class="flex w-1/4 text-center bg-yellow-400 text-white rounded py-2 px-4 hover:bg-yellow-500 items-center">
                        いいね
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="-mt-px mr-1 w-5 h-5 stroke-red-400 dark:stroke-red-600 group-hover:stroke-red-600 dark:group-hover:stroke-red-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                            </svg>
                        </button>
                </div>
                </div>        
            @endforeach
            @endif
        </div>
    </div>
</content>
<div >
    <div class="justify-center">{{ $cakeImages->onEachSide(2)->links() }}</div>
    
</div>
  
<footer class="bg-yellow-300 ">

</footer>
@endsection