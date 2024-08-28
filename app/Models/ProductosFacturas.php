<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductosFacturas extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function facturaDelProducto() {
        return $this->belongsTo(Factura::class, 'id_factura');
    }

    public function productoDeLaFactura() {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}
