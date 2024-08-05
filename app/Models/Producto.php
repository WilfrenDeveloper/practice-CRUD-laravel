<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    public $timestamps = false; 

    public function clientesDelProducto() {
        return $this->belongsToMany(Cliente::class, 'cliente_productos', 'id_producto', 'id_cliente');
    }

    public function facturasDelProducto() {
        return $this->belongsToMany(Factura::class, 'cliente_productos', 'id_producto', 'id_factura');
    }

       
}
