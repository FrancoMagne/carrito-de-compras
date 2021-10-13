<?php

namespace App\Exports;

use App\Articulo;
use App\Models\Articulo as ModelsArticulo;
use Maatwebsite\Excel\Concerns\FromCollection;

class ArticulosExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $articulos = ModelsArticulo::select('name', 'quantity', 'price')
                                    ->where('user_id', '=', auth()->user()->id)
                                    ->get();
       
        return $articulos;
    }
}
