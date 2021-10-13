<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function departamentos() {
        return $this->hasMany(Departament::class, 'province_id');
    } 

    public function ordenes() {
        return $this->hasMany(Order::class, 'province_id');
    }
}
