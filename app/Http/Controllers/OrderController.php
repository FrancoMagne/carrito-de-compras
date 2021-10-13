<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{

    public function index() {

        $orders = Order::query()->where('user_id', auth()->user()->id);

        if(request('status')) {
            $orders->where('status', request('status'));
        }

        $orders = $orders->get();

        $pendiente = Order::where('user_id', auth()->user()->id)->where('status', 1)->count();
        $recibido = Order::where('user_id', auth()->user()->id)->where('status', 2)->count();
        $enviado = Order::where('user_id', auth()->user()->id)->where('status', 3)->count();
        $entregado = Order::where('user_id', auth()->user()->id)->where('status', 4)->count();
        $anulado = Order::where('user_id', auth()->user()->id)->where('status', 5)->count();
        $todas = $pendiente + $recibido + $enviado + $entregado + $anulado;

        //session()->flash('flash.banner', 'Yay for free components!');
        //session()->flash('flash.bannerStyle', 'success');

        return view('orders.index', compact('orders', 'pendiente', 'recibido', 'enviado', 'entregado', 'anulado', 'todas'));
    }

    public function success(Order $orden, Request $request) {
        //$this->authorize('author', $orden);

        $orden->status = Order::RECIBIDO;
        $orden->save();

        $items = json_decode($orden->content);

        return view('orders.success', compact('orden', 'items'));
    }

    public function show(Order $orden) {
        $this->authorize('author', $orden);

        $items = json_decode($orden->content);

        return view('orders.show', compact('orden', 'items'));
    }

    /*public function pay(Order $orden, Request $request) {

        $this->authorize('author', $orden);

        $payment_id = $request->get('payment_id');

        $response = Http::get("https://api.mercadopago.com/v1/payments/$payment_id"."?access_token=APP_USR-2902606375393295-070918-f16ddaeac13b46e880ceac4d053b6187-788626205");

        $response = json_decode($response);

        $status = $response->status;

        if($status == 'approved') {
            $orden->status = Order::RECIBIDO;
            $orden->save();
        }

        return $status;
    } */

}
