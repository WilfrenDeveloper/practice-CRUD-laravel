<form id="form_dataCliente" class="form_dataCliente d-flex flex-wrap" >
    @csrf
    <input id="cliente_id" class="cliente_id" type="hidden" value="">
    <div class="me-3">
        <div class="input-group mb-3" style="filter: drop-shadow( 0 0 5px #9a9afc9d)">
            <label for="nombre" class="input-group-text" id="inputGroup-sizing-sm">Nombre</label>
            <input id="nombre" type="text" name="nombre" class="form-control" disabled tabindex="1">
        </div>
        <p id="error">No debe contener números. <br> No debe contener carateres especiales: #$%&/-+*</p>
    </div>
    <div class="me-3">
        <div class="input-group mb-3" style="filter: drop-shadow( 0 0 5px #9a9afc9d)">
            <label for="apellido" class="input-group-text" id="inputGroup-sizing-sm">Apellido</label>
            <input id="apellido" type="text" name="apellido" class="form-control" disabled tabindex="2">
        </div>
        <p id="error">No debe contener números, <br> No debe contener carateres especiales: #$%&/-+*</p>
    </div>
    <div class="me-3">
        <div class="input-group mb-3" style="filter: drop-shadow( 0 0 5px #9a9afc9d)">
            <label for="direccion" class="input-group-text" id="inputGroup-sizing-sm">Dirección</label>
            <input id="direccion" type="text" name="direccion" class="form-control" disabled tabindex="3" min="01-01-1900" max="01-01-2001">
        </div>
        <p id="error">Debes insertar una dirección</p>
    </div>
    <div class="me-3">
        <div class="input-group mb-3" style="filter: drop-shadow( 0 0 5px #9a9afc9d)">
            <label for="nacimiento" class="input-group-text" id="inputGroup-sizing-sm">Fecha de nacimiento</label>
            <input id="nacimiento" type="date" name="nacimiento" class="form-control" disabled tabindex="4" min="01-01-1900" max="01-01-2001">
        </div>
        <p id="error">Debes ser mayor de 18 años</p>
    </div>
    <div class="me-3">
        <div class="input-group mb-3" style="filter: drop-shadow( 0 0 5px #9a9afc9d)">
            <label for="telefono" class="input-group-text" id="inputGroup-sizing-sm">Telefono</label>
            <input id="telefono" type="tel" name="telefono" class="form-control" disabled tabindex="5" maxlength="10" >
        </div>
        <p id="error">Inserta un número de 10 dígitos</p>
        <p id="error">El número de teléfono debe comenzar con 3</p>
    </div>

    <button class="btn_editar_datos_modal_verCliente btn btn-outline-secondary rounded-0" type="button" style="height:36px">Editar datos...</button>
</form>

<hr>

<table class="facturasDelCliente_modalDatosDelCliente table">
    <thead class="table-dark">
        <th>Factura</th>
        <th>Fecha de Compra</th>
        <th>Numero de articulos</th>
        <th>Valor Total</th>
    </thead>
    <tbody>

    </tbody>
</table>


<button class="btn_eliminar_cliente btn btn-danger" type="button" style="display: none" data-bs-toggle="modal" data-bs-target="#modal_eliminar_cliente">Eliminar</button>