<!-- Primary Navigation Menu fixed z-10-->
<div class="bg-yellow-300">
    <div class="flex w-full m-auto justify-between sm:w-2/3">
        <!-- Logo -->
        <div class="w-1/3 my-auto mx-0">
            <a href="{{ route('home') }}"><img class="w-full md:h-14" src="{{asset('img/logo.png')}}" alt="menu-logo"></a>
        </div>

        <!-- Navigation Links -->
        <div class="my-auto">
            <ul class="flex my-6 mx-auto">
            @if (url()->current() === route('home'))
                <li class="text-sm sm:text-base m-auto pr-3"><a href="#products">おすすめ</a></li>
                <li class="text-sm sm:text-base m-auto pr-3"><a href="#shops">店舗一覧</a></li>
                @auth
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
                    </div>
                </div>
                @endauth
                @guest

                <li id="login" class="text-sm sm:text-base m-auto pr-3"><a href="{{ route('login.show') }}">ログイン</a></li>
                @endguest
            @else
                @if (url()->current() === route('login.show'))
                <a href="{{ route('home') }}">ホームページ</a>
                @else
                <li id="login" class="text-sm sm:text-base m-auto pr-3"><a href="{{ route('login.show') }}">ログイン</a></li>
                @endif
            @endif
            </ul>
        </div>
    </div>
</div>