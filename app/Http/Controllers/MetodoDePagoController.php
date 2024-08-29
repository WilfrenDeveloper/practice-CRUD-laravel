<?php

namespace App\Http\Controllers;

use App\Models\MetodoDePago;
use Illuminate\Http\Request;

class MetodoDePagoController extends Controller
{
    public function getAll()
    {
        $metodos_de_pago = MetodoDePago::all();
        return response()->json($metodos_de_pago);
    }
}
