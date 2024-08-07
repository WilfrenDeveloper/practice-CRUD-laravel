<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\ClienteProducto;
use App\Models\Factura;
use App\Models\Producto;
use DateTime;
use GuzzleHttp\Client;
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
    public function store(Request $request, $productoId)
{
    $request->validate([
        'id_cliente' => 'required|exists:clientes,id',
    ]);

    // Crear nueva factura
    $ultimoCodigo = Factura::latest('id')->value('codigo');
    $numero = $ultimoCodigo ? intval(substr($ultimoCodigo, 3)) + 1 : 1;
    $nuevocodigo = "VEN" . str_pad($numero, 3, '0', STR_PAD_LEFT);

    $factura = new Factura();
    $factura->codigo = $nuevocodigo;
    $factura->fecha_de_compra = date('Y-m-d');
    $factura->save();

    // Obtener el último factura creada
    $id_Factura = $factura->id;

    $pivote = new ClienteProducto();
    $pivote->id_producto = $productoId;
    $pivote->id_cliente = $request->input('id_cliente');
    $pivote->id_factura = $id_Factura;
    $pivote->save();

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
