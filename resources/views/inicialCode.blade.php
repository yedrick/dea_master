<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">
    {{-- @include('layouts.notificacion') --}}
    <div class="p-8 bg-white rounded-lg shadow-lg">
        <h1 class="mb-4 text-2xl font-bold">Ingrese un número de 3 dígitos</h1>
        @if (session('message_error'))
            <div class="text-red-500">{{ session('message_error') }}</div>
        @endif
        <form id="numeroForm" onsubmit="return validarYRedirigir()">
            @csrf
            <input
                type="text"
                id="numero"
                name="numero"
                pattern="\d{3}"
                title="Por favor, ingrese exactamente 3 dígitos."
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                required
            >
            <button
                type="submit"
                class="w-full px-4 py-2 mt-4 text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                Enviar
            </button>
        </form>
    </div>

    <script>
        function validarYRedirigir() {
            // Obtener el valor del input
            const numero = document.getElementById('numero').value;

            // Validar que tenga exactamente 3 dígitos
            if (/^\d{3}$/.test(numero)) {
                // Redirigir a la ruta dinámica
                window.location.href = `/view-pst/${numero}`;
                return false; // Evitar el envío del formulario
            } else {
                alert("Por favor, ingrese exactamente 3 dígitos.");
                return false; // Evitar el envío del formulario
            }
        }
    </script>
</body>
</html>