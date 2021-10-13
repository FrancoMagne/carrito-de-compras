<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;

    protected $guarded = []; 

    public function getRouteKeyName() {
        return 'slug';
    }

    public function categoria() {
        return $this->belongsTo(Categoria::class, 'category_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function sales() {
        $orders = Order::whereIn('status', [2,3,4])->get();
        $total = 0;

        foreach($orders as $order) {
            $items = json_decode($order->content);
            foreach($items as $item) {
                if($item->options->id_vendedor == auth()->user()->id) {
                    $total += $item->qty * $item->price;
                }
            }
        }
        
        return $total;
    }

}
