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

    protected $fillable = ['producto', 'marca', 'modelo', 'sistema', 'cantidad', 'imagen', 'precio']; 

    public function factura() {
        return $this->hasMany(ProductosFacturas::class, 'id_producto');
    }

    

    public function scopeGetProductBySearch(Builder $query, $search){
        if(trim($search) !== ""){
            $products = explode(' ', trim($search));
            return $query->where(function($q) use ($products){
                foreach($products as $product){
                    $q->where(function ($subQuery) use ($product) {
                        $subQuery->where('producto', 'LIKE', '%'.$product.'%')
                                 ->orWhere('marca', 'LIKE', '%'.$product.'%')
                                 ->orWhere('modelo', 'LIKE', '%'.$product.'%')
                                 ->orWhere('sistema', 'LIKE', '%'.$product.'%');
                    });
                }
            });
        }

        if(trim($search) === "") return $query;
    }
};
