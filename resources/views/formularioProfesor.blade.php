@extends('layouts.app_master')

@section('content')
<main class="main-content w-full px-[var(--margin-x)] pb-8">
    <div class="flex items-center py-5 space-x-4 lg:py-6">
        <div class="flex items-center space-x-1 group">
            <h2 class="text-2xl font-medium text-slate-700">DASSWORD</h2>
        </div>
    </div>

    <div class="mt-4">
        <!-- Parent Form -->
        <div  class="p-4 mt-4 card sm:p-5">
            <h2 class="text-lg font-medium tracking-wide text-slate-700 line-clamp-1">Registrar Nuevo Docente</h2>
            <div class="mt-4 space-y-4">
                <div>
                    <label class="block text-sm font-medium">Nombre</label>
                    <input
                        type="text"
                        class="form-input mt-1.5 w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    >
                </div>
                <div>
                    <label class="block text-sm font-medium">Email</label>
                    <input
                        type="email"
                        class="form-input mt-1.5 w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    >
                </div>
                <div>
                    <label class="block text-sm font-medium">CI</label>
                    <input
                        type="texto"
                        class="form-input mt-1.5 w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    >
                </div>
                <div>
                    <label class="block text-sm font-medium">Celular</label>
                    <input
                        type="tel"
                        class="form-input mt-1.5 w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    >
                </div>
                <div>
                    <label class="block text-sm font-medium">Materia</label>
                    <select class="form-select mt-1.5 w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Seleccione una materia</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name}}</option>
                            @endforeach
                    </select>
                </div>
                <div >
                    <h3 class="block text-sm font-medium">Curso</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach ($courses->chunk(5) as $chunk)
                            <ul class="w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                @foreach ($chunk as $course)
                                    <li class="w-full border-b border-gray-200 dark:border-gray-600">
                                        <div class="flex items-center gap-2 px-3 py-2">
                                            <input id="course-{{ $course->id }}" type="checkbox" value="{{ $course->id }}" 
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="course-{{ $course->id }}" class="text-sm font-medium text-gray-900 dark:text-gray-300">
                                                {{ $course->fullname }}
                                            </label>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- Action Buttons -->
        <div class="flex flex-col gap-4 mt-4 sm:flex-row">
            <button class="font-medium text-white btn bg-primary hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90" >
                Guardar
            </button>
        </div>
    </div>
</main>
@endsection
