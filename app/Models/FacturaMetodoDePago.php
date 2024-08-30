<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturaMetodoDePago extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function facturaDelProducto() {
        return $this->belongsTo(Factura::class, 'id_factura');
    }

    public function productoDeLaFactura() {
        return $this->belongsTo(MetodoDePago::class, 'id_metodo_de_pago');
    }
}
