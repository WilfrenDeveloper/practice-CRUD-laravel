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
            'producto' => 'required|max:200|min:2',
            'marca' => 'required|max:200|min:2',
            'modelo' => 'required|max:200|min:2',
            'sistema' => 'required|max:100|min:2',
            'imagen' => 'required|image|mimes:jpeg,png,jpg|max:3072|min:1'
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

        $productos = Producto::all();

        return response()->json([
            'html' => view('productos.dataproducto', compact('productos'))->render(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request){
        $search = $request->input('value');
        $productos = ""; 
        $message="";
        if ($search) {
            $productos = Producto::where('producto', 'LIKE', '%'.$search.'%')
                ->orWhere('marca', 'LIKE', '%'.$search.'%')
                ->orWhere('modelo', 'LIKE', '%'.$search.'%')
                ->orWhere('sistema', 'LIKE', '%'.$search.'%')
                ->get();
            $message="";
            if($productos->isEmpty()){
                $message = "El producto que buscas no se encuentra disponible";
                $productos = Producto::all();
            };
        } else {
            $productos = Producto::all();
            $message="";
        };  

        return response()->json([
            'html' => view('productos.cardProducts', compact('productos'))->render(),
            'message' => $message]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $producto = Producto::find($id);
        return response()->json($producto);
        //return view('productos.editarProducto')->with('producto', $producto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        //validacion de lo datos
        $validateData = $request->validate([
            'producto' => 'required|max:200|min:2',
            'marca' => 'required|max:200|min:2',
            'modelo' => 'required|max:200|min:2',
            'sistema' => 'required|max:100|min:2',
            'imagen' => 'sometimes|image|mimes:jpeg,png,jpg|max:3072'
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

        $productos = Producto::all();
        /***** 
        return response()->json([
            'html' => view('productos.dataProducto', compact('productos'))->render(),
        ]);
        */
        $productos = Producto::all();
        return view('inventario.inventario')->with('productos', $productos);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $producto = Producto::find($id);

        // Verifica si el producto tiene una imagen asociada
        if ($producto->imagen) {
            $rutaImagen = public_path('imagen/' . $producto->imagen);
            
            // Verifica si la imagen existe en la carpeta antes de intentar eliminarla
            if (file_exists($rutaImagen)) {
                unlink($rutaImagen); // Elimina la imagen
            }
        }

        $producto->delete();
        $productos = Producto::all();
        return response()->json([
            'html' => view('productos.dataproducto', compact('productos'))->render(),
        ]);
    }
}