{{-- btn --}}
<div class="flex items-center justify-between">
    <h2 id="title_name"  class="text-base font-medium tracking-wide text-slate-700 line-clamp-1">
        Fitros de tabla
    </h2>
    <div class="flex">
        <div class="flex items-center" x-data="{isInputActive:false}">
            <label class="block">
                <input x-effect="isInputActive === true && $nextTick(() => { $el.focus()});"
                    :class="isInputActive ? 'w-32 lg:w-48' : 'w-0'"
                    class="px-1 text-right transition-all duration-100 bg-transparent form-input placeholder:text-slate-500"
                    placeholder="Busquedas..." type="text">
            </label>
            <button @click="isInputActive = !isInputActive"
                class="p-0 rounded-full btn size-8 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4.5" fill="none" viewbox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </button>
        </div>

        <button @click="isFilterExpanded = !isFilterExpanded" x-on:click="showDrawer('Fitros de tabla')"
            class="p-0 rounded-full btn size-8 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-4 sm:h-5 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
              </svg>
        </button>

        <button @click="isSecondDivExpanded  = !isSecondDivExpanded" x-on:click="showDrawer('Ordenar tabla')"
            class="p-0 rounded-full btn size-8 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-4 sm:h-5 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
              </svg>
        </button>

        <button @click="isCreatefilters = !isCreatefilters" x-on:click="showDrawer('Agregar filtros')"
            class="p-0 rounded-full btn size-8 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-4.5" fill="none" viewbox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                    d="M18 11.5H6M21 4H3m6 15h6"></path>
            </svg>
        </button>

    </div>
</div>
{{-- filtros --}}
<div x-show="isFilterExpanded" x-collapse="">
    <div class="max-w-full py-3">
        <form action="{{ url('model-list/'.$node->name)}}" method="get">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-5 lg:gap-6">
                @foreach ($filters as $key=>$filter)
                    @if ($filter->type=='text')
                        <label class="block">
                            <span>{{ $filter->name }}</span>
                            <input
                                class="w-full px-3 py-2 bg-transparent border rounded-lg form-input peer border-slate-300 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary"
                                placeholder="Ingresa {{ $filter->name }}" type="text" name="{{ $filter->label }}" value="{{ request()->input($filter->label)!=null?request()->input($filter->label):'' }}">
                        </label>
                    @elseif ($filter->type=='date')
                        <label class="block">
                            <span>{{ $filter->name }}</span>
                            <div class="relative mt-1.5 flex">
                                <input x-init="$el._x_flatpickr = flatpickr($el)"
                                    class="w-full px-3 py-2 bg-transparent border rounded-lg form-input peer border-slate-300 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary"
                                    placeholder="Inicio de fecha..." type="text" name="{{ $filter->label }}" value="{{ request()->input($filter->label)!=null?request()->input($filter->label):'' }}">
                                <span
                                    class="absolute flex items-center justify-center w-10 h-full pointer-events-none text-slate-400 peer-focus:text-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="transition-colors duration-200 size-5"
                                        fill="none" viewbox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </span>
                            </div>
                        </label>
                    @elseif ($filter->type=='number')
                        <label class="block">
                            <span>{{ $filter->name }}</span>
                            <input
                                class="w-full px-3 py-2 bg-transparent border rounded-lg form-input peer border-slate-300 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary"
                                placeholder="Ingresa {{ $filter->name }}" type="number" name="{{ $filter->label }}" value="{{ request()->input($filter->label)!=null?request()->input($filter->label):'' }}">
                        </label>
                    @endif

                @endforeach
                {{-- <label class="block">
                    <span>Desde:</span>
                    <div class="relative mt-1.5 flex">
                        <input x-init="$el._x_flatpickr = flatpickr($el)"
                            class="w-full px-3 py-2 bg-transparent border rounded-lg form-input peer border-slate-300 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary"
                            placeholder="Inicio de fecha..." type="text">
                        <span
                            class="absolute flex items-center justify-center w-10 h-full pointer-events-none text-slate-400 peer-focus:text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="transition-colors duration-200 size-5"
                                fill="none" viewbox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </span>
                    </div>
                </label>
                <label class="block">
                    <span>Hasta:</span>
                    <div class="relative mt-1.5 flex">
                        <input x-init="$el._x_flatpickr = flatpickr($el)"
                            class="w-full px-3 py-2 bg-transparent border rounded-lg form-input peer border-slate-300 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary"
                            placeholder="Finializacion de la fecha..." type="text">
                        <div
                            class="absolute flex items-center justify-center w-10 h-full pointer-events-none text-slate-400 peer-focus:text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="transition-colors duration-200 size-5"
                                fill="none" viewbox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </label>
                <label class="block">
                    <span>Nombre Pais:</span>
                    <div class="relative mt-1.5 flex">
                        <input
                            class="w-full px-3 py-2 bg-transparent border rounded-lg form-input peer border-slate-300 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary"
                            placeholder="Ingresa nombre de la ciudad" type="text">
                        <span
                            class="absolute flex items-center justify-center w-10 h-full pointer-events-none text-slate-400 peer-focus:text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4.5 transition-colors duration-200"
                                fill="none" viewbox="0 0 24 24">
                                <path stroke="currentColor" stroke-width="1.5"
                                    d="M5 19.111c0-2.413 1.697-4.468 4.004-4.848l.208-.035a17.134 17.134 0 015.576 0l.208.035c2.307.38 4.004 2.435 4.004 4.848C19 20.154 18.181 21 17.172 21H6.828C5.818 21 5 20.154 5 19.111zM16.083 6.938c0 2.174-1.828 3.937-4.083 3.937S7.917 9.112 7.917 6.937C7.917 4.764 9.745 3 12 3s4.083 1.763 4.083 3.938z">
                                </path>
                            </svg>
                        </span>
                    </div>
                </label> --}}
            </div>
            <div class="mt-4 space-x-1 text-right">
                <a href="{{ url('model-list/'.$node->name) }}" @click="isFilterExpanded = ! isFilterExpanded"
                    class="font-medium btn text-slate-700 hover:bg-slate-300/20 active:bg-slate-300/25">
                    Limpiar Filtro
                </a>

                <button @click="isFilterExpanded = ! isFilterExpanded"
                    class="font-medium text-white btn bg-primary hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90">
                    Aplicar Filtro
                </button>
            </div>
        </form>
    </div>
</div>

{{-- orden --}}
<div x-show="isSecondDivExpanded" x-collapse="">
    <div class="card max-w-full py-3 px-4 pt-2 pb-4">
        <form action="{{ url('model-order/'.$node->name) }}" method="post">
            @csrf
            <div x-init="Sortable.create($el, { animation: 200, easing: 'cubic-bezier(0, 0, 0.2, 1)', direction: 'vertical', delay: 150, delayOnTouchOnly: true, })" >
                @foreach ($fields->sortBy('order') as  $key=>$field)
                    <div class="border-b border-slate-150 py-3" @click="$dispatch('show-drawer', { drawerId: 'edit-todo-drawer' })">
                        <div class="flex items-center space-x-2 sm:space-x-3">
                            <label class="flex">
                                {{-- checkbox oculto --}}
                            <input type="hidden" name="display_order[]" value="{{ $field->name }}" checked>
                            <input type="checkbox" {{ $field->display_list=='show'?'checked':null }} name="display_list[]" value="{{ $field->name }}"
                                @click.stop="" class="form-checkbox is-outline size-5 rounded-full border-slate-400/70 before:bg-primary checked:border-primary hover:border-primary focus:border-primary">

                            </label>
                            <h2 class="cursor-pointer text-slate-600 line-clamp-1">
                                {{ $field->label ?__($field->label)  : $field->trans_name}}
                            </h2>
                        </div>
                        <div class="mt-1 flex items-end justify-between">
                            <div class="flex flex-wrap items-center font-inter text-xs" x-data=>
                                <p>Orden {{ $field->order }}</p>
                                <div class="m-1.5 w-px self-stretch bg-slate-200"></div>
                                @if ($field->display_list=='show')
                                    <div class="badge space-x-2.5 px-1 text-success">
                                        <div class="size-2 rounded-full bg-current"></div>
                                        <span >Lista</span>
                                    </div>
                                @elseif ($field->display_list=='none' || $field->display_list=='excel')
                                    <div class="badge space-x-2.5 px-1 text-error">
                                        <div class="size-2 rounded-full bg-current"></div>
                                        <span >Oculto</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4  text-left text-sm">
                <p>* Arrastra hacia arriba para ordenar. </p>
                <p>* Marca la casilla para mostrar</p>
            </div>
            <div class="mt-4 space-x-1 text-right">
                <a @click="isSecondDivExpanded = ! isSecondDivExpanded" class="btn bg-secondary/10 font-medium text-secondary hover:bg-secondary/20 focus:bg-secondary/20 active:bg-secondary/25" >
                    Cancelar
                </a>

                <button @click="isSecondDivExpanded = ! isSecondDivExpanded" class="font-medium text-white btn bg-primary hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90" >
                    Aplicar
                </button>
            </div>
        </form>
    </div>
</div>

{{-- agregar filtros --}}
<div x-show="isCreatefilters" x-collapse="">
    <div class="card max-w-full py-3 px-4 pt-2 pb-4" x-data="{isFilterRelation:false}">
        <form action="{{ url('model-filter/'.$node->name) }}" method="post">
            @csrf
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-5 lg:gap-6">
                <label class="block">
                    <span>Nombre del filtro:</span>
                    <input
                        class="w-full px-3 py-2 bg-transparent border rounded-lg form-input peer border-slate-300 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary"
                        placeholder="Ingresa nombre del filtro" type="text" name="name">
                </label>
                <input type="hidden" name="value" id="value">
                <label class="block" x-data="dropdownComponent()">
                    <span>Nombre del campo:</span>
                    <select
                        class="w-full px-3 py-2 bg-transparent border rounded-lg form-input peer border-slate-300 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary"
                        name="field" @change="handleSelectChange($event)">
                        <option value="">Selecciona un campo</option>
                        @foreach ($fields as $field)
                            @if ($field->relation === 1)
                                <option value="{{ $field->name }}" data-relation="{{ $field->value }}" data-field_id="{{ $field->id }}" >{{ $field->label ?__($field->label)  : $field->name}}</option>
                            @else
                                <option value="{{ $field->name }}">{{ $field->label ?__($field->label)  : $field->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </label>
                <label class="block">
                    <span>Operador:</span>
                    <select
                        class="w-full px-3 py-2 bg-transparent border rounded-lg form-input peer border-slate-300 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary"
                        name="operator">
                        <option value="like">Contiene</option>
                        <option value="not like">No contiene</option>
                        <option value="=">Igual</option>
                        <option value="!=">Diferente</option>
                        <option value=">">Mayor</option>
                        <option value=">=">Mayor Igual</option>
                        <option value="<">Menor</option>
                        <option value="<=">Menor Igual</option>
                    </select>
                </label>
                {{-- type radio text,date --}}
                <label class="block">
                    <span>Valor:</span>
                    <div class="mt-5 grid grid-cols-2 place-items-start gap-6 sm:grid-cols-3">
                        <label class="inline-flex items-center space-x-2">
                            <input
                              checked
                              class="form-radio is-outline size-5 rounded-md border-slate-400/70 before:bg-slate-500 checked:border-slate-500 hover:border-slate-500 focus:border-slate-500"
                              name="type"
                              type="radio"
                              value="text"
                            />
                            <p>Texto</p>
                        </label>
                        <label class="inline-flex items-center space-x-2">
                            <input
                              class="form-radio is-outline size-5 rounded-md border-slate-400/70 before:bg-slate-500 checked:border-slate-500 hover:border-slate-500 focus:border-slate-500"
                              name="type"
                              type="radio"
                              value="number"
                            />
                            <p>Numero</p>
                        </label>
                        <label class="inline-flex items-center space-x-2">
                            <input
                              class="form-radio is-outline size-5 rounded-md border-slate-400/70 before:bg-slate-500 checked:border-slate-500 hover:border-slate-500 focus:border-slate-500"
                              name="type"
                              type="radio"
                              value="date"
                            />
                            <p>Fecha</p>
                        </label>
                    </div>
                </label>

                <label class="block" x-show="isFilterRelation">
                    <span>Relacion:</span>
                    <select class="w-full px-3 py-2 bg-transparent border rounded-lg form-input peer border-slate-300 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary"
                        name="field_relation" id="field_relation" >
                        <option value="">Selecciona una relacion</option>
                    </select>
                </label>
            </div>
            <div class="mt-4 space-x-1 text-right">
                <a @click="isCreatefilters = ! isCreatefilters" class="btn bg-secondary/10 font-medium text-secondary hover:bg-secondary/20 focus:bg-secondary/20 active:bg-secondary/25" >
                    Cancelar
                </a>

                <button @click="isCreatefilters = ! isCreatefilters" class="font-medium text-white btn bg-primary hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90" >
                    Aplicar
                </button>
            </div>
        </form>

    </div>
</div>

<script>
    function showDrawer(text) {
        document.getElementById('title_name').innerText = text;
    }

    function dropdownComponent() {
        return {
            handleSelectChange(event) {
                const selectedValue = event.target.value;
                // verificar q tenga '_id'
                const relation = event.target.options[event.target.selectedIndex].getAttribute('data-relation');
                if (relation) {
                    let value=event.target.value;
                    let id=event.target.options[event.target.selectedIndex].getAttribute('data-field_id');
                    document.getElementById('value').value = relation;
                    let params={value:value,id:id};
                    submitAjax(params);
                    this.isFilterRelation = true;
                } else {
                    this.isFilterRelation = false;
                }
                console.log(selectedValue);
            }
        };
    }

    function submitAjax(params) {
        console.log(params);
        // consultamos al servidor de los datos de la relcion parap llenar las opciones por metodo GET
        fetch("{{ url('model-ajax/relation/'.$node->name) }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(params)
        })
            .then(response => response.json())
            .then(data => {
                // selecioanamos el select field_relation
                let select = document.getElementById('field_relation');
                // limpiamos las opciones
                select.innerHTML = '';
                // creamos la opcion por defecto
                let option = document.createElement('option');
                option.value = '';
                option.text = 'Selecciona una relacion';
                select.add(option);
                // recorremos los datos de la respuesta
                data.forEach(element => {
                    // creamos la opcion
                    let option = document.createElement('option');
                    option.value = element.name;
                    option.text = element.label;
                    // agregamos la opcion al select
                    select.add(option);
                });

                console.log(data);
            })
            .catch((error) => {
                console.error('Error:', error);
            });



    }

</script>
