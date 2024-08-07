@extends('../plantillaBase')

@section('newProduct')
    <h1 class="text-center">Crear Nuevo Producto</h1>
    
    <form id="productForm" action="{{ url('/inventario') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateFormProduct()" style="display:flex; flex-direction:column; gap: 20px; width:300px; padding: 20px">
        @csrf
        <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
            <label for="producto" class="form-label">Producto</label>
            <input id="producto" type="text" name="producto" class="input" tabindex="1">
        </div>
        <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
            <label for="marca" class="form-label">Marca</label>
            <input id="marca" type="text" name="marca" class="input" tabindex="2">
        </div>
        <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
            <label for="modelo" class="form-label">Modelo</label>
            <input id="modelo" type="text" name="modelo" class="input" tabindex="3">
        </div>
        <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
            <label for="sistema" class="form-label">Sistema Operativo</label>
            <input id="sistema" type="text" name="sistema" class="input" tabindex="4">
        </div>
        <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
            <label for="imagen" class="form-label">Selecciona la imagen</label>
            <input id="imagen" type="file" name="imagen" class="" tabindex="5" accept=".jpg,.jpeg,.png">
        </div>
        <div>
            <button type="submit" style="border-style:none; border-radius:5px; padding: 12px 30px; color:white; background-color:rgb(73, 199, 61)" tabindex="6">Crear</button>
            <a href="/inventario" style="text-decoration:none; border-radius:5px; padding: 10px 30px; color:white; background-color:rgb(104, 104, 104)" tabindex="7">Cancelar</a>
        </div>
    </form>
@endsection