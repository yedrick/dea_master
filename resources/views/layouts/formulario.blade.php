@extends('layouts.app_master')

@section('content')
<main class="main-content w-full px-[var(--margin-x)] pb-8">
    <div class="flex items-center py-5 space-x-4 lg:py-6">
        <div class="flex items-center space-x-1 group">
            <h2 class="text-2xl font-medium text-slate-700">DASSWORD</h2>
        </div>
    </div>

    <div x-data="parentRegistration()" class="mt-4">
        <!-- Search Section -->
        <div class="card p-4 sm:p-5">
            <div class="flex flex-col sm:flex-row gap-4">
                <input 
                    type="text" 
                    x-model="searchCarnet" 
                    placeholder="Buscar papá por carnet"
                    class="form-input flex-1"
                >
                <button 
                    @click="searchParent()"
                    class="btn bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90"
                >
                    Buscar Papá
                </button>
            </div>
        </div>

        <!-- Parent Form -->
        <div x-show="!parentFound" class="card p-4 sm:p-5 mt-4">
            <h2 class="text-lg font-medium tracking-wide text-slate-700 line-clamp-1">
                Registrar Nuevo Padre
            </h2>
            <div class="mt-4 space-y-4">
                <div>
                    <label class="block text-sm font-medium">Nombre</label>
                    <input 
                        type="text" 
                        x-model="parent.name"
                        class="form-input mt-1.5 w-full"
                    >
                </div>
                <div>
                    <label class="block text-sm font-medium">Email</label>
                    <input 
                        type="email" 
                        x-model="parent.email"
                        class="form-input mt-1.5 w-full"
                    >
                </div>
                <div>
                    <label class="block text-sm font-medium">Celular</label>
                    <input 
                        type="tel" 
                        x-model="parent.phone"
                        class="form-input mt-1.5 w-full"
                    >
                </div>
            </div>
        </div>

        <!-- Parent Info (when found) -->
        <div x-show="parentFound" class="card p-4 sm:p-5 mt-4">
            <h2 class="text-lg font-medium tracking-wide text-slate-700 line-clamp-1">
                Datos del Padre
            </h2>
            <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <span class="block text-sm font-medium text-slate-600">Nombre:</span>
                    <span x-text="parent.name" class="block mt-1"></span>
                </div>
                <div>
                    <span class="block text-sm font-medium text-slate-600">Carnet:</span>
                    <span x-text="parent.carnet" class="block mt-1"></span>
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
            <div class="card p-4 sm:p-5 mt-4">
                <h2 class="text-lg font-medium tracking-wide text-slate-700 line-clamp-1">
                    Datos del Niño
                </h2>
                <div class="mt-4 space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium">Nombre</label>
                            <input 
                                type="text" 
                                x-model="child.name"
                                class="form-input mt-1.5 w-full"
                            >
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Apellido</label>
                            <input 
                                type="text" 
                                x-model="child.lastName"
                                class="form-input mt-1.5 w-full"
                            >
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">CI</label>
                        <input 
                            type="text" 
                            x-model="child.ci"
                            class="form-input mt-1.5 w-full"
                        >
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Celular</label>
                        <input 
                            type="tel" 
                            x-model="child.phone"
                            class="form-input mt-1.5 w-full"
                        >
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Curso</label>
                        <select 
                            x-model="child.course"
                            class="form-select mt-1.5 w-full"
                        >
                            <option value="">Seleccione un curso</option>
                            <option value="1">Curso 1</option>
                            <option value="2">Curso 2</option>
                            <option value="3">Curso 3</option>
                        </select>
                    </div>
                </div>
            </div>
        </template>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 mt-4">
            <button 
                @click="addChild()"
                class="btn bg-success font-medium text-white hover:bg-success-focus focus:bg-success-focus active:bg-success-focus/90"
            >
                Añadir Otro Niño
            </button>
            <button 
                @click="saveData()"
                class="btn bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90"
            >
                Guardar
            </button>
        </div>
    </div>
</main>

@push('scripts')
<script>
function parentRegistration() {
    return {
        searchCarnet: '',
        parentFound: false,
        parent: {
            name: '',
            email: '',
            phone: '',
            carnet: ''
        },
        children: [
            {
                name: '',
                lastName: '',
                ci: '',
                phone: '',
                course: ''
            }
        ],
        
        async searchParent() {
            try {
                const response = await fetch(`/api/search-parent/${this.searchCarnet}`);
                const data = await response.json();
                
                if (data.found) {
                    this.parentFound = true;
                    this.parent = data.parent;
                } else {
                    this.parentFound = false;
                    this.parent = {
                        name: '',
                        email: '',
                        phone: '',
                        carnet: this.searchCarnet
                    };
                }
            } catch (error) {
                console.error('Error searching parent:', error);
            }
        },

        addChild() {
            this.children.push({
                name: '',
                lastName: '',
                ci: '',
                phone: '',
                course: ''
            });
        },

        async saveData() {
            try {
                const data = {
                    parent: this.parent,
                    children: this.children
                };

                const response = await fetch('/api/save-registration', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(data)
                });

                if (response.ok) {
                    toastr.success('Datos guardados exitosamente');
                    // Opcional: redireccionar o resetear el formulario
                } else {
                    toastr.error('Error al guardar los datos');
                }
            } catch (error) {
                console.error('Error saving data:', error);
                toastr.error('Error al guardar los datos');
            }
        }
    }
}
</script>
@endpush
@endsection