@extends('layouts.app')

@section('title', 'Nuevo proveedor')
@section('page_title', 'Registrar proveedor')

@section('content')
    <div class="page-heading">
        <div>
            <h2>Nuevo proveedor</h2>
            <p>Registre un laboratorio o suplidor mayorista en el directorio.</p>
        </div>
        <a href="{{ route('proveedores.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Volver al directorio
        </a>
    </div>

    <div class="card form-card">
        <div class="card-body">
            <form action="{{ route('proveedores.store') }}" method="POST">
                @csrf
                @include('proveedores._form')
            </form>
        </div>
    </div>
@endsection
