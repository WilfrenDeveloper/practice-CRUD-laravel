@extends('../plantillaBase')

@section('crearCliente')

<h1>Insertar Datos del Cliente</h1>

<form action="/clientes" method="POST" onsubmit="return validateFormCliente()" style="display:flex; flex-direction:column; gap: 20px; width:300px">
    @csrf
    <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
        <label for="nombre" class="form-label" >Nombre</label>
        <input id="nombre" type="text" name="nombre" class="input" tabindex="1">
    </div>
    <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
        <label for="apellido" class="form-label" >Apellido</label>
        <input id="apellido" type="text" name="apellido" class="input" tabindex="2">
    </div>
    <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
        <label for="nacimiento" class="form-label" >Fecha de nacimiento</label>
        <input id="nacimiento" type="date" name="nacimiento" class="input" tabindex="3" min="01-01-1900" max="01-01-2001">
    </div>
    <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
        <label for="telefono" class="form-label" >Telefono</label>
        <input id="telefono" type="text" name="telefono" class="input" tabindex="3">
    </div>
    <div>
    <button type="submit" style="border-style:none; border-radius:5px;padding: 12px 30px; color:white; background-color:rgb(28, 199, 221)"  tabindex="4">Aceptar</button>
    <a href="/clientes" style="text-decoration:none; border-radius:5px; padding: 10px 30px; color:white; background-color:rgb(249, 57, 57)"  tabindex="5">Cancelar</a>
    </div>
</form>
    
@endsection