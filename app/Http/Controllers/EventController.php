<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Inertia\Inertia;

class EventController extends Controller
{
    public function dashboard()
    {
        $eventos = Evento::with('tareas')->get();
        return view('dashboard', compact('eventos'));
    }

    public function storeEvento(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'fecha' => 'required|date',
            'imagen' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('eventos', 'public');
        }

        Evento::create($data);

        return redirect()->route('dashboard')->with('success', 'Evento creado correctamente.');
    }


    public function index() {
        return Inertia::render('Events/Index', [
            'events' => Event::all()
        ]);
    }

    public function create() {
        return Inertia::render('Events/Create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'date' => 'required|date',
        ]);

        Event::create($request->all());
        return redirect()->route('events.index');
    }
}
