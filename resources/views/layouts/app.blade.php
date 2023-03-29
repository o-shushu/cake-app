<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
        *{
            margin: 0;
            padding: 0;
            text-decoration: none;
            list-style: none;
        }
        #banner{
            width: 800px;
            height: 400px;
            border: 2px solid black;
            overflow: hidden;
            position: relative;
        }
        #design{
            width: 3200px;
            height: 400px;
        } 
        #design img{
            width: 800px;
            height: 400px;
        }  
		#design li{
            float:left;
        }
        .prev{
            width: 80px;
            height: 60px;
            color: white;
            text-align: center;
            font-size: 40px;
            position: absolute;
            left:10px;
            top:140px;
            cursor:pointer;
        }
        .next{
            width: 80px;
            height: 60px;
            color: white;
            text-align: center;
            font-size: 40px;
            position: absolute;
            right:10px;
            top:140px;
            cursor:pointer;
        }
        #icoList{
            position: absolute;
            right: 10px;
            bottom: 10px;
        }
        #icoList li{
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: gray;
            text-align: center;
            line-height: 50px;
            color: white;
            float: left;
            margin-left: 5px;
            cursor: pointer;

        }

	    </style>
        
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @if(auth()->check())
                @include('layouts.guest-navigation')
            @else
                @include('layouts.navigation')
            @endif
        <!-- Page Content -->
            <main>
            @yield('content') 
            </main>
        </div>
    </body>
</html>

