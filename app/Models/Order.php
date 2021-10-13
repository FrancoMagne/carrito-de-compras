<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const PENDIENTE = 1;
    const RECIBIDO = 2; // Pago Recibido, Pedido En espera
    const ENVIADO = 3;
    const ENTREGADO = 4;
    const ANULADO = 5;

    public function departamento() {
        return $this->belongsTo(Departament::class, 'departament_id');
    }

    public function provincia() {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

}
