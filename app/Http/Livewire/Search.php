<?php

namespace App\Http\Livewire;

use App\Models\Articulo;
use Livewire\Component;

class Search extends Component
{   
    public $search;
    public $open = false;

    public function updatedSearch($value) {
        if($value) {
            $this->open = true;
        } else {
            $this->open = false;
        }
    }

    public function render()
    {
        if ($this->search) {
            $articulos = Articulo::select('articulos.*')
/*                                 ->join('users', 'users.id' ,'articulos.user_id')
                                ->where('users.enabled', 1) */
                                ->where('articulos.enabled', 1)
                                ->where('articulos.visible', 1)
                                ->where('articulos.quantity', '>', 0)
                                ->where('articulos.name', 'LIKE', '%'.$this->search.'%')
                                ->latest('articulos.id')
                                ->take(8)
                                ->get();
        } else {
            $articulos = [];
        }
        
        return view('livewire.search', compact('articulos'));
    }
}
