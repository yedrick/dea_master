{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
</div>

@if (session('status') == 'verification-link-sent')
<div class="mb-4 font-medium text-sm text-green-600">
    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
</div>
@endif

<div class="mt-4 flex items-center justify-between">
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf

        <div>
            <x-primary-button>
                {{ __('Resend Verification Email') }}
            </x-primary-button>
        </div>
    </form>

    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <button type="submit"
            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            {{ __('Log Out') }}
        </button>
    </form>
</div>
</x-guest-layout> --}}
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

    <div class="bg-white p-6 w-4/5 h-4/5 flex flex-col justify-between border rounded-lg shadow-lg">

        <!-- Primera parte -->
        <div class="flex justify-center my-7">
            <select
                class="block appearance-none w-96 bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option>Option 1</option>
                <option>Option 2</option>
                <option>Option 3</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg>
            </div>
        </div>

        <!-- Segunda parte -->
        <div class="flex justify-center items-center flex-1 mb-4">
            <div class="grid grid-cols-4 grid-rows-2 gap-6 w-full max-w-4xl">
                <button class="bg-blue-500 p-12 rounded-lg text-white flex items-center justify-center">
                    <span class="font-semibold">ASISTENCIA <br> 1</span>
                </button>
                <button class="bg-green-500 p-12 rounded-lg text-white flex items-center justify-center">
                    <span class="font-semibold">PUNTUALIDAD<br>2</span>
                </button>
                <button class="bg-yellow-500 p-12 rounded-lg text-white flex items-center justify-center">
                    <span class="font-semibold">PUNTUALIDAD<br>2</span>
                </button>
                <button class="bg-red-500 p-12 rounded-lg text-white flex items-center justify-center">
                    <span class="font-semibold">PUNTUALIDAD<br>2</span>
                </button>
                <button class="bg-purple-500 p-12 rounded-lg text-white flex items-center justify-center">
                    <span class="font-semibold">PUNTUALIDAD<br>2</span>
                </button>
                <button class="bg-teal-500 p-12 rounded-lg text-white flex items-center justify-center">
                    <span class="font-semibold">PUNTUALIDAD<br>2</span>
                </button>
                <button class="bg-orange-500 p-12 rounded-lg text-white flex items-center justify-center">
                    <span class="font-semibold">PUNTUALIDAD<br>2</span>
                </button>
                <button class="bg-pink-500 p-12 rounded-lg text-white flex items-center justify-center">
                    <span class="font-semibold">PUNTUALIDAD<br>2</span>
                </button>
            </div>
        </div>

        <div class="flex justify-end">
            <button class="bg-blue-600 text-white px-6 py-2 rounded-lg shadow-md">
                GUARDAR
            </button>
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
