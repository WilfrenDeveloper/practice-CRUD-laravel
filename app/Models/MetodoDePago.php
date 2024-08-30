<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodoDePago extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'metodo_de_pago';

    protected $fillable = ['metodo_de_pago'];

    public function relacion_metodo_de_pago()
    {
        switch ($this->metodo_de_pago) {
            case 'Banco':
                return $this->hasOne(Banco::class, 'metodo_de_pago_id');
            case 'Crypto':
                return $this->hasOne(Crypto::class, 'metodo_de_pago_id');
            default:
                return null;
        }
    }

    public function metodoDePagoDeFactura() {
        return $this->hasMany(FacturaMetodoDePago::class, 'id_metodo_de_pago');
    }
}
