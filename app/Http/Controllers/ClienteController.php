<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.clientes', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.crearCliente');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de los datos de entrada
        $validatedData = $request->validate([
            'nombre' => 'required|max:100',
            'apellido' => 'required|max:100',
            'nacimiento' => 'required|date|before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
            'telefono' => 'required|digits:10',
        ]);

        // Creación del nuevo cliente
        $cliente = new Cliente();
        $cliente->nombre = $validatedData['nombre'];
        $cliente->apellido = $validatedData['apellido'];
        $cliente->nacimiento = $validatedData['nacimiento'];
        $cliente->telefono = $validatedData['telefono'];

        // Guardar el cliente en la base de datos
        $cliente->save();

        // Redireccionar a la lista de clientes
        return redirect('/clientes');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cliente = Cliente::find($id);
        return view('clientes.comprasDelCliente', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cliente = Cliente::find($id);
        return response()->json($cliente);
        //return view('clientes.editarCliente')->with('cliente', $cliente);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validación de los datos de entrada
        $validatedData = $request->validate([
            'nombre' => 'required|max:255',
            'apellido' => 'required|max:255',
            'nacimiento' => 'required|date|before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
            'telefono' => 'required|digits:10',
        ]);

        $cliente = Cliente::find($id);
        $cliente->nombre = $validatedData['nombre'];
        $cliente->apellido = $validatedData['apellido'];
        $cliente->nacimiento = $validatedData['nacimiento'];
        $cliente->telefono = $validatedData['telefono'];

        $cliente->save();

        return redirect('/clientes');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cliente = Cliente::find($id);
        $cliente->delete();
        return redirect('clientes');
    }
}
