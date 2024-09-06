<form id="form_dataCliente" class="form_dataCliente" >
    <div class="mb-3">
        <label for="nombre" class="form-label" >Nombre</label>
        <div id="div_input">
            <input id="nombre" type="text" name="nombre" class="form-control" tabindex="1">
            <p id="error">No debe contener números. <br> No debe contener carateres especiales: #$%&/-+*</p>
        </div>
    </div>
    <div class="mb-3">
        <label for="apellido" class="form-label" >Apellido</label>
        <div id="div_input">
            <input id="apellido" type="text" name="apellido" class="form-control" tabindex="2">
            <p id="error">No debe contener números, <br> No debe contener carateres especiales: #$%&/-+*</p>
        </div>
    </div>
    <div class="mb-3">
        <label for="direccion" class="form-label" >Dirección</label>
        <div id="div_input">
            <input id="direccion" type="text" name="direccion" class="form-control" tabindex="3" min="01-01-1900" max="01-01-2001">
            <p id="error">Debes insertar una dirección</p>
        </div>
    </div>
    <div class="mb-3">
        <label for="nacimiento" class="form-label" >Fecha de nacimiento</label>
        <div id="div_input">
            <input id="nacimiento" type="date" name="nacimiento" class="form-control" tabindex="3" min="01-01-1900" max="01-01-2001">
            <p id="error">Debes ser mayor de 18 años</p>
        </div>
    </div>
    <div class="mb-3">
        <label for="telefono" class="form-label" >Telefono</label>
        <div id="div_input">
            <input id="telefono" type="text" name="telefono" class="form-control" tabindex="3">
            <p id="error">Inserta un número de 10 dígitos</p>
            <p id="error">El número de teléfono debe comenzar con 3</p>
        </div>
    </div>
    
    <div>
    <button type="submit" style="border-style:none; padding: 12px 30px; color:white; background-color:rgb(28, 199, 221)"  tabindex="4">Aceptar</button>
    <a  class="a_editar btn_create_client_cancel" style="text-decoration:none; padding: 10px 30px; color:white; background-color:rgb(249, 57, 57)" >Cancelar</a>
    </div>
</form>


