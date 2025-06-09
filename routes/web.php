<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\EventoController;
use App\Http\Controllers\TareaController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [EventoController::class, 'dashboard'])->name('dashboard');

    Route::post('/eventos', [EventoController::class, 'store'])->name('eventos.store');
    Route::post('/eventos/{evento}/tareas', [TareaController::class, 'store'])->name('tareas.store');
});


Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::post('/eventos', [App\Http\Controllers\EventoController::class, 'store'])->name('eventos.store');
Route::post('/eventos/{evento}/tareas', [App\Http\Controllers\TareaController::class, 'store']);

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

//Route::get('/dashboard', function () {
//    return Inertia::render('Dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
