@php
    $editando = isset($medicamento);
    $fechaVencimiento = old('fecha_vencimiento', $editando && $medicamento->fecha_vencimiento ? $medicamento->fecha_vencimiento->format('Y-m-d') : '');
@endphp

<div class="row g-4">
    <div class="col-md-4">
        <label for="codigo" class="form-label">Código SKU <span class="text-danger">*</span></label>
        <input
            type="text"
            name="codigo"
            id="codigo"
            value="{{ old('codigo', $editando ? $medicamento->codigo : '') }}"
            class="form-control @error('codigo') is-invalid @enderror"
            placeholder="Ej. MED-001"
            required
        >
        @error('codigo')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-8">
        <label for="nombre" class="form-label">Nombre del medicamento <span class="text-danger">*</span></label>
        <input
            type="text"
            name="nombre"
            id="nombre"
            value="{{ old('nombre', $editando ? $medicamento->nombre : '') }}"
            class="form-control @error('nombre') is-invalid @enderror"
            placeholder="Ej. Amoxicilina 500 mg"
            required
        >
        @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label for="categoria" class="form-label">Categoría <span class="text-danger">*</span></label>
        <select name="categoria" id="categoria" class="form-select @error('categoria') is-invalid @enderror" required>
            <option value="">Seleccione una categoría</option>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria }}" @selected(old('categoria', $editando ? $medicamento->categoria : '') === $categoria)>{{ $categoria }}</option>
            @endforeach
        </select>
        @error('categoria')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label for="laboratorio" class="form-label">Laboratorio <span class="text-danger">*</span></label>
        <input
            type="text"
            name="laboratorio"
            id="laboratorio"
            value="{{ old('laboratorio', $editando ? $medicamento->laboratorio : '') }}"
            class="form-control @error('laboratorio') is-invalid @enderror"
            placeholder="Laboratorio fabricante o proveedor"
            required
        >
        @error('laboratorio')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-3">
        <label for="precio" class="form-label">Precio de venta (L.) <span class="text-danger">*</span></label>
        <input
            type="number"
            name="precio"
            id="precio"
            value="{{ old('precio', $editando ? $medicamento->precio : '') }}"
            class="form-control @error('precio') is-invalid @enderror"
            min="0.01"
            step="0.01"
            placeholder="0.00"
            required
        >
        @error('precio')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-3">
        <label for="costo" class="form-label">Costo (L.) <span class="text-danger">*</span></label>
        <input
            type="number"
            name="costo"
            id="costo"
            value="{{ old('costo', $editando ? $medicamento->costo : '') }}"
            class="form-control @error('costo') is-invalid @enderror"
            min="0"
            step="0.01"
            placeholder="0.00"
            required
        >
        @error('costo')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-3">
        <label for="inventario" class="form-label">Inventario <span class="text-danger">*</span></label>
        <input
            type="number"
            name="inventario"
            id="inventario"
            value="{{ old('inventario', $editando ? $medicamento->inventario : '') }}"
            class="form-control @error('inventario') is-invalid @enderror"
            min="0"
            step="1"
            placeholder="0"
            required
        >
        @error('inventario')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-3">
        <label for="numero_lote" class="form-label">Número de lote <span class="text-danger">*</span></label>
        <input
            type="text"
            name="numero_lote"
            id="numero_lote"
            value="{{ old('numero_lote', $editando ? $medicamento->numero_lote : '') }}"
            class="form-control @error('numero_lote') is-invalid @enderror"
            placeholder="Ej. LOT-AMX-2026"
            required
        >
        @error('numero_lote')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-4">
        <label for="fecha_vencimiento" class="form-label">Fecha de vencimiento <span class="text-danger">*</span></label>
        <input
            type="date"
            name="fecha_vencimiento"
            id="fecha_vencimiento"
            value="{{ $fechaVencimiento }}"
            class="form-control @error('fecha_vencimiento') is-invalid @enderror"
            required
        >
        @error('fecha_vencimiento')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-8">
        <label for="imagen" class="form-label">Fotografía del empaque</label>
        <input
            type="file"
            name="imagen"
            id="imagen"
            class="form-control @error('imagen') is-invalid @enderror"
            accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
        >
        <div class="form-text">Formatos permitidos: JPG, PNG o WEBP. Tamaño máximo: 5 MB.</div>
        @error('imagen')<div class="invalid-feedback">{{ $message }}</div>@enderror

        @if ($editando && $medicamento->imagen)
            <div class="current-image">
                <img src="{{ asset('uploads/medicamentos/'.$medicamento->imagen) }}" alt="{{ $medicamento->nombre }}">
                <span>Imagen actual. Si selecciona otra, será reemplazada.</span>
            </div>
        @endif
    </div>
</div>

<div class="form-actions">
    <a href="{{ route('medicamentos.index') }}" class="btn btn-outline-secondary">Cancelar</a>
    <button type="submit" class="btn btn-disfarma">
        <i class="bi bi-save me-1"></i>{{ $editando ? 'Actualizar medicamento' : 'Guardar medicamento' }}
    </button>
</div>
