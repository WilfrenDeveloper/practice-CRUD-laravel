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
use function PHPUnit\Framework\isEmpty;

class FacturasController extends Controller
{

    public function index(){
        return view('inventario.ventas');
    }

    public function getAllFacturas(Request $request){

        try {
            DB::beginTransaction();
            $search = $request->input('search') ? $request->input('search') : "";
            $offset = $request->input('offset') ? $request->input('offset') : 0;
            $limit = $request->input('limit') ? $request->input('limit') : 10;

            $buscar = [];
            if ($search) {
                foreach ($search as $item) {
                    $buscar[$item['name']] = $item['value'];
                };
            }

            $codigo = $buscar['codigo'];
            $cliente = $buscar['cliente'];
            $desde = $buscar['desde'];
            $hasta = $buscar['hasta'];
            $metodo_de_pago = $buscar['metodo_de_pago'];
            $rango_precio = $buscar['rango_precios'];

            $facturas = Factura::getFacturaByClient($cliente)
            ->getFacturaByCode($codigo)
            ->getFacturaByDate($desde, $hasta)
            ->getFacturaByMetodoDePago($metodo_de_pago)
            ->getFacturaByRangoDePrecios($rango_precio)
            ->with('factura_metodoDePago.metodoDePago:id,forma_de_pago',
                'cliente:id,nombre,apellido',
                'productos.productoDeLaFactura:id,producto,marca,modelo,sistema,cantidad,precio')
            ->offset($offset)
            ->limit($limit)
            ->orderby('id','desc')
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
            
            $productsSales = [];
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

                $productSale = [];
                $productSale['id'] = $producto->id;
                $productSale['cantidad'] = $producto->cantidad;
                $productsSales[] = $productSale;
            };

            DB::commit();
            
            return response()->json([
                'productsSales' => $productsSales,
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
