@extends('layouts.app')
@section('content')
<content>
<!-- 購入記録-->
    <div class="w-2/3 m-auto pt-20">
        <h2 class="pb-10">購入記録</h2>
        <table class="w-full border border-gray-900">
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
                                <a href="{{route('buyCode.Detail',$order->id)}}">詳細</a>
                                <a href="">削除</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
    </div>  
@endsection