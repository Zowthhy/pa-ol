<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestamo;
use App\Models\Herramienta;

class prestamosController extends Controller
{
    /**
     * Muestra todos los prestamos
     */
    public function index(Request $request)
    {


        $prestamos = Prestamo::query()
        -> orderBy('created_at', 'desc')
        -> paginate(15);;
        return view('prestamos.index', ['prestamos' => $prestamos]);
    }

    /**
     * Muestra el formulario para agregar un prestamo
     */
    public function create()
    {
        return view('prestamos.create');
    }
    public function crearSinCB()
    {
        return view('prestamos.crearSinCB');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request -> validate([
            'id_herramienta' => ['required', 'integer', 'min:1'],
            'id_encargado' => ['required', 'integer', 'min:1'],
            'id_usuario' => ['required', 'integer', 'min:1']
        ]);

        $herramienta = Herramienta::find($data['id_herramienta']);
        // Verificar si la herramienta está disponible
        if ($herramienta && $herramienta->disponible == 1) {
            // Cambiar el estado de disponibilidad a 0 (no disponible)
            $herramienta->disponible = 0;
            $herramienta->save();
            $prestamo = Prestamo::create($data);
            return to_route('prestamos.show', $prestamo)->with('success', 'Prestamo creado');
        } else {
            return back()->with('error', 'La herramienta no está disponible.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Prestamo $prestamo)
    {
        return view('prestamos.show', ['prestamo' => $prestamo]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prestamo $prestamo)
    {
        return view('prestamos.edit', ['prestamo' => $prestamo]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prestamo $prestamo)
    {
        $data = $request -> validate([
            'id_herramienta' => ['required', 'integer', 'min:1'],
            'id_encargado' => ['required', 'integer', 'min:1'],
            'id_usuario' =>['required', 'integer', 'min:1']
        ]);

        $prestamo -> update($data);
        return to_route('prestamos.show', $prestamo)->with('success', 'Prestamo actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prestamo $prestamo)
    {
        $prestamo -> delete();
        return to_route('prestamos.index')->with('success','El prestamo fue eliminado');
    }

    public function devolver(Prestamo $prestamo)
    {
        $prestamo->devolucion = now();

        $prestamo->save();

        $herramienta = Herramienta::find($prestamo -> id_herramienta);
        $herramienta->disponible = 1;
        $herramienta->save();

        return to_route('prestamos.index')->with('success','La herramienta fue devuelta');
    }
    public function buscar(Request $request)
    {

        $search = $request->get('search');
        
        $prestamos = Prestamo::query()
        ->whereHas('usuario', function($query) use ($search) {
            $query->where('nombre', 'like', "%{$search}%")
                  ->orWhere('apellido', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(15);
    
        return view('prestamos.index', ['prestamos' => $prestamos]);
    }
}
