<div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">

    <div x-data="{isFilterExpanded:false,isSecondDivExpanded: false,isCreatefilters:false}">
        @if (auth()->user()->hasRole('admin'))
            @include('node.filtro')
        @endif
        <div class="mt-3 card">
            <div class="min-w-full overflow-x-auto is-scrollbar-hidden">
                <table class="w-full text-left is-hoverable">
                    <thead>
                        <tr>
                            <th class="px-4 py-3 font-semibold uppercase whitespace-nowrap bg-slate-200 text-slate-800 lg:px-5">
                                No.
                            </th>
                            @foreach ($titles  as $key=>$field)
                                <th class="px-4 py-3 font-semibold uppercase whitespace-nowrap bg-slate-200 text-slate-800 lg:px-5">
                                    {{ $field->label ?__($field->label)  : $field->trans_name}}
                                </th>
                            @endforeach
                            {{-- adñadil funciones --}}
                            <th class="px-4 py-3 font-semibold uppercase whitespace-nowrap bg-slate-200 text-slate-800 lg:px-5">
                                Actiones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $key=>$item)
                        <tr class="border-transparent border-y border-b-slate-200">
                            <td class="px-4 py-3 whitespace-nowrap sm:px-5">{{ $key+1 }}</td>
                            @foreach ($titles  as $key=>$field)
                                @if ($field->relation === 1)
                                    <td class="px-4 py-3 font-medium whitespace-nowrap text-slate-700 sm:px-5">
                                        {{ $item->{$field->value}->name??$item->{$field->name} }}
                                    </td>
                                @elseif ($field->type === 'image')
                                    <td class="px-4 py-3 font-medium whitespace-nowrap text-slate-700 sm:px-5">
                                            <!--<a href="{{ asset('images/'.$node->name.'/'.$item->{$field->name}) }}">VER</a>-->
                                        @if(!empty($item->foto))
                                            <a href="{{ $item->foto }}" target="_blank">VER</a>
                                        @elseif(!empty($item->{$field->name}))
                                            <a href="{{ asset('images/'.$node->name.'/'.$item->{$field->name}) }}" target="_blank">VER</a>
                                        @else
                                            <span>No disponible</span>
                                        @endif
                                    </td>
                                @else
                                    <td class="px-4 py-3 font-medium whitespace-nowrap text-slate-700 sm:px-5">
                                        {{ $item->{$field->name} }}
                                    </td>
                                @endif
                            @endforeach
                            {{-- funciones para añadir --}}
                            <td class="px-4 py-3 whitespace-nowrap sm:px-5">
                                <div class="flex space-x-2 items center">
                                    @if (auth()->user()->can('edit'))
                                    <a href="{{ url('model/'.$node->name.'/'.$item->id) }}"
                                        class="p-1 rounded-full btn size-8 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4.5"  viewBox="0 0 600 600" stroke="currentColor" stroke-width="1.5" >
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152L0 424c0 48.6 39.4 88 88 88l272 0c48.6 0 88-39.4 88-88l0-112c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 112c0 22.1-17.9 40-40 40L88 464c-22.1 0-40-17.9-40-40l0-272c0-22.1 17.9-40 40-40l112 0c13.3 0 24-10.7 24-24s-10.7-24-24-24L88 64z"/>
                                        </svg>
                                    </a>
                                    @endif
                                    @if (auth()->user()->can('delete'))
                                    <a href="{{ url('model/delete/'.$node->name.'/'.$item->id) }}" class="p-1 rounded-full btn size-8 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </a>
                                    @endif

                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td class="px-4 py-3 whitespace-nowrap sm:px-5" colspan="{{ count($titles)+2 }}">
                                    <div class="flex items-center justify-center py-6 space-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-slate-300"
                                            fill="none" viewbox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        <span class="font-medium text-slate-300">No data found</span>
                                    </div>
                                </td>
                            </tr>

                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
