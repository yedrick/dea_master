@extends('layouts.app_master')

@section('content')
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="flex items-center py-5 space-x-4 lg:py-6">
            <div class="flex items-center space-x-1 group">
                <h2 class="text-xl font-medium text-slate-700 line-clamp-1 lg:text-2xl">
                    Roles
                </h2>
                <div x-data="usePopper({placement:'bottom-start',offset:4})"
            @click.outside="isShowPopper  && (isShowPopper = false)" class="inline-flex">
            <button x-ref="popperRef" @click="isShowPopper = !isShowPopper"
                class="p-0 rounded-full btn size-8 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25">
                <i class="fas fa-chevron-down"></i>
            </button>

            <div x-ref="popperRoot" class="popper-root" :class="isShowPopper  && 'show'">
                <div class="popper-box rounded-md border border-slate-150 bg-white py-1.5 font-inter">
                    <ul>
                        @if (auth()->user()->can('create'))
                        <li>
                            <a href="{{ url('roles') }}"
                                class="flex items-center h-8 px-3 pr-8 space-x-3 font-medium tracking-wide transition-all outline-none hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mt-px size-4.5" fill="none"
                                    viewbox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                                </svg>
                                <span>Nuevo Rol</span></a>
                        </li>
                        @endif

                    </ul>
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
