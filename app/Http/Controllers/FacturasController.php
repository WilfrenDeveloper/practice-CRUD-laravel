<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\ProductosFacturas;
use App\Models\Factura;
use App\Models\FacturaMetodoDePago;
use App\Models\MetodoDePago;
use App\Models\Producto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\map;

class FacturasController extends Controller
{

    public function index(){
        return view('inventario.ventas');
    }



    public function getAllFacturas(Request $request){

        try {
            DB::beginTransaction();
            $search = $request->input('search');
            $offset = $request->input('offset');

            $buscar = [];
            if ($search) {
                foreach ($search as $item) {
                    if($item['value'])$buscar[$item['name']] = $item['value'];
                };
            }

            $facturas = Factura::with('factura_metodoDePago.metodoDePago', 'cliente', 'productos.productoDeLaFactura')
            ->offset($offset)
            ->limit(10)
            ->orderby('id','asc')
            ->get(['id', 'codigo', 'fecha_de_compra', 'valor_total','id_cliente']);

            DB::commit();

            
            return response()->json([
                'message' => 'la petición se ha realizado exitosamente',
                'facturas' => $facturas,
                'buscar' => $buscar,
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

        $pivote = new ProductosFacturas();
        $pivote->id_producto = $productoId;
        $pivote->id_cliente = $request->input('id_cliente');
        $pivote->id_factura = $id_Factura;
        $pivote->save();

        return redirect('/ventas');
    }

    
    public function generarFacturaOfCart(Request $request){

        $request->validate([
            'cliente' => 'required|array',
            'cart' => 'required|array',
            'precio_total' => 'required'
        ]);

        try {
            //code...
            DB::beginTransaction();

            $clienteDataArray = $request->input('cliente');
            $cartDataArray = $request->input('cart');
            $precio_total = floatval($request->input(('precio_total')));
            $metodo = $request->input('metodo');
            
            // Convertir el array de objetos en un array asociativo
            $clienteData = [];
            foreach ($clienteDataArray as $item) {
                $clienteData[$item['name']] = $item['value'];
            }
            
                
            $cliente = new Cliente();
            $cliente->nombre = $clienteData['nombre'];
            $cliente->apellido = $clienteData['apellido'];
            $cliente->direccion = $clienteData['direccion'];
            $cliente->telefono = $clienteData['telefono'];
            $cliente->save();
            $id_cliente = $cliente->id;
    
            // Crear nueva factura
            $ultimoCodigo = Factura::latest('id')->value('codigo');
            $numero = $ultimoCodigo ? intval(substr($ultimoCodigo, 3)) + 1 : 1;
            $nuevocodigo = "VEN" . str_pad($numero, 3, '0', STR_PAD_LEFT);
    
            $factura = new Factura();
            $factura->codigo = $nuevocodigo;
            $factura->fecha_de_compra = date('Y-m-d');
            $factura->id_cliente = $id_cliente;
            $factura->valor_total = $precio_total;
            $factura->save();
            // Obtener el último factura creada
            $id_factura = $factura->id;
    
             function calculateTotalPrice($prod){
                $porcentaje = 1 - ($prod['descuento']/100);
                return  $prod['precio'] * $prod['quantity'] * $porcentaje;
            };
            

            $metodo_de_pago = new FacturaMetodoDePago();
            $metodo_de_pago->id_factura = $id_factura;
            $metodo_de_pago->id_metodo_de_pago = $metodo;
            $metodo_de_pago->save();
    
            //throw new Exception("Error interno");
            $id_products = [];
            
            foreach ($cartDataArray as $prod) {
                $productoFactura = new ProductosFacturas();
                $productoFactura->id_producto = $prod['productId'];
                $productoFactura->id_factura = $id_factura;
                $productoFactura->descuento = $prod['descuento'];
                $productoFactura->cantidad = $prod['quantity'];
                $productoFactura->precio_total = calculateTotalPrice($prod);
                $productoFactura->save();

                $producto = Producto::find($prod['productId']);
                $producto->cantidad -= $prod['quantity'];
                $producto->save();

                $id_products[] = $producto->id; 
            };

            DB::commit();
            
            return response()->json([
                'cart' => $id_products,
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
    /**
     * Display the specified resource.
     */
    public function show(string $id){
        $producto = Producto::find($id);
        $factura = Factura::all();
        $clientes = Cliente::all();
        return response();
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
