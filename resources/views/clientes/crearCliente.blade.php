
<form id="clientesForm" class="form_create_client" style="display:flex; flex-direction:column; align-items:center; gap: 35px; padding:30px; background-color:white; border: 1px solid rgb(218, 216, 216) ">
    @csrf
    <h1 style="margin:0; padding-bottom:0">Insertar Datos del Cliente</h1>
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
        <label for="nacimiento" class="form-label" >Fecha de nacimiento</label>
        <div id="div_input">
            <input id="nacimiento" type="date" name="nacimiento" class="input" tabindex="3" min="01-01-1900" max="01-01-2001">
            <p id="error">Debes ser mayor de 18 años</p>
        </div>
    </div>
    <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
        <label for="telefono" class="form-label" >Telefono</label>
        <div id="div_input">
            <input id="telefono" type="text" name="telefono" class="input" tabindex="3">
            <p id="error">Inserta un número de 10 dígitos</p>
            <p id="error">El número de teléfono debe comenzar con 3</p>
        </div>
    </div>
    
    <div>
    <button type="submit" style="border-style:none; padding: 12px 30px; color:white; background-color:rgb(28, 199, 221)"  tabindex="4">Aceptar</button>
    <a  class="a_editar btn_create_client_cancel" style="text-decoration:none; padding: 10px 30px; color:white; background-color:rgb(249, 57, 57)" >Cancelar</a>
    </div>
</form>

<script>
    $(document).ready(function () {
        $('.btn_create_client_cancel').click(function() {
            $('.form_create_client')[0].reset();
            $('#nombre').css('background-color', 'white'),
            $('#apellido').css('background-color', 'white'),
            $('#nacimiento').css('background-color', 'white'),
            $('#telefono').css('background-color', 'white'),
            $('[id="error"]').hide(),
            $('#modal_crearCliente').hide()
        });

        $('.form_create_client').submit(function(e){
            e.preventDefault();
            //Validar que los datos sean correctos
            if(validateFormCliente()) {
                $.ajax({
                    type: "POST",
                    url: "/clientes",
                    data: $('#clientesForm').serialize(),
                    success: function (res) {
                        //const cliente = res.cliente;
                        alert('Cliente Creado Exitosamente');
                        const cliente = res.cliente;
                        $('.tbody_clientes').append(`
                            <tr class="tr_operaciones tr_${cliente.id}" style="height:40px" data-id="${cliente.id}">
                                ${res.html}
                            </tr>
                        `);
                        //escodemos el modal crear cliente y lo reseteamos
                        $('.form_create_client')[0].reset();
                        $('#modal_crearCliente').hide();

                        alert('Cliente creado satisfactoriamente');
                    },
                    error: function (error) {
                        console.error('error', error);
                    }
                });
            };
        });

    });
</script>