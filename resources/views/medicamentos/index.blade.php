@extends('layouts.app')

@section('title', 'Medicamentos')
@section('page_title', 'Catálogo de medicamentos')

@section('content')
    <div class="page-heading">
        <div>
            <h2>Catálogo e inventario farmacéutico</h2>
            <p>Control de medicamentos genéricos, de marca e insumos médico-quirúrgicos.</p>
        </div>
        <a href="{{ route('medicamentos.create') }}" class="btn btn-disfarma">
            <i class="bi bi-plus-lg me-1"></i>Nuevo medicamento
        </a>
    </div>

    <div class="card table-card">
        <div class="card-header flex-wrap gap-3">
            <div>
                <h5 class="mb-0">Medicamentos registrados</h5>
                <small>Consulte existencias, precios y fechas de vencimiento.</small>
            </div>
            <form action="{{ route('medicamentos.index') }}" method="GET" class="search-form">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="search" name="buscar" value="{{ $buscar }}" class="form-control" placeholder="Buscar por nombre o SKU...">
                    @if ($buscar !== '')
                        <a href="{{ route('medicamentos.index') }}" class="btn btn-outline-secondary" title="Limpiar búsqueda"><i class="bi bi-x-lg"></i></a>
                    @endif
                    <button type="submit" class="btn btn-disfarma">Buscar</button>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Medicamento</th>
                        <th>SKU</th>
                        <th>Categoría</th>
                        <th>Laboratorio</th>
                        <th class="text-end">Precio</th>
                        <th class="text-center">Inventario</th>
                        <th>Vencimiento</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($medicamentos as $medicamento)
                        <tr>
                            <td>
                                <div class="table-product">
                                    @if ($medicamento->imagen)
                                        <img src="{{ asset('uploads/medicamentos/'.$medicamento->imagen) }}" alt="{{ $medicamento->nombre }}" class="med-thumb">
                                    @else
                                        <span class="med-thumb med-thumb-placeholder"><i class="bi bi-capsule"></i></span>
                                    @endif
                                    <div>
                                        <strong>{{ $medicamento->nombre }}</strong>
                                        <small>Lote: {{ $medicamento->numero_lote }}</small>
                                    </div>
                                </div>
                            </td>
                            <td><span class="code-pill">{{ $medicamento->codigo }}</span></td>
                            <td>{{ $medicamento->categoria }}</td>
                            <td>{{ $medicamento->laboratorio }}</td>
                            <td class="text-end fw-semibold">L. {{ number_format((float) $medicamento->precio, 2, '.', ',') }}</td>
                            <td class="text-center">
                                @if ($medicamento->inventario > 20)
                                    <span class="badge rounded-pill text-bg-success">Óptimo · {{ $medicamento->inventario }}</span>
                                @elseif ($medicamento->inventario >= 10)
                                    <span class="badge rounded-pill text-bg-warning">Moderado · {{ $medicamento->inventario }}</span>
                                @else
                                    <span class="badge rounded-pill text-bg-danger">¡Desabastecimiento! · {{ $medicamento->inventario }}</span>
                                @endif
                            </td>
                            <td>{{ $medicamento->fecha_vencimiento?->format('d/m/Y') }}</td>
                            <td class="text-center text-nowrap">
                                <a href="{{ route('medicamentos.edit', $medicamento) }}" class="btn btn-sm btn-outline-primary" title="Editar">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('medicamentos.destroy', $medicamento) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Está seguro de eliminar este medicamento?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                No se encontraron medicamentos.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($medicamentos->hasPages())
            <div class="card-footer bg-white">
                {{ $medicamentos->links() }}
            </div>
        @endif
    </div>
@endsection
