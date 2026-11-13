<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Medicamento;
use App\Models\Proveedor;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMedicamentos = Medicamento::count();
        $proveedoresActivos = Proveedor::where('estado', 'Activo')->count();
        $empleadosActivos = Empleado::where('estado', 'Activo')->count();

        $valorInventario = Medicamento::query()
            ->selectRaw('COALESCE(SUM(inventario * precio), 0) as total')
            ->value('total');

        $medicamentosCriticos = Medicamento::where('inventario', '<', 10)
            ->orderBy('inventario')
            ->take(5)
            ->get();

        $ultimosMedicamentos = Medicamento::latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalMedicamentos',
            'proveedoresActivos',
            'empleadosActivos',
            'valorInventario',
            'medicamentosCriticos',
            'ultimosMedicamentos',
        ));
    }
}
