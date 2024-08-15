@extends('../plantillaBase')
@section('inventario')

                
    <div style="display: flex; justify-content:center; align-items:center; flex-direction:column; position:relative">
        
        <h1 class="title" style="position: absolute">Inventario</h1>

        <div style="margin:10px 0   ; width:600px; display: flex; justify-content:space-between; align-items:center;">              
                <a href="/ventas" style="text-decoration:none; color:black; padding:10px 20px; text-align:center; font-size:28px">Ventas</a>
                <button id="btn_crearProducto" class="a_editar" style="text-decoration:none; border: 1px rgba(220, 182, 182, 0) solid; color:white; padding:10px 20px; text-align:center; background-color: rgb(0, 192, 0)">Ingresar Nuevo Producto</button>
        </div>

        <table style="border: 1px solid gray; background-color:white">
            <thead  style="background-color: black; color:white; text-aling:center;" >
                <th style="padding: 10px">producto</th>
                <th style="padding: 10px">marca</th>
                <th style="padding: 10px">modelo</th>
                <th style="padding: 10px">sistema operativo</th>
                <th style="padding: 10px">imagen</th>
                <th style="padding: 10px">operaciones</th>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                    <tr>
                        <td>{{$producto->producto}}</td>
                        <td>{{$producto->marca}}</td>
                        <td>{{$producto->modelo}}</td>
                        <td>{{$producto->sistema}}</td>
                        <td style="display:flex; justify-content:center; padding:0 5px; align-items:center">
                            <img src="/imagen/{{$producto->imagen}}" alt="" style="max-width:100px; max-height:60px">
                        </td>
                        <td style="padding-left: 20px">
                            <form action="{{ route('inventario.destroy', $producto->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                            <a class="btn-editarProducto a_editar" data-id="{{$producto->id}}" style="text-decoration:none; border: 1px solid; border-radius:5px; color:white; padding:10px 20px; text-align:center; background-color: rgb(104, 104, 104)">Editar</a>
                            <button type="submit" style="text-decoration:none; border: 1px solid; border-radius:5px; color:white; padding:12px 20px; text-align:center; background-color: rgb(255, 59, 59)">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <article id="modal_crearProducto" style="width:100%; height:100%; top:0; display:flex; justify-content:center; align-items:center ;background-color: rgba(255, 255, 255, 0.792)">
        @include('productos.crearProducto')
    </article>

    <article id="modal_editarProducto" style="width:100%; height:100%; top:0; display:flex; justify-content:center; align-items:center ;background-color: rgba(255, 255, 255, 0.792)">
        @include('productos.editarProducto')
    </article>


    <script>
        $('#modal_crearProducto').hide();
        $('#modal_editarProducto').hide();
        $(document).ready(function () {
            $('#btn_crearProducto').click(function (e) { 
                e.preventDefault();
                $('#modal_crearProducto').show();
                return;
            });

            $('.btn-editarProducto').click(function (e) { 
                e.preventDefault();
                $('#modal_editarProducto').show();
                peticion($(this).data('id'));
                return;
            });
        });

        function peticion(id) {
            $.ajax({
                type: "GET",
                url: `/inventario/${id}/edit`,
                success: function(res){
                    $('.edit_producto').val(res.producto);
                    $(".edit_marca").val(res.marca);
                    $(".edit_modelo").val(res.modelo);
                    $(".edit_sistema").val(res.sistema);

                    $("#form_editarProducto").attr('action', `/inventario/${res.id}`);
                }
            });
        }
    </script>
@endsection