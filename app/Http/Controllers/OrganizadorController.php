<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\User;

class OrganizadorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified', 'role:organizador']);
    }

    // Muestra todos los eventos al organizador
    public function index()
    {
        $eventos = Evento::all();
        return view('organizador.eventos.index', compact('eventos'));
    }

    // Muestra el perfil del organizador con sus reseñas recibidas
    public function show(User $organizador)
    {
        // Verifica que tenga el rol correcto
        if (!$organizador->hasRole('organizador')) {
            abort(404);
        }

        // Cargar relaciones necesarias (ejemplo: reseñas del cliente)
        $organizador->load('reseñasRecibidas.cliente');

        return view('organizador.show', compact('organizador'));
    }
}
