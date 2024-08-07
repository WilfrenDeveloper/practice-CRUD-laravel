<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function productoDeLaFactura() {
        return $this->belongsToMany(Producto::class, 'cliente_productos', 'id_factura', 'id_producto');
    }

    public function clienteDeLaFactura() {
        return $this->belongsToMany(Cliente::class, 'cliente_productos', 'id_factura', 'id_cliente');
    }
}
