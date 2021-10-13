<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ArticulosHomeController extends Controller
{
    public function index() {
        $categorias = Categoria::all();
        /*$articulos = Articulo::select('articulos.*')
                            ->join('users', 'users.id' ,'articulos.user_id')
                            ->where('users.enabled', 1)
                            ->where('articulos.enabled', 1)
                            ->where('articulos.visible', 1)
                            ->latest('articulos.id')
                            ->paginate(12);*/
        return view('home.articulos.index', compact('categorias'));
    }

    public function show(Articulo $articulo) {
        $relacionados = Articulo::select('articulos.*')
/*                             ->join('users', 'users.id' ,'articulos.user_id')
                            ->where('users.enabled', 1) */
                            ->where('articulos.id', '!=', $articulo->id)
                            ->where('articulos.enabled', 1)
                            ->where('articulos.category_id', $articulo->category_id)
                            ->where('articulos.visible', 1)
                            ->latest('articulos.id')
                            ->take('4')
                            ->get();
        return view('home.articulos.show', compact('articulo', 'relacionados'));
    }
}
