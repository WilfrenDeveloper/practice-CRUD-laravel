@extends('../plantillaBase')
@section('script_head')
         
@endsection

@section('ventas')
<div>

  <h1 class="title">Ventas</h1>

  <form class="ventas_form_search">
    <div>
      <label for="codigo">Código de la Factura</label>
      <input id="" name="codigo" type="text" >
    </div>
    <div>
      <label for="cliente">Cliente</label>
      <input id="" name="cliente" type="text" >
    </div>
    <div>
      <label for="desde">Desde</label>
      <input id="" name="desde" type="date" max="{{date('Y-m-d')}}">
    </div>
    <div>
      <label for="hasta">Hasta</label>
      <input id="" name="hasta" type="date" value="{{date('Y-m-d')}}" max="{{date('Y-m-d')}}">
    </div>
    <div>
      <label for="metodo_de_pago">Metodo de Pago</label>
      <select class="ventas_formSelect_metodos" name="metodo_de_pago" id="">
        <option value="">Todos</option>
        <option value="Efectivo">Efectivo</option>
      </select>
    </div>
    <div>
      <label for="rango_precios">Rango de precios</label>
      <input id="" name="rango_precios" type="text" >
    </div>

    <button class="btn_ventas_form_search btn btn-primary">Buscar</button>
  </form>

    <!-- Tabla de Todas las Facturas -->
    <div class="ventas_container" style="display: flex; justify-content:center; align-items:center; flex-direction:column">
        <table class="table table-striped table-bordered table-hover">
            <thead class="table-dark text-center"  style="background-color: black; color:white; text-aling:center;" >
                <th>codigo</th>
                <th>Cliente</th>
                <th>Total</th>
                <th>Forma de Pago</th>
                <th>fecha de compra</th>
                <th>Items</th>
            </thead>
            <tbody class="ventas_tbody">
            </tbody>
            
        </table>
    </div>
    
    <p class="ventas_noFound" style="display: none"> <i class="bi bi-info-circle-fill text-danger"></i> No se encontraron más registros.</p>

    <button class="ventas_btn_verMas btn btn-dark">Ver más...</button>


      <!-- Modal Factura Individual -->
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

                <table class="table table-striped table-bordered table-hover">
                    <thead class="table-dark text-center">
                        <th>Producto</th>
                        <th>Sistema Operativo</th>
                        <th>Precio Unidad</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th>% Descuento</th>
                        <th>Valor de Descuento</th>
                        <th>Total</th>
                    </thead>
                    <tbody class="ventas_tbody_productsOfFactura">
                    </tbody>

                    <thead class="text-end table-dark border-white">
                      <th class="bg-transparent"></th>
                      <th class="bg-transparent"></th>
                      <th><span class="factura_valorBruto"></span></th>
                      <th class="text-center"><span class="factura_cantidad"></span></th>
                      <th><span class="factura_subtotal"></span></th>
                      <th class="bg-transparent"></th>
                      <th><span class="factura_descuento"></span></th>
                      <th><span class="factura_valorTotal"></span></th>
                    </thead>
                </table>

                <br>
                
                <table class="table table-bordered border-primary" style="width:300px">
                  <thead>
                    <tr>
                      <th>Valor Bruto</th>
                      <th><span class="factura_valorBruto"></span></th>
                    </tr>
                    <tr>
                      <th>Cantidad</th>
                      <th><span class="factura_cantidad"></span></th>
                    </tr>
                    <tr>
                      <th>Subtotal</th>
                      <th><span class="factura_subtotal"></span></th>
                    </tr>
                    <tr>
                      <th>Descuento</th>
                      <th><span class="factura_descuento"></span></th>
                    </tr>
                    <tr>
                      <th>Valor Total</th>
                      <th><span class="factura_valorTotal"></span></th>
                    </tr>
                  </thead>
                </table>
                
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Understood</button>
            </div>
          </div>
        </div>
      </div>
</div>
      

      <script src="{{asset('js/inventario/ventas.js')}}"></script>
@endsection

