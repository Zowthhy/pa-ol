<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Herramienta;
use Illuminate\Database\QueryException;
use App\Rules\CodigoBarrasUnico;
class herramientasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $search = $request->input('search');

        $herramientas = Herramienta::query()
            ->orWhere('estado', 'like', "%{$search}%")
            ->orWhere('codigo_barras', 'like', "%{$search}%")
            ->paginate(10);

        return view('herramientas.index', compact('herramientas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('herramientas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'estado' => ['required', 'string'],
            'disponible' => 'boolean',
            'tipo_herramienta' => ['required', 'string'],
            'codigo_barras' => [
                'string',
                'nullable',
                new CodigoBarrasUnico,  // Se usa la regla personalizada aquí
            ],
        ]);
    
        // Si no se provee un código de barras, asigna '0'
        $data['codigo_barras'] = $data['codigo_barras'] ?? '0';
    
        // Establecer disponible como verdadero o falso dependiendo de si se envió
        $data['disponible'] = $request->has('disponible');
    
        // Crear el registro en la base de datos
        $herramienta = Herramienta::create($data); 
    
        // Redirigir al usuario al detalle de la herramienta creada
        return to_route('herramientas.show', $herramienta)->with('success', 'Herramienta creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Herramienta $herramienta)
    {
       return view('herramientas.show', ["herramienta" => $herramienta]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Herramienta $herramienta)
    {
        return view('herramientas.edit', ["herramienta" => $herramienta]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Herramienta $herramienta)
    {
        $data = $request -> validate([
            'estado' => ['required', 'string'],
            'disponible' => 'boolean',
            'tipo_herramienta' => ['required', 'string'],
            'codigo_barras' => ['string', 'nullable']
        ]);

        $data['codigo_barras'] = $data['codigo_barras'] ?? '0';
        
        $data['disponible'] = $request->has('disponible');

        $herramienta->update($data);
        return to_route('herramientas.show', $herramienta)->with('success', 'Herramienta actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Herramienta $herramienta)
    {

        try {
            // Intentar eliminar la herramienta
            $herramienta->delete();
    
            // Redirigir con mensaje de éxito
            return redirect()->route('herramientas.index')->with('success', 'Herramienta eliminada correctamente.');
    
        } catch (QueryException $e) {
            // Si ocurre una violación de clave foránea (error 1451)
            if ($e->getCode() == 23000) {
                // Redirigir con un mensaje de error amigable
                return redirect()->route('herramientas.index')->with('error', 'No se puede eliminar la herramienta porque está asociada a un préstamo.');
            }
    
            // Si es otro error, puedes manejarlo de manera diferente o volver a lanzarlo
            throw $e;
        }
    }

    public function buscar(Request $request)
    {
        $search = $request->get('search');
        $herramientas = Herramienta::where('codigo_barras', 'like', "%{$search}%")->limit(10)->get();
    
        return response()->json($herramientas);
    }

}
