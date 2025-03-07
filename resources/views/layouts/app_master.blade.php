<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        {{-- <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> --}}

        <!-- Scripts -->
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="{{ asset('js/app.js') }}" defer></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
    </head>
    <body x-data="{isShowPopper :false}" class="is-header-blur" x-bind="$store.global.documentBody" style="font-family: Helvetica, Arial, sans-serif;">
        {{-- <div id="notify-container" style="position: fixed; top: 0; left: 0; width: 100%; z-index: 9999;"> --}}
            @include('layouts.notificacion')
        {{-- </div> --}}
        <div id="root" class="flex min-h-100vh grow bg-slate-50 dark:bg-navy-900" x-cloak="">
            @include('layouts.sidebar')
            @include('layouts.navWeb')
            @include('layouts.navMobile')
            @yield('content')
        </div>
        <div id="x-teleport-target"></div>
        <script> window.addEventListener("DOMContentLoaded", () => Alpine.start());</script>
        <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
        {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
        <script src="{{ asset('js/sweet-alert.js') }}"></script>
        {{-- inserto js --}}
        @stack('scripts')
    </body>
</html>
