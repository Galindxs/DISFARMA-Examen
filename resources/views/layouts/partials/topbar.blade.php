<header class="topbar">
    <div class="topbar-left">
        <button class="btn topbar-toggle d-lg-none" type="button" id="sidebarToggle" aria-label="Abrir menú">
            <i class="bi bi-list"></i>
        </button>
        <div>
            <span class="topbar-eyebrow">DISFARMA Honduras</span>
            <h1 class="topbar-title">@yield('page_title', 'Panel de Gestión')</h1>
        </div>
    </div>

    <div class="topbar-right">
        <div class="topbar-date d-none d-md-flex">
            <i class="bi bi-calendar3"></i>
            <span>{{ now()->translatedFormat('d/m/Y') }}</span>
        </div>

        <div class="topbar-user">
            <div class="topbar-avatar">
                {{ strtoupper(substr(auth()->user()->name ?? 'D', 0, 1)) }}
            </div>
            <div class="topbar-user-text d-none d-sm-block">
                <strong>{{ auth()->user()->name ?? 'Usuario DISFARMA' }}</strong>
                <small>{{ auth()->user()->email ?? '' }}</small>
            </div>
        </div>

        <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-outline-danger btn-sm topbar-logout" title="Cerrar sesión">
                <i class="bi bi-box-arrow-right"></i>
                <span class="d-none d-sm-inline">Cerrar sesión</span>
            </button>
        </form>
    </div>
</header>
