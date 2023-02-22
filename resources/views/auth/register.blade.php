@extends('layouts.app')
@section('content')
    <div class="max-w-lg mx-auto mt-10 bg-gray-100 border border-gray-200 p-6 rounded-xl ">
        <h1 class="text-center font-bold text-xl">新規登録</h1>
        <form action="" method="post">
        @csrf
            <div>
                <label for="name" class="font-bold">ユーザーネーム</label>
                <input type="text" name="name" class="border border-gray-400 p-2 w-full">
            </div>

            <div>
                <label for="email" class="font-bold">メールアドレス</label>
                <input type="text" name="email" class="border border-gray-400 p-2 w-full">
            </div>

            <div>
                <label for="password" class="font-bold">パスワード</label>
                <input type="text" name="password" class="border border-gray-400 p-2 w-full">
            </div>

            <div>
                <label for="tel" class="font-bold">電話番号</label>
                <input type="text" name="tel" class="border border-gray-400 p-2 w-full">
            </div>

            <div>
                <label for="residence" class="font-bold">県地</label>
                <select name="residence" class="border border-gray-400 p-2 w-full">
                    <option value="1">神奈川県</option>
                    <option value="2">茨城県</option>
                </select>
            </div>

            <div>
                <label for="type" class="font-bold">属性</label>
                <select name="type" class="border border-gray-400 p-2 w-full">
                    <option value="1">会員ユーザー</option>
                    <option value="2">営業ユーザー</option>
                </select>
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('login.show') }}" class="bg-blue-400 text-white rounded py-2.5 px-4 hover:bg-blue-500  mr-20">
                    戻る
                </a>
                <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500">
                    登録
                </button>
            </div>
        </form>
    </div>
@endsection