
    <form id="form_editarProducto" method="POST" enctype="multipart/form-data" onsubmit="return validateEditProduct()"  style="display:flex; flex-direction:column; align-items:center; gap: 20px; padding: 20px; background-color:white; border: 1px solid rgb(218, 216, 216)">
        @csrf
        @method('PUT')
        <h1 class="text-center">Editar Registro</h1>
        <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
            <label for="producto" class="form-label">Producto</label>
            <div id="div_input">
                <input id="producto" value="" type="text" name="producto" class="input edit_producto" tabindex="1">
                <p id="error">Debes insertar el nombre del producto</p>
            </div>
        </div>
        <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
            <label for="marca" class="form-label">Marca</label>
            <div id="div_input">
                <input id="marca" value="" type="text" name="marca" class="input edit_marca" tabindex="2">
                <p id="error">Debes insertar la marca del producto</p>
            </div>
        </div>
        <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
            <label for="modelo" class="form-label">Modelo</label>
            <div id="div_input">
                <input id="modelo" value="" type="text" name="modelo" class="input edit_modelo" tabindex="3">
                <p id="error">Debes insertar el modelo</p>
            </div>
        </div>
        <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
            <label for="sistema" class="form-label">Sistema Operativo</label>
            <div id="div_input">
                <input id="sistema" value="" type="text" name="sistema" class="input edit_sistema" tabindex="4">
                <p id="error">Debes insertar el sistema Operativo</p>
            </div>
        </div>
        <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
            <label for="imagen" class="form-label">Selecciona la imagen</label>
            <div id="div_input">
                <input id="imagen" value=""  type="file" name="imagen" class=" edit_imagen" accept=".jpg,.jpeg,.png" tabindex="5"  >
                <p id="error">Debes adjuntar una imagen formato: jpg, jpeg o png</p>
            </div>
        </div>
        <div>
            <button type="submit" style="border-style:none ;padding: 12px 30px; color:white; background-color:rgb(73, 199, 61)" tabindex="4">Editar</button>
            <a href="/inventario" class="a_editar"  style="text-decoration:none; padding: 10px 30px; color:white; background-color:rgb(104, 104, 104) " tabindex="5">Cancelar</a>
        </div>
    </form>