<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tarea extends Model
{
    protected $fillable = ['evento_id', 'titulo', 'descripcion', 'fecha'];

    public function evento(): BelongsTo {
        return $this->belongsTo(Evento::class);
    }
}
