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
            <tbody class="tbody_productos">
                @foreach ($productos as $producto)
                    <tr class="tr_product_{{$producto->id}}">
                        <td>{{$producto->producto}}</td>
                        <td>{{$producto->marca}}</td>
                        <td>{{$producto->modelo}}</td>
                        <td>{{$producto->sistema}}</td>
                        <td style="display:flex; justify-content:center; padding:0 5px; align-items:center">
                            <img src="/imagen/{{$producto->imagen}}" alt="" style="max-width:100px; max-height:60px">
                        </td>
                        <td style="padding-left: 20px">
                            <div class="modal_eliminar_producto modal-{{$producto->id}}" style="display: none">
                                @csrf
                                        <div id="div_modal_eliminar">
                                            <p>Estás seguro de querer eliminar el producto <br> <strong>{{$producto->producto}} {{$producto->marca}} {{$producto->modelo}}</strong></p>
                                            <button onclick="cancelarEliminarProducto({{$producto->id}})" href="/inventario" id="btn_confirm-cancel" class="a_editar" style="text-decoration:none; border: 1px solid; border-radius:5px; color:white; padding:10px 20px; text-align:center; background-color: rgb(104, 104, 104)">Cancelar</button>
                                            <button onclick="aceptarEliminarProducto({{$producto->id}})" style="text-decoration:none; border: 1px solid; border-radius:5px; color:white; padding:12px 20px; text-align:center; background-color: rgb(31, 209, 0)">Aceptar</button>
                                        </div>
                            </div>
                            <button onclick="modalEditarProducto({{$producto->id}})" style="text-decoration:none; border: 1px solid; border-radius:5px; color:white; padding:10px 20px; text-align:center; background-color: rgb(104, 104, 104)">Editar</button>
                            <button onclick="modalEliminarProducto({{$producto->id}})" style="text-decoration:none; border: 1px solid; border-radius:5px; color:white; padding:12px 20px; text-align:center; background-color: rgb(255, 59, 59)">Eliminar</button>
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

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //Botón eliminar que activa el modal Eliminar Producto
        function modalEliminarProducto(id) {
            $(`.modal-${id}`).css('display', 'flex');
        };

        //Botón Cancelar que esconde el modal eliminar producto
        function cancelarEliminarProducto(id){
            $(`.modal-${id}`).css('display', 'none');
        }
        
        //Botón Editar que activa el modal Editar Producto
        function modalEditarProducto(id) { 
            //id.preventDefault();
            $('#modal_editarProducto').show();

            $.ajax({
                type: "GET",
                url: `/productos/${id}/edit`,
                success: function(res){
                    $(".producto_id").val(res.id)
                    $(".edit_producto").val(res.producto);
                    $(".edit_marca").val(res.marca);
                    $(".edit_modelo").val(res.modelo);
                    $(".edit_sistema").val(res.sistema);
                    $(".edit_imagen").attr('file', `/imagen/${res.imagen}`);
                    
                    $("#form_editarProducto").attr('action', `/inventario/${res.id}`);
                },
                error: function(error) {
                    console.error('error', error);
                },
            });
        };

        //Botón Aceptar que confirma el modal Eliminar Producto
        function aceptarEliminarProducto(id) {
            $('.modal_eliminar_producto').css('display', 'none');
            $.ajax({
                type: "DELETE",
                url: `/inventario/${id}`,
                success: function (res) {
                    $('.tbody_productos').html(res.html);
                    alert('El Producto ha sido eliminado satisfactoriamente');
                },
                error: function(error){
                    console.log(error);
                },
            });
        };

        
        $(document).ready(function () {
            $('#btn_crearProducto').click(function (e) { 
                e.preventDefault();
                $('#modal_crearProducto').show();
                return;
            }); 
        });
    </script>
@endsection