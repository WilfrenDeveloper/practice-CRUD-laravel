<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crypto extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'cryptos'; 

    protected $fillable = ['wallet'];

    public function metodo_de_pago()
    {
        return $this->belongsTo(MetodoDePago::class, 'metodo_de_pago_id');
    }
}
