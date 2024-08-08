<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\ClienteProducto;
use App\Models\Factura;
use App\Models\Producto;
use DateTime;
use Illuminate\Http\Request;

class ClienteProductoController extends Controller
{
    public function index(Request $request){
        
        $message="";
        $search = $request->search;
        $productos = ""; 
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

        return view('welcome', compact('productos','message'));
    }

    public function create(){
        //
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'nacimiento' => 'required|date|before_or_equal:' . now()->subYears(18)->format('Y-m-d'), 
            'telefono' => 'required|digits:10',
            'id_producto' => 'required|exists:productos,id',
        ]);
    
        // Crear nuevo cliente
        $cliente = new Cliente();
        $cliente->nombre = $validateData['nombre'];
        $cliente->apellido = $validateData['apellido'];
        $cliente->nacimiento = $validateData['nacimiento'];
        $cliente->telefono = $validateData['telefono'];
        $cliente->save();
    
        // Obtener el último cliente creado
        $id_cliente = Cliente::latest('id')->value('id');
    
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
    
        // Crear entrada en la tabla pivote
        $pivote = new ClienteProducto();
        $pivote->id_producto = $request->get('id_producto');
        $pivote->id_cliente = $id_cliente;
        $pivote->id_factura = $id_Factura;
        $pivote->save();
    
        return redirect('/ventas');
    }
}
