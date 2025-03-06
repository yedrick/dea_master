<div class="flex items-center py-5 space-x-4 lg:py-6">
    <div class="flex items-center space-x-1 group">
        <h2 class="text-xl font-medium text-slate-700 line-clamp-1 lg:text-2xl">
            {{ $node->plural ? __($node->plural) : $node->name }}
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
                            <a href="{{ url('model/'.$node->name) }}"
                                class="flex items-center h-8 px-3 pr-8 space-x-3 font-medium tracking-wide transition-all outline-none hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mt-px size-4.5" fill="none"
                                    viewbox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                                </svg>
                                {{-- dd node name singular --}}
                                <span>Nuevo {{ $node->singular ? __($node->singular) : $node->name }}</span></a>
                        </li>
                        @endif

                        <li>
                            <a href="{{ url('model-export/'.$node->name) }}"
                                class="flex items-center h-8 px-3 pr-8 space-x-3 font-medium tracking-wide transition-all outline-none hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mt-px size-4.5" fill="none"
                                    viewbox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                {{-- dd node name plural --}}
                                <span>Exportar {{ $node->plural ? __($node->plural) : $node->name }} </span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @include('node.nav', ['action' => 'show'])
</div>
