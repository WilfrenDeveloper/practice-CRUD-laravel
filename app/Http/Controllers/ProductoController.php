<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::all();
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
        $validateData = $request->validate([
            'producto' => 'required|max:200|min:3',
            'marca' => 'required|max:200|min:3',
            'modelo' => 'required|max:200|min:3',
            'sistema' => 'required|max:100|min:3',
            'imagen' => 'required|image|mimes:jpeg,png,jpg|max:3072|min:10'
        ]);

        $producto = new Producto();
        $producto->producto = $validateData['producto'];
        $producto->marca = $validateData['marca'];
        $producto->modelo = $validateData['modelo'];
        $producto->sistema = $validateData['sistema'];
        $producto->imagen = $validateData['imagen'];

        // Procesar y almacenar la imagen
        if ($imagen = $request->file('imagen')) {
            $rutaGuardarImagen = 'imagen/';
            $imagenProducto = date('YmdHis') . "." . $imagen->getClientOriginalExtension();

            

            // Mover la imagen a la ruta especificada
            $imagen->move($rutaGuardarImagen, $imagenProducto);

            // Almacenar el nombre de la imagen en la base de datos
            $producto->imagen = $imagenProducto;
        }

        $producto->save();

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
        //validacion de lo datos
        $validateData = $request->validate([
            'producto' => 'required|max:200|min:3',
            'marca' => 'required|max:200|min:2',
            'modelo' => 'required|max:200|min:3',
            'sistema' => 'required|max:100|min:3',
            'imagen' => 'required|image|mimes:jpeg,png,jpg|min:10|max:3072'
        ]);

        $producto = Producto::find($id);
        $producto->producto = $validateData['producto'];
        $producto->marca = $validateData['marca'];
        $producto->modelo = $validateData['modelo'];
        $producto->sistema = $validateData['sistema'];
        $producto->imagen = $validateData['imagen'];

        if ($imagen = $request->file('imagen')) {
            $rutaGuardarImagen = 'imagen/';
            $imagenProducto = date('YmdHis') . "." . $imagen->getClientOriginalExtension();

            // Mover la imagen a la ruta especificada
            $imagen->move($rutaGuardarImagen, $imagenProducto);

            // Almacenar el nombre de la imagen en la base de datos
            $producto->imagen = $imagenProducto;
        }

        $producto->save();

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
