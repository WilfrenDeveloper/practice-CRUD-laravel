@extends('../plantillaBase')
@section('inventario')

                
    <div style="display: flex; justify-content:center; align-items:center; flex-direction:column; position:relative">
       
        <div style="margin:10px 0; width:600px;">              
                <button id="btn_crearProducto" class="a_editar" type="button" data-bs-toggle="modal" data-bs-target="#modal_crearProducto" style="text-decoration:none; border: 1px rgba(220, 182, 182, 0) solid; color:white; padding:10px 20px; text-align:center; background-color: rgb(0, 192, 0)">Ingresar Nuevo Producto</button>
        </div>
        
        <table style="border: 1px solid gray; background-color:white">
            <thead  style="background-color: black; color:white; text-aling:center;" >
                <th style="padding: 10px">imagen</th>
                <th style="padding: 10px">producto</th>
                <th style="padding: 10px">marca</th>
                <th style="padding: 10px">modelo</th>
                <th style="padding: 10px">sistema operativo</th>
                <th style="padding: 10px">cantidad</th>
                <th style="padding: 10px">precio</th>
                <th style="padding: 10px">acciones</th>
            </thead>
            <tbody class="tbody_productosInventario">
                
            </tbody>
        </table>
        <br>
        <button class="btn_verMas_inventario btn btn-info rounded-0 text-light fs-6" >Ver más...</button>
    </div>

    
    <!-- Modal ver Producto -->
    <div class="modal fade" id="modal_verProducto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Información del Producto</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('productos.editarProducto')
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Understood</button>
            </div>
        </div>
        </div>
    </div>

    

    <div class="modal fade" id="modal_crearProducto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Ingresar Nuevo Producto</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('productos.crearProducto')
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Understood</button>
            </div>
        </div>
        </div>
    </div>

<script src="{{asset('js/inventario/inventario.js')}}"></script>

    <script>

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
                    console.error(error);
                },
            });
        };
    </script>
@endsection