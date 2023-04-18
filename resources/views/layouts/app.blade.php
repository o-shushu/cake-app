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
    
    </head>
    <body class="h-full">
        <header class="fixed z-10 top-0 w-full bg-yellow-300">
            @if(auth()->check())
                @include('layouts.guest-navigation')
            @else
                @include('layouts.navigation')
            @endif
        <!-- Page Content -->
        </header>
        <div class="min-h-screen">
            <main class="relative">
                @yield('content') 
            </main>
        </div>
        <footer class="flex items-center bg-yellow-300 h-10 w-full relative bottom-0 mt-1/5">
            <div class="w-full text-center">
                <i class="bi bi-0-square"></i>
                <p >© 2022 サイトDeli Cake</p>
            </div>
        </footer>  
    </body>
</html>

