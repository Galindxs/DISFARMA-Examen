@php
    $editando = isset($proveedor);
@endphp

<div class="row g-4">
    <div class="col-md-5">
        <label for="rtn" class="form-label">RTN SAR (14 dígitos) <span class="text-danger">*</span></label>
        <input
            type="text"
            name="rtn"
            id="rtn"
            value="{{ old('rtn', $editando ? $proveedor->rtn : '') }}"
            class="form-control @error('rtn') is-invalid @enderror"
            placeholder="08011985123456"
            inputmode="numeric"
            maxlength="14"
            pattern="[0-9]{14}"
            required
        >
        <div class="form-text">Ingrese exactamente 14 dígitos, sin guiones.</div>
        @error('rtn')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-7">
        <label for="empresa" class="form-label">Empresa / Laboratorio <span class="text-danger">*</span></label>
        <input
            type="text"
            name="empresa"
            id="empresa"
            value="{{ old('empresa', $editando ? $proveedor->empresa : '') }}"
            class="form-control @error('empresa') is-invalid @enderror"
            placeholder="Razón social del laboratorio o suplidor"
            required
        >
        @error('empresa')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label for="contacto" class="form-label">Contacto / Asesor comercial <span class="text-danger">*</span></label>
        <input
            type="text"
            name="contacto"
            id="contacto"
            value="{{ old('contacto', $editando ? $proveedor->contacto : '') }}"
            class="form-control @error('contacto') is-invalid @enderror"
            placeholder="Nombre del asesor comercial"
            required
        >
        @error('contacto')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label for="telefono" class="form-label">Teléfono (8 dígitos) <span class="text-danger">*</span></label>
        <input
            type="text"
            name="telefono"
            id="telefono"
            value="{{ old('telefono', $editando ? $proveedor->telefono : '') }}"
            class="form-control @error('telefono') is-invalid @enderror"
            placeholder="22394500"
            inputmode="numeric"
            maxlength="8"
            pattern="[2389][0-9]{7}"
            required
        >
        <div class="form-text">Debe iniciar con 2, 3, 8 o 9.</div>
        @error('telefono')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-4">
        <label for="categoria" class="form-label">Rubro / Categoría <span class="text-danger">*</span></label>
        <select name="categoria" id="categoria" class="form-select @error('categoria') is-invalid @enderror" required>
            <option value="">Seleccione una categoría</option>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria }}" @selected(old('categoria', $editando ? $proveedor->categoria : '') === $categoria)>{{ $categoria }}</option>
            @endforeach
        </select>
        @error('categoria')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-4">
        <label for="limite_credito" class="form-label">Límite de crédito (L.) <span class="text-danger">*</span></label>
        <input
            type="number"
            name="limite_credito"
            id="limite_credito"
            value="{{ old('limite_credito', $editando ? $proveedor->limite_credito : '') }}"
            class="form-control @error('limite_credito') is-invalid @enderror"
            min="0"
            step="0.01"
            placeholder="0.00"
            required
        >
        @error('limite_credito')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-4">
        <label for="dias_credito" class="form-label">Plazo de pago <span class="text-danger">*</span></label>
        <select name="dias_credito" id="dias_credito" class="form-select @error('dias_credito') is-invalid @enderror" required>
            <option value="">Seleccione el plazo</option>
            @foreach ($diasCredito as $dia)
                <option value="{{ $dia }}" @selected((string) old('dias_credito', $editando ? $proveedor->dias_credito : '') === (string) $dia)>{{ $dia }} días</option>
            @endforeach
        </select>
        @error('dias_credito')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-4">
        <label for="estado" class="form-label">Estado <span class="text-danger">*</span></label>
        <select name="estado" id="estado" class="form-select @error('estado') is-invalid @enderror" required>
            @foreach ($estados as $estado)
                <option value="{{ $estado }}" @selected(old('estado', $editando ? $proveedor->estado : 'Activo') === $estado)>{{ $estado }}</option>
            @endforeach
        </select>
        @error('estado')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>

<div class="form-actions">
    <a href="{{ route('proveedores.index') }}" class="btn btn-outline-secondary">Cancelar</a>
    <button type="submit" class="btn btn-disfarma">
        <i class="bi bi-save me-1"></i>{{ $editando ? 'Actualizar proveedor' : 'Guardar proveedor' }}
    </button>
</div>
