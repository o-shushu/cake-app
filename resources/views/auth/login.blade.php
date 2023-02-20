@extends('layouts.app')
@section('content')
    <main class="max-w-lg mx-auto mt-10 bg-gray-100 border border-gray-200 p-6 rounded-xl ">
        <h1 class="text-center font-bold text-xl">ログイン</h1>
        <form action="" method="post">
        @csrf
            <div>
                <label for="email" class="font-bold">Email</label>
                <input type="text" name="email" class="border border-gray-400 p-2 w-full">
            </div>

            <div>
                <label for="password" class="font-bold">Password</label>
                <input type="text" name="password" class="border border-gray-400 p-2 w-full">
            </div>


            <div>
                <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500">
                ログイン
                </button>
                <a href="register" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500">
                新規
                </a>
            </div>
        </form>
    </main>
@endsection