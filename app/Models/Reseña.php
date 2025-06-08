<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reseña extends Model
{
    protected $fillable = ['evento_id', 'cliente_id', 'organizador_id', 'valoracion', 'comentario'];

    public function evento() {
        return $this->belongsTo(Evento::class);
    }

    public function cliente() {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    public function organizador() {
        return $this->belongsTo(User::class, 'organizador_id');
    }
    
}
