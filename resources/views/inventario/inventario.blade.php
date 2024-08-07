@extends('../plantillaBase')
@section('inventario')

    <div style="display: flex; justify-content:center; align-items:center; flex-direction:column">
        <div style="display: flex; justify-content:space-between; align-items:center; gap:200px;">
            <h1 style="margin: 20px 0">
                Inventario
            </h1>
            <div>              
                <a href="/ventas" style="text-decoration:none; color:black; padding:10px 20px; text-align:center">Ventas</a>
                <a href="/crearproducto" class="a_editar" style="text-decoration:none; border: 1px rgba(220, 182, 182, 0) solid; color:white; padding:10px 20px; text-align:center; background-color: rgb(0, 192, 0)">Ingresar Nuevo Producto</a>
            </div>
        </div>
        <table style="border: 1px solid gray; background-color:white">
            <thead  style="background-color: black; color:white; text-aling:center;" >
                <th style="padding: 10px">producto</th>
                <th style="padding: 10px">marca</th>
                <th style="padding: 10px">modelo</th>
                <th style="padding: 10px">sistema operativo</th>
                <th style="padding: 10px">imagen</th>
                <th style="padding: 10px">operaciones</th>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                    <tr>
                        <td>{{$producto->producto}}</td>
                        <td>{{$producto->marca}}</td>
                        <td>{{$producto->modelo}}</td>
                        <td>{{$producto->sistema}}</td>
                        <td style="display:flex; justify-content:center; padding:0 5px; align-items:center">
                            <img src="/imagen/{{$producto->imagen}}" alt="" style="width:80px">
                        </td>
                        <td style="padding-left: 20px">
                            <form action="{{ route('inventario.destroy', $producto->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                            <a href="/inventario/{{ $producto->id }}/edit" class="a_editar" style="text-decoration:none; border: 1px solid; border-radius:5px; color:white; padding:10px 20px; text-align:center; background-color: rgb(104, 104, 104)">Editar</a>
                            <button type="submit" style="text-decoration:none; border: 1px solid; border-radius:5px; color:white; padding:12px 20px; text-align:center; background-color: rgb(255, 59, 59)">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
    
