<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'clientes';

    protected $fillable = ['nombre', 'apellido', 'direccion', 'nacimiento', 'telefono'];

    public function factura() {
        return $this->hasMany(Factura::class, 'id_cliente', 'id');
    }

    public function scopeGetClientesByName(Builder $query, $cliente){
        if($cliente){
            $terms = explode(' ', $cliente);
    
            return $query->where(function ($q) use ($terms) {
                foreach ($terms as $term) {
                    $q->where(function ($subQuery) use ($term) {
                        $subQuery->where('nombre', 'LIKE', '%'.$term.'%')
                                 ->orWhere('apellido', 'LIKE', '%'.$term.'%');
                    });
                }
            });
        }
        return $query;
    }

    public function scopeGetClientesByDireccion(Builder $query, $direccion){
        if($direccion){
            return $query->where('direccion',  'LIKE', '%'.$direccion.'%');
        }
        return $query;
    }

    public function scopeGetClientesByNacimiento(Builder $query, $nacimiento){
        if($nacimiento){
            return $query->where('nacimiento',  'LIKE', '%'.$nacimiento.'%');
        }
        return $query;
    }

    public function scopeGetClientesByTelefono(Builder $query, $telefono){
        if($telefono){
            return $query->where('telefono',  'LIKE', '%'.$telefono.'%');
        }
        return $query;
    }
}
