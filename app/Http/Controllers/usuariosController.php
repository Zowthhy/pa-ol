<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Database\QueryException;
class usuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuario::query()
        -> orderBy('created_at', 'desc')
        -> paginate(15);;
        return view('usuarios.index', ['usuarios' => $usuarios]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request -> validate([
            'nombre' => ['required', 'string'],
            'apellido' => ['required', 'string'],
            'email' => ['required', 'string'],
            'curso' => ['required', 'string']
        ]);

        $usuario = Usuario::create($data);
        return to_route('usuarios.show', $usuario)->with('success', 'Usuario creado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        return view('usuarios.show', ['usuario' => $usuario]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuario $usuario)
    {
        return view('usuarios.edit', ['usuario' => $usuario]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuario $usuario)
    {
        $data = $request -> validate([
            'nombre' => ['required', 'string'],
            'apellido' => ['required', 'string'],
            'email' => ['required', 'string'],
            'curso' => ['required', 'string']
        ]);

        $usuario -> update($data);
        return to_route('usuarios.show', $usuario)->with('success', 'Usuario actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        
        try {
            // Intentar eliminar la herramienta
            $usuario->delete();
    
            // Redirigir con mensaje de éxito
            return redirect()->route('herramientas.index')->with('success', 'Usuario eliminado correctamente.');
    
        } catch (QueryException $e) {
            // Si ocurre una violación de clave foránea (error 1451)
            if ($e->getCode() == 23000) {
                // Redirigir con un mensaje de error amigable
                return redirect()->route('usuarios.index')->with('error', 'No se puede eliminar al usuario porque está asociado a un préstamo.');
            }
    
            // Si es otro error, puedes manejarlo de manera diferente o volver a lanzarlo
            throw $e;
        }
    }

    public function buscar(Request $request)
    {
        $search = $request->get('search');
        $usuarios = Usuario::where('nombre', 'like', "%{$search}%")->limit(10)->get();
    
        return response()->json($usuarios);
    }
}
