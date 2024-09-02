<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['codigo', 'fecha_de_compra', 'valor_total', 'id_cliente'];

    public function cliente() {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function productos() {
        return $this->hasMany(ProductosFacturas::class, 'id_factura');
    }

    public function factura_metodoDePago() {
    
        return $this->hasMany(FacturaMetodoDePago::class,'id_factura','id');
    }
}
