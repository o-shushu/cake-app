@extends('layouts.app')
@section('content')
    <div>
        <h1>パスワードリセットメールを送信しました。</h1>

        <a href="{{ route('login.show') }}">TOPへ</a>
    </div>
@endsection