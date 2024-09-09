<form id="form_crearCliente" class="form_crearCliente" >
    @csrf
    <div id="container" class="me-3">
        <div class="input-group mb-3" style="filter: drop-shadow( 0 0 2px #5ad0ff9d)">
            <label for="nombre" class="input-group-text" id="inputGroup-sizing-sm">Nombre</label>
            <input id="nombre" type="text" name="nombre" class="form-control"  tabindex="1">
        </div>
        <div id="error">
            <p class="m-0 p-0">No debe contener números. <br> No debe contener carateres especiales: #$%&/-+*</p>
        </div>
    </div>
    <div id="container" class="me-3">
        <div class="input-group mb-3" style="filter: drop-shadow( 0 0 2px #5ad0ff9d)">
            <label for="apellido" class="input-group-text" id="inputGroup-sizing-sm">Apellido</label>
            <input id="apellido" type="text" name="apellido" class="form-control"  tabindex="2">
        </div>
        <div id="error">
            <p class="m-0 p-0">No debe contener números, <br> No debe contener carateres especiales: #$%&/-+*</p>
        </div>
    </div>
    <div id="container" class="me-3">
        <div class="input-group mb-3" style="filter: drop-shadow( 0 0 2px #5ad0ff9d)">
            <label for="direccion" class="input-group-text" id="inputGroup-sizing-sm">Dirección</label>
            <input id="direccion" type="text" name="direccion" class="form-control"  tabindex="3" min="01-01-1900" max="01-01-2001">
        </div>
        <div id="error">
            <p class="m-0 p-0">Debes insertar una dirección</p>
        </div>
    </div>
    <div id="container" class="me-3">
        <div class="input-group mb-3" style="filter: drop-shadow( 0 0 2px #5ad0ff9d)">
            <label for="nacimiento" class="input-group-text" id="inputGroup-sizing-sm">Fecha de nacimiento</label>
            <input id="nacimiento" type="date" name="nacimiento" class="form-control"  tabindex="4" min="01-01-1900" max="01-01-2001">
        </div>
        <div id="error">
            <p class="m-0 p-0">Debes ser mayor de 18 años</p>
        </div>
    </div>
    <div id="container" class="me-3">
        <div class="input-group mb-3" style="filter: drop-shadow( 0 0 2px #5ad0ff9d)">
            <label for="telefono" class="input-group-text" id="inputGroup-sizing-sm">Telefono</label>
            <input id="telefono" type="tel" name="telefono" class="form-control"  tabindex="5" maxlength="10" >
        </div>
        <div id="error">
            <p class="diezDigitos m-0 p-0" style="display:none">Inserta un número de 10 dígitos</p>
            <p class="empezarConTres m-0 p-0" style="display:none">El número de teléfono debe comenzar con 3</p>
        </div>
    </div>
</form>