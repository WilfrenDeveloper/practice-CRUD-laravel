<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request){ 
        try {
            DB::beginTransaction();

            $search = ($request->input('search')) ? $request->input('search'): "";
            $offset = ($request->input('offset')) ? $request->input('offset'): 0;
            $limit = ($request->input('limit')) ? $request->input('limit'): 10;

            $buscar = [];
            if($search){
                foreach($search as $item){
                    $buscar[$item['name']] = $item['value'];
                };
            };

            $cliente = $buscar['cliente'];
            $direccion = $buscar['direccion'];
            $nacimiento = $buscar['nacimiento'];
            $telefono = $buscar['telefono'];

            $clientes = Cliente::getClientesByName($cliente)
                ->getClientesByDireccion($direccion)
                ->getClientesByNacimiento($nacimiento)
                ->getClientesByTelefono($telefono)
                ->with(['factura' => function($query) {$query->select('id', 'codigo', 'fecha_de_compra', 'valor_total', 'id_cliente');}, 
                    'factura.productos.productoDeLaFactura',
                ])
                ->offset($offset)
                ->limit($limit)
                ->orderby('id','desc')
                ->get(['id', 'nombre','apellido', 'nacimiento', 'direccion', 'telefono']);

            DB::commit();

            return response()->json([
                'clientes' => $clientes,
                'buscar' => $buscar
            ]);
            
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
                'trace' => $th->getTrace(),
            ]);
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.crearCliente');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de los datos de entrada
        $validatedData = $request->validate([
            'nombre' => 'required|max:100',
            'apellido' => 'required|max:100',
            'nacimiento' => 'required|date|before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
            'telefono' => 'required|digits:10',
        ]);

        // Creación del nuevo cliente
        $cliente = new Cliente();
        $cliente->nombre = $validatedData['nombre'];
        $cliente->apellido = $validatedData['apellido'];
        $cliente->nacimiento = $validatedData['nacimiento'];
        $cliente->telefono = $validatedData['telefono'];

        // Guardar el cliente en la base de datos
        $cliente->save();

        $cliente = $cliente;

        // retornar el cliente creado
        //return redirect('/clientes');
        return response()->json([
            'cliente' => $cliente,
            'html' => view('clientes.dataCliente', compact('cliente'))->render(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cliente = Cliente::find($id);
        return view('clientes.comprasDelCliente', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cliente = Cliente::find($id);
        return response()->json($cliente);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->input('data');

        $datosDelNuevoCliente = [];
        foreach ($data as $dato) {
            $datosDelNuevoCliente[$dato['name']] = $dato['value'];
        };

        $cliente = Cliente::with(['factura' => function($query) {$query->select('id', 'codigo', 'fecha_de_compra', 'valor_total', 'id_cliente');}, 
                    'factura.productos.productoDeLaFactura',
                ])
                ->find($id, ['id', 'nombre','apellido', 'nacimiento', 'direccion', 'telefono']);
        $cliente->nombre = $datosDelNuevoCliente['nombre'];
        $cliente->apellido = $datosDelNuevoCliente['apellido'];
        $cliente->nacimiento = $datosDelNuevoCliente['nacimiento'];
        $cliente->direccion = $datosDelNuevoCliente['direccion'];
        $cliente->telefono = $datosDelNuevoCliente['telefono'];

        $cliente->save();

        return response()->json([
            'cliente' => $cliente,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cliente = Cliente::find($id);
        $cliente->delete();
        return response()->json(['id_cliente' => $id]);
    }
}
