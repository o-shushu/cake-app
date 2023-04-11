@extends('layouts.app')
@section('content')
<div class="relative" style="top:18vh">
    <div class="w-max mx-auto bg-gray-100 border border-gray-200 p-6 rounded-xl shadow-xl">
        <h1 class="title text-center font-bold">新しいパスワードを設定</h1>
        <div class="text-center text-red-600">
            @error('password')
            <p class="error">{{ $message }}</p>
            @enderror
            @error('token')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <form method="POST" action="{{ route('password_reset.update') }}">
            @csrf
            <input type="hidden" name="reset_token" value="{{ $userToken->token }}">
            <div class="input-group">
                <label for="password" class="label font-bold">パスワード</label>
                <input type="password" name="password" class="input {{ $errors->has('password') ? 'incorrect' : '' }} w-full">
            </div>
            <div class="input-group">
                <label for="password_confirmation" class="label font-bold">パスワードを再入力</label>
                <input type="password" name="password_confirmation" class="input {{ $errors->has('password_confirmation') ? 'incorrect' : '' }} w-full">
            </div>
            <button type="submit" class="w-full mt-3 bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500 mr-20">パスワードを再設定</button>
        </form>
    </div>
</div>
@endsection