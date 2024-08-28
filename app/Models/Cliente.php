<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'clientes';

    protected $fillable = ['nombre', 'apellido', 'direccion', 'nacimiento', 'telefono'];

    public function factura() {
        return $this->hasMany(Factura::class, 'id_cliente');
    }
}
