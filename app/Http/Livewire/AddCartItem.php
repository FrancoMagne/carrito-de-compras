<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class AddCartItem extends Component
{   
    public $qty = 1;
    public $articulo, $quantity;
    public $options = [];
    public $flag = true;

    public function mount() {
        $this->quantity = qtyAvailable($this->articulo->id);
        $this->options['image'] = $this->articulo->image;
        $this->options['id_vendedor'] = $this->articulo->user->id;
    }

    public function decrement() {
        $this->qty--;
    }

    public function increment() {
        $this->qty++;
    }

    public function addItem() {
        Cart::add([
            'id' => $this->articulo->id, 
            'name' => $this->articulo->name, 
            'qty' => $this->qty, 
            'price' => $this->articulo->price, 
            'weight' => 0,
            'options' => $this->options
        ]);
        $this->quantity = qtyAvailable($this->articulo->id);
        $this->reset('qty');
        $this->emitTo('dropdown-cart', 'render');
        $this->emitTo('cart-mobil', 'render');
    }

    public function render()
    {
        return view('livewire.add-cart-item');
    }
}
