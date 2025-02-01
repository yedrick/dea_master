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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body x-data="{isShowPopper :false}" class="is-header-blur bg-gray-100 h-screen flex items-center justify-center"
    x-bind="$store.global.documentBody" style="font-family: Helvetica, Arial, sans-serif;">


    <div class="w-1/2 bg-white rounded-lg shadow-lg overflow-hidden ">

        <!-- Contenido dividido horizontalmente -->
        <div class="flex">

            <!-- Primer parte: formulario -->
            <div class="w-1/3 p-6 flex flex-col items-center border-r">

                <!-- Imagen circular -->
                <img src="{{ asset('image/logo1.png') }}" alt="Imagen" class="w-24 h-24 rounded-full mb-4">

                <!-- Subtítulo -->
                <h2 class="text-xl font-semibold mb-4">DATOS</h2>

                <!-- Inputs del formulario -->
                <input type="text" placeholder="Nombre" class="w-full mb-4 p-2 border border-gray-300 rounded-md">
                <input type="text" placeholder="Apellido" class="w-full mb-4 p-2 border border-gray-300 rounded-md">
                <input type="text" placeholder="Fecha de Nacimiento" class="w-full p-2 border border-gray-300 rounded-md">
                <!-- Botón superior -->
                <button class="w-32 py-2 bg-gray-500 text-white rounded-md my-4">
                    Guardar
                </button>

            </div>

            <!-- Segunda parte: cerdo y contador -->


            <!-- Segunda parte: cerdo y contador -->
            <div class="w-2/3 p-4 flex flex-col items-center justify-center space-y-6">
                <!-- Imagen de cerdo (alcancia) más grande y centrada -->
                <div class="flex items-center space-x-4">

                    <!-- Contador -->

                <!-- Si necesitas una fuente tipo display, puedes agregarla como una clase -->
                <style>
                    @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap');
                </style>

                <!-- Usar la clase de la fuente en el contenedor -->

                    <!-- JUDEA COIN con diferente tipografía y alineado a la derecha -->
                    <div class="text-lg font-extrabold text-blue-500">
                        JUDEA COIN
                    </div>

                </div>
                <div class="tenor-gif-embed" data-postid="13609401" data-share-method="host" data-aspect-ratio="1.33512" data-width="80%">
                    <a href="https://tenor.com/view/alcancia-ahorrar-guardar-chanchito-money-gif-13609401">Alcancia Ahorrar GIF</a>
                    from
                    <a href="https://tenor.com/search/alcancia-gifs">Alcancia GIFs</a>
                </div>
                <script type="text/javascript" async src="https://tenor.com/embed.js"></script>
                {{-- <img src="{{ asset('image/12.png') }}" alt="Cerdo Alcancia" class=" w-auto h-48 object-contain mb-4 "> --}}
                    <!-- Contenedor con el contador y JUDEA COIN -->
                    <div class="bg-white border-8 border-blue-900 text-black text-5xl font-[PressStart2P] px-6 py-2 rounded-lg text-center w-auto mx-auto">
                        1234
                    </div>

            </div>

        </div>

    </div>

    <script>
        window.addEventListener("DOMContentLoaded", () => Alpine.start());

    </script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('js/sweet-alert.js') }}"></script>
    {{-- inserto js --}}
    @stack('scripts')
</body>

</html>
