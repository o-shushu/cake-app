@extends('layouts.app')
@section('content')
<content>
<!-- ユーザー情報-->
            <div class="w-4/5 m-auto text-center">
                <h2 class="pb-3 ">
                  <span class="font-bold border-t-2 border-yellow-400 text-2xl">ユーザー情報</span>  
                </h2>
                <div  class="w-full sm:w-1/3 text-left m-auto">
                   @foreach($userInformation as $item)
                        <div class="mb-3 border-b-2 ">
                            ユーザー名:<span>{{ $item->name }}</span>
                        </div>
                        <div class="mb-3 border-b-2">
                            メールアドレス:<span>{{ $item->email }}</span>
                        </div>
                        <div class="mb-3 border-b-2">
                            電話番号:<span>{{ $item->tel }}</span>
                        </div>
                        @foreach($residence as $item)
                            <div class="mb-3 border-b-2">
                                県地:<span>{{ $item->residence }}</span>
                            </div>
                        @endforeach
                   @endforeach
                </div>
                <div class="mt-12 flex justify-around gap-10">
                    @if(auth()->user()->type === 2)
                       <div>
                            <a href="{{ route('home') }}" class="bg-blue-400 text-white rounded py-2.5 px-6 hover:bg-blue-500">
                            戻る
                            </a>
                       </div>
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