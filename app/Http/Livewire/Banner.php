<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;

class Banner extends Component
{   
    public $pendientes = 0;
    public $message = 'nulo';

    protected $listeners = ['render'];

    public function render()
    {
        if(auth()->user() != null) {
           $this->pendientes = Order::where('user_id', auth()->user()->id)->where('status', 1)->count();
           $this->message = "Tienes $this->pendientes compras pendientes para abonar el pago "; 
           $this->message .= "de lo contrario las mismas serán eliminadas en 10 minutos.";
        }
        
        return view('livewire.banner');
    }
}
