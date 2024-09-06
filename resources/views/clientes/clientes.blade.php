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
                    <input id="" name="telefono" type="number" class="form-control form-control-sm" >
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
            <button id="btn_crearCliente" class="btn_crear_cliente btn rounded-0 text-white" type="button" data-bs-toggle="modal" data-bs-target="#modal_crearCliente" style="background-color: rgb(0, 192, 0); align-self:flex-end">Ingresar Nuevo Cliente</button>
        </div>

        <table style="border: 1px solid gray; background-color:white">            
            <thead style="background-color: black; color:white; text-aling:center;" >
                <th style="padding: 10px">Nombre</th>
                <th style="padding: 10px">Apellido</th>
                <th style="padding: 10px">Fecha de Nacimiento</th>
                <th style="padding: 10px">Dirección</th>
                <th style="padding: 10px">Teléfono</th>
                <th style="padding: 10px">Historial</th>
                <th style="padding: 10px">Acciones</th>
            </thead>
            <tbody class="tbody_clientes">
               
            </tbody>
        </table>
        <button class="btn_verMas_clientes btn btn-dark rounded-0 text-light fs-6" >Ver más...</button>
    </div>

    <!-- Modal ver Cliente -->
    <div class="modal fade" id="modal_verCliente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Información del Cliente</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('clientes.datosDelCliente')
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-info text-white">Editar</button>
            </div>
        </div>
        </div>
    </div>

    

    <div class="modal fade" id="modal_crearCliente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Ingresar Nuevo Cliente</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('clientes.datosDelCliente')
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-info text-white">Crear</button>
            </div>
        </div>
        </div>
    </div>

    

<script src="{{asset('js/clientes/clientes.js')}}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //Botón Editar Cliente que activa el modal
        function editarClienteForm(id) {
            $('#modal_editarCliente').show();
            $.ajax({
                type: "GET",
                url: `/clientes/${id}/edit`,
                success: function(res){
                    $(".edit_nombre").val(res.nombre);
                    $(".edit_apellido").val(res.apellido);
                    $(".edit_nacimiento").val(res.nacimiento);
                    $(".edit_telefono").val(res.telefono);
                    $(".cliente_id").val(res.id);
                }
            });
            return;
        };
        
        //Botón Elminar que activa el modal
        function activarmodalEliminar(id){
            $(`.modal_${id}`).css('display', 'flex');
        };
        
        
        //Botón Cancelar la eliminacion del cliente
        function cancelarEliminarCliente(id){
            $(`.modal_${id}`).css('display', 'none');
        };
        
        //Confirmar Eliminar Cliente
        function confirmarEliminarCliente(id){
            $.ajax({
                type: "DELETE",
                url: `/clientes/${id}`,
                success: function (response) {
                    let id = response.id_cliente;
                    $(`.tr_${id}`).remove();
                },
                error: function (error){
                        //manejo de errores
                        console.error('error', error);
                    }
                });
                
                $(`.modal_${id}`).css('display', 'none');
            };
            
            
            $(document).ready(function () {
                //botón crear Nuevo Cliente
                $('#btn_crearCliente').click(function (e) { 
                    e.preventDefault();
                    $('#modal_crearCliente').show();
                    return;
                });
            });
            
    </script>

@endsection