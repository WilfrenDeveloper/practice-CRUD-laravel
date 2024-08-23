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

    protected $fillable = ['producto', 'marca', 'modelo', 'sistema', 'imagen']; 

    public function clientesDelProducto() {
        return $this->belongsToMany(Cliente::class, 'cliente_productos', 'id_producto', 'id_cliente');
    }

    public function facturasDelProducto() {
        return $this->belongsToMany(Factura::class, 'cliente_productos', 'id_producto', 'id_factura');
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
