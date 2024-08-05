<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $productos= Producto::all();
        return view('inventario.inventario')->with('productos', $productos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('productos.crearProducto');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $productos = new Producto();
        $productos->producto = $request->get('producto');
        $productos->marca = $request->get('marca');
        $productos->modelo = $request->get('modelo');
        $productos->sistema = $request->get('sistema');
        $productos->imagen = $request->get('imagen');

        $productos->save();

        return redirect('/inventario');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $producto = Producto::find($id);
        return view('productos.editarProducto')->with('producto', $producto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $productos = Producto::find($id);
        $productos->producto = $request->get('producto');
        $productos->marca = $request->get('marca');
        $productos->modelo = $request->get('modelo');
        $productos->sistema = $request->get('sistema');
        $productos->imagen = $request->get('imagen');

        $productos->save();

        return redirect('/inventario');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $producto = Producto::find($id);
        $producto->delete();
        return redirect('inventario');
    }
}
