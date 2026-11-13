@extends('layouts.app')

@section('title', 'Nuevo empleado')
@section('page_title', 'Registrar empleado')

@section('content')
    <div class="page-heading">
        <div>
            <h2>Nuevo empleado</h2>
            <p>Registre un colaborador en la plantilla de personal de DISFARMA.</p>
        </div>
        <a href="{{ route('empleados.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Volver a la nómina
        </a>
    </div>

    <div class="card form-card">
        <div class="card-body">
            <form action="{{ route('empleados.store') }}" method="POST">
                @csrf
                @include('empleados._form')
            </form>
        </div>
    </div>
@endsection
