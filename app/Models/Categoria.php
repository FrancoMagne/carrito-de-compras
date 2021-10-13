<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $guarded = []; 

    public function getRouteKeyName() {
        return 'slug';
    }

    public function articulos() {
        return $this->hasMany(Articulo::class, 'category_id');
    }
}
