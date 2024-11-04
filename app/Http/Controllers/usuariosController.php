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
    public function index(Request $request)
    {

        $search = $request->input('search');

        $usuarios = Usuario::query()
        ->orWhere('apellido', 'like', "%{$search}%")
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
        $data = $request->validate([
            'nombre' => ['required', 'string'],
            'apellido' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:usuarios,email'], // Corregido
            'curso' => ['required', 'string'],
        ]);
        $email = trim($request->input('email')); // Elimina espacios en blanco alrededor del email

        // Verificamos si el email no es válido
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Retorna un mensaje de error si el email no es válido
            return back()->withErrors(['email' => 'El formato del email no es válido']);
        }

        $usuario = Usuario::create($data);
        return to_route('usuarios.show', $usuario)->with('success', 'Usuario creado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        $usuario = usuario::with('prestamos')->find($usuario -> id); // Usa el ID del usuario que deseas mostrar
        return view('usuarios.show', compact('usuario'));
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
            'email' => ['required', 'email'],
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
            return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    
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
        $usuarios = Usuario::where('nombre',  'like', "%{$search}%")->limit(5)->get();
    
        return response()->json($usuarios);
    }
}
