<?php

namespace App\Http\Controllers;

use App\Models\medicamento;
use Illuminate\Http\Request;

class MedicamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medicamentos = medicamento::latest()->paginate(10);
        return view('medicamentos.index', compact('medicamentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('medicamentos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $request->validate([
            'sku'               => 'unique',
            'nombre'            => 'required|max:255',
            'categoria'         => 'required|string',
            'precio'            => 'required|numeric|min:1',
            'costo'             => 'required|integer|min:0',
            'inventario'        => 'numeric',
            'imagen'            => 'nullable',
            'laboratorio'       => 'string',
            'fecha_vencimiento' => 'date',
            'fecha_registro'    => 'date',
            'numero_lote'       => 'numeric',
        ]);

        medicamento::create($request->all());

        return redirect()->route('medicamentos.index')
                         ->with('success', '¡Medicamento registrado exitosamente en el inventario!');
    }

    /**
     * Display the specified resource.
     */
    public function show(medicamento $medicamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(medicamento $medicamento)
    {
        return view('medicamentos.edit', compact('medicamento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, medicamento $medicamento)
    {
         $request->validate([
            'sku'               => '',
            'nombre'            => 'required|max:255',
            'categoria'         => 'required|string',
            'precio'            => 'required|numeric|min:1',
            'costo'             => 'required|integer|min:0',
            'inventario'        => 'numeric',
            'imagen'            => 'nullable',
            'laboratorio'       => 'string',
            'fecha_vencimiento' => 'date',
            'fecha_registro'    => 'date',
            'numero_lote'       => 'numeric',
        ]);

        $medicamento->update($request->all());

        return redirect()->route('medicamentos.index')
                         ->with('success', '¡Medicamento actualizado exitosamente en el inventario!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(medicamento $medicamento)
    {
        $medicamento->delete();

        return redirect()->route('medicamentos.index')
                         ->with('success', '¡Producto eliminado del inventario!');
    }
}
