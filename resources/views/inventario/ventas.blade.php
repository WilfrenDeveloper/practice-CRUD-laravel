@extends('../plantillaBase')
@section('script_head')
    
        
@endsection

@section('ventas')
    <div class="ventas_container" style="display: flex; justify-content:center; align-items:center; flex-direction:column">
        <h1 class="title">Ventas</h1>
        <table class="table table-striped table-bordered table-hover">
            <thead class="table-dark text-center"  style="background-color: black; color:white; text-aling:center;" >
                <th>codigo</th>
                <th>Cliente</th>
                <th>Total</th>
                <th>Forma de Pago</th>
                <th>fecha de compra</th>
            </thead>
            <tbody class="ventas_tbody">
            </tbody>
        </table>
    </div>




      
      <!-- Modal Cliente -->
      <div class="ventas_modal_cliente modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">Factura</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="overflow: auto">
                <div class="d-flex gap-2 justify-content-between" style="width: 100%">
                    <div>
                        <p class="m-0">Nombre: <strong class="ventas_modalFactura_nombre"></strong></p>
                        <p class="m-0">Fecha de Nacimiento: <strong class="ventas_modalFactura_nacimiento"></strong></p>
                        <p class="m-0">Dirección: <strong class="ventas_modalFactura_direccion"></strong></p>
                        <p class="m-0">Telefono: <strong class="ventas_modalFactura_telefono"></strong></p>
                    </div>

                    <div>
                        <p class="m-0">Fecha de Compra: <strong class="ventas_modalFactura_fecha"></strong></p>
                    </div>
                </div>

                <hr>
        
                <h5>Productos</h5>
                <table class="table table-striped table-bordered table-hover">
                    <thead class="table-dark text-center">
                        <th>Producto</th>
                        <th>Sistema Operativo</th>
                        <th>Precio Unidad</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th>Descuento</th>
                        <th>Total</th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

                
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Understood</button>
            </div>
          </div>
        </div>
      </div>

      

      <script src="{{asset('js/inventario/ventas.js')}}"></script>
@endsection

