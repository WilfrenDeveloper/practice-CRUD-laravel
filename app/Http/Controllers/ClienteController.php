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
        $cliente = new Cliente();
        $cliente->nombre = $request->get('nombre');
        $cliente->apellido = $request->get('apellido');
        $cliente->nacimiento = $request->get('nacimiento');
        $cliente->telefono = $request->get('telefono');

        $cliente->save();

        return redirect('/clientes');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cliente= Cliente::find($id);
        return view('clientes.comprasDelCliente', compact('cliente'));
     
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cliente = Cliente::find($id);
        return view('clientes.editarCliente')->with('cliente', $cliente);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cliente = Cliente::find($id);
        $cliente->nombre = $request->get('nombre');
        $cliente->apellido = $request->get('apellido');
        $cliente->nacimiento = $request->get('nacimiento');
        $cliente->telefono = $request->get('telefono');

        $cliente->save();

        return redirect('/clientes');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
