<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PdfHistorial extends Model
{
    protected $table = 'pdf_historial';

    protected $fillable = ['user_id', 'tipo', 'evento_id', 'ruta_pdf'];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function evento(): BelongsTo {
        return $this->belongsTo(Evento::class);
    }
}
