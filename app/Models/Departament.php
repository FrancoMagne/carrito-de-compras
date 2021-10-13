<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departament extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function provincia() {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function ordenes() {
        return $this->hasMany(Order::class, 'departament_id');
    }
}
