@extends('../plantillaBase')
@section('inventario')

    <div style="display: flex; justify-content:center; align-items:center; flex-direction:column; position:relative">
       
        <div style="margin:10px 0; width:600px;">              
                <button id="btn_ingresarNuevoProducto" class="btn rounded-0 text-white" type="button" data-bs-toggle="modal" data-bs-target="#modal_datosDelProducto" style="background-color: rgb(0, 192, 0)">Ingresar Nuevo Producto</button>
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

    <div class="modal fade" id="modal_datosDelProducto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Información del Producto</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('productos.datosDelProducto')
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Salir</button>
            <button id="btn_crearEditar_datosDelProducto" type="button" class=" btn btn-info text-white">Editar</button>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal confirmar eliminar Producto-->
<div class="modal fade" id="confirmarEliminarProductoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar Producto</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p>
                <span>Estás seguro de eliminar el producto:</span>
                <br>
                <strong></strong>
            </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn_confirmar_eliminarProducto_inventario btn btn-primary">Confirmar</button>
        </div>
      </div>
    </div>
  </div>

<script src="{{asset('js/inventario/inventario.js')}}"></script>

@endsection