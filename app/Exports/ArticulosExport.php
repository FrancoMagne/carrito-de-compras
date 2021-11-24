<?php

namespace App\Exports;

use App\Articulo;
use App\Models\Articulo as ModelsArticulo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ArticulosExport implements FromCollection, WithHeadings
{
    public function headings(): array {
        return [
            'Nombre Producto',
            'Cantidad',
            'Precio Unitario',
        ];
    }
    
    public function collection()
    {
        $articulos = ModelsArticulo::select('name', 'quantity', 'price')
                                    ->where('user_id', '=', auth()->user()->id)
                                    ->get();
       
        return $articulos;
    }
}
