<x-guest-layout>
    <div class="max-w-md w-full mx-auto">
        <a href="{{ url('./') }}" class="flex justify-center items-center">
            <img class="transition-transform duration-500 ease-in-out hover:rotate-[360deg] w-40 h-40"
                src="{{ asset('image/logo1.png') }}" alt="logo">
        </a>
        <h1 class="text-xl font-bold text-center   mt-5 mb-4 "
        style="font-family: Helvetica, Arial, sans-serif; color:#727272" >
            REGISTRO
        </h1>

        <div class="bg-white rounded-lg overflow-hidden shadow-2xl">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="my-4 mx-2">
                    <x-input-label for="name" :value="__('Nombre')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="my-4 mx-2">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="my-4 mx-2">
                    <x-input-label for="password" :value="__('Contraseña')" />

                    <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="my-4 mx-2">
                    <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />

                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end my-4 mr-5">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-900"
                    href="{{ route('login') }}">
                        {{ __('¿Ya tienes una cuenta?') }}
                    </a>


                </div><x-primary-button class="w-96 my-4 mx-2 text-white rounded shadow justify-center" style="background: #002860; font-family: Helvetica, Arial, sans-serif">
                        {{ __('Registrate') }}
                    </x-primary-button>
            </form>
        </div>
    </div>
</x-guest-layout>
