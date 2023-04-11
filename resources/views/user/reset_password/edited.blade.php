@extends('layouts.app')
@section('content')
    <div class="text-center">
        <h1>パスワードリセットが完了しました.</h1>

        <button  class="mt-3 bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500 mr-20">
            <a href="{{ route('login.show') }}">TOPへ</a>
        </button>
    </div>
@endsection