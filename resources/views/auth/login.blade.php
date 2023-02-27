@extends('layouts.app')
@section('content')
    <div class="max-w-lg mx-auto mt-10 bg-gray-100 border border-gray-200 p-6 rounded-xl ">
        <h1 class="text-center font-bold text-xl">ログイン</h1>
        @isset($errors)
            <p class="text-red-500">{{ $errors->first('message') }}</p>
        @endisset
        <form action="{{ route('login.action') }}" method="post">
        @csrf
            <div>
                <label for="email" class="font-bold">メールアドレス</label>
                <input type="text" name="email" value="{{old('email')}}" class="border border-gray-400 p-2 w-full">
            </div>

            <div>
                <label for="password" class="font-bold">パスワード</label>
                <input type="password" name="password" class="border border-gray-400 p-2 w-full">
            </div>


            <div class="text-center mt-5">
                <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500 mr-20">
                ログイン
                </button>
                <a href="{{ route('register.show') }}" class="bg-blue-400 text-white rounded py-2.5 px-6 hover:bg-blue-500">
                新規
                </a>
            </div>
        </form>
        <p class="text-center font-bold mt-3"><a href="{{ route('reset-password.show')}}">パスワードを忘れた方はこちら</a></p>
    </div>
@endsection