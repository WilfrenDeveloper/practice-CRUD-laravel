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
        $productos = Producto::get(['id', 'producto', 'marca', 'modelo', 'sistema', 'cantidad', 'imagen', 'precio']);
        return view('inventario.inventario')->with('productos', $productos);
    }

    public function getProducts(Request $request){
        $search = ($request->input('search'))? $request->input('search') : "" ;
        $offset = ($request->input('offset'))? $request->input('offset') : 0;
        $limit = ($request->input('limit'))? $request->input('limit') : 5;
            
        $productos = Producto::getProductBySearch($search)
            ->offset($offset)
            ->limit($limit)
            ->orderby('id', 'desc')
            ->get(['id', 'producto', 'marca', 'modelo', 'sistema', 'cantidad', 'imagen', 'precio']);

        return response()->json([
            'productos' => $productos,
            ]);
    }

    /**
     * Show the form for creating a new resource.
*/

    /**
     * Store a newly created resource in storage.
     */
    public function create(Request $request)
    {   
        $producto = new Producto();
        $producto->producto = $request->input('producto');
        $producto->marca = $request->input('marca');
        $producto->modelo = $request->input('modelo');
        $producto->sistema = $request->input('sistema');
        $producto->precio = $request->input('precio');
        $producto->cantidad = $request->input('cantidad');
        /*
        $validateData = $request->validate([
            'producto' => 'required|max:200|min:2',
            'marca' => 'required|max:200|min:2',
            'modelo' => 'required|max:200|min:2',
            'sistema' => 'required|max:100|min:2',
            'precio' => 'required|min:1',
            'imagen' => 'required|image|mimes:jpeg,png,jpg|max:3072|min:1'
        ]);

        $producto = new Producto();
        $producto->producto = $validateData['producto'];
        $producto->marca = $validateData['marca'];
        $producto->modelo = $validateData['modelo'];
        $producto->sistema = $validateData['sistema'];
        $producto->imagen = $validateData['imagen'];
        $producto->precio = $validateData['precio'];
        $producto->cantidad = $request->input('cantidad');
*/
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

        return response()->json([
            'producto' => $producto,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id){

        $productos = Producto::find($id, ['id', 'producto', 'marca', 'modelo', 'sistema', 'cantidad', 'imagen', 'precio']);

        return response()->json($productos);
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
        $producto = Producto::find($id);
        //$producto->producto = $request->input('producto');
        $producto->producto = $request->string(('producto'));
        $producto->marca = $request->input('marca');
        $producto->modelo = $request->input('modelo');
        $producto->sistema = $request->input('sistema');
        $producto->precio = $request->input('precio');
        $producto->cantidad = $request->input('cantidad');
        /*
        //validacion de lo datos
        $validateData = $request->validate([
            'producto' => 'required|max:200|min:2',
            'marca' => 'required|max:200|min:2',
            'modelo' => 'required|max:200|min:2',
            'sistema' => 'required|max:100|min:2',
            'imagen' => 'sometimes|image|mimes:jpeg,png,jpg|max:3072',
            'precio' => 'required|min:1',
        ]);



        $producto = Producto::find($id);
        $producto->producto = $validateData['producto'];
        $producto->marca = $validateData['marca'];
        $producto->modelo = $validateData['modelo'];
        $producto->sistema = $validateData['sistema'];
        $producto->imagen = $validateData['imagen'];
        $producto->precio = $validateData['precio'];
        */

        if ($imagen = $request->file('imagen')) {
            $rutaGuardarImagen = 'imagen/';
            $imagenProducto = date('YmdHis') . "." . $imagen->getClientOriginalExtension();

            // Mover la imagen a la ruta especificada
            $imagen->move($rutaGuardarImagen, $imagenProducto);

            // Almacenar el nombre de la imagen en la base de datos
            $producto->imagen = $imagenProducto;
        }

        $producto->save();
        
        return response()->json([
            'producto' => $producto,
        ]);
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

        return response()->json([
            'message' => 'el producto ha sido eliminado',
        ]);
    }
}