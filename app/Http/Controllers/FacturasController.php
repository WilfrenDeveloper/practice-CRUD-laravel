<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\ClienteProducto;
use App\Models\Factura;
use App\Models\Producto;
use DateTime;
use Illuminate\Http\Request;

class FacturasController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $facturas = Factura::all();
        return view('inventario/ventas', compact('facturas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   $facturas = Factura::all();
        $codigo = $facturas[count($facturas)-1]->codigo;
        $numero = intval(substr($codigo, 3)) + 1;
        $nuevocodigo = "VEN".str_pad($numero, 3, '0', STR_PAD_LEFT);


        $factura = new Factura();
        $factura->codigo = $request->get($nuevocodigo);
        $factura->decha_de_compra = $request->get(date('Y-m-d'));
        $factura->save();

        $nuevaFactura = Factura::find(count(Factura::all()));

        return redirect('/ventas');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $producto = Producto::find($id);
        $factura = Factura::all();
        $clientes = Cliente::all();
        return view('facturas.generarFactura', compact('factura', 'producto', 'clientes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
