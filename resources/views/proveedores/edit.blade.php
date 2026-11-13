@extends('layouts.app')

@section('title', 'Editar proveedor')
@section('page_title', 'Editar proveedor')

@section('content')
    <div class="page-heading">
        <div>
            <h2>Editar proveedor</h2>
            <p>Actualice la información de <strong>{{ $proveedor->empresa }}</strong>.</p>
        </div>
        <a href="{{ route('proveedores.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Volver al directorio
        </a>
    </div>

    <div class="card form-card">
        <div class="card-body">
            <form action="{{ route('proveedores.update', $proveedor) }}" method="POST">
                @csrf
                @method('PUT')
                @include('proveedores._form')
            </form>
        </div>
    </div>
@endsection
