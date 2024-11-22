@extends('layouts.app_master')

@section('content')
<main class="main-content w-full px-[var(--margin-x)] pb-8">
    <div class="flex items-center py-5 space-x-4 lg:py-6">
        <h2 class="text-xl font-medium text-slate-800 lg:text-2xl">
            Editar {{ $node->singular ? __($node->singular) : $node->name }}
        </h2>
        @include('node.nav' , ['action' => 'edit'])
    </div>
    @include('node.form', ['edit' => true])
</main>
@endsection
