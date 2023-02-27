@extends('layouts.app')
@section('content')
@if(isset($messageRegister))
    <p class="text-red-500 text-center">{{ $messageRegister}}</p>
@endif
    <div class="max-w-lg mx-auto mt-10 bg-gray-100 border border-gray-200 p-6 rounded-xl ">
        <h1 class="text-center font-bold text-xl">新規登録</h1>
        <form action="{{route('register.store')}}" method="POST">
        @csrf
            <div>
                <label for="name" class="font-bold">ユーザーネーム</label>
                <p class="text-red-500">{{ $errors->first('name') }}</p>
                <input type="text" name="name" value="{{old('name')}}" class="border border-gray-400 p-2 w-full">
            </div>

            <div>
                <label for="email" class="font-bold">メールアドレス</label>
                <p class="text-red-500">{{ $errors->first('email') }}</p>
                <input type="text" name="email" value="{{old('email')}}" class="border border-gray-400 p-2 w-full">
            </div>

            <div>
                <label for="password" class="font-bold">パスワード</label>
                <p class="text-red-500">{{ $errors->first('password') }}</p>
                <input type="password" name="password" class="border border-gray-400 p-2 w-full">
            </div>
            <div>
                <label for="password" class="font-bold">パスワード確認</label>
                <p class="text-red-500">{{ $errors->first('password_confirmation') }}</p>
                <input type="password" name="password_confirmation" class="border border-gray-400 p-2 w-full">
            </div>
            <div>
                <label for="tel" class="font-bold">電話番号</label>
                <p class="text-red-500">{{ $errors->first('tel') }}</p>
                <input type="text" name="tel" value="{{old('tel')}}" class="border border-gray-400 p-2 w-full">
            </div>

            <div>
                <label for="residence" class="font-bold">県地</label>
                <p class="text-red-500">{{ $errors->first('residence') }}</p>
                <select name="residence" class="border border-gray-400 p-2 w-full">
                    @foreach ($residences as $residence)
                    <option value="{{ $residence->id }}">{{ $residence->residence }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="type" class="font-bold">属性</label>
                <p class="text-red-500">{{ $errors->first('type') }}</p>
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