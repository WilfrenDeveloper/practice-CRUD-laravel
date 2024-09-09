
<form id="form_datosDelProducto" class="form_datosDelproducto" enctype="multipart/form-data">
    @csrf
    <input id="producto_id" name="producto_id" class="producto_id" type="hidden" >
    <div id="div_container" class="mb-3">
        <label for="producto" class="form-label">Producto</label>
        <div id="div_input">
            <input id="producto" type="text" name="producto" class="form-control form-control-sm" tabindex="1">
        </div>
    </div>
    <div id="div_container" class="mb-3">
        <label for="marca" class="form-label">Marca</label>
        <div id="div_input">
            <input id="marca" type="text" name="marca" class="form-control form-control-sm" tabindex="2">
        </div>
    </div>
    <div id="div_container" class="mb-3">
        <label for="modelo" class="form-label">Modelo</label>
        <div id="div_input">
            <input id="modelo" type="text" name="modelo" class="form-control form-control-sm" tabindex="3">
        </div>
    </div>
    <div id="div_container" class="mb-3">
        <label for="sistema" class="form-label">Sistema Operativo</label>
        <div id="div_input">
            <input id="sistema" type="text" name="sistema" class="form-control form-control-sm" tabindex="4">
        </div>
    </div>
    <div id="div_container" class="mb-3">
        <label for="precio" class="form-label">Precio</label>
        <div id="div_input">
            <input id="precio" type="number" name="precio" class="form-control form-control-sm" tabindex="4">
        </div>
    </div>
    <div id="div_container" class="mb-3">
        <label for="cantidad" class="form-label">Cantidad</label>
        <div id="div_input">
            <input id="cantidad" type="number" name="cantidad" class="form-control form-control-sm" tabindex="4">
        </div>
    </div>
    <div id="seleccione_imagen" class="seleccione_imagen mb-3">
        <label class="form-label">Imagen</label>
        <br>
        <img id="mostrarImagen" src="" class="mostrarImagen mb-3" style="max-height:100px">
        <div class="mb-3" >
            <label for="imagen" class="border-dashed px-3 py-1 hover-purple">
                <div id="selectImage" class="selectImage d-flex flex-column justify-content-center align-items-center">
                    <i class="bi bi-card-image fs-3 m-0"></i>
                    <p class="m-0 fs-6">Selecciona una imagen</p>
                </div>
                <input id="imagen" class="hidden" value="" name="imagen" type="file" accept=".jpg,.jpeg,.png" >
            </label>
        </div>
        <div class="error">
            <p id="error">Debes adjuntar una imagen formato: jpg, jpeg o png</p>
        </div>
    </div>
</form>
