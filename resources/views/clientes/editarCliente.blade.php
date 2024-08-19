
    <form id="form_editarCliente" class="form_edit_client" onsubmit="return validateEditCliente()" style="display:flex; flex-direction:column; align-items:center; gap: 35px; padding:30px; background-color:white; border: 1px solid rgb(218, 216, 216) ">
        @csrf
        <h1>Editar Datos del Cliente</h1>
            <input id="cliente_id" name="cliente_id" class="cliente_id" type="hidden" >
        <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
            <label for="nombre" class="form-label" >Nombre</label>
            <div id="div_input">
                <input id="nombre" type="text" name="nombre" class="input edit_nombre" value="">
                <p id="error">No debe contener números, No debe contener carateres especiales: #$%&/-+*</p>
            </div>
        </div>
        <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
            <label for="apellido" class="form-label" >Apellido</label>
            <div id="div_input">
                <input id="apellido" type="text" name="apellido" class="input edit_apellido" value="">
                <p id="error">No debe contener números, No debe contener carateres especiales: #$%&/-+*</p>
            </div>
        </div>
        <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
            <label for="nacimiento" class="form-label" >Fecha de nacimiento</label>
            <div id="div_input">
                <input id="nacimiento" type="date" name="nacimiento" class="input edit_nacimiento" value="" min="01-01-1900" max="01-01-2001">
                <p id="error">Debes ser mayor de 18 años</p>
            </div>
        </div>
        <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
            <label for="telefono" class="form-label" >Telefono</label>
            <div id="div_input">
                <input id="telefono" type="text" name="telefono" class="input edit_telefono" value="">
                <p id="error">Inserta un número de 10 dígitos</p>
                <p id="error">El número de teléfono debe comenzar con 3</p>
            </div>
        </div>

        <div>
        <button type="submit" style="border-style:none; border-radius:5px;padding: 12px 30px; color:white; background-color:rgb(28, 199, 221)"  tabindex="4"> Editar </button>
        <a class="btn_cancel_edit_client" style="text-decoration:none; border-radius:5px; padding: 10px 30px; color:white; background-color:rgb(249, 57, 57)"  tabindex="5">Cancelar</a>
        </div>
    </form>

<script>
    $(document).ready(function () {

        //Botón Editar que envía la información a ClienteController al metodo store
        $('.form_edit_client').on('submit', function (e) { 
            e.preventDefault();
            let id = $(".cliente_id").val();
            $.ajax({
                type: "PUT",
                url: `/clientes/${id}`,
                data: $('.form_edit_client').serialize(),
                success: function(res) {
                    $(`.tr_${res.id}`).html(res.html);
                    $('#modal_editarCliente').hide();
                },
                error: function(error) {
                    console.error('error', error);
                }
            });
        });

        //Botón Cancelar el modal Editar cliente
        $('.btn_cancel_edit_client').on('click', function() {
            $('.form_edit_client')[0].reset();
            $('[id="nombre"]').css('background-color', 'white'),
            $('[id="apellido"]').css('background-color', 'white'),
            $('[id="nacimiento"]').css('background-color', 'white'),
            $('[id="telefono"]').css('background-color', 'white'),
            $('[id="error"]').hide(),
            $('#modal_editarCliente').hide()
        })


    });

</script>