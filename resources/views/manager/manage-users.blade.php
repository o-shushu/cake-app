@extends('layouts.app')
@section('content')
<content>
<!-- ユーザー一覧-->
            <div class="w-2/3 m-auto pt-20">
            @if(isset($user) && $user == 'shopkeepers')
                <h2 class="pb-10">営業ユーザー一覧</h2>
                <div class="text-left">
                    <table class="w-full border border-gray-900">
                        <tr>
                            <th>番号</th>
                            <th>ユーザー名</th>
                            <th>メールアドレス</th>
                            <th>電話番号</th>
                            <th>県地</th>
                            <th>操作</th>
                        </tr>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ $user->name}}</td>
                            <td>{{ $user->email}}</td>
                            <td>{{ $user->tel}}</td>
                            <td>{{ $user->residence->residence}}</td>
                            <td>
                                <a href="{{route('shop.detail',$user->id)}}">店舗情報</a>
                                <a href="{{route('consumers.update',$user->id)}}">編集</a>
                                <a href="{{route('delete.User',$user->id)}}">削除</a>
                            </td>
                        </tr>
                        @endforeach
            @else
                <h2 class="pb-10">会員ユーザー一覧</h2>
                    <div class="text-left">
                        <table class="w-full border border-gray-900">
                            <tr>
                                <th>番号</th>
                                <th>ユーザー名</th>
                                <th>メールアドレス</th>
                                <th>電話番号</th>
                                <th>県地</th>
                                <th>操作</th>
                            </tr>
                            @foreach($users as $user)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $user->name}}</td>
                                <td>{{ $user->email}}</td>
                                <td>{{ $user->tel}}</td>
                                <td>{{ $user->residence->residence}}</td>
                                <td>
                                    <a href="{{route('consumers.update',$user->id)}}">編集</a>
                                    <a href="{{route('delete.User',$user->id)}}">削除</a>
                                </td>
                            </tr>
                            @endforeach
            @endif
                        <div class="justify-center">{{ $users->onEachSide(2)->links() }}</div>
                    </table>
                   
                </div>
            </div>

    </content>
    
    <footer class="bg-yellow-300 ">

    </footer>
@endsection