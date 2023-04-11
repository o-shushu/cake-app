@extends('layouts.app')
@section('content')
<content>
<!-- いいね一覧-->
    <div class="w-2/3 m-auto">
        @if(isset($like) && $like == 'shops')
        <h2 class="pb-3 ">
            <span class="font-bold border-t-2 border-yellow-400 text-2xl">店舗いいね一覧</span>  
        </h2>
        <div class="text-left">
            <table class="w-full border border-gray-900">
                <tr>
                    <th>順番</th>
                    <th>店舗名</th>
                    <th>いいね数</th>
                </tr>
                @foreach($shops as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->shop->shop_name}}</td>
                    <td>{{$item->total}}</td>
                </tr>
                @endforeach
                
            </table>
            
        </div>
        @else
        <h2 class="pb-3 ">
            <span class="font-bold border-t-2 border-yellow-400 text-2xl">商品いいね一覧</span>  
        </h2>
        <div class="text-left">
            <table class="w-full border border-gray-900">
                <tr>
                    <th>順番</th>
                    <th>店舗名</th>
                    <th>商品名</th>
                    <th>いいね数</th>
                </tr>
                @foreach($shops as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->cake->shop->shop_name}}</td>
                    <td>{{$item->cake->cake_name}}</td>
                    <td>{{$item->total}}</td>
                </tr>
                @endforeach
            </table> 
        </div>
        @endif      
        <div class="justify-center">{{ $shops->links() }}</div> 
    </div>
</content>
@endsection