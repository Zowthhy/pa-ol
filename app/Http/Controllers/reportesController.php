<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reporte;
class reportesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $reportes = Reporte::query()
        ->orWhere('id_prestamo', 'like', "%{$search}%")
        -> orderBy('created_at', 'desc')
        -> paginate(15);;
        return view('reportes.index', ['reportes' => $reportes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id_prestamo)
    {
        return view('reportes.create', compact('id_prestamo'));
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request -> validate ([
            'id_prestamo' => ['required', 'integer', 'min:1'],
            'descripcion' => ['required', 'string']
        ]);

        $reporte = Reporte::create($data);
        return to_route('reportes.show', $reporte)->with('success', 'reporte creado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reporte $reporte)
    {
        return view('reportes.show', ['reporte' => $reporte]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reporte $reporte)
    {
        return view('reportes.edit', ['reporte' => $reporte]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reporte $reporte)
    {
        $data = $request -> validate([
            'id_prestamo' => ['required', 'integer', 'min:1'],
            'descripcion' => ['required', 'string']
        ]);

        $reporte -> update($data);

        return to_route('reportes.show', $reporte) -> with('success', 'Reporte actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reporte $reporte)
    {
        $id_prestamo = $reporte -> id_prestamo;
        $reporte -> delete();

        return to_route('prestamos.show', $id_prestamo) -> with('success', 'Reporte eliminado');
    }
}
