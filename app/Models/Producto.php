<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    public $timestamps = false; 

    protected $table = 'productos';

    protected $fillable = ['producto', 'marca', 'modelo', 'sistema', 'imagen', 'precio']; 

    public function factura() {
        return $this->hasMany(ProductosFacturas::class, 'id_producto');
    }

    

    public function scopeGetProductBySearch(Builder $query, $search){

        if($search !== ""){
            return $query->where('producto', 'LIKE', '%'.$search.'%')
                        ->orWhere('marca', 'LIKE', '%'.$search.'%')
                        ->orWhere('modelo', 'LIKE', '%'.$search.'%')
                        ->orWhere('sistema', 'LIKE', '%'.$search.'%');
            
        }

    }
};
