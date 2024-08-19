
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


