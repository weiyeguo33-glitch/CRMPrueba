<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    //todos los clientes
    public function index()
    {
        return response()->json(Cliente::all());
    }

    //crear un cliente
    public function store(Request $request)
    {
        //los campis necesarios
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email',
            'telefono' => 'nullable|string|max:50',
            'empresa' => 'nullable|string|max:255',
        ]);

        $cliente = Cliente::create($request->all());
        return response()->json($cliente, 201);
    }

}
