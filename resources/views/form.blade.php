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
        <h3 class="mb-4 text-xl font-semibold text-center text-gray-600">FORMULARIO </h3>
        <h2 class="mb-4 text-6xl font-extrabold text-center text-blue-600 drop-shadow-2xl animate-pulse">
            {{$code}}
        </h2>
        <form action="{{ url('register-young') }}" method="POST" class="grid grid-cols-2 gap-4" enctype="multipart/form-data">
            @csrf
            <div>
                <label class="block mb-2 font-semibold text-gray-700">Nombre:</label>
                <input type="text" name="first_name" id="first_name"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div>
                <label class="block mb-2 font-semibold text-gray-700">Apellido Paterno:</label>
                <input type="text" name="last_name" id="last_name"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div>
                <label class="block mb-2 font-semibold text-gray-700">Apellido Materno:</label>
                <input type="text" name="last_name" id="last_name"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div>
                <label class="block mb-2 font-semibold text-gray-700">Fecha de nacimiento:</label>
                <input type="date" id="dateInput" min="1900-01-01" max="2021-12-31" name="birth_date"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div>
                <label class="block mb-2 font-semibold text-gray-700">Codigo:</label>
                <input type="text" name="code" id="code" value="{{$code}}" readonly
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div>
                <label class="block mb-2 font-semibold text-gray-700">Celular:</label>
                <input type="tel" name="phone_number" id="phone_number"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div>
                <label class="block mb-2 font-semibold text-gray-700">Carrera Universitaria:</label>
                <input type="text" name="career" id="career"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div>
                <label class="block mb-2 font-semibold text-gray-700">Discipulado:</label>
                <ul class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                        <div class="flex items-center ps-2"> <!-- Reducido de ps-3 a ps-2 -->
                            <input id="horizontal-list-radio-license" type="radio" value="Si" name="discipleship"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="horizontal-list-radio-license"
                                class="w-full py-3 text-sm font-medium text-gray-900 ms-1 dark:text-gray-300">Si
                            </label> <!-- Reducido ms-2 a ms-1 -->
                        </div>
                    </li>
                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                        <div class="flex items-center ps-2"> <!-- Reducido de ps-3 a ps-2 -->
                            <input id="horizontal-list-radio-id" type="radio" value="No" name="discipleship"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="horizontal-list-radio-id"
                                class="w-full py-3 text-sm font-medium text-gray-900 ms-1 dark:text-gray-300">No</label> <!-- Reducido ms-2 a ms-1 -->
                        </div>
                    </li>
                </ul>
            </div>


            <div>
                <label class="block mb-2 font-semibold text-gray-700">Bautizado:</label>
                <ul class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                        <div class="flex items-center ps-2"> <!-- Reducido de ps-3 a ps-2 -->
                            <input id="horizontal-list-radio-license" type="radio" value="Si" name="baptized"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="horizontal-list-radio-license"
                                class="w-full py-3 text-sm font-medium text-gray-900 ms-1 dark:text-gray-300">Si
                            </label> <!-- Reducido ms-2 a ms-1 -->
                        </div>
                    </li>
                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                        <div class="flex items-center ps-2"> <!-- Reducido de ps-3 a ps-2 -->
                            <input id="horizontal-list-radio-id" type="radio" value="No" name="baptized"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="horizontal-list-radio-id"
                                class="w-full py-3 text-sm font-medium text-gray-900 ms-1 dark:text-gray-300">No</label> <!-- Reducido ms-2 a ms-1 -->
                        </div>
                    </li>
                </ul>
            </div>


            <div class="col-span-2">
                <div class="w-full p-4 bg-white rounded-lg shadow-md">
                    <label class="block mb-2 font-semibold text-gray-700">Subir Imagen</label>
                    <input type="file" id="imageInput" name="image"
                        class="w-full p-2 text-sm border border-gray-300 rounded-md focus:ring focus:ring-blue-300">

                    <div id="preview" class="flex items-center justify-center w-full h-48 mt-4 border-2 border-gray-300 border-dashed rounded-lg">
                        <span class="text-gray-500">Previsualización</span>
                        <img id="previewImage" class="hidden max-w-full max-h-full rounded-lg">
                    </div>
                </div>


            </div>
            <div class="col-span-2 mt-4 text-center">
                <button class="px-6 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-900">GUARDAR</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const dateInput = document.getElementById("dateInput");
            if (!dateInput.value) {
                dateInput.value = "2000-01-01"; // Fecha predeterminada
            }
        });
        document.getElementById("imageInput").addEventListener("change", function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.getElementById("previewImage");
                    img.src = e.target.result;
                    img.classList.remove("hidden");
                    document.getElementById("preview").querySelector("span").classList.add("hidden");
                };
                reader.readAsDataURL(file);
            }
        });
    </script>

</body>

</html>
