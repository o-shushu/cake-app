@extends('layouts.app')
@section('content')
<content>
<!-- 購入記録-->
    <div class="w-2/3 m-auto">
        <h2 class="pb-3 ">
            <span class="font-bold border-t-2 border-yellow-400 text-2xl">購入記録</span>  
        </h2>
        <table class="w-full border border-gray-900 text-xs sm:text-base">
            <tr>
                <th>番号</th>
                <th>到着予定</th>
                <th>支払方法</th>
                <th>合計金額</th>
                <th>配達地</th>
                <th>備考</th>
                <th>生成時間</th>
                <th>操作</th>
            </tr>
            @foreach($orders as $order)
            <tr>
                <td>{{$order->orderNo}}</td>
                    <td>{{$order->appointment_time}}</td>
                    <td>{{$order->payment_method}}</td>
                    <td>{{$order->total_price}}</td>
                    <td>{{$order->delivery_place}}</td>
                    <td>{{$order->content}}</td>   
                    <td>{{$order->created_at}}</td>
                    <td>
                    <a href="{{route('buyCode.Detail',$order->id)}}" class="bg-blue-400 rounded hover:bg-blue-500">詳細</a>
                    <a href="{{route('buyCode.Delete',$order->id)}}" class="bg-red-400 rounded hover:bg-red-500" onclick=" return confirm('本当に削除しますか？')">削除</a>
                </td>
            </tr>
            @endforeach
        </table>
        <div class="mt-10">
            <a href="{{ route('home') }}" class="bg-blue-400 text-white rounded py-2.5 px-6 hover:bg-blue-500">
            戻る
            </a>
        </div>  
    </div>
@endsection