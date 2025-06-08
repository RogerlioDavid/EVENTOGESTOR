<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use App\Models\PdfHistorial;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function descargarResumenPDF()
    {
        $eventos = Evento::with(['cliente', 'organizador'])->get();
        $pdf = Pdf::loadView('admin.pdf.resumen', compact('eventos'));
        $filename = 'resumen_eventos_' . now()->format('Ymd_His') . '.pdf';

        Storage::disk('public')->put('pdfs/' . $filename, $pdf->output());

        PdfHistorial::create([
            'user_id' => Auth::id(),
            'tipo' => 'resumen_admin',
            'ruta_pdf' => 'pdfs/' . $filename
        ]);

        return $pdf->download($filename);
    }
}
