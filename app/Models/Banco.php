<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'bancos'; 

    protected $fillable = ['tipo_de_cuenta', 'numero_de_cuenta', 'metodo_de_pago_id'];

    public function metodo_de_pago()
    {
        return $this->belongsTo(MetodoDePago::class, 'metodo_de_pago_id');
    }
}
