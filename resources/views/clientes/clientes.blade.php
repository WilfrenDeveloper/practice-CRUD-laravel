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
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Regresar</button>
            <button type="button" class="btn_aceptar_modal_verCliente btn btn-info text-white">Aceptar</button>
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
            <button type="button" class="btn_crear_cliente btn btn-info text-white">Crear</button>
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