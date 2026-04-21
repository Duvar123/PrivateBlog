@php
    $navActive = $navActive ?? '';
@endphp
<aside class="adm-sidebar">
    <div class="adm-sidebar-top">
        <a href="{{ route('dashboard') }}" class="adm-sidebar-brand">
            <img src="{{ asset('images/logo-sidebar.png') }}" alt="Super Market" class="adm-sidebar-brand-logo">
        </a>
        <p class="adm-sidebar-section-label">Usuarios</p>
        <nav class="adm-nav" aria-label="Sección usuarios">
            <a href="{{ route('dashboard') }}"
               class="adm-nav-item {{ $navActive === 'users' ? 'is-active' : '' }}">
                Ver lista de usuarios
            </a>
        </nav>
        <p class="adm-sidebar-section-label adm-sidebar-section-label--spaced">Catálogo</p>
        <nav class="adm-nav" aria-label="Sección catálogo">
            <a href="{{ route('categorias.index') }}"
               class="adm-nav-item {{ $navActive === 'categorias' ? 'is-active' : '' }}">
                Categorías
            </a>
            <a href="{{ route('productos.index') }}"
               class="adm-nav-item {{ $navActive === 'productos' ? 'is-active' : '' }}">
                Productos
            </a>
        </nav>
    </div>

    <div class="adm-sidebar-foot">
        <div class="adm-sidebar-user">
            <div class="adm-avatar" aria-hidden="true">
                @if(auth()->user()->avatar)
                    <img src="{{ asset('storage/'.auth()->user()->avatar) }}" alt="" width="32" height="32" style="border-radius:999px;object-fit:cover;display:block;">
                @else
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
                    </svg>
                @endif
            </div>
            <span class="adm-sidebar-user-name">{{ auth()->user()->name }}</span>
        </div>
        <form method="POST" action="{{ route('logout') }}" class="adm-sidebar-logout-form">
            @csrf
            <button type="submit" class="adm-btn-logout adm-btn-logout--block">Salir</button>
        </form>
    </div>
</aside>
