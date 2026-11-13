@extends('layouts.app')

@section('title', 'Editar empleado')
@section('page_title', 'Editar empleado')

@section('content')
    <div class="page-heading">
        <div>
            <h2>Editar empleado</h2>
            <p>Actualice la información de <strong>{{ $empleado->nombre }} {{ $empleado->apellido }}</strong>.</p>
        </div>
        <a href="{{ route('empleados.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Volver a la nómina
        </a>
    </div>

    <div class="card form-card">
        <div class="card-body">
            <form action="{{ route('empleados.update', $empleado) }}" method="POST">
                @csrf
                @method('PUT')
                @include('empleados._form')
            </form>
        </div>
    </div>
@endsection
