@extends('layouts.app_master')

@section('content')
<main class="main-content w-full px-[var(--margin-x)] pb-8">
    <div class="flex items-center py-5 space-x-4 lg:py-6">
        <div class="flex items-center space-x-1 group">
            <h2 class="text-2xl font-medium text-slate-700">Listado de Estudiantes</h2>
        </div>
    </div>

    <div class="mt-4">
        <div class="p-4 card sm:p-5">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Nombre</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">CI</th>
                        <th scope="col" class="px-6 py-3">Celular</th>
                        <th scope="col" class="px-6 py-3">Materia</th>
                        <th scope="col" class="px-6 py-3">Cursos</th>
                        <th scope="col" class="px-6 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teachers as $teacher)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4">{{ $teacher->name }}</td>
                        <td class="px-6 py-4">{{ $teacher->email }}</td>
                        <td class="px-6 py-4">{{ $teacher->ci_number }}</td>
                        <td class="px-6 py-4">{{ $teacher->phone }}</td>
                        <td class="px-6 py-4">{{ $teacher->subject->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4">
                            @if ($teacher->courses)
                                <ul>
                                    @foreach ($teacher->courses as $course)
                                        <li>{{ $course->fullname }}</li>
                                    @endforeach
                                </ul>
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ url('edit-teacher/' . $teacher->id) }}" class="text-blue-600 hover:underline">Editar</a>
                            <form action="{{ url('delete-teacher/' . $teacher->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection