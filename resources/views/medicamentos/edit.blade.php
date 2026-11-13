@extends('layouts.app')

@section('title', 'Editar medicamento')
@section('page_title', 'Editar medicamento')

@section('content')
    <div class="page-heading">
        <div>
            <h2>Editar medicamento</h2>
            <p>Actualice la información de <strong>{{ $medicamento->nombre }}</strong>.</p>
        </div>
        <a href="{{ route('medicamentos.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Volver al catálogo
        </a>
    </div>

    <div class="card form-card">
        <div class="card-body">
            <form action="{{ route('medicamentos.update', $medicamento) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('medicamentos._form')
            </form>
        </div>
    </div>
@endsection
