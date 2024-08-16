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
            <tbody>
                @foreach ($clientes as $cliente)
                    <tr style="height:40px">
                        <td>{{$cliente->nombre}}</td>
                        <td>{{$cliente->apellido}}</td>
                        <td>{{$cliente->nacimiento}}</td>
                        <td>{{$cliente->telefono}}</td>
                        <td style="padding-left: 20px; ">
                            <a href="/clientes/{{$cliente->id}}" style="text-decoration:none;  padding:12px 20px; text-align:center;">Ver historial de compras</a>
                        </td>
                       <td style="padding-left: 20px; ">
                            <div class="modal_eliminar_cliente modal_{{$cliente->id}}" style="display: none">
                                <form action="{{ route('clientes.destroy', $cliente->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div id="div_modal_eliminar">
                                        <p>Estás seguro de querer eliminar el Cliente <br> <strong>{{$cliente->nombre}} {{$cliente->apellido}}</strong></p>
                                        <a href="/clientes" class="a_editar" style="text-decoration:none; border: 1px solid; border-radius:5px; color:white; padding:10px 20px; text-align:center; background-color: rgb(104, 104, 104)">Cancelar</a>
                                        <button type="submit" style="text-decoration:none; border: 1px solid; border-radius:5px; color:white; padding:12px 20px; text-align:center; background-color: rgb(9, 218, 43)">Aceptar</button>
                                    </div>
                                </form>
                            </div>
                            <a class="btn-editarCliente a_editar" data-id="{{$cliente->id}}" style="text-decoration:none; border: 1px solid; border-radius:5px; color:white; padding:10px 20px; text-align:center; background-color: rgb(104, 104, 104)">Editar</a>
                            <button onclick="confirmarModal({{$cliente->id}})" style="text-decoration:none; border: 1px solid; border-radius:5px; color:white; padding:12px 20px; text-align:center; background-color: rgb(255, 59, 59)">Eliminar</button>
                            <script>
                                function confirmarModal(e) {
                                    //e.preventDefault();
                                    $(`.modal_${e}`).css('display', 'flex');
                                    return;
                                };
                            </script>
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
        $(document).ready(function () {
            $('#btn_crearCliente').click(function (e) { 
                e.preventDefault();
                $('#modal_crearCliente').show();
                return;
            });

            $('.btn-editarCliente').click(function (e) { 
                e.preventDefault();
                $('#modal_editarCliente').show();
                peticion($(this).data('id'));
                return;
            });
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function peticion(id) {
            $.ajax({
                type: "GET",
                url: `/clientes/${id}/edit`,
                success: function(res){
                    $('#modal_editarCliente').find('.edit_nombre').val(res.nombre);
                    $('#modal_editarCliente').find(".edit_apellido").val(res.apellido);
                    $('#modal_editarCliente').find(".edit_nacimiento").val(res.nacimiento);
                    $('#modal_editarCliente').find(".edit_telefono").val(res.telefono); 

                    $("#form_editarCliente").attr('action', `/clientes/${res.id}`);
                }
            });
        }
    </script>

@endsection