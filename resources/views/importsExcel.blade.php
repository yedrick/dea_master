@extends('layouts.app_master')

@section('content')
<main class="main-content w-full px-[var(--margin-x)] pb-8">
    <div class="flex items-center py-5 space-x-4 lg:py-6">
        <div class="flex items-center space-x-1 group">
            <h2 class="text-2xl font-medium text-slate-700">Excel Manager</h2>
        </div>
    </div>

    <!-- Contenedor Principal -->
    <div class="grid gap-6 md:grid-cols-2">
        <!-- Descargar Excel -->
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow">
            <h3 class="mb-4 text-lg font-semibold text-gray-700">Descargar Excel</h3> <br>
            <a href="{{ url('export-student') }}" class="px-2 py-2 text-white rounded-lg bg-secondary">
                Descargar Plantilla
            </a>
        </div>

        <!-- Subir Excel -->
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow">
            <h3 class="mb-4 text-lg font-semibold text-gray-700">Subir Excel</h3>
            <form action="{{ url('/import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mt-2 mb-4">
                    <label for="file" class="block text-sm font-medium text-gray-700">Selecionar curso:</label>
                    <select id="course_id" name="course_id" class="form-select mt-1.5 w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Seleciona Curso</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->fullname }}</option>
                        @endforeach
                    </select>
                    @error('course_id')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-2 mb-4">
                    <label for="file" class="block text-sm font-medium text-gray-700">Selecciona Materia:</label>
                    <select id="subject_id" name="subject_id" class="form-select mt-1.5 w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Seleccione Materia</option>
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @endforeach
                    </select>
                    @error('subject_id')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-2 mb-4">
                    <label for="file" class="block text-sm font-medium text-gray-700">Selecciona Materia:</label>
                    <select id="quarter_id" name="quarter_id" class="form-select mt-1.5 w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Seleccione Trimestre</option>
                        @foreach ($quaters as $quarter)
                            <option value="{{ $quarter->id }}">{{ $quarter->name }}</option>
                        @endforeach
                    </select>
                    @error('quarter_id')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-2 mb-4 ">
                    <label for="file" class="block text-sm font-medium text-gray-700">Selecciona un archivo Excel:</label>
                    <input type="file" name="file" id="file" accept=".xlsx, .xls" class="form-input mt-1.5 w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @error('file')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="px-2 py-2 mt-4 text-white bg-primary">
                    Subir Archivo
                </button>
            </form>
        </div>
    </div>
</main>
@endsection
