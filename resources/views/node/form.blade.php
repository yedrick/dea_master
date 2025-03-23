<div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
    <div class="col-span-12 sm:col-span-12">
        <div class="p-4 card sm:p-5">
            <p class="text-base font-medium text-slate-700">
                {{ $node->singular ? __($node->singular) : $node->name }}
            </p>
            <span class="text-error">Datos con (*) son requridos</span>
            <form action="{{ $edit?url('model/update/'.$node->name.'/'.$model->id):url('model/store/'.$node->name) }}" method="POST" enctype="multipart/form-data">
                @if (isset($model))
                    @method('PUT')
                @endif
                @csrf
                <div class="mt-4 space-y-4">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        @foreach ($field_form as $key=>$field)
                            @if ($field->type=='select')
                                @if ($field->relation==1)
                                    <label class="block">
                                        <span>{{ $field->label ? __($field->label) : $field->name }} <span class="text-error">{{ $field->required==1?'*':'' }}</span></span>
                                        <select class="mt-1.5 w-full " x-init="$el._tom = new Tom($el,{create: true,sortField: {field: 'text',direction: 'asc'}})" name="{{ $field->name }}" id="{{ $field->name }}" {{ $field->required==1?'required':null }} >

                                            @forelse (app($field->relation_cond)->get() as $realation)
                                                <option value="{{ $realation->id }}" {{ (isset($model) && $model->{$field->name} == $realation->id) ? 'selected' : '' }} > {{ $realation->name }}</option>
                                            @empty
                                                <option value="">No hay datos</option>
                                            @endforelse
                                        </select>
                                        @error($field->name)
                                                <span class="text-tiny+ text-error ">{{ $message }}</span>
                                        @enderror
                                    </label>
                                @else
                                    <label class="block">
                                        <span>{{ $field->label ? __($field->label) : $field->name }} <span class="text-error">{{ $field->required==1?'*':'' }}</span></span>
                                        <select class="mt-1.5 w-full " x-init="$el._tom = new Tom($el,{create: true,sortField: {field: 'text',direction: 'asc'}})" name="{{ $field->name }}" id="{{ $field->name }}" {{ $field->required==1?'required':null }}>
                                            @forelse ($field->options as $option)
                                                <option value="{{ $option->name }}" {{(isset($model) && $model->{$field->name} == $option->name) ? 'selected' : '' }} >{{ __($option->label) }}</option>
                                            @empty
                                                <option value="">No hay datos</option>
                                            @endforelse
                                        </select>
                                        @error($field->name)
                                                <span class="text-tiny+ text-error ">{{ $message }}</span>
                                        @enderror
                                    </label>
                                @endif
                            @elseif ($field->type=='image')
                                <label class="block">
                                    {{-- <span>{{ $field->label ? __($field->label) : $field->name }} <span class="text-error">{{ $field->required==1?'*':'' }}</span></span>
                                    <div class="filepond fp-grid fp-bordered [--fp-grid:4]">
                                        <input type="file"  x-init="$el._x_filepond = FilePond.create($el)" multiple  name="{{ $field->name }}" id="{{ $field->name }}"  accept="image/*" />
                                    </div>
                                    <span class="absolute flex items-center justify-center w-10 h-full pointer-events-none text-slate-400 peer-focus:text-primary">
                                        <i class="fa fa-file" aria-hidden="true"></i>
                                    </span> --}}
                                    <span><p>{{ $field->label ? __($field->label) : $field->name }} <span class="text-error">{{ $field->required==1?'*':'' }}</p></span> <br>
                                    <input type="file" name="{{ $field->name }}" id="{{ $field->name }}">
                                    @error($field->name)
                                            <span class="text-tiny+ text-error ">{{ $message }}</span>
                                    @enderror
                                </label>
                            @elseif ($field->type=='file')
                                <label class="block">
                                    <span>{{ $field->label ? __($field->label) : $field->name }} <span class="text-error">{{ $field->required==1?'*':'' }}</span></span>
                                    <div class="filepond fp-grid fp-bordered [--fp-grid:4]">
                                        <input type="file"  x-init="$el._x_filepond = FilePond.create($el)" multiple  name="{{ $field->name }}" id="{{ $field->name }}"  accept=".pdf,.doc,.xml," />
                                    </div>
                                    <span class="absolute flex items-center justify-center w-10 h-full pointer-events-none text-slate-400 peer-focus:text-primary">
                                        <i class="fa fa-file" aria-hidden="true"></i>
                                    </span>

                                    @error($field->name)
                                            <span class="text-tiny+ text-error ">{{ $message }}</span>
                                    @enderror
                                </label>
                            @elseif ($field->type=='date')
                                <label class="block">
                                    <span>{{ $field->label ? __($field->label) : $field->name }} <span class="text-error">{{ $field->required==1?'*':'' }}</span></span>
                                        <label class="relative flex">
                                            <input
                                            x-init="$el._x_flatpickr = flatpickr($el)"
                                            class="w-full px-3 py-2 bg-transparent border rounded-lg form-input peer border-slate-300 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary"
                                            placeholder="{{ $field->placeholder }}"
                                            type="text" value="{{ old($field->name, isset($model) ? $model->{$field->name} : '') }}" name="{{ $field->name }}" id="{{ $field->name }}" {{ $field->required==1?'required':null }}
                                            />
                                            <span class="absolute flex items-center justify-center w-10 h-full pointer-events-none text-slate-400 peer-focus:text-primary" >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="transition-colors duration-200 size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                            </span>
                                        </label>
                                        @error($field->name)
                                            <span class="text-tiny+ text-error ">{{ $message }}</span>
                                        @enderror

                                </label>
                            @elseif ($field->type=='integer' || $field->type=='decimal' )
                                <label class="block">
                                    <span>{{ $field->label ? __($field->label) : $field->name }} <span class="text-error">{{ $field->required==1?'*':'' }}</span></span>
                                    <span class="relative mt-1.5 flex">
                                        <input
                                            class="w-full px-3 py-2 bg-transparent border rounded-lg  @error($field->name) border-error @else border-slate-300 @enderror  form-input peer  pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary"
                                            placeholder="{{ $field->placeholder }}" type="number" value="{{ old($field->name, isset($model) ? $model->{$field->name} : '') }}" name="{{ $field->name }}" id="{{ $field->name }}" {{ $field->required==1?'required':null }}>
                                        <span class="absolute flex items-center justify-center w-10 h-full pointer-events-none text-slate-400 peer-focus:text-primary">
                                            <i class="fa fa-hashtag" aria-hidden="true"></i>
                                        </span>
                                    </span>
                                    @error($field->name)
                                            <span class="text-tiny+ text-error">{{ $message }}</span>
                                    @enderror
                                </label>
                            @elseif ($field->type=='password')
                                <label class="block">
                                    <span>{{ $field->label ? __($field->label) : $field->name }} <span class="text-error">{{ $field->required==1?'*':'' }}</span></span>
                                    <span class="relative mt-1.5 flex">
                                        <input
                                            class="w-full px-3 py-2 bg-transparent border rounded-lg  @error($field->name) border-error @else border-slate-300 @enderror  form-input peer  pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary"
                                            placeholder="{{ $field->placeholder }}" type="password" value="" name="{{ $field->name }}" id="{{ $field->name }}" {{ $field->required==1?'required':null }}>
                                        <span
                                            class="absolute flex items-center justify-center w-10 h-full pointer-events-none text-slate-400 peer-focus:text-primary">
                                            <i class="fa fa-key" aria-hidden="true"></i>
                                        </span>
                                    </span>
                                    @error($field->name)
                                            <span class="text-tiny+ text-error">{{ $message }}</span>
                                    @enderror
                                </label>
                            @elseif ($field->type=='email')
                                <label class="block">
                                    <span>{{ $field->label ? __($field->label) : $field->name }} <span class="text-error">{{ $field->required==1?'*':'' }}</span></span>
                                    <span class="relative mt-1.5 flex">
                                        <input
                                            class="w-full px-3 py-2 bg-transparent border rounded-lg  @error($field->name) border-error @else border-slate-300 @enderror  form-input peer  pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary"
                                            placeholder="{{ $field->placeholder }}" type="email" value="{{ old($field->name, isset($model) ? $model->{$field->name} : '') }}" name="{{ $field->name }}" id="{{ $field->name }}" {{ $field->required==1?'required':null }}>
                                        <span
                                            class="absolute flex items-center justify-center w-10 h-full pointer-events-none text-slate-400 peer-focus:text-primary">
                                            <i class="text-base fa-regular fa-building"></i>
                                        </span>
                                    </span>
                                    @error($field->name)
                                            <span class="text-tiny+ text-error">{{ $message }}</span>
                                    @enderror
                                </label>
                            @elseif ($field->type=='color')
                                <label class="block">
                                    <span>{{ $field->label ? __($field->label) : $field->name }} <span class="text-error">{{ $field->required==1?'*':'' }}</span></span>
                                    <span class="relative mt-1.5 flex">
                                        <input
                                            class="w-full px-3 bg-transparent border rounded-lg  @error($field->name) border-error @else border-slate-300 @enderror  form-input peer  pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary"
                                            type="color" value="{{ old($field->name, isset($model) ? $model->{$field->name} : '') }}" name="{{ $field->name }}" id="{{ $field->name }}" {{ $field->required==1?'required':null }}>
                                        <span
                                            class="absolute flex items-center justify-center w-10 h-full pointer-events-none text-slate-400 peer-focus:text-primary">
                                            <i class="fa fa-square-o" aria-hidden="true"></i>
                                        </span>
                                    </span>
                                    @error($field->name)
                                            <span class="text-tiny+ text-error">{{ $message }}</span>
                                    @enderror
                                </label>
                            @elseif($field->type=='checkbox')
                                <label class="block">
                                    <span>{{ $field->label ? __($field->label) : $field->name }} <span class="text-error">{{ $field->required==1?'*':'' }}</span></span>
                                    <div class="flex items-center mt-1.5">
                                        <select x-init="$el._tom = new Tom($el)" class="mt-1.5 w-full" multiple placeholder="Select a state..." autocomplete="off" name="{{ $field->name }}[]" id="{{ $field->name }}" {{ $field->required == 1 ? 'required' : null }}>
                                            @forelse (app($field->relation_cond)->get() as $relation)
                                                <option value="{{ $relation->id }}"
                                                    {{ (isset($model) && in_array($relation->id, old($field->name, json_decode($model->{$field->name} ?? '[]', true)))) ? 'selected' : '' }} >
                                                    {{ $relation->name }}
                                                </option>
                                            @empty
                                                <option value="">No hay datos</option>
                                            @endforelse
                                        </select>
                                    </div>
                                    @error($field->name)
                                            <span class="text-tiny+ text-error">{{ $message }}</span>
                                    @enderror
                                </label>
                            @else
                                <label class="block">
                                    <span>{{ $field->label ? __($field->label) : $field->name }} <span class="text-error">{{ $field->required==1?'*':'' }}</span></span>
                                    <span class="relative mt-1.5 flex">
                                        <input
                                            class="w-full px-3 py-2 bg-transparent border rounded-lg  @error($field->name) border-error @else border-slate-300 @enderror  form-input peer  pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary"
                                            placeholder="{{ $field->placeholder }}" type="text" value="{{ old($field->name, isset($model) ? $model->{$field->name} : '') }}" name="{{ $field->name }}" id="{{ $field->name }}" {{ $field->required==1?'required':null }}>
                                        <span
                                            class="absolute flex items-center justify-center w-10 h-full pointer-events-none text-slate-400 peer-focus:text-primary">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </span>
                                    </span>
                                    @error($field->name)
                                            <span class="text-tiny+ text-error">{{ $message }}</span>
                                    @enderror
                                </label>
                            @endif
                        @endforeach
                    </div>

                    <div class="flex justify-end space-x-2">
                        <a href="{{url('model-list/'.$node->name)}}" class="space-x-2 font-medium btn bg-slate-150 text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewbox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span>Atras</span>
                        </a>
                        <button class="space-x-2 font-medium text-white btn bg-primary hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90"
                            type="submit">
                            <span>Guardar</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewbox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
