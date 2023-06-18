<?php

namespace App\Http\Controllers;

use App\Mail\SendPost;
use App\Mail\SendPostNewComment;
use App\Models\Cliente;
use App\Models\Comentario;
use Illuminate\Http\Request;
use App\Mail\SendPostNewClient;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::get();

        $data = $clientes->map(function ($cliente) {
            return [
                'Codigo_cliente' => $cliente->id,
                'Nombre_cliente' => $cliente->nombre,
                'Email' => $cliente->email,
                'Telefono' => $cliente->telefono,

            ];
        });

        return response()->json([
            'mensaje' => 'Listado de clientes',
            'date' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'nombre' => ['required', 'string'],
            'telefono' => ['required', 'numeric'],
            'comentario' => ['required', 'string']
        ]);

        $cliente = Cliente::where('email', $request->email)->first();

        if ($cliente) {
            $comentario = Comentario::create([
                'cliente_id' => $cliente['id'],
                'comentario' => $request['comentario'],
            ]);

            $details = [
                'email' => $cliente['email'],
                'nombre' => $cliente['nombre'],
                'telefono' => $cliente['telefono'],
                'comentario' => $comentario['comentario'],
            ];

            Mail::to('mundose.comentario.pin@gmail.com')->send(new SendPostNewComment($details));

            return response()->json([
                'mensaje' => 'El cliente agrego un nuevo comentario',
                'cliente' => $cliente,
                'comentario' => $comentario
            ]);

        } else {

            $cliente = Cliente::create([
                'email' => $request['email'],
                'nombre' => $request['nombre'],
                'telefono' => $request['telefono'],

            ]);

            $comentario = Comentario::create([
                'cliente_id' => $cliente['id'],
                'comentario' => $request['comentario'],
            ]);

            $details = [
                'email' => $cliente['email'],
                'nombre' => $cliente['nombre'],
                'telefono' => $cliente['telefono'],
                'comentario' => $comentario['comentario'],
            ];

            Mail::to('mundose.cliente.pin@gmail.com')->send(new SendPostNewClient($details));


            return response()->json([
                'mensaje' => 'El cliente se agrego correctamente',
                'cliente' => $cliente,
                'comentario' => $comentario,
            ]);
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try {
            $cliente = Cliente::FindOrFail($id);

            $comentarios = $cliente->comentarios()->get();

            $data = $comentarios->map(function ($comentario) {
                return [
                    'Id_cliente' => $comentario->cliente_id,
                    'Comentario' => $comentario->comentario,
                    'Fecha' => $comentario->created_at,

                ];
            });

            return response()->json([
                'mensaje' => 'datos del cliente',
                'cliente' => [
                    'Nombre_cliente' => $cliente->nombre,
                    'Email' => $cliente->email,
                    'Telefono' => $cliente->telefono,
                    'Comentarios' => $data,
                ],
            ]);
        } catch (\Throwable $th) {
            return response()->json(['mensaje' => 'Cliente no encontrado'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $cliente = Cliente::FindOrFail($id);
        $cliente->delete();

        return response()->json([
            'mensaje' => 'Se elimino el cliente y sus comentarios'
        ]);
    }

    public function activarCliente(int $id)
    {

        $cliente = Cliente::withTrashed()
            ->where('id', $id)
            ->restore();
    }
}