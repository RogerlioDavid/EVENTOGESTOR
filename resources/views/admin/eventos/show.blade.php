@extends('layouts.app')

@section('content')
<div class="p-4">
    <h1 class="text-xl font-bold mb-2">Detalles del evento</h1>
    <p><strong>Cliente:</strong> {{ $evento->cliente->name }}</p>
    <p><strong>Organizador:</strong> {{ $evento->organizador->name ?? 'Sin asignar' }}</p>
    <p><strong>Estado:</strong> {{ $evento->estado }}</p>
    <p><strong>Mensaje:</strong> {{ $evento->mensaje }}</p>

    <h2 class="text-lg font-semibold mt-4">Tareas</h2>
    <ul>
        @foreach ($evento->tareas as $tarea)
            <li>{{ $tarea->titulo }} - {{ $tarea->fecha }}</li>
        @endforeach
    </ul>
</div>
@endsection
