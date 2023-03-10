@extends('layouts.app')
@section('content')
<content>
<!-- ユーザー情報-->
            <div class="w-4/5 m-auto pt-20">
                <h2 class="pb-10">ユーザー情報</h2>
                <div  class="shopTable">
                   @foreach($userInformation as $item)
                        <div class="shopTableBox">
                            ユーザー名:<span>{{ $item->name }}</span>
                        </div>
                        <div class="shopTableBox">
                            メールアドレス:<span>{{ $item->email }}</span>
                        </div>
                        <div class="shopTableBox">
                            電話番号:<span>{{ $item->tel }}</span>
                        </div>
                        @foreach($residence as $item)
                            <div class="shopTableBox">
                                県地:<span>{{ $item->residence }}</span>
                            </div>
                        @endforeach
                   @endforeach
                </div>
                <div class="m-6">
                    @if(auth()->user()->type === 2)
                        <a href="{{ route('product.show') }}" class="bg-blue-400 text-white rounded py-2.5 px-6 hover:bg-blue-500">
                        戻る
                        </a>
                    @else
                        <a href="{{ route('home') }}" class="bg-blue-400 text-white rounded py-2.5 px-6 hover:bg-blue-500">
                        戻る
                        </a>
                    @endif
                    <a href="{{ route('user.Update') }}" class="bg-blue-400 text-white rounded py-2.5 px-6 hover:bg-blue-500">
                    変更
                    </a>
                </div>
            </div>

    </content>
    
    <footer class="bg-yellow-300 ">

    </footer>
@endsection