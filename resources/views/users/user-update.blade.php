@extends('layouts.app')
@section('content')
<content>
<!-- ユーザー情報-->
            <div class="w-4/5 m-auto pt-20">
                <h2 class="pb-10">ユーザー情報</h2>
                <form method="POST" action="{{ route('user.Store') }}">
                    @csrf
                    <div class="max-w-lg mx-auto mt-10 bg-gray-300 border border-black-500 p-6 rounded-xl text-center">
                    @foreach($userInformation as $item)
                        <input type="text" name="userId" value="{{ $item->id }}" hidden>
                        <div class="p-6 text-center"> 
                            <label for=""> ユーザー名</label>
                            <input type="text" name="name" value="{{ $item->name }}">
                        </div>
                        
                        <div class="p-6 text-center"> 
                            <label for="">メールアドレス</label>
                            <input type="text" name="email" value="{{ $item->email }}">
                        </div>

                        <div class="p-6 text-center"> 
                            <label for="">電話番号</label>
                            <input type="text" name="tel" value="{{ $item->tel }}">
                        </div>
                        @foreach($residence as $item)
                            <select name="residence" class="border border-gray-400 p-2 w-full">
                                @foreach ($residences as $residence)
                                    @if($item->residence ==  $residence->residence )
                                        <option value="{{ $residence->id }}" selected>{{ $residence->residence }}</option>
                                    @else
                                        <option value="{{ $residence->id }}">{{ $residence->residence }}</option>
                                    @endif
                                @endforeach
                            </select>
                        @endforeach
                        
                    @endforeach
                    <div class="text-center mt-5">
                        <a href="{{ route('user.detail') }}" class="bg-blue-400 text-white rounded py-2.5 px-6 hover:bg-blue-500">
                        戻る
                        </a>
                        <button class="bg-blue-400 text-white rounded py-2.5 px-6 hover:bg-blue-500" type="submit">送る</button>
                    </div>
                </form>
            </div>

    </content>
    
    <footer class="bg-yellow-300 ">

    </footer>
@endsection
