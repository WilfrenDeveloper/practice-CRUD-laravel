@extends('../plantillaBase')
@section('newProduct')
    <h1 class="text-center">Crear Registro</h1>
    
    <form action="/inventario/{{$producto->id}}" method="POST"  style="display:flex; flex-direction:column; gap: 20px; width:300px; padding: 20px">
        @csrf
        @method('PUT')
        <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
            <label for="producto" class="form-label" >Producto</label>
            <input id="producto" value="{{$producto->producto}}" type="text" name="producto" class="form-control" tabindex="1">
        </div>
        <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
            <label for="marca" class="form-label" >Marca</label>
            <input id="marca" value="{{$producto->marca}}" type="text" name="marca" class="form-control" tabindex="2">
        </div>
        <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
            <label for="modelo" class="form-label" >Modelo</label>
            <input id="modelo" value="{{$producto->modelo}}" type="text" name="modelo" class="form-control" tabindex="3">
        </div>
        <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
            <label for="sistema" class="form-label" >Sistema Operatico</label>
            <input id="sistema" value="{{$producto->sistema}}" type="text" name="sistema" class="form-control" tabindex="3">
        </div>
        <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
            <label for="imagen" class="form-label" >Imagen</label>
            <input id="imagen" value="{{$producto->imagen}}" type="text" name="imagen" class="form-control" tabindex="3">
        </div>
        <div>
            <button type="submit" class="btn btn-primary" style="border-style:none; border-radius:5px;padding: 12px 30px; color:white; background-color:rgb(73, 199, 61)" tabindex="4">Editar</button>
            <a href="/inventario" class="btn btn-secundary btn-danger" style="text-decoration:none; border-radius:5px; padding: 10px 30px; color:white; background-color:rgb(104, 104, 104) " tabindex="5">Cancelar</a>
        </div>
    </form>


@endsection