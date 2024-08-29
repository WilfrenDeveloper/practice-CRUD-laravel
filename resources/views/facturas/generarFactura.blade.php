
<div class="generarFactura" style="display:none; position:fixed; top:0; left:0; height:100%; width:50%; background-color:white; overflow-y:auto" z-index="100">
    
    <div class="position-relative" style="padding: 20px; background-color:white;">
        <button class="generarFactura_exit btn position-absolute top-0 end-0 fs-5" ><i class="bi bi-x-lg"></i> </button>


        <h3>Datos del Cliente</h3>
        
        <form class="generarFactura_form form-control" style="display:flex; flex-direction:column; gap: 30px; width:330px">
                @csrf
                
                <div style="display: flex; flex-direction:column; gap:5px; margin-top:-20px; padding-top:0" class="mb-3">
                    <label for="nombre" class="form-label" >Nombre</label>
                    <div id="div_input">
                        <input id="nombre" type="text" name="nombre" class="input" tabindex="1">
                        <p id="error">No debe contener números. <br> No debe contener carateres especiales: #$%&/-+*</p>
                    </div>
                </div>
                <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
                    <label for="apellido" class="form-label" >Apellido</label>
                    <div id="div_input">
                        <input id="apellido" type="text" name="apellido" class="input" tabindex="2">
                        <p id="error">No debe contener números, <br> No debe contener carateres especiales: #$%&/-+*</p>
                    </div>
                </div>
                <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
                    <label for="direccion" class="form-label" >Dirección</label>
                    <div id="div_input">
                        <input id="direccion" type="text" name="direccion" class="input" tabindex="3">
                        <p id="error">Debes insertar una dirección correcta</p>
                    </div>
                </div>
                <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
                    <label for="telefono" class="form-label" >Telefono</label>
                    <div id="div_input">
                        <input id="telefono" type="number" name="telefono" class="input" tabindex="3">
                        <p id="error">Inserta un número de 10 dígitos</p>
                        <p id="error">El número de teléfono debe comenzar con 3</p>
                    </div>
                </div>
                <div>
                <button class="generarFactura_btn_comprar btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Comprar</button>
                <a class="generarFactura_exit btn btn-light">Cancelar</a>
                </div>
            </form>
        <div>
        </div>
    </div>
</div>  

<script src="{{asset('js/facturas/generarFactura.js')}}"></script>