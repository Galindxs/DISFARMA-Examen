@extends('layouts.app')

@section('title', 'Nuevo medicamento')
@section('page_title', 'Registrar medicamento')

@section('content')
    <div class="page-heading">
        <div>
            <h2>Nuevo medicamento</h2>
            <p>Registre un nuevo SKU en el catálogo e inventario farmacéutico.</p>
        </div>
        <a href="{{ route('medicamentos.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Volver al catálogo
        </a>
    </div>

    <div class="card form-card">
        <div class="card-body">
            <form action="{{ route('medicamentos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('medicamentos._form')
            </form>
        </div>
    </div>
@endsection
