@extends('../plantillaBase')
@section('newProduct')
    <h1 class="text-center">Editar Registro</h1>
    
    <form action="/inventario/{{$producto->id}}" method="POST" enctype="multipart/form-data" onsubmit="return validateFormProduct()"  style="display:flex; flex-direction:column; gap: 20px; width:300px; padding: 20px">
        @csrf
        @method('PUT')
        <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
            <label for="producto" class="form-label" >Producto</label>
            <input id="producto" value="{{$producto->producto}}" type="text" name="producto" class="input" tabindex="1">
        </div>
        <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
            <label for="marca" class="form-label" >Marca</label>
            <input id="marca" value="{{$producto->marca}}" type="text" name="marca" class="input" tabindex="2">
        </div>
        <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
            <label for="modelo" class="form-label" >Modelo</label>
            <input id="modelo" value="{{$producto->modelo}}" type="text" name="modelo" class="input" tabindex="3">
        </div>
        <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
            <label for="sistema" class="form-label" >Sistema Operatico</label>
            <input id="sistema" value="{{$producto->sistema}}" type="text" name="sistema" class="input" tabindex="3">
        </div>
        <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
            <label for="imagen" class="form-label" >Imagen</label>
            <input id="imagen" value="/imagen/{{$producto->imagen}}" type="file" name="imagen" accept=".jpg,.jpeg,.png"  class="" tabindex="3">
        </div>
        <div>
            <button type="submit" style="border-style:none ;padding: 12px 30px; color:white; background-color:rgb(73, 199, 61)" tabindex="4">Editar</button>
            <a href="/inventario" class="a_editar"  style="text-decoration:none; padding: 10px 30px; color:white; background-color:rgb(104, 104, 104) " tabindex="5">Cancelar</a>
        </div>
    </form>


@endsection