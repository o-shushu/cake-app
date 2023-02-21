@extends('layouts.app')
@section('content')
    <main class="max-w-lg mx-auto mt-10 bg-gray-100 border border-gray-200 p-6 rounded-xl ">
        <h1 class="text-center font-bold text-xl">パスワードリセット</h1>
        <form action="" method="post">
        @csrf
            <div>
                <label for="email" class="font-bold">電話番号</label>
                <input type="text" name="email" class="border border-gray-400 p-2 w-full">
            </div>

            <div>
                <label for="password" class="font-bold">メールアドレス</label>
                <input type="text" name="password" class="border border-gray-400 p-2 w-full">
            </div>


            <div class="text-center mt-5">
                <a href="login" class="bg-blue-400 text-white rounded py-2.5 px-4 hover:bg-blue-500 mr-20">
                戻る
                </a>
                <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500">
                送信
                </button>
            </div>
        </form>
    </main>
@endsection