@extends('layouts.app_master')

@section('content')
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="container p-4 mx-auto">
            <h1 class="mb-4 text-2xl font-bold">Cumpleañeros de Hoy</h1>

            <!-- Tarjeta de Cumpleañero -->
            <div class="p-6 mb-4 bg-white rounded-lg shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-semibold">Nombre del Cumpleañero</h2>
                        <p class="text-gray-600">Edad: 25 años</p>
                    </div>
                    <button onclick="openModal()" class="px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                        Enviar Mensaje
                    </button>
                </div>
            </div>

            <!-- Modal -->
            <div id="modal" class="fixed inset-0 hidden w-full h-full overflow-y-auto bg-gray-600 bg-opacity-50">
                <div class="relative p-5 mx-auto bg-white border rounded-md shadow-lg top-20 w-96">
                    <div class="mt-3 text-center">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Enviar Mensaje de Cumpleaños</h3>
                        <div class="py-3 mt-2 px-7">
                            <textarea id="message" class="w-full h-24 p-2 border rounded-lg" placeholder="Escribe tu mensaje aquí..."></textarea>
                        </div>
                        <div class="items-center px-4 py-3">
                            <button onclick="sendWhatsApp()" class="px-4 py-2 text-base font-medium text-white bg-green-500 rounded-md shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300">
                                Enviar por WhatsApp
                            </button>
                            <button onclick="closeModal()" class="px-4 py-2 ml-3 text-base font-medium text-white bg-gray-500 rounded-md shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300">
                                Cerrar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function openModal() {
                document.getElementById('modal').classList.remove('hidden');
            }

            function closeModal() {
                document.getElementById('modal').classList.add('hidden');
            }

            function sendWhatsApp() {
                const message = document.getElementById('message').value;
                const phoneNumber = '5512999999999'; // Número de teléfono del cumpleañero
                const url = `https://api.whatsapp.com/send?phone=${phoneNumber}&text=${encodeURIComponent(message)}`;
                window.open(url, '_blank');
                closeModal();
            }
        </script>
    </main>
@endsection
