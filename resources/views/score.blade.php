
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body  class="flex items-center justify-center min-h-screen bg-gray-100">

    <div class="flex flex-col justify-between w-full h-auto max-w-screen-lg p-6 bg-white border rounded-lg shadow-lg sm:w-4/5">
        <form action="{{ url('save-score') }}" method="post">
            @csrf
            <!-- Primera parte -->
            <div class="flex flex-col items-center space-y-2 my-7">
                <label for="young_id" class="text-lg font-semibold text-gray-700">Jóvenes</label>
                <select class="js-states form-control select2 " id="young_id" name="young_id" onchange="filterByYoung()">
                    <option value="">Selecciona un joven</option>
                    @foreach ($youngs as $young)
                        {{-- // Aquí se debe de agregar el valor del joven seleccionado --}}
                        <option value="{{ $young->id }}" {{ $young->id == request()->young_id ? 'selected' : '' }}>
                            {{ $young->first_name.' '.$young->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Segunda parte -->
            <div class="flex items-center justify-center flex-1 mb-4">
                <div class="grid w-full max-w-4xl grid-cols-2 gap-6 sm:grid-cols-3 md:grid-cols-4">
                    @foreach ($type_scores as $type_score)
                        <label class="flex items-center justify-center p-6 text-white transition-all duration-300 bg-blue-500 rounded-lg cursor-pointer sm:p-8 md:p-10">
                            <input type="checkbox" name="score[]" class="hidden" value="{{ $type_score->id }}" onchange="toggleColor(this)">
                            <span class="font-semibold text-center">
                                {{ $type_score->name }}<br>({{ $type_score->score }} pts)
                            </span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="flex justify-end">
                <button class="px-6 py-2 text-white bg-blue-600 rounded-lg shadow-md" type="submit">
                    GUARDAR
                </button>
            </div>
        </form>
    </div>


    <script>
        window.addEventListener("DOMContentLoaded", () => Alpine.start());
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('js/sweet-alert.js') }}"></script>
    <script>
        function filterByYoung() {
            var youngId = document.getElementById("young_id").value;
            var url = new URL(window.location.href);
            if (youngId) {
                url.searchParams.set('young_id', youngId);
            } else {
                url.searchParams.delete('young_id');
            }
            window.location.href = url.toString();
        }
    </script>
    <script>
        function toggleColor(checkbox) {
            let label = checkbox.parentElement;
            if (checkbox.checked) {
                label.classList.remove('bg-blue-500');
                label.classList.add('bg-green-500');
            } else {
                label.classList.remove('bg-green-500');
                label.classList.add('bg-blue-500');
            }
        }
    </script>
    @stack('scripts')
</body>

</html>
