<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriasHomeController extends Controller
{
    public function show(Categoria $categoria) {
        return view('home.categorias.show', compact('categoria'));
    }
}
