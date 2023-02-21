<!-- Primary Navigation Menu -->
<div class="bg-yellow-300">
    <div class="flex m-5 w-2/3 m-auto justify-between">
        <!-- Logo -->
        <div>
            <a href="homepage/"><img class="m-5" src="{{asset('css/cafe/img/logo.png')}}" alt="menu-logo"></a>
        </div>

        <!-- Navigation Links -->
        <div >
            <ul class="flex m-5">
            @if (Route::has('login'))
            <li><a href="homepage/">Homepage</a></li>
            @else
                <!-- <li class=" "><a href="./index#content1">ユーザー一覧</a></li>
                <li class="ml-5"><a href="./index#content4">Likes</a></li> -->
                <li class="ml-5"><a href="#">おすすめ</a></li>
                <li class="ml-5"><a href="#">人気店</a></li>
            @endif
            </ul>
        </div>

        <!-- Settings Dropdown -->

    </div>

        
</div>