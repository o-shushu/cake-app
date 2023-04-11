@extends('layouts.app')
@section('content')
<content>
<!-- ユーザー情報-->
            <div class="w-4/5 m-auto">
                <h2 class="pb-3 ">
                  <span class="font-bold border-t-2 border-yellow-400 text-2xl">ユーザー情報変更</span>  
                </h2>
                <form method="POST" action="{{ route('user.Store') }}">
                    @csrf
                    <div class="max-w-lg mx-auto mb-3 bg-gray-300 border border-black-500 p-6 rounded-xl text-left">
                    @foreach($userInformation as $item)
                        <input type="text" name="userId" value="{{ $item->id }}" hidden>
                        <div class="p-2">
                            @error('name')
                                <p class="text-red-500"> {{ $message }}</p>
                            @enderror  
                            <label for=""> ユーザー名:</label></br>
                            <input type="text" name="name" value="{{ $item->name }}" class="h-10 w-full">
                        </div>
                        
                        <div class="p-2">
                            @error('email')
                                <p class="text-red-500"> {{ $message }}</p>
                            @enderror  
                            <label for="">メールアドレス:</label></br>
                            <input type="text" name="email" value="{{ $item->email }}" class="h-10 w-full">
                        </div>

                        <div class="p-2">
                            @error('tel')
                                <p class="text-red-500"> {{ $message }}</p>
                            @enderror  
                            <label for="">電話番号:</label></br>
                            <input type="text" name="tel" value="{{ $item->tel }}" class="h-10 w-full">
                        </div>
                        <div class="p-2">
                            @error('residence')
                                <p class="text-red-500"> {{ $message }}</p>
                            @enderror  
                            <label for="">県地:</label></br>
                            @foreach($residence as $item)
                            <select name="residence" class="border border-gray-400 p-2 w-full h-10">
                                @foreach ($residences as $residence)
                                    @if($item->residence ==  $residence->residence )
                                        <option value="{{ $residence->id }}" selected>{{ $residence->residence }}</option>
                                    @else
                                        <option value="{{ $residence->id }}">{{ $residence->residence }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @endforeach
                        </div>
                    @endforeach
                        <div class="mt-3 flex justify-around gap-10">
                            <a href="{{ url()->previous() }}" class="bg-blue-400 text-white rounded py-2.5 px-6 hover:bg-blue-500">
                                戻る
                            </a>
                            <button class="bg-blue-400 text-white rounded py-2.5 px-6 hover:bg-blue-500" type="submit">送る</button>
                        </div>
                    </div>
                </form>
            </div>

    </content>
    
    <footer class="bg-yellow-300 ">

    </footer>
@endsection
