@extends('../plantillaBase')
@section('clientes')

    <div style="display: flex; justify-content:center; align-items:center; flex-direction:column; position:relative">
        <h1 class="title" style="position: absolute">Clientes</h1>

        <div style="margin-top:40px">
            <div class="a_editar">
                <button id="btn_crearCliente" style="text-decoration:none; border: 1px solid; color:white; padding:10px 20px; text-align:center; background-color: rgb(0, 192, 0)">Ingresar Nuevo Cliente</button>
            </div>
        </div>
        <table style="margin-top:40px;border: 1px solid gray; background-color:white">
            <thead style="background-color: black; color:white; text-aling:center;" >
                <th style="padding: 10px">Nombre</th>
                <th style="padding: 10px">Apellido</th>
                <th style="padding: 10px">Fecha de Nacimiento</th>
                <th style="padding: 10px">Teléfono</th>
                <th style="padding: 10px">Operaciones</th>
                <th style="padding: 10px">Historial</th>
            </thead>
            <tbody class="tbody_clientes">
                @foreach ($clientes as $cliente)
                <tr class="tr_operaciones tr_{{$cliente->id}}" style="height:40px" data-id="{{$cliente->id}}">
                    <td class="td_nombre">{{$cliente->nombre}}</td>
                    <td class="td_apellido">{{$cliente->apellido}}</td>
                    <td class="td_nacimiento">{{$cliente->nacimiento}}</td>
                    <td class="td_telefono">{{$cliente->telefono}}</td>
                    <td style="padding-left: 20px; ">
                        <a href="/clientes/{{$cliente->id}}" style="text-decoration:none;  padding:12px 20px; text-align:center">Ver historial de compras</a>
                    </td>
                    <td style="padding-left: 20px">
                        <!-- modal confirmar eliminacion -->
                        <div class="modal_eliminar_cliente modal_{{$cliente->id}}" style="display: none">
                            <div id="div_modal_eliminar">
                                @csrf
                                <p>Estás seguro de querer eliminar el Cliente <br> <strong>{{$cliente->nombre}} {{$cliente->apellido}}</strong></p>
                                <button onclick="cancelarEliminarCliente({{$cliente->id}})" style="text-decoration:none; border: 1px solid; border-radius:5px; color:white; padding:10px 20px; text-align:center; background-color: rgb(104, 104, 104)">Cancelar</button>
                                <button onclick="confirmarEliminarCliente({{$cliente->id}})" style="text-decoration:none; border: 1px solid; border-radius:5px; color:white; padding:10px 20px; text-align:center; background-color: rgb(9, 218, 43)">Aceptar</button>
                            </div>
                        </div>
                        <button onclick="editarClienteForm({{$cliente->id}})" style="text-decoration:none; border: 1px solid; border-radius:5px; color:white; padding:10px 20px; text-align:center; background-color: rgb(104, 104, 104)">Editar</button>
                        <button onclick="activarmodalEliminar({{$cliente->id}})" style="text-decoration:none; border: 1px solid; border-radius:5px; color:white; padding:12px 20px; text-align:center; background-color: rgb(255, 59, 59)">Eliminar</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <article id="modal_crearCliente" style="width:100%; height:100%; top:0; display:flex; justify-content:center; align-items:center; background-color: rgba(255, 255, 255, 0.874)">
        @include('clientes.crearCliente')
    </article>

    <article id="modal_editarCliente" style="width:100%; height:100%; top:0; display:flex; justify-content:center; align-items:center; background-color: rgba(255, 255, 255, 0.874)">
        @include('clientes.editarCliente')
    </article>


    <script>
        $('#modal_crearCliente').hide();
        $('#modal_editarCliente').hide();
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
            console.log('hola')
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