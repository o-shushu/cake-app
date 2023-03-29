<!-- Primary Navigation Menu -->
<div class="bg-yellow-300">
    <div class="flex m-5 w-2/3 m-auto justify-between">
        <!-- Logo -->
        <div class="w-1/3">
            <a href="{{ route('home') }}"><img class="m-5" src="{{asset('img/logo.png')}}" alt="menu-logo"></a>
        </div>

        <!-- Navigation Links -->
        <!-- 0はシステム管理者、１は会員ユーザー、２は営業ユーザー -->
        @if (auth()->user()->type === '0')
            <div >
                <ul class="flex m-5">
                    <div class="relative inline-block px-4 group">ユーザー一覧
                        <div class="absolute bg-gray-100 ring-2 z-10 hidden group-hover:block">
                            <a class="block px-4 py-3 hover:bg-gray-300" href="{{route('consumers.Index')}}">会員ユーザー</a>
                            <a class="block px-4 py-3 hover:bg-gray-300" href="{{route('shopkeepers.Index')}}">営業ユーザー</a>
                        </div>
                    </div>
                    <div class="relative inline-block px-4 group">いいね一覧
                        <div class="absolute bg-gray-100 ring-2 z-10 hidden group-hover:block">
                            <a class="block px-4 py-3 hover:bg-gray-300" href="{{route('shopLikes.index')}}">店舗いいね</a>
                            <a class="block px-4 py-3 hover:bg-gray-300" href="{{route('cakeLikes.index')}}">商品いいね</a>
                        </div>
                    </div>
                    <li class="ml-5"><a href="/cake-app/public/#products">おすすめ </a></li>
                    <li class="ml-5"><a href="/cake-app/public/#shops">店一覧</a></li>

                    <div class="relative inline-block px-4 group">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-yellow hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ auth()->user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                        <div class="absolute w-24 bg-gray-100 ring-2 z-10 hidden group-hover:block">
                            <a class="block px-4 py-3 hover:bg-gray-300" href="{{ route('logout.action') }}">ログアウト</a>
                            <a class="block px-4 py-3 hover:bg-gray-300" href="#">おすすめ</a>
                            <a class="block px-4 py-3 hover:bg-gray-300" href="#">おすすめ</a>
                            <a class="block px-4 py-3 hover:bg-gray-300" href="#">おすすめ</a>
                        </div>
                    </div>
                </ul>
            </div>
       @endif
       @if (auth()->user()->type === '1')
            <div >
                <ul class="flex m-5">
                    <li class="ml-5"><a href="/cake-app/public/#shops">店一覧</a></li>
                    <li><a href="{{ route('indexCart') }}"><i class="fa-solid fa-cart-plus"></i></a></li>
                    <div class="relative inline-block px-4 group">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-yellow hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ auth()->user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                        <div class="absolute w-24 bg-gray-100 ring-2 z-10 hidden group-hover:block">
                            <a class="block px-4 py-3 hover:bg-gray-300" href="{{ route('user.detail') }}">ユーザー情報</a>
                            <a class="block px-4 py-3 hover:bg-gray-300" href="{{ route('buyCode.Index') }}">購入記録</a>
                            <a class="block px-4 py-3 hover:bg-gray-300" href="{{ route('logout.action') }}">ログアウト</a>
                        </div>
                    </div>
                </ul>
            </div>
       @endif
       @if (auth()->user()->type === '2')
            <div >
                <ul class="flex m-5">
                    <li class="ml-5"><a href="{{ route('proceeds.index') }}">売上</a></li>
                    <li class="ml-5"><a href="{{ route('upload.index') }}">商品新規</a></li>
                    <li class="ml-5"><a href="{{ route('orders.index') }}">明細 </a></li>

                    <div class="relative inline-block px-4 group">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-yellow hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ auth()->user()->name }}</div>
                            
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                        <div class="absolute w-24 bg-gray-100 ring-2 z-10 hidden group-hover:block">
                            <a class="block px-4 py-3 hover:bg-gray-300" href="{{ route('user.detail') }}">ユーザー情報</a>
                            <a class="block px-4 py-3 hover:bg-gray-300" href="{{ route('shop.index') }}">店舗情報</a>
                            <a class="block px-4 py-3 hover:bg-gray-300" href="{{ route('logout.action') }}">ログアウト</a>
                            <a class="block px-4 py-3 hover:bg-gray-300" href="#">おすすめ</a>
                        </div>
                        <div>{{ auth()->user()->id }}</div>    
                    </div>
                </ul>
            </div>
       @endif
     
        <!-- Settings Dropdown -->
    </div>
</div>