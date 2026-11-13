@php
    $editando = isset($empleado);
    $fechaIngreso = old('fecha_ingreso', $editando && $empleado->fecha_ingreso ? $empleado->fecha_ingreso->format('Y-m-d') : '');
@endphp

<div class="row g-4">
    <div class="col-md-5">
        <label for="identidad" class="form-label">Identidad / DNI (13 dígitos) <span class="text-danger">*</span></label>
        <input
            type="text"
            name="identidad"
            id="identidad"
            value="{{ old('identidad', $editando ? $empleado->identidad : '') }}"
            class="form-control @error('identidad') is-invalid @enderror"
            placeholder="0801199012345"
            inputmode="numeric"
            maxlength="13"
            pattern="[0-9]{13}"
            required
        >
        <div class="form-text">Ingrese exactamente 13 dígitos, sin guiones.</div>
        @error('identidad')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-7">
        <label for="correo" class="form-label">Correo electrónico <span class="text-danger">*</span></label>
        <input
            type="email"
            name="correo"
            id="correo"
            value="{{ old('correo', $editando ? $empleado->correo : '') }}"
            class="form-control @error('correo') is-invalid @enderror"
            placeholder="colaborador@disfarma.hn"
            required
        >
        @error('correo')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label for="nombre" class="form-label">Nombre <span class="text-danger">*</span></label>
        <input
            type="text"
            name="nombre"
            id="nombre"
            value="{{ old('nombre', $editando ? $empleado->nombre : '') }}"
            class="form-control @error('nombre') is-invalid @enderror"
            placeholder="Nombre del colaborador"
            required
        >
        @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label for="apellido" class="form-label">Apellido <span class="text-danger">*</span></label>
        <input
            type="text"
            name="apellido"
            id="apellido"
            value="{{ old('apellido', $editando ? $empleado->apellido : '') }}"
            class="form-control @error('apellido') is-invalid @enderror"
            placeholder="Apellido del colaborador"
            required
        >
        @error('apellido')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-4">
        <label for="cargo" class="form-label">Cargo <span class="text-danger">*</span></label>
        <select name="cargo" id="cargo" class="form-select @error('cargo') is-invalid @enderror" required>
            <option value="">Seleccione un cargo</option>
            @foreach ($cargos as $cargo)
                <option value="{{ $cargo }}" @selected(old('cargo', $editando ? $empleado->cargo : '') === $cargo)>{{ $cargo }}</option>
            @endforeach
        </select>
        @error('cargo')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-4">
        <label for="salario" class="form-label">Salario mensual (L.) <span class="text-danger">*</span></label>
        <input
            type="number"
            name="salario"
            id="salario"
            value="{{ old('salario', $editando ? $empleado->salario : '') }}"
            class="form-control @error('salario') is-invalid @enderror"
            min="0.01"
            step="0.01"
            placeholder="0.00"
            required
        >
        @error('salario')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-4">
        <label for="fecha_ingreso" class="form-label">Fecha de ingreso <span class="text-danger">*</span></label>
        <input
            type="date"
            name="fecha_ingreso"
            id="fecha_ingreso"
            value="{{ $fechaIngreso }}"
            class="form-control @error('fecha_ingreso') is-invalid @enderror"
            required
        >
        @error('fecha_ingreso')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-4">
        <label for="estado" class="form-label">Estado <span class="text-danger">*</span></label>
        <select name="estado" id="estado" class="form-select @error('estado') is-invalid @enderror" required>
            @foreach ($estados as $estado)
                <option value="{{ $estado }}" @selected(old('estado', $editando ? $empleado->estado : 'Activo') === $estado)>{{ $estado }}</option>
            @endforeach
        </select>
        @error('estado')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>

<div class="form-actions">
    <a href="{{ route('empleados.index') }}" class="btn btn-outline-secondary">Cancelar</a>
    <button type="submit" class="btn btn-disfarma">
        <i class="bi bi-save me-1"></i>{{ $editando ? 'Actualizar empleado' : 'Guardar empleado' }}
    </button>
</div>
