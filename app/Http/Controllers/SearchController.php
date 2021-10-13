<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use Illuminate\Http\Request;
use Livewire\WithPagination;

class SearchController extends Controller
{   
    use WithPagination;
    
    public function __invoke(Request $request)
    {
        $name = $request->name;

        $articulos = Articulo::select('articulos.*')
/*                                 ->join('users', 'users.id' ,'articulos.user_id')
                                ->where('users.enabled', 1) */
                                ->where('articulos.enabled', 1)
                                ->where('articulos.visible', 1)
                                ->where('articulos.quantity', '>', 0)
                                ->where('articulos.name', 'LIKE', '%'.$name.'%')
                                ->latest('articulos.id')
                                ->paginate(8);

        return view('search', compact('articulos', 'name'));
    }
}
