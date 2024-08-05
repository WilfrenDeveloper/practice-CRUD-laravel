@extends('../plantillaBase')

@section('editarCliente')

<h1>Editar Datos del Cliente</h1>

<form action="/clientes/{{$cliente->id}}" method="POST" style="display:flex; flex-direction:column; gap: 20px; width:300px">
    @csrf
    @method('PUT')
    <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
        <label for="nombre" class="form-label" >Nombre</label>
        <input id="nombre" type="text" name="nombre" value="{{$cliente->nombre}}" class="form-control" tabindex="1">
    </div>
    <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
        <label for="apellido" class="form-label" >Apellido</label>
        <input id="apellido" type="text" name="apellido" value="{{$cliente->apellido}}" class="form-control" tabindex="2">
    </div>
    <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
        <label for="nacimiento" class="form-label" >Fecha de nacimiento</label>
        <input id="nacimiento" type="date" name="nacimiento" value="{{$cliente->nacimiento}}" class="form-control" tabindex="3">
    </div>
    <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
        <label for="telefono" class="form-label" >Telefono</label>
        <input id="telefono" type="text" name="telefono" value="{{$cliente->telefono}}" class="form-control" tabindex="3">
    </div>
    <div>
    <button type="submit" style="border-style:none; border-radius:5px;padding: 12px 30px; color:white; background-color:rgb(28, 199, 221)"  tabindex="4"> Editar </button>
    <a href="/clientes" style="text-decoration:none; border-radius:5px; padding: 10px 30px; color:white; background-color:rgb(249, 57, 57)"  tabindex="5">Cancelar</a>
    </div>
</form>
    
@endsection