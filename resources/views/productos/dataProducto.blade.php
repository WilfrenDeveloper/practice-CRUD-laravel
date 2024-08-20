
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