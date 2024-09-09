
<div class="modal fade" id="exampleModalToggle" aria-labelledby="exampleModalToggleLabel" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content" style="width:380px">
            <div class="modal-header">
                <h2 class="modal-title fs-5" id="exampleModalToggleLabel">Metodo de pago</h2>
                <button type="button" class="btn-close generarFactura_exit" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="generarFactura_metodoDePago">
                    <select class="generarFactura_select form-select form-select-sm" name="metodos" id="metodos" aria-label="Small select example" style="width:300px">
                        <option value="1" selected>Efectivo</option>
                    </select>
                </div> 
                
                <form class="generarFactura_form" style="display:flex; flex-direction:column">
                    @csrf
                    <hr>
                    <h5>Datos del cliente</h5>
                    <div style="display: flex; flex-direction:column; gap:5px; padding-top:0" class="mb-3">
                        <label for="nombre" class="form-label" >Nombre</label>
                        <div id="div_input">
                            <input id="nombre" type="text" name="nombre" class="form-control" tabindex="1">
                            <p id="error">No debe contener números. <br> No debe contener carateres especiales: #$%&/-+*</p>
                        </div>
                    </div>
                    <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
                        <label for="apellido" class="form-label" >Apellido</label>
                        <div id="div_input">
                            <input id="apellido" type="text" name="apellido" class="form-control" tabindex="2">
                            <p id="error">No debe contener números, <br> No debe contener carateres especiales: #$%&/-+*</p>
                        </div>
                    </div>
                    <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
                        <label for="direccion" class="form-label" >Dirección</label>
                        <div id="div_input">
                            <input id="direccion" type="text" name="direccion" class="form-control" tabindex="3">
                            <p id="error">Debes insertar una dirección correcta</p>
                        </div>
                    </div>
                    <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
                        <label for="telefono" class="form-label" >Telefono</label>
                        <div id="div_input">
                            <input id="telefono" type="tel" name="telefono" class="form-control" maxlength="10" tabindex="3">
                            <p id="error">Inserta un número de 10 dígitos</p>
                            <p id="error">El número de teléfono debe comenzar con 3</p>
                        </div>
                    </div>           
                </form>  
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger generarFactura_exit" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                <button class="btn btn-primary btn_comprar_generarFactura">Comprar</button>
            </div> 
      </div>
    </div>
</div>
 

<script src="{{asset('js/facturas/generarFactura.js')}}"></script>