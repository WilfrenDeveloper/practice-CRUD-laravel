<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

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

    
    public function scopeGetFacturaByCode(Builder $query, $codigo){
        if ($codigo) {
            return $query->where('codigo', 'LIKE', '%'.$codigo.'%');
        } else{
            return $query;
        };
    }

    public function scopeGetFacturaByClient(Builder $query, $cliente){

        if ($cliente) {
            // Dividimos el valor del input en palabras, asumiendo que están separadas por un espacio
            $terms = explode(' ', $cliente);
    
            return $query->whereHas('cliente', function ($q) use ($terms) {
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

    public function scopeGetFacturaByDate(Builder $query, $desde, $hasta){
        if ($desde && $hasta) {
            return $query->whereDate('fecha_de_compra', '>=', $desde)
                         ->whereDate('fecha_de_compra', '<=', $hasta);
        } elseif ($desde) {
            return $query->whereDate('fecha_de_compra', '>=', $desde);
        } elseif ($hasta) {
            return $query->whereDate('fecha_de_compra', '<=', $hasta);
        }
        return $query;
    }

    public function scopeGetFacturaByMetodoDePago(Builder $query, $metodo_de_pago){
        if ($metodo_de_pago) {
            return $query->whereHas('factura_metodoDePago.metodoDePago', function ($q) use ($metodo_de_pago) {
                $q->where('forma_de_pago', $metodo_de_pago);
            });
        } 
        return $query;
    }

    public function scopeGetFacturaByRangoDePrecios(Builder $query, $rango_de_precio){
        if ($rango_de_precio) {
            $rango = explode('-', $rango_de_precio);
            if(count($rango) === 1){
                return $query->where('valor_total', $rango[0]);
            } else {
                return $query->where('valor_total', '>=', $rango[0])
                ->where('valor_total', '<=', $rango[1]);
            }
        } 
        return $query;
    }

}
