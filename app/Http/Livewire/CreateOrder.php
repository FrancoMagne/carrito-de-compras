<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Departament;
use App\Models\Order;
use App\Models\Province;
use Gloudemans\Shoppingcart\Facades\Cart;

class CreateOrder extends Component
{   
    public $contact, $phone;
    public $departaments = [], $provinces, $address, $reference;
    public $departament_id = "", $province_id = "";
    public $envio = 1, $costo = 0;

    public $rules = [
        'contact' => 'required',
        'phone' => 'required',
        'envio' => 'required'
    ];

    public function mount() {
        $this->provinces = Province::all();
    }

    public function updatedEnvio($value) {
        if($value == 1) {
            $this->resetValidation([
                'departament_id', 
                'province_id', 
                'address', 
                'reference'
            ]);

            //$this->reset('province_id','departament_id', 'address', 'reference');
        }
    }

    public function updatedProvinceId($value) {
        $this->departaments = Departament::where('province_id', $value)->get();
        $this->reset('departament_id', 'costo');
    }

    public function updatedDepartamentId($value) {
        $departament = Departament::where('id', $value)->first();
        $this->costo = $departament->cost;
    }

    public function create_order() {
        $rules = $this->rules;

        if($this->envio == 2) {
            $rules['departament_id'] = 'required';
            $rules['province_id'] = 'required';
            $rules['address'] = 'required';
            $rules['reference'] = 'required';
        }

        $this->validate($rules);

        $order = new Order();

        $order->user_id = auth()->user()->id;
        $order->contact = $this->contact;
        $order->phone = $this->phone;
        $order->shipping_type = $this->envio;
        $order->total = $this->costo + Cart::subtotal();
        $order->content = Cart::content();

        if($this->envio == 2) {
            $order->shipping_cost = $this->costo;
            $order->departament_id = $this->departament_id;
            $order->province_id = $this->province_id;
            $order->address = $this->address;
            $order->reference = $this->reference;
        } else {
            $order->shipping_cost = 0;
        }

        $order->save();

        foreach(Cart::content() as $item) {
            discount($item);
        }

        Cart::destroy();

        $this->emitTo('banner', 'render');
        
        return redirect()->route('orders.payment', $order);  
    }

    public function render()
    {
        return view('livewire.create-order');
    }
}
