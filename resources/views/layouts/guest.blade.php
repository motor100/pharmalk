<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <meta name="csrf-token" content="{{-- csrf_token() --}}"> -->
        <meta name="robots" content="noindex, nofollow">
        <link rel="shortcut icon" href="{{ asset('/img/favicon.svg') }}" type="image/x-icon">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <!-- <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> -->

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center py-8">
            <div class="logo">
                <img src="/img/natura-pharma-logo.svg" alt="">
            </div>
            <div class="title">Добро пожаловать на страницу<br>входа в личный кабинет</div>
            <div class="subtitle">введите свои данные выданные ранее администратором</div>
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
