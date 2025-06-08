<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\Evento;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    public function store(Request $request, Evento $evento)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha' => 'required|date',
        ]);
        $evento->tareas()->create($data);
        return back()->with('success', 'Tarea añadida.');
    
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'estado' => 'required|in:Pendiente,En Proceso,Completado'
        ]);

        $data['evento_id'] = $eventoId;

        Tarea::create($data);

        return redirect()->route('dashboard')->with('success', 'Tarea agregada correctamente.');

    }

    public function update(Request $request, Tarea $tarea)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha' => 'required|date',
        ]);
        $tarea->update($data);
        return back()->with('success', 'Tarea actualizada.');
    }

    public function destroy(Tarea $tarea)
    {
        $tarea->delete();
        return back()->with('success', 'Tarea eliminada.');
    }

}

