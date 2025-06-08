<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Evento;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = $user->role;

        $eventos = Evento::with('tareas')->get();

        // Puedes usar Inertia si usas Vue, o usar una vista Blade
        if ($role === 'admin') {
            return Inertia::render('Dashboard/Admin', [
                'eventos' => $eventos,
            ]);
        }

        if ($role === 'organizador') {
            return Inertia::render('Dashboard/Organizador', [
                'eventos' => $eventos,
            ]);
        }

        // Si usas Blade directamente
        return view('dashboard', [
            'totalEventos' => Evento::count(),
            'enEspera' => Evento::where('estado', 'en espera')->count(),
            'finalizados' => Evento::where('estado', 'finalizado')->count(),
            'cancelados' => Evento::where('estado', 'cancelado')->count(),
            'eventosRecientes' => Evento::latest()->take(5)->get(),
            'eventos' => $eventos,
            'user' => $user,
        ]);
    }
}
