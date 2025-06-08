@extends('layouts.app')

@section('content')

<div class="p-4"> <h1 class="text-2xl font-bold mb-2">{{ $organizador->name }}</h1>
<p class="mb-1"><strong>Email:</strong> {{ $organizador->email }}</p>

<p class="text-sm text-gray-600">
    Valoración promedio: {{ $organizador->promedioValoracion() }} estrellas
    ({{ $organizador->cantidadValoraciones() }} reseñas)
</p>

<h2 class="text-xl font-semibold mt-4">Reseñas</h2>
<ul class="list-disc pl-6">
    @foreach ($organizador->reseñasRecibidas as $reseña)
        <li>
            ⭐ {{ $reseña->valoracion }} - {{ $reseña->comentario }}
            <br>
            <small class="text-gray-500">Cliente: {{ $reseña->cliente->name }}</small>
        </li>
    @endforeach
</ul>
</div> @endsection

