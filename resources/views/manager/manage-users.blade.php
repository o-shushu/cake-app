@extends('layouts.app')
@section('content')
<content>
<!-- ユーザー一覧-->
    <div class="w-2/3 m-auto">
    @if(isset($user) && $user == 'shopkeepers')
        <h2 class="pb-3 ">
            <span class="font-bold border-t-2 border-yellow-400 text-2xl">営業ユーザー一覧</span>  
        </h2>
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
                        <a href="{{route('shop.detail',$user->id)}}" class="bg-green-400 rounded hover:bg-green-500">店舗情報</a>
                        <a href="{{route('consumers.update',$user->id)}}" class="bg-blue-400 rounded hover:bg-blue-500">編集</a>
                        <a href="{{route('delete.User',$user->id)}}" class="bg-red-400 rounded hover:bg-red-500">削除</a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    @else
        <h2 class="pb-3 ">
            <span class="font-bold border-t-2 border-yellow-400 text-2xl">会員ユーザー一覧</span>  
        </h2>
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
                        <a href="{{route('consumers.update',$user->id)}}" class="bg-blue-400 rounded hover:bg-blue-500">編集</a>
                        <a href="{{route('delete.User',$user->id)}}" class="bg-red-400 rounded hover:bg-red-500">削除</a>
                    </td>
                </tr>
                @endforeach
    @endif
            </table>
            <div class="justify-center">{{ $users->onEachSide(2)->links() }}</div>
        </div>
    </div>
</content>
@endsection