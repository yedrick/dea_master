<!DOCTYPE html>
<html lang="es">

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

<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-3xl p-8 bg-white rounded-lg shadow-lg">
        <h3 class="mb-4 text-xl font-semibold text-center text-gray-600">Imagen </h3>
        {{-- cargar imagen --}}
        <div class="flex flex-col items-center justify-center h-screen p-4">
            <img src="{{ $link }}" alt="imagen" class="object-cover w-full h-auto max-w-md mb-4 rounded-lg shadow-lg">
            <a href="{{ url('register-young') }}" class="px-6 py-3 text-white transition duration-300 ease-in-out bg-blue-500 rounded-full hover:bg-blue-600 focus:outline-none">Crear otro</a>
        </div>


    </div>



</body>

</html>
