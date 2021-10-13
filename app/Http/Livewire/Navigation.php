<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use Livewire\Component;

class Navigation extends Component
{
    public function render()
    {
        $categories = Categoria::all();
        return view('livewire.navigation', compact('categories'));
    }
}
