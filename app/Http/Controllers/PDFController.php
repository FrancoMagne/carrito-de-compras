<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class PDFController extends Controller
{
    public function PDF(){
        $this->authorize('enabled', auth()->user());
        $articulos = Articulo::all()->where('user_id', auth()->user()->id);
        $ventas = Articulo::sales();
        $pdf = PDF::loadView('vendedor.articulo.vistaPDF', compact('articulos', 'ventas'));
        return $pdf->stream('articulos.pdf');
    }
}
