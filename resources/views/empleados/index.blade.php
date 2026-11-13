@extends('layouts.app')

@section('title', 'Personal y nómina')
@section('page_title', 'Recursos humanos')

@section('content')
    <div class="page-heading">
        <div>
            <h2>Plantilla de personal y regentes farmacéuticos</h2>
            <p>Control del talento humano, cargos y salarios del personal de DISFARMA Honduras.</p>
        </div>
        <a href="{{ route('empleados.create') }}" class="btn btn-disfarma">
            <i class="bi bi-plus-lg me-1"></i>Registrar empleado
        </a>
    </div>

    <div class="card table-card">
        <div class="card-header flex-wrap gap-3">
            <div>
                <h5 class="mb-0">Nómina de colaboradores</h5>
                <small>Consulte identidad, cargo, salario y fecha de ingreso.</small>
            </div>
            <form action="{{ route('empleados.index') }}" method="GET" class="search-form">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="search" name="buscar" value="{{ $buscar }}" class="form-control" placeholder="Buscar por nombre, apellido o identidad...">
                    @if ($buscar !== '')
                        <a href="{{ route('empleados.index') }}" class="btn btn-outline-secondary" title="Limpiar búsqueda"><i class="bi bi-x-lg"></i></a>
                    @endif
                    <button type="submit" class="btn btn-disfarma">Buscar</button>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Colaborador</th>
                        <th>Identidad</th>
                        <th>Correo</th>
                        <th>Cargo</th>
                        <th class="text-end">Salario</th>
                        <th>Fecha de ingreso</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($empleados as $empleado)
                        @php
                            $badgeCargo = match ($empleado->cargo) {
                                'Regente Farmacéutico' => 'text-bg-primary',
                                'Asistente de Farmacia' => 'text-bg-info',
                                'Jefe de Bodega' => 'text-bg-warning',
                                'Despachador' => 'text-bg-secondary',
                                'Cajero' => 'text-bg-dark',
                                default => 'text-bg-light',
                            };
                        @endphp
                        <tr>
                            <td>
                                <div class="employee-cell">
                                    <span class="employee-avatar">{{ strtoupper(substr($empleado->nombre, 0, 1).substr($empleado->apellido, 0, 1)) }}</span>
                                    <div>
                                        <strong>{{ $empleado->nombre }} {{ $empleado->apellido }}</strong>
                                        <small>Ingreso: {{ $empleado->fecha_ingreso?->format('d/m/Y') }}</small>
                                    </div>
                                </div>
                            </td>
                            <td><span class="code-pill">{{ $empleado->identidad }}</span></td>
                            <td>{{ $empleado->correo }}</td>
                            <td><span class="badge rounded-pill {{ $badgeCargo }}">{{ $empleado->cargo }}</span></td>
                            <td class="text-end fw-semibold">L. {{ number_format((float) $empleado->salario, 2, '.', ',') }}</td>
                            <td>{{ $empleado->fecha_ingreso?->format('d/m/Y') }}</td>
                            <td class="text-center">
                                @if ($empleado->estado === 'Activo')
                                    <span class="badge rounded-pill text-bg-success">Activo</span>
                                @else
                                    <span class="badge rounded-pill text-bg-secondary">Inactivo</span>
                                @endif
                            </td>
                            <td class="text-center text-nowrap">
                                <a href="{{ route('empleados.edit', $empleado) }}" class="btn btn-sm btn-outline-primary" title="Editar">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('empleados.destroy', $empleado) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Está seguro de eliminar este empleado?');">
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
                                No se encontraron empleados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($empleados->hasPages())
            <div class="card-footer bg-white">
                {{ $empleados->links() }}
            </div>
        @endif
    </div>
@endsection
