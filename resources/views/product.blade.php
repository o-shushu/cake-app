@extends('layouts.app')
@section('content')
   <content>
 <!-- 人気店 -->    
            <div class="w-2/3 m-auto">
                <div class="headerImg relative  h-screen">
                    <img class="absolute object-cover h-screen w-full" src="{{asset('css/cafe/img/exp1.jpg')}}" alt="exp1">
                    <img class="absolute object-cover h-screen w-full" src="{{asset('css/cafe/img/exp2.jpg')}}" alt="exp2">
                    <img class="absolute object-cover h-screen w-full" src="{{asset('css/cafe/img/exp3.jpg')}}" alt="exp3">
                </div>
            </div>

            <div class="w-2/3 m-auto pt-20">
 <!-- 人気商品のおすすめ -->               
                <h2 class="pb-10">おすすめ</h2>
                
                <div class="flex">
                    <div class="">
                        <img src="{{asset('css/cafe/img/exp1.jpg')}}" alt="ジョブ体験">
                        <h3>ジョブ体験</h3>
                        <p>カフェカウンターを体験しよう。</p>
                    </div>
                    <div class="">
                        <img src="{{asset('css/cafe/img/exp2.jpg')}}" alt="レシピ体験">
                        <h3>レシピ体験</h3>
                        <p>美味しいレシピを考えてみよう。</p>
                    </div>
                    <div class="">
                        <img src="{{asset('css/cafe/img/exp3.jpg')}}" alt="プロモーション体験">
                        <h3>プロモーション体験</h3>
                        <p>お店の宣伝を手伝ってみよう。</p>
                    </div>
                </div>
            </div>
<!-- 商店一覧 -->
            <div class="w-2/3 m-auto pt-20">
                <h2 class="pb-10">商店一覧</h2>
                <div class="w-1/2 max-w-lg  mt-10 bg-gray-100 border border-gray-200 p-6 rounded-xl ">
                    <img src="{{asset('css/cafe/img/cafe4.jpg')}}" alt="">
                    <div class="flex justify-center mt-5">
                        <a href="#" class="bg-yellow-400 text-white rounded py-2.5 px-4 hover:bg-yellow-500 mr-20">
                        GO
                        </a>
                        <button type="submit" class="bg-yellow-400 text-white rounded py-2 px-4 hover:bg-yellow-500">
                        いいね
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="-mt-px mr-1 w-5 h-5 stroke-red-400 dark:stroke-red-600 group-hover:stroke-red-600 dark:group-hover:stroke-red-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>


    </content>
    
    <footer class="bg-yellow-300 ">

    </footer>
@endsection