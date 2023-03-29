@extends('layouts.app')
@section('content')
   <content>
 <!-- 人気店 -->    
        <div class="w-2/3 m-auto">
            <div id="banner">
                <ul id="design">
                    @if(isset($chunkShopLike))
                    @foreach($chunkShopLike[0] as $item)
                    <li>
                        <a href="{{ route('home.Product', $item->shop->id) }}">
                        <img src="{{asset($item->shop->images->first()->tmp_name)}}" alt="exp1">
                        </a>
                    </li>
                    @endforeach
                    @endif
                    <li>
                        <a href="{{ route('home.Product', $item->shop->id) }}">
                        <img src="{{asset($item->shop->images->first()->tmp_name)}}" alt="exp1">
                        </a>
                    </li>
                </ul>
                <ul id="icoList">
                    <li>1</li>
                    <li>2</li>
                    <li>3</li>
                </ul>
                <div class="prev"><i class="fas fa-backward"></i></div>
                <div class="next"><i class="fas fa-forward"></i></div>
            </div>
        </div> 
            <script>
                //创建移动变量和定时器
                var prev = document.querySelector('.prev');
                var next = document.querySelector('.next');
                var allIco = document.getElementById('icoList').getElementsByTagName('li');
                var icoList = document.querySelector('#icoList');
                var imgList = document.querySelector('#design');//获取图片列表元素
                var left = 0;
                var timer
                // 滚动函数.通过marginleft移动
                run();
                function run(){
                    if(left <= -2400){
                        left = 0;

                    }
                    var m = Math.floor(-left / 800);//创建变量获取当前图片序号
                    design.style.marginLeft = left + 'px';
                    var n =(left % 800 == 0) ? n = 1200 :n = 10;//添加变量n，滚完一张图停1200毫秒
                    left -= 10;//每10毫秒运行一次run()，每次偏移left累积-10
                    timer = setTimeout(run,n);
                    // 在run函数调用icoChange进行小圆点变化
                    icoChange(m);
                }
                //定位到指定图片函数
                function imgchange(n){
                    let lt = - (n * 800);
                    design.style.marginLeft = lt + 'px';
                    left = lt;
                }
                prev.onclick = function(){
                    let prevgo = Math.floor(-left / 800) - 1;//获取当前位置-1
                    if(prevgo == -1){
                        prevgo = 2;//第一张往前是第三张 
                    }
                    imgchange(prevgo); 
                }
                next.onclick = function(){
                    let nextgo = Math.floor(-left / 800) + 1;
                    if(nextgo == 3){
                        nextgo = 0;
                    }
                    imgchange(nextgo);
                }
                function icoChange(m){
                    for(let index = 0; index < allIco.length; index++){
                        allIco[index].style.backgroundColor = '';//通过循环for清空li元素背景色
                    }
                    if(m < allIco.length){
                        allIco[m].style.backgroundColor = 'lightblue';
                    }
                }
                // 创建列表点击事件
                icoList.onclick = function(){
                    var tg = event.target;//获取事件目标元素
                    let ico = tg.innerHTML - 1;//获取点击序号
                    imgchange(ico);
                    icoChange(ico);
                }
                //鼠标在图片列表上时，轮播停止，移开后又启动
                imgList.onmouseover = function(){
                    clearTimeout(timer);
                }
                imgList.onmouseout = function(){
                    run();
                }
            </script>
<!-- 人気商品のおすすめ -->               
        <div class="w-2/3 m-auto pt-20">
            <h2 id="products" class="pb-10">おすすめ</h2>
            <button id="moreLook">もっと見る</button>
            <div class="flex relative">
                @if(isset($chunkCakeLike))
                @foreach($chunkCakeLike[0] as $item)
                    <div class="border">
                        <a href="{{ route('home.ProductDetail', $item->cake->id) }}">
                        <img src="{{ asset($item->cake->images->first()->tmp_name) }}" alt="ジョブ体験">
                        </a>
                        <h3>{{$item->cake->cake_name}}</h3>
                        <p>
                            <i class="fas fa-heart"></i>
                            <span class="likesCount">{{$item->total}}</span>
                        </p>
                    </div>
                @endforeach
                @endif
            </div>
            <div class="lookMoreProducts fixed z-10 bg-transparent w-2/3 h-screen top-0 overflow-scroll hidden">
                <p>おすすめの商品</p>
                <div class="float-right">
                    <div class="flex  flex-wrap justify-between">
                        @if(isset($cakesLike)) 
                        @foreach ($cakesLike as $item)
                        <div class="w-1/2 mt-5 bg-gray-100 border border-gray-200 p-2 rounded-xl">
                                <a class="h-3/4 w-3/4 mx-0" href="{{ route('home.ProductDetail', $item->cake->id) }}">
                                    <img class="h-3/4 w-full mx-auto rounded" src="{{ asset($item->cake->images->first()->tmp_name) }}">
                                </a>
                            <p>{{$item->cake->cake_name}}</p>
                                <div class="flex justify-center mt-5">
                                    </a>
                                    @auth
                                        @if($like_model->like_exist(Auth::user()->id,$item->cake->id))
                                        <p class="bg-yellow-400 rounded py-2.5 px-4 hover:bg-yellow-500 mr-20">
                                            <a class="cake-like-toggle text-red-500 cursor-pointer" data-cake-id="{{$item->cake->id}}"><i class="fas fa-heart"></i></a>
                                            <span class="likesCount">{{$item->total}}</span>
                                        </p>
                                        @else
                                        <p class="bg-yellow-400 rounded py-2.5 px-4 hover:bg-yellow-500 mr-20">
                                            <a class="cake-like-toggle cursor-pointer" data-cake-id="{{$item->cake->id}}"><i class="fas fa-heart"></i></a>
                                            <span class="likesCount">{{$item->total}}</span>
                                        </p>
                                        @endif 
                                    @endauth
                                    @guest
                                        <p class="bg-yellow-400 rounded py-2.5 px-4 hover:bg-yellow-500 mr-20">
                                            <i class="fas fa-heart"></i>
                                            <span class="likesCount">{{$item->total}}</span>
                                        </p>
                                    @endguest
                                </div>
                            @if(isset(auth()->user()->type) && auth()->user()->type === '0')

                            @else
                                <div class="mt-5">
                                    <a data-cake-id="{{$item->cake->id}}" data-shop-id="{{$item->cake->shop->id}}" class="shopsInputCart bg-blue-400 text-white rounded py-2.5 px-6 hover:bg-blue-500">
                                    カートに入れる
                                    </a>
                                </div>
                            @endif
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
<!-- 商店一覧 -->
            <div class="w-2/3 m-auto pt-20">
                <h2 id="shops" class="pb-2">商店一覧</h2>      
                <div class="flex flex-wrap justify-between">
                    @if(isset($shops)) 
                    @foreach ($shops as $shop)
                    @php
                        $shopImages = $shop->images()->shopImages()->get();
                    @endphp
                    <div class="w-1/2 mt-5 bg-gray-100 border border-gray-200 p-2 rounded-xl">
                        @foreach($shopImages as $shopImage)
                            <img class="h-3/5 w-4/5 mx-auto rounded" src="{{ asset($shopImage->tmp_name) }}" alt="">
                        @endforeach
                        <div class="justify-center mt-5">
                            <p class="">{{$shop->shop_name}}</p>
                            <div class="flex justify-center mt-2">
                                <a href="{{ route('home.Product', $shopImage->shop_id) }}" class="bg-yellow-400 rounded py-2.5 px-4 hover:bg-yellow-500 mr-20">
                                    GO
                                </a>
                                @auth
                                    @if($like_model->like_exist(Auth::user()->id,$shop->id))
                                    <p class="bg-yellow-400 rounded py-2.5 px-4 hover:bg-yellow-500 mr-20">
                                        <a class="js-like-toggle text-red-500 cursor-pointer" data-shop-id="{{$shop->id}}"><i class="fas fa-heart"></i></a>
                                        <span class="likesCount">{{$shop->likes_count}}</span>
                                    </p>
                                    @else
                                    <p class="bg-yellow-400 rounded py-2.5 px-4 hover:bg-yellow-500 mr-20">
                                        <a class="js-like-toggle cursor-pointer" data-shop-id="{{$shop->id}}"><i class="fas fa-heart"></i></a>
                                        <span class="likesCount">{{$shop->likes_count}}</span>
                                    </p>
                                    @endif 
                                @endauth
                                @guest
                                <p class="bg-yellow-400 rounded py-2.5 px-4 hover:bg-yellow-500 mr-20">
                                    <i class="fas fa-heart"></i>
                                    <span class="likesCount">{{$shop->likes_count}}</span>
                                </p>
                                @endguest
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif  
                </div>
                <div >
                    <div class="justify-center">{{ $shops->links() }}</div>
                </div>
            </div>

    </content>
    
    <footer class="bg-yellow-300 ">
    </footer>
    <script>
        
    </script>
@endsection