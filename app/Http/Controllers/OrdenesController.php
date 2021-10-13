<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrdenesController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:ventas');
    }

    public function index()
    {
        $this->authorize('enabled', auth()->user());

        $allOrders = Order::all();
        $my_orders = [];
        $total = 0;

        foreach($allOrders as $order) {
            $items = json_decode($order->content);
            $flag = false;
            $total = 0;
            foreach($items as $item) {
                if($item->options->id_vendedor == auth()->user()->id) {
                    $flag = true;
                    $total += $item->price * $item->qty;
                }
            }
            if($flag) {
                $order['total_order'] = $total; 
                $my_orders[] = $order;
            }
        }

        return view('vendedor.ventas.index', compact('my_orders', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $orden)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $venta)
    {
        $this->authorize('enabled', auth()->user());

        $total = 0;
        $items = json_decode($venta->content);
        $my_articles = [];

        foreach($items as $item) {
            if($item->options->id_vendedor == auth()->user()->id) {
                $my_articles[] = $item;
                $total += $item->price * $item->qty;
            }
        }

        return view('vendedor.ventas.edit', compact('venta', 'my_articles', 'total'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $venta)
    {   
        $this->authorize('enabled', auth()->user());
        
        $resp = '';
        $status = '';

        if($request->get('status') != $venta->status) {
            $venta->status = $request->get('status');
            $venta->save();
            switch($request->get('status')) {
                case 2: $status = 'recibido'; break;
                case 3: $status = 'enviado'; break;
                case 4: $status = 'entregado'; break;
                default: $status = 'anulado';
            }
            $resp = 'Orden #'.$venta->id.' a '. $status;
        }

        return redirect()->route('ventas.index')->with('status', $resp);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
