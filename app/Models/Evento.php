<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'fecha',
        'estado',
        'imagen',
        'cliente_id',
    ];

    public function tareas()
    {
        return $this->hasMany(Tarea::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
