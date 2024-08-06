@extends('../plantillaBase')

@section('comprasDelCliente')

    <div style="display: flex; justify-content:center; align-items:center; flex-direction:column">
        <h2 style="margin: 20px 0">
            El usuario {{$cliente->nombre}} {{$cliente->apellido}} ha hecho las siguiente compras:
        </h2>
        <table style="border: 1px solid gray">
            <thead  style="background-color: black; color:white; text-aling:center;" >
                <th style="padding: 10px">factura</th>
                <th style="padding: 10px">producto</th>
                <th style="padding: 10px">marca</th>
                <th style="padding: 10px">modelo</th>
                <th style="padding: 10px">fecha de compra</th>
                <th style="padding: 10px">imagen</th>
            </thead>
            <tbody>
                @foreach ($cliente->productosDelCliente as $productos)
                    <tr>
                        <td>{{$productos->facturasDelProducto[0]->codigo}}</td>
                        <td>{{$productos->producto}}</td>
                        <td>{{$productos->marca}}</td>
                        <td>{{$productos->modelo}}</td>
                        <td style="text-align: end">{{$productos->facturasDelProducto[0]->fecha_de_compra}}</td>
                        <td style="display:flex; justify-content:center; align-items:center">
                            <img src="/imagen/{{$productos->imagen}}" alt="" style="width:50px">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
@endsection