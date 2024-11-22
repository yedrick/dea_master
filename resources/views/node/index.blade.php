@extends('layouts.app_master')

@section('content')
    <main class="main-content w-full px-[var(--margin-x)] pb-8">

        @include('node.titulo')
        @include('node.listado')
    </main>
@endsection
