<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodoDePago extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'metodo_de_pago';

    protected $fillable = ['tipo_de_pago'];

    public function relacion_metodo_de_pago()
    {
        switch ($this->tipo_de_pago) {
            case 'Bancos':
                return $this->hasMany(Banco::class);
            case 'Crypto':
                return $this->hasMany(Crypto::class);
            default:
                return null;
        }
    }
}
