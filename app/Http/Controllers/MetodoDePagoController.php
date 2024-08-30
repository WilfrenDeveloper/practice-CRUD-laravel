<?php

namespace App\Http\Controllers;

use App\Models\Banco;
use App\Models\Crypto;
use App\Models\MetodoDePago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MetodoDePagoController extends Controller
{
    public function getAll()
    {
        
        
        try {
            //code...
            DB::beginTransaction();
            
            // Obtener los métodos de pago tipo 'Banco'
            $bancos = MetodoDePago::where('metodo_de_pago', 'Banco')->get();
            $bancos_relaciones = $bancos->map(function ($metodo) {
                return [$metodo, $metodo->relacion_metodo_de_pago];
            });

            // Obtener los métodos de pago tipo 'Crypto'
            $cryptos = MetodoDePago::where('metodo_de_pago', 'Crypto')->get();
            $cryptos_relaciones = $cryptos->map(function ($metodo) {
                return [$metodo, $metodo->relacion_metodo_de_pago];
            });

            
            DB::commit();
            
            return response()->json([
                'bancos' => $bancos_relaciones,
                'cryptos' => $cryptos_relaciones,
            ]);

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
                'trace' => $th->getTrace(),
            ]);

        }
    }
}
