<?php

namespace App\Http\Livewire;

use App\Models\Articulo;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class CategoryArticle extends Component
{   
    public $category;
    public $articulos = [];

    public function loadArticle() {
        $this->articulos = $this->category->articulos()->select('articulos.*')
/*                                         ->join('users', 'users.id', 'articulos.user_id')
                                        ->where('users.enabled', 1) */
                                        ->where('articulos.enabled', 1)
                                        ->where('articulos.visible', 1)
                                        ->where('articulos.quantity', '>', 0)
                                        ->latest('articulos.id')
                                        ->take(10)
                                        ->get();
        $this->emit('glider', $this->category->id);
    }

    public function render()
    {
        return view('livewire.category-article');
    }
}
