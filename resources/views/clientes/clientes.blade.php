@extends('../plantillaBase')


@section('clientes')
    <div class="d-flex justify-content-center align-items-center flex-column mt-3">
        <form class="form_search_clientes form container mb-3">
            <div class="row d-flex ">
                <div class="col mb-3">
                    <label class="form-label me-2" for="cliente">Nombre</label>
                    <input id="" name="cliente" type="text" class="form-control form-control-sm" >
                </div>

                <div class="col mb-3">
                    <label class="form-label me-2" for="direccion">Direccion</label>
                    <input id="" name="direccion" type="text" class="form-control form-control-sm" >
                </div>
            
                <div class="col mb-3">
                    <label class="form-label me-2" for="telefono">Teléfono</label>
                    <input id="" name="telefono" type="tel" maxlength="10" class="form-control form-control-sm" >
                </div>
            
                <div class="col-auto mb-3">
                    <label class="form-label me-2" for="nacimiento">Fecha de Nacimiento</label>
                    <input id="" name="nacimiento" type="date" class="form-control form-control-sm">
                </div>
            </div>
            <button class="btn_search_form_clientes btn btn-primary me-2 rounded 0">Buscar</button>
        </form>

        <div class="container d-flex justify-content-between mb-3">
            <div class="">
                <label class="form-label me-2" for="hasta">Mostrar registros</label>
                <br>
                <select name="mostrar" id="mostrar" class="clientes_select_mostrar">
                    <option value="10" selected>x10</option>
                    <option value="25">x25</option>
                    <option value="50">x50</option>
                    <option value="100">x100</option>
                </select>
            </div>
            <button id="btn_ingresar_nuevo_cliente" class="btn_ingresar_nuevo_cliente btn rounded-0 text-white" type="button" data-bs-toggle="modal" data-bs-target="#modal_crearCliente" style="background-color: rgb(0, 192, 0); align-self:flex-end">Ingresar Nuevo Cliente</button>
        </div>

        <table style="border: 1px solid gray; background-color:white">            
            <thead style="background-color: black; color:white; text-aling:center;" >
                <th style="padding: 10px">Nombre</th>
                <th style="padding: 10px">Apellido</th>
                <th style="padding: 10px">Fecha de Nacimiento</th>
                <th style="padding: 10px">Dirección</th>
                <th style="padding: 10px">Teléfono</th>
                <th style="padding: 10px">Acciones</th>
            </thead>
            <tbody class="tbody_clientes">
               
            </tbody>
        </table>
        <button class="btn_verMas_clientes btn btn-dark rounded-0 text-light fs-6" >Ver más...</button>
    </div>

    <!-- Modal ver Cliente -->
    <div class="modal fade" id="modal_verCliente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Información del Cliente</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('clientes.datosDelCliente')
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
            <button type="button" class="btn_aceptar_modal_verCliente btn btn-info text-white">Aceptar</button>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal Factura Individual -->
    <div class="clientes_modalFacturaDelCliente modal fade" id="modalFacturaDelCliente" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Factura</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="overflow: auto">
                <div class="d-flex gap-2 justify-content-between" style="width: 100%">
                    <div>
                        <p class="m-0">Nombre: <strong class="clientes_modalFacturaDelCliente_nombre"></strong></p>
                        <p class="m-0">Fecha de Nacimiento: <strong class="clientes_modalFacturaDelCliente_nacimiento"></strong></p>
                        <p class="m-0">Dirección: <strong class="clientes_modalFacturaDelCliente_direccion"></strong></p>
                        <p class="m-0">Telefono: <strong class="clientes_modalFacturaDelCliente_telefono"></strong></p>
                    </div>

                    <div>
                        <p class="m-0">Fecha de Compra: <strong class="clientes_modalFacturaDelCliente_fecha"></strong></p>
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
                    <tbody class="clientes_modalFacturaDelCliente_tbody">
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
                <button class="btn btn-primary" data-bs-target="#modal_verCliente" data-bs-toggle="modal">Regresar</button>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal Crear Nuevo Cliente -->

    <div class="modal fade" id="modal_crearCliente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Ingresar Nuevo Cliente</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('clientes.crearCliente')
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" class="btn_crear_modalCrearCliente btn btn-info text-white">Crear</button>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal Eliminar Cliente -->

    <div class="modal fade" id="modal_eliminar_cliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5><span>Estás seguro de eliminar al usuario</span> <strong class="modal_eliminar_cliente_strong"></strong></h5>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
              <button type="button" class="btn_aceptar_modal_eliminar_cliente btn btn-primary" >Aceptar</button>
              <input class="input_id_cliente_modal_eliminar_cliente" type="hidden" val="">
            </div>
          </div>
        </div>
    </div>
    

<script src="{{asset('js/clientes/clientes.js')}}"></script>

@endsection