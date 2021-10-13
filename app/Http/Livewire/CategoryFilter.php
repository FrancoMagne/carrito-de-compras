<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class CategoryFilter extends Component
{   
    use WithPagination;

    public $category;

    public $view = 'grid';

    public function render()
    {
        $articulos = $this->category->articulos()->select('articulos.*')
/*                                     ->join('users', 'users.id' ,'articulos.user_id')
                                    ->where('users.enabled', 1) */
                                    ->where('articulos.enabled', 1)
                                    ->where('articulos.visible', 1)
                                    ->where('articulos.quantity', '>', 0)
                                    ->latest('articulos.id')
                                    ->paginate(10);
        return view('livewire.category-filter', compact('articulos'));
    }
}
