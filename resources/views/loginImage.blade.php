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

<body x-data="{isShowPopper :false}" class="is-header-blur bg-gray-100 flex items-center justify-center min-h-screen"
    x-bind="$store.global.documentBody" style="font-family: Helvetica, Arial, sans-serif;">
    <!-- Contenedor principal ajustado para pantallas pequeñas -->
    <div class="w-full max-w-4xl bg-white rounded-lg shadow-lg overflow-hidden p-6">
        <div class="flex flex-col md:flex-row gap-6 min-h-screen">
            <!-- Sección del formulario -->
            <div class="w-full md:w-1/3 p-6 flex flex-col items-center border-b md:border-r md:border-b-0">
                <!-- Imagen del logo ajustada para no cortarse y mejor centrado -->
                <img src="{{ asset('image/logo1.png') }}" alt="Imagen" class="w-32 h-32 object-contain mb-4">
                <h2 class="text-xl font-semibold mb-4">DATOS</h2>
                <input type="text" placeholder="Nombre" class="w-full mb-4 p-2 border border-gray-300 rounded-md">
                <input type="text" placeholder="Apellido" class="w-full mb-4 p-2 border border-gray-300 rounded-md">
                <input type="text" placeholder="Fecha de Nacimiento"
                    class="w-full p-2 border border-gray-300 rounded-md">
                <button class="w-60 py-2 bg-gray-500 text-white rounded shadow justify-center mt-8"
                    style="font-family: Helvetica, Arial, sans-serif;background: #6696d8;">
                    GUARDAR
                </button>
            </div>

            <!-- Sección de JUDEA COIN y el GIF -->
            <div class="w-full md:w-2/3 flex flex-col items-center justify-center space-y-6">
                <div class="flex items-center space-x-4">
                    <div class="text-2xl sm:text-3xl text-yellow-500 text-center font-semibold">
                        JUDEA COIN
                    </div>
                    <img src="{{ asset('image/coin.png') }}" alt="Coin Icon" class="w-12 sm:w-14 animate-pulse">
                </div>

                <div class="relative w-full max-w-[350px] overflow-hidden flex justify-center">
                    <div class="tenor-gif-embed scale-[1.3] -translate-x-1/6" data-postid="13609401"
                        data-share-method="host" data-aspect-ratio="1.33512" data-width="100%">
                        <a href="https://tenor.com/view/alcancia-ahorrar-guardar-chanchito-money-gif-13609401">
                            Alcancia Ahorrar GIF
                        </a>
                        from
                        <a href="https://tenor.com/search/alcancia-gifs">Alcancia GIFs</a>
                    </div>
                </div>

                <script type="text/javascript" async src="https://tenor.com/embed.js"></script>
                {{-- <img src="{{ asset('image/12.png') }}" alt="Cerdo Alcancia" class=" w-auto h-48 object-contain mb-4
                "> --}}
                <!-- Contenedor con el contador y JUDEA COIN -->
                <div
                    class="bg-black border-8 border-yellow-600 text-gray-300 text-2xl sm:text-4xl font-bold px-5 py-2 rounded-lg text-center w-auto mx-auto shadow-lg">
                    Bs. 10000000
                </div>
            </div>
        </div>
    </div>

    <script> vcc
        window.addEventListener("DOMContentLoaded", () => Alpine.start());

    </script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('js/sweet-alert.js') }}"></script>
    @stack('scripts')

</body>

</html>
