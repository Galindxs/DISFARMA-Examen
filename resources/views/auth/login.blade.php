@extends('layouts.guest')

@section('title', 'Iniciar sesión')

@section('content')
    <div class="login-card card">
        <div class="row g-0">
            <div class="col-lg-5 login-brand">
                <div class="login-brand-content">
                    <div class="login-logo">
                        <svg viewBox="0 0 48 48" role="img" aria-label="Logo DISFARMA">
                            <rect x="4" y="4" width="40" height="40" rx="12" fill="currentColor" opacity=".18"/>
                            <path d="M24 12v24M12 24h24" stroke="currentColor" stroke-width="6" stroke-linecap="round"/>
                            <circle cx="24" cy="24" r="5" fill="currentColor"/>
                        </svg>
                    </div>
                    <h1>DISFARMA<br><span>HONDURAS</span></h1>
                    <p>Droguería y Distribuidora Farmacéutica San Rafael S. de R.L.</p>
                    <div class="login-brand-footer">
                        <i class="bi bi-shield-check"></i>
                        <span>Plataforma interna de gestión farmacéutica</span>
                    </div>
                    <br>
                    <div class="login-brand-footer">
                        <small>correo:      admin@disfarma.hn</small>
                        <small>password:    Disfarma2026*</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 login-form-panel">
                <div class="login-form-inner">
                    <div class="mb-4">
                        <span class="login-eyebrow">Acceso al sistema interno</span>
                        <h2>Iniciar sesión</h2>
                        <p class="text-muted mb-0">Ingrese sus credenciales de colaborador.</p>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success py-2" role="alert">
                            <i class="bi bi-check-circle me-1"></i>{{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('login.store') }}" method="POST" novalidate>
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico institucional</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    value="{{ old('email') }}"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="usuario@disfarma.hn"
                                    autocomplete="email"
                                    autofocus
                                    required
                                >
                            </div>
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña de seguridad</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input
                                    type="password"
                                    name="password"
                                    id="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Ingrese su contraseña"
                                    autocomplete="current-password"
                                    required
                                >
                            </div>
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" value="1" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    Recordar mi sesión en este navegador
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-disfarma w-100 py-2">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Ingresar a la plataforma
                        </button>
                    </form>

                    <div class="login-help">
                        <i class="bi bi-info-circle"></i>
                        <span>El acceso está restringido a correos institucionales <strong>@disfarma.hn</strong>.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
