@extends('../plantillaBase')
@section('clientes')

    <div style="display: flex; justify-content:center; align-items:center; flex-direction:column; position:relative">
        <h1 class="title" style="position: absolute">Clientes</h1>

        <div style="margin-top:40px">
            <div class="a_editar">
                <a href="/crearcliente"  style="text-decoration:none; border: 1px solid; color:white; padding:10px 20px; text-align:center; background-color: rgb(0, 192, 0)">Ingresar Nuevo Cliente</a>
            </div>
        </div>
        <table style="margin-top:40px;border: 1px solid gray; background-color:white">
            <thead style="background-color: black; color:white; text-aling:center;" >
                <th style="padding: 10px">Nombre</th>
                <th style="padding: 10px">Apellido</th>
                <th style="padding: 10px">Fecha de Nacimiento</th>
                <th style="padding: 10px">Teléfono</th>
                <th style="padding: 10px">Operaciones</th>
                <th style="padding: 10px">Historial</th>
            </thead>
            <tbody>
                @foreach ($clientes as $cliente)
                    <tr style="height:40px">
                        <td>{{$cliente->nombre}}</td>
                        <td>{{$cliente->apellido}}</td>
                        <td>{{$cliente->nacimiento}}</td>
                        <td>{{$cliente->telefono}}</td>
                        <td style="padding-left: 20px; ">
                            <a href="/clientes/{{$cliente->id}}" style="text-decoration:none;  padding:12px 20px; text-align:center;">Ver historial de compras</a>
                        </td>
                       <td style="padding-left: 20px; ">
                            <form action="{{ route('clientes.destroy', $cliente->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                            <a href="/clientes/{{$cliente->id}}/edit" class="a_editar" style="text-decoration:none; border: 1px solid; border-radius:5px; color:white; padding:10px 20px; text-align:center; background-color: rgb(104, 104, 104)">Editar</a>     
                            <button type="submit" style="text-decoration:none; border: 1px solid; border-radius:5px; color:white; padding:12px 20px; text-align:center; background-color: rgb(255, 59, 59)">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection