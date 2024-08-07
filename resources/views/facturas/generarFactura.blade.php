@extends('../plantillaBase')
@section('generarFactura')

    <h1>Realizar Compra</h1>

    <div style="display:flex; gap:30px">
        <div style="padding: 20px;  border-radius:15px">
            <figure style="width: 300px; height: 180px; display:flex; align-items:center">
                <img src="/imagen/{{$producto->imagen}}" alt="" style="width: 300px">
            </figure>
            <hr>
            <div style="height: 180px; position:relative">
                <h3>{{$producto->nombre}} {{$producto->marca}} {{$producto->modelo}}</h3>
                <p style="opacity: 0.6">Sistema Operativo:</p>
                <p style="margin-top:-15px;">{{$producto->sistema}}</p>

            </div>
        </div>

        <div>
            <h2>Datos del Cliente</h2>

            <div>
                <h4>Eres Cliente Antiguo</h4>
                <form action="/facturas">
                    @csrf
                    <select name="id_cliente" id="id_cliente">
                        <option value="">Seleccione un opción</option>
                        @foreach ($clientes as $cliente)   
                            <option value="{{$cliente->id}}">
                                {{$cliente->nombre}} {{$cliente->apellido}}
                            </option>  
                        @endforeach
                    </select>

                    <button type="submit" style="border-style:none; border-radius:5px;padding: 5px 30px; color:white; background-color:rgb(61, 141, 199)">Aceptar y Comprar</button>
                </form>
            </div>
            <br>
                <h4>Eres Cliente Nuevo</h4>
                <form action="/" method="POST" onsubmit="return validateFormCliente()" style="display:flex; flex-direction:column; gap: 20px; width:300px">
                    @csrf
                    <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
                        <label for="id_producto" class="form-label" ></label>
                        <input id="id_producto" type="text" name="id_producto" class="input" tabindex="1" value="{{$producto->id}}" style="display:none">
                    </div>
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
                        <input id="nacimiento" type="date" name="nacimiento" class="input" tabindex="3" min="01-01-1900" max="d-m-Y">
                    </div>
                    <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
                        <label for="telefono" class="form-label" >Telefono</label>
                        <input id="telefono" type="text" name="telefono" class="input" tabindex="3">
                    </div>
                    <div>
                    <button type="submit" style="border-style:none; border-radius:5px;padding: 12px 30px; color:white; background-color:rgb(61, 141, 199)"  tabindex="4">Comprar</button>
                    <a href="/" style="text-decoration:none; border-radius:5px; padding: 10px 30px; color:white; background-color:rgb(104, 104, 104)"  tabindex="5">Cancelar</a>
                    </div>
                </form>
            <div>
                
            </div>
        </div>
    </div>
    
@endsection