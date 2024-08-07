<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'clientes';

    protected $fillable = ['nombre', 'apellido', 'nacimiento', 'telefono'];

    public function productosDelCliente() {
        return $this->belongsToMany(Producto::class, 'cliente_productos', 'id_cliente', 'id_producto');
    }

    public function facturasDelCliente() {
        return $this->belongsToMany(Factura::class, 'cliente_productos', 'id_cliente', 'id_factura');
    }
}
