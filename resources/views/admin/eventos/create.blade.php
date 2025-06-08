@extends('layouts.app')

@section('content')
<div class="p-4">
    <h1 class="text-xl font-bold mb-4">Crear nuevo evento</h1>
    <form action="{{ route('eventos.store') }}" method="POST">
        @csrf
        <label>Cliente ID:</label>
        <input type="text" name="cliente_id" class="form-input mb-2">
        <label>Mensaje:</label>
        <textarea name="mensaje" class="form-textarea mb-2"></textarea>
        <button type="submit" class="btn btn-success">Crear</button>
    </form>
</div>
@endsection
