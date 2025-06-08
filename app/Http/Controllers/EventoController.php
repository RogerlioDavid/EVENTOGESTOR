<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    public function index()
    {
        $eventos = Evento::with(['cliente', 'organizador'])->get();
        return view('admin.eventos.index', compact('eventos'));
    }

    public function show(Evento $evento)
    {
        return view('admin.eventos.show', compact('evento'));
    }

    public function create()
    {
        return view('admin.eventos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'cliente_id' => 'required|exists:users,id',
            'mensaje' => 'nullable|string',
        ]);
        Evento::create($data);
        return redirect()->route('eventos.index')->with('success', 'Evento creado.');
    }

    public function edit(Evento $evento)
    {
        return view('admin.eventos.edit', compact('evento'));
    }

    public function update(Request $request, Evento $evento)
    {
        $data = $request->validate([
            'estado' => 'required|in:disponible,ocupado,finalizado',
            'organizador_id' => 'nullable|exists:users,id',
        ]);
        $evento->update($data);
        return redirect()->route('eventos.index')->with('success', 'Evento actualizado.');
    }

    public function destroy(Evento $evento)
    {
        $evento->delete();
        return redirect()->route('eventos.index')->with('success', 'Evento eliminado.');
    }
}
