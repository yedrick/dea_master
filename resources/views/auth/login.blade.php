<x-guest-layout>
    <div class="max-w-md w-full mx-auto">
        <a href="{{ url('./') }}" class="flex justify-center items-center">
            <img class="transition-transform duration-500 ease-in-out hover:rotate-[360deg] w-40 h-30"
                src="{{ asset('image/logo1.png') }}" alt="logo">
        </a>
        <h1 class="text-xl font-bold text-center   mt-5 mb-4 "
            style="font-family: Helvetica, Arial, sans-serif; color:#727272">
            INICIO DE SESION
        </h1>

        <div class="bg-white rounded-lg overflow-hidden shadow-2xl">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-6">
                    <!-- Email Address -->
                    <div class="my-4 mx-2">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <!-- Password -->
                    <div class="my-4 mx-2">
                        <x-input-label for="password" :value="__('Contraseña')" />

                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="current-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <!-- Remember Me -->
                    <div class="my-4 mx-2">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                class="rounded border-gray-300 text-blue-900 shadow-sm focus:ring-blue-900"
                                name="remember">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Recuerdame') }}</span>
                        </label>
                    </div>

                    <x-primary-button class="w-96 my-4 mx-2 text-white rounded shadow justify-center"
                        style="font-family: Helvetica, Arial, sans-serif;background: #002860; ">
                        {{ __('Iniciar Sesion') }}
                    </x-primary-button>
                </div>
            </form>
        </div>

        <div class="flex justify-between p-8 text-sm border-t border-gray-300 bg-gray-100">
            <!--<a href="{{ url('./register') }}" class="font-medium text-base "-->
            <!--style="color: #002860">Crear Cuenta</a>-->

            @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('password.request') }}">
                {{ __('Olvidaste tu contraseña?') }}
            </a>
            @endif
        </div>
    </div>


</x-guest-layout>
