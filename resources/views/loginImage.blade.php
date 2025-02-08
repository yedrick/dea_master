<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body x-data="{isShowPopper :false}" class="flex items-center justify-center min-h-screen bg-gray-100 is-header-blur"
    x-bind="$store.global.documentBody" style="font-family: Helvetica, Arial, sans-serif;">
    <!-- Contenedor principal ajustado para pantallas pequeñas -->
    <div class="w-full max-w-4xl p-6 overflow-hidden bg-white rounded-lg shadow-lg">
        <div class="flex flex-col min-h-screen gap-6 md:flex-row">
            <!-- Sección del formulario -->
            <div class="flex flex-col items-center w-full p-4 border-b md:w-1/3 md:border-r md:border-b-0">
                <!-- Imagen del logo ajustada para no cortarse y mejor centrado -->
                <img src="{{ asset('image/logo1.png') }}" alt="Imagen" class="object-contain w-32 h-32 mb-4">

                <div class="w-full max-w-sm p-4 bg-white rounded-lg shadow-lg">
                    <div class="flex items-center space-x-4">
                        <img class="w-32 h-32 rounded-full" src="{{asset($link)}}" alt="Foto de perfil">
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">{{ $young->first_name.' '.$young->last_name }}</h2>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="text-gray-700"><span class="font-semibold">Numero:</span> {{ $young->code }}</p>
                        <p class="text-gray-700"><span class="font-semibold">Celular:</span> {{ $young->phone_number }}</p>
                        <p class="text-gray-700"><span class="font-semibold">Cumpleaños:</span> {{ $young->birth_date }} </p>
                    </div>
                </div>
            </div>

            <!-- Sección de JUDEA COIN y el GIF -->
            {{-- <div class="flex flex-col items-center justify-center w-full space-y-4 md:w-2/3">
                <div class="w-auto px-4 py-2 mx-auto text-2xl font-bold text-center text-gray-300 bg-black border-8 border-yellow-600 rounded-lg shadow-lg sm:text-4xl">
                    10000000
               </div>
                <div class="flex items-center space-x-4">
                    <div class="text-2xl font-semibold text-center text-yellow-500 sm:text-3xl">
                        JUDEA COIN
                    </div>
                    <img src="{{ asset('image/coin.png') }}" alt="Coin Icon" class="w-12 sm:w-14 animate-pulse">
                </div>

                <div class="relative w-full max-w-[550px] overflow-hidden flex justify-center">
                    <div class="tenor-gif-embed scale-[1.3] -translate-x-1/6" data-postid="13609401"
                        data-share-method="host" data-aspect-ratio="1.33512" data-width="100%">
                        <a href="{{ asset('image/alcancia-ahorrar.gif') }}">
                            <img src="{{ asset('image/alcancia-ahorrar.gif') }}"  class="object-contain mb-4 h-96 ">
                        </a>
                    </div>
                </div>
            </div> --}}
            <div class="flex flex-col items-center justify-center w-full space-y-4 md:w-2/3">
                <!-- Contenedor para la imagen y el número -->
                <div class="w-auto px-4 py-2 mx-auto text-2xl font-bold text-center text-gray-300 bg-black border-8 border-yellow-600 rounded-lg shadow-lg sm:text-4xl">
                    <div class="flex items-center justify-center">
                        <img src="{{ asset('image/coin.png') }}" alt="Coin Icon" class="w-12 mr-2 sm:w-14 animate-pulse">
                        <span>10 000 000</span>
                    </div>
                </div>

                <!-- Texto "JUDEA COIN" -->
                <div class="text-2xl font-semibold text-center text-yellow-500 sm:text-3xl">
                    JUDEA COIN
                </div>

                <!-- GIF debajo de todo -->
                <div class="relative w-full max-w-[550px] overflow-hidden flex justify-center">
                    <div class="tenor-gif-embed scale-[1.3] -translate-x-1/6" data-postid="13609401"
                        data-share-method="host" data-aspect-ratio="1.33512" data-width="100%">
                        <a href="{{ asset('image/alcancia-ahorrar.gif') }}">
                            <img src="{{ asset('image/alcancia-ahorrar.gif') }}" class="object-contain mb-4 h-96">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener("DOMContentLoaded", () => Alpine.start());

    </script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('js/sweet-alert.js') }}"></script>
    @stack('scripts')

</body>

</html>
