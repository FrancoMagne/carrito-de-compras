<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PaymentOrder extends Component
{   

    use AuthorizesRequests;

    public $orden;

    protected $listeners = ['payOrder'];

    public function mount(Order $orden) {
        $this->orden = $orden;
    }

    public function render()
    {
        $this->authorize('author', $this->orden);
        $this->authorize('payment', $this->orden);

        $items = json_decode($this->orden->content);
        return view('livewire.payment-order', compact('items'));
    }
    
}
