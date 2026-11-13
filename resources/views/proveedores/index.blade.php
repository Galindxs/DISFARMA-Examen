@extends('layouts.app')

@section('title', 'Proveedores')
@section('page_title', 'Directorio de proveedores')

@section('content')
    <div class="page-heading">
        <div>
            <h2>Directorio de proveedores y cadena de suministro</h2>
            <p>Control de laboratorios suplidores, condiciones fiscales SAR y límites de crédito.</p>
        </div>
        <a href="{{ route('proveedores.create') }}" class="btn btn-disfarma">
            <i class="bi bi-plus-lg me-1"></i>Registrar proveedor
        </a>
    </div>

    <div class="card table-card">
        <div class="card-header flex-wrap gap-3">
            <div>
                <h5 class="mb-0">Proveedores mayoristas</h5>
                <small>Consulte RTN, asesor comercial, rubro y condiciones de pago.</small>
            </div>
            <form action="{{ route('proveedores.index') }}" method="GET" class="search-form">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="search" name="buscar" value="{{ $buscar }}" class="form-control" placeholder="Buscar por empresa, RTN o asesor...">
                    @if ($buscar !== '')
                        <a href="{{ route('proveedores.index') }}" class="btn btn-outline-secondary" title="Limpiar búsqueda"><i class="bi bi-x-lg"></i></a>
                    @endif
                    <button type="submit" class="btn btn-disfarma">Buscar</button>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Empresa / Laboratorio</th>
                        <th>RTN SAR</th>
                        <th>Contacto</th>
                        <th>Teléfono</th>
                        <th>Categoría</th>
                        <th class="text-end">Límite de crédito</th>
                        <th class="text-center">Plazo de pago</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($proveedores as $proveedor)
                        <tr>
                            <td>
                                <strong>{{ $proveedor->empresa }}</strong>
                                <small class="d-block text-muted">Registro: {{ $proveedor->fecha_registro?->format('d/m/Y') }}</small>
                            </td>
                            <td><span class="code-pill">{{ $proveedor->rtn }}</span></td>
                            <td>{{ $proveedor->contacto }}</td>
                            <td>{{ $proveedor->telefono }}</td>
                            <td>{{ $proveedor->categoria }}</td>
                            <td class="text-end fw-semibold">L. {{ number_format((float) $proveedor->limite_credito, 2, '.', ',') }}</td>
                            <td class="text-center">
                                <span class="badge rounded-pill text-bg-info">{{ $proveedor->dias_credito }} días</span>
                            </td>
                            <td class="text-center">
                                @if ($proveedor->estado === 'Activo')
                                    <span class="badge rounded-pill text-bg-success">Activo</span>
                                @else
                                    <span class="badge rounded-pill text-bg-secondary">Inactivo</span>
                                @endif
                            </td>
                            <td class="text-center text-nowrap">
                                <a href="{{ route('proveedores.edit', $proveedor) }}" class="btn btn-sm btn-outline-primary" title="Editar">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('proveedores.destroy', $proveedor) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Está seguro de eliminar este proveedor?');">
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
                            <td colspan="9" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                No se encontraron proveedores.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($proveedores->hasPages())
            <div class="card-footer bg-white">
                {{ $proveedores->links() }}
            </div>
        @endif
    </div>
@endsection
