@extends('../plantillaBase')
@section('newProduct')
    <h1 class="text-center">Crear Nuevo Producto</h1>
    
    <form action="/inventario" method="POST" style="display:flex; flex-direction:column; gap: 20px; width:300px; padding: 20px">
        @csrf
        <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
            <label for="producto" class="form-label" >Producto</label>
            <input id="producto" type="text" name="producto" class="form-control" tabindex="1">
        </div>
        <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
            <label for="marca" class="form-label" >Marca</label>
            <input id="marca" type="text" name="marca" class="form-control" tabindex="2">
        </div>
        <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
            <label for="modelo" class="form-label" >Modelo</label>
            <input id="modelo" type="text" name="modelo" class="form-control" tabindex="3">
        </div>
        <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
            <label for="sistema" class="form-label" >Sistema Operatico</label>
            <input id="sistema" type="text" name="sistema" class="form-control" tabindex="3">
        </div>
        <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
            <label for="imagen" class="form-label" >Imagen</label>
            <input id="imagen" type="text" name="imagen" class="form-control" tabindex="3">
        </div>
        <div>
        <button type="submit" style="border-style:none; border-radius:5px;padding: 12px 30px; color:white; background-color:rgb(73, 199, 61)"  tabindex="4">Crear</button>
        <a href="/inventario" style="text-decoration:none; border-radius:5px; padding: 10px 30px; color:white; background-color:rgb(104, 104, 104)"  tabindex="5">Cancelar</a>
        </div>
    </form>


@endsection