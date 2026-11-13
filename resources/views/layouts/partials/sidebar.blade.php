<aside class="sidebar" id="sidebar">
    <a href="{{ route('dashboard') }}" class="sidebar-brand">
        <span class="sidebar-brand-icon">
            <svg viewBox="0 0 48 48" role="img" aria-label="Logo DISFARMA">
                <rect x="4" y="4" width="40" height="40" rx="12" fill="currentColor" opacity=".18"/>
                <path d="M24 12v24M12 24h24" stroke="currentColor" stroke-width="6" stroke-linecap="round"/>
                <circle cx="24" cy="24" r="5" fill="currentColor"/>
            </svg>
        </span>
        <span class="sidebar-brand-text">
            <strong>DISFARMA</strong>
            <small>HONDURAS</small>
        </span>
    </a>

    <div class="sidebar-divider"></div>

    <div class="sidebar-heading">Gestión general</div>

    <nav class="nav flex-column sidebar-nav">
        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
            <i class="bi bi-speedometer2"></i>
            <span>Dashboard general</span>
        </a>
    </nav>

    <div class="sidebar-heading">Módulos del negocio</div>

    <nav class="nav flex-column sidebar-nav">
        <a class="nav-link {{ request()->routeIs('medicamentos.*') ? 'active' : '' }}" href="{{ route('medicamentos.index') }}">
            <i class="bi bi-capsule"></i>
            <span>Medicamentos</span>
        </a>
        <a class="nav-link {{ request()->routeIs('proveedores.*') ? 'active' : '' }}" href="{{ route('proveedores.index') }}">
            <i class="bi bi-truck"></i>
            <span>Proveedores SAR</span>
        </a>
        <a class="nav-link {{ request()->routeIs('empleados.*') ? 'active' : '' }}" href="{{ route('empleados.index') }}">
            <i class="bi bi-people"></i>
            <span>Personal y nómina</span>
        </a>
    </nav>

    <div class="sidebar-heading">Seguridad</div>

    <div class="sidebar-user">
        <div class="sidebar-user-avatar">
            {{ strtoupper(substr(auth()->user()->name ?? 'D', 0, 1)) }}
        </div>
        <div class="sidebar-user-info">
            <small>Sesión iniciada como:</small>
            <strong>{{ auth()->user()->name ?? 'Usuario DISFARMA' }}</strong>
            <span><i class="bi bi-circle-fill"></i> En línea</span>
        </div>
    </div>

    <div class="sidebar-footer">
        <span>Droguería y Distribuidora Farmacéutica San Rafael S. de R.L.</span>
    </div>
</aside>
