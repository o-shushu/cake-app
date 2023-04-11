<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

  <style type="text/css">
    @font-face {
      font-family: ipaexm;
      font-style: normal;
      font-weight: normal;
      src: url('{{ storage_path("fonts/ipaexm.ttf") }}') format('truetype');
    }
    @font-face {
      font-family: ipaexm;
      font-style: bold;
      font-weight: bold;
      src: url('{{ storage_path("fonts/ipaexm.ttf") }}') format('truetype');
    }
    body {
      font-family: ipaexm !important;
    }
    table {
            border-collapse: collapse;
            width: 100%;
        }
        td {
            border:1px solid #000;
            word-break:break-all;
            word-wrap:break-word;
        }
        th {
            border:1px solid #000;
            font: bold;
        }
   </style>

</head>
<body>
    <div>
        <div>
            <img style="width: 200px; height:40px" src="{{asset('img/logo.png')}}" alt="menu-logo">
        </div>
        <h2 style="text-align: center;">売上報告</h2>
        <p style="text-align: right;">作成時間：{{$date}}</p>
        <table>
            <tr>
                <th>番号</th>
                <th>商品名</th>
                <th>サイズ</th>
                <th>価格</th>
                <th>販売量</th>
                <th>小計</th>
            </tr>
            @foreach($carts as $cart)
                @php
                $amount = $proceed->amount($cart->size,$cart->cake_id);
                $subtotal = $proceed->subtotal($cart->size,$cart->cake_id);
                @endphp
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$cart->cake->cake_name}}</td>
                    <td>{{$cart->size}}</td>
                    <td>{{$cart->price}}</td>
                    <td>{{$amount}}</td>
                    <td>{{$subtotal}}</td>
                </tr>
            @endforeach
        </table>
        @if(isset($tax) && isset($total))
        <div style="text-align: right;">
            <p>税金:{{$tax}}円</p>
            <p>総計:{{$total}}円</p>
        </div>
        @endif
        <div>
            <p>営業者：{{auth()->user()->name}}</p>
            <p>店舗名：{{$show_shop->shop_name}}</p>
        </div>
    </div>
</body>
</html>

