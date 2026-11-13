@extends('layouts.app')

@section('title', 'Dashboard general')
@section('page_title', 'Dashboard general')

@section('content')
    <div class="page-heading">
        <div>
            <h2>Dashboard gerencial</h2>
            <p>Monitoreo en tiempo real de operaciones — DISFARMA Honduras (Tegucigalpa y San Pedro Sula).</p>
        </div>
        <span class="page-date"><i class="bi bi-calendar-check me-1"></i>{{ now()->translatedFormat('d/m/Y') }}</span>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card stat-card h-100">
                <div class="card-body">
                    <div class="stat-card-top">
                        <span class="stat-icon bg-soft-primary"><i class="bi bi-capsule"></i></span>
                        <span class="stat-label">Medicamentos</span>
                    </div>
                    <div class="stat-value">{{ number_format($totalMedicamentos) }}</div>
                    <p class="stat-caption">SKUs registrados en catálogo</p>
                    <a href="{{ route('medicamentos.index') }}" class="stat-link">Ver catálogo completo <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card stat-card h-100">
                <div class="card-body">
                    <div class="stat-card-top">
                        <span class="stat-icon bg-soft-success"><i class="bi bi-truck"></i></span>
                        <span class="stat-label">Proveedores SAR</span>
                    </div>
                    <div class="stat-value">{{ number_format($proveedoresActivos) }}</div>
                    <p class="stat-caption">Laboratorios activos autorizados</p>
                    <a href="{{ route('proveedores.index') }}" class="stat-link">Ver proveedores <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card stat-card h-100">
                <div class="card-body">
                    <div class="stat-card-top">
                        <span class="stat-icon bg-soft-warning"><i class="bi bi-people"></i></span>
                        <span class="stat-label">Personal en nómina</span>
                    </div>
                    <div class="stat-value">{{ number_format($empleadosActivos) }}</div>
                    <p class="stat-caption">Colaboradores activos</p>
                    <a href="{{ route('empleados.index') }}" class="stat-link">Ver recursos humanos <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card stat-card stat-card-highlight h-100">
                <div class="card-body">
                    <div class="stat-card-top">
                        <span class="stat-icon bg-soft-light"><i class="bi bi-cash-stack"></i></span>
                        <span class="stat-label">Valor de inventario</span>
                    </div>
                    <div class="stat-value">L. {{ number_format((float) $valorInventario, 2, '.', ',') }}</div>
                    <p class="stat-caption">Inventario x precio de venta</p>
                    <span class="stat-link">Moneda oficial de Honduras</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-xl-12">
            <div class="card table-card h-100">
                <div class="card-header">
                    <div>
                        <h5 class="mb-0">Últimos fármacos registrados</h5>
                        <small>Catálogo reciente del inventario farmacéutico</small>
                    </div>
                    <a href="{{ route('medicamentos.index') }}" class="btn btn-sm btn-outline-secondary">Ver todo</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Medicamento</th>
                                <th>Categoría</th>
                                <th>Laboratorio</th>
                                <th class="text-end">Precio</th>
                                <th class="text-center">Existencias</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($ultimosMedicamentos as $medicamento)
                                <tr>
                                    <td><span class="code-pill">{{ $medicamento->codigo }}</span></td>
                                    <td>
                                        <div class="table-product">
                                            @if ($medicamento->imagen)
                                                <img src="{{ asset('uploads/medicamentos/'.$medicamento->imagen) }}" alt="{{ $medicamento->nombre }}" class="med-thumb">
                                            @else
                                                <span class="med-thumb med-thumb-placeholder"><i class="bi bi-capsule"></i></span>
                                            @endif
                                            <span>{{ $medicamento->nombre }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $medicamento->categoria }}</td>
                                    <td>{{ $medicamento->laboratorio }}</td>
                                    <td class="text-end">L. {{ number_format((float) $medicamento->precio, 2, '.', ',') }}</td>
                                    <td class="text-center">
                                        @if ($medicamento->inventario > 20)
                                            <span class="badge rounded-pill text-bg-success">{{ $medicamento->inventario }}</span>
                                        @elseif ($medicamento->inventario >= 10)
                                            <span class="badge rounded-pill text-bg-warning">{{ $medicamento->inventario }}</span>
                                        @else
                                            <span class="badge rounded-pill text-bg-danger">{{ $medicamento->inventario }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">No hay medicamentos registrados.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        
    </div>
@endsection
