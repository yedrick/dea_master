@extends('layouts.app_master')

@section('content')
<main class="main-content w-full px-[var(--margin-x)] pb-8">
    <div class="flex items-center py-5 space-x-4 lg:py-6">
        <div class="flex items-center space-x-1 group">
            <h2 class="text-2xl font-medium text-slate-700">DASHBOARD</h2>
        </div>
    </div>

    <div x-data="parentRegistration()" class="mt-4">
        <!-- Search Section -->
        <div class="p-4 card sm:p-5">
            <div class="flex flex-col gap-4 sm:flex-row">
                <input
                    type="text"
                    x-model="searchCarnet"
                    placeholder="Buscar papá por carnet"
                    class="form-input flex-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                >
                <button
                    @click="searchParent()"
                    class="font-medium text-white btn bg-primary hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90"
                >
                    Buscar Papá
                </button>
            </div>
        </div>

        <!-- Parent Form -->
        <div x-show="!parentFound" class="p-4 mt-4 card sm:p-5">
            <h2 class="text-lg font-medium tracking-wide text-slate-700 line-clamp-1">
                Registrar Nuevo Padre
            </h2>
            <div class="mt-4 space-y-4">
                <div>
                    <label class="block text-sm font-medium">Nombre</label>
                    <input
                        type="text"
                        x-model="parent.name"
                        class="form-input mt-1.5 w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    >
                </div>
                <div>
                    <label class="block text-sm font-medium">Email</label>
                    <input
                        type="email"
                        x-model="parent.email"
                        class="form-input mt-1.5 w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    >
                </div>
                <div>
                    <label class="block text-sm font-medium">Celular</label>
                    <input
                        type="tel"
                        x-model="parent.phone"
                        class="form-input mt-1.5 w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    >
                </div>
            </div>
        </div>

        <!-- Parent Info (when found) -->
        <div x-show="parentFound" class="p-4 mt-4 card sm:p-5">
            <h2 class="text-lg font-medium tracking-wide text-slate-700 line-clamp-1">
                Datos del Padre
            </h2>
            <div class="grid grid-cols-1 gap-4 mt-4 sm:grid-cols-2">
                <div>
                    <span class="block text-sm font-medium text-slate-600">Nombre:</span>
                    <span x-text="parent.name" class="block mt-1"></span>
                </div>
                <div>
                    <span class="block text-sm font-medium text-slate-600">Carnet:</span>
                    <span x-text="parent.ci_number" class="block mt-1"></span>
                </div>
                <div>
                    <span class="block text-sm font-medium text-slate-600">Email:</span>
                    <span x-text="parent.email" class="block mt-1"></span>
                </div>
                <div>
                    <span class="block text-sm font-medium text-slate-600">Celular:</span>
                    <span x-text="parent.phone" class="block mt-1"></span>
                </div>
            </div>
        </div>

        <!-- Children Forms -->
        <template x-for="(child, index) in children" :key="index">
            <div class="p-4 mt-4 card sm:p-5">
                <h2 class="text-lg font-medium tracking-wide text-slate-700 line-clamp-1">
                    Datos del Niño
                </h2>
                <div class="mt-4 space-y-4">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label class="block text-sm font-medium">Nombre</label>
                            <input
                                type="text"
                                x-model="child.first_name"
                                class="form-input mt-1.5 w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            >
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Apellido</label>
                            <input
                                type="text"
                                x-model="child.last_name"
                                class="form-input mt-1.5 w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            >
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">CI</label>
                        <input
                            type="text"
                            x-model="child.ci_number"
                            class="form-input mt-1.5 w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        >
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Celular</label>
                        <input
                            type="tel"
                            x-model="child.phone"
                            class="form-input mt-1.5 w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        >
                    </div>
                    <div>
                        <label class="block text-sm font-medium">fecha de nacimiento</label>
                        <input
                            type="date"
                            x-model="child.birthdate"
                            class="form-input mt-1.5 w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        >
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Sexo</label>
                        <select
                            x-model="child.sex"
                            class="form-select mt-1.5 w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        >
                            <option value="">Seleccione sexo</option>
                            <option value="F">Femenino</option>
                            <option value="M">Masculino</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Curso</label>
                        <select
                            x-model="child.course_id"
                            class="form-select mt-1.5 w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Seleccione un curso</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->fullname }}</option>
                            @endforeach
                        </select>
                    </div>

                   <!-- <div >
                         <h3 class="block text-sm font-medium">Curso</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach ($courses->chunk(5) as $chunk)
                                <ul class="w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    @foreach ($chunk as $course)
                                        <li class="w-full border-b border-gray-200 dark:border-gray-600">
                                            <div class="flex items-center gap-2 px-3 py-2">
                                                <input
                                                    type="radio"
                                                    x-model="child.course"
                                                    :value="{{$course->id}}" :id="course"
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:bg-gray-600 dark:border-gray-500">
                                                <label for="course" class="text-sm font-medium text-gray-900 dark:text-gray-300">
                                                    {{ $course->fullname }}
                                                </label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @endforeach
                        </div>
                    </div>-->
                </div>
            </div>
        </template>

        <!-- Action Buttons -->
        <div class="flex flex-col gap-4 mt-4 sm:flex-row">
            <button
                @click="addChild()"
                class="font-medium text-white btn bg-success hover:bg-success-focus focus:bg-success-focus active:bg-success-focus/90"
            >
                Añadir Otro Niño
            </button>
            <button
                @click="saveData()"
                class="font-medium text-white btn bg-primary hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90"
            >
                Guardar
            </button>
        </div>
    </div>
</main>

@push('scripts')
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        background: '#28a745', // Color verde de fondo
        color: '#ffffff',
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });

function parentRegistration() {
    return {
        searchCarnet: '',
        parentFound: false,
        parent: {
            name: '',
            email: '',
            ci_number: '',
            phone: ''
        },
        children: [
            {
                first_name: '',
                last_name: '',
                ci_number: '',
                sex: '',
                phone: '',
                birthdate:'',
                course_id: ''
            }
        ],

        async searchParent() {
            try {
                const response = await fetch(`/ajax/search-parent/${this.searchCarnet}`);
                const data = await response.json();
                console.log(data);
                if (data.status) {
                    this.parentFound = true;
                    this.parent = data.user;
                } else {
                    this.parentFound = false;
                    this.parent = {
                        name: '',
                        email: '',
                        phone: '',
                        ci_number: this.searchCarnet
                    };
                    // mandar alerta de que no se encontró el padre
                    alert('Padre no encontrado');

                }
            } catch (error) {
                console.error('Error searching parent:', error);
            }
        },

        addChild() {

            this.children.push({
                first_name: '',
                last_name: '',
                ci_number: '',
                sex: '',
                phone: '',
                birthdate:'',
                course_id: ''
            });
        },

        async saveData() {
            try {
                const data = {
                    parent: this.parent,
                    children: this.children
                };

                const response = await fetch('/ajax/save-registration', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(data)
                });

                if (response.ok) {
                    // mostra un mesnaje Toast
                    Toast.fire({
                        icon: "success",
                        title: "Datos guardados correctamente"
                    });

                } else {
                    Toast.fire({
                        icon: "error",
                        title: "Error al guardar los datos"
                    });
                }
            } catch (error) {
                console.error('Error saving data:', error);
            }
        }
    }
}
</script>
@endpush
@endsection
