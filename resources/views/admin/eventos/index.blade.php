@extends('layouts.app')

@section('content')
<div class="p-4">
    <h1 class="text-xl font-bold mb-4">Lista de eventos</h1>
    <a href="{{ route('eventos.create') }}" class="btn btn-primary mb-2">Crear nuevo evento</a>
    <ul>
        @foreach ($eventos as $evento)
            <li>
                <a href="{{ route('eventos.show', $evento) }}">{{ $evento->estado }} - {{ $evento->cliente->name }}</a>
            </li>
        @endforeach
    </ul>
</div>
@endsection
