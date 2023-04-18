@extends('layouts.app')
@section('content')
    <div class="relative" style="top:18vh">
        <div class="w-max mx-auto bg-gray-100 border border-gray-200 p-6 rounded-xl shadow-xl">
            <h1 class="font-bold text-center">パスワード再設定メール送信フォーム</h1>
            @error('email')
                <p class="error text-center" style = 'color:red;'>{{ $message }}</p>
            @enderror
            <form method="POST" action="{{ route('password_reset.email.send') }}">
                @csrf
                <div class="mt-3">
                    <label class="font-bold" for="email">メールアドレス</label>
                    <input type="text" name="email" id="email" value="{{ old('email') }}" class="border border-gray-400 p-2 w-full">
                </div>
                <button class="w-full mt-3 bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500 mr-20">再設定用メールを送信</button>
            </form>
            <div class="w-full mt-3 h-9 text-center bg-blue-400 text-white rounded py-2.5 px-6 hover:bg-blue-500">
            <a href="{{ route('login.show') }}">戻る</a>
            </div>
        </div>
    </div>
@endsection