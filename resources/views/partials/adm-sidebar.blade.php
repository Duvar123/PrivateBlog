@php
    $navActive = $navActive ?? '';
@endphp
<aside class="adm-sidebar">
    <header class="adm-sidebar-header">
        <a href="{{ route('dashboard') }}" class="adm-sidebar-brand">Moka Market</a>
    </header>

    <div class="adm-sidebar-user-card">
        <img src="https://images.unsplash.com/photo-1734122415415-88cb1d7d5dc0?q=80&w=320&h=320&auto=format&fit=facearea&facepad=3&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Avatar" class="adm-sidebar-avatar">
        
        <div>
            <p class="adm-sidebar-user-name">{{auth() -> user() -> name ?? 'Sin usuario '}}</p>
            <p class="adm-sidebar-user-role">{{ auth() -> user() -> rol ?? "sin rol"}}</p>
        </div>
    </div>

    <nav class="adm-sidebar-nav" aria-label="Main navigation">
        <ul class="adm-sidebar-menu">
            <li class="adm-sidebar-item">
                <a href="{{ route('paginaprincipal') }}" class="adm-sidebar-link {{ in_array($navActive, ['dashboard', 'users']) ? 'is-active' : '' }}">
                    <span class="adm-sidebar-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9.5L12 4l9 5.5v9.5a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1V9.5z"/></svg>
                    </span>
                    Dashboard
                </a>
            </li>
            <li class="adm-sidebar-item">
                <a href="{{ route('dashboard') }}" class="adm-sidebar-link {{ $navActive === 'users' ? 'is-active' : '' }}">
                    <span class="adm-sidebar-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </span>
                    Users
                </a>
            </li>
            <li class="adm-sidebar-item">
                <a href="{{ route('roles.index') }}" class="adm-sidebar-link {{ $navActive === 'users' ? 'is-active' : '' }}">
                    <span class="adm-sidebar-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </span>
                    Roles
                </a>
            </li>
            <li class="adm-sidebar-group">
                <details open>
                    <summary class="adm-sidebar-link summary-link">
                        <span class="adm-sidebar-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M3 12h18"/><path d="M3 18h18"/></svg>
                        </span>
                        Catálogo
                        <span class="adm-sidebar-caret" aria-hidden="true">▾</span>
                    </summary>
                    <ul class="adm-sidebar-submenu">
                        <li class="adm-sidebar-item">
                            <a href="{{ route('categorias.index') }}" class="adm-sidebar-link {{ $navActive === 'categorias' ? 'is-active' : '' }}">
                                Categorías
                            </a>
                        </li>
                        <li class="adm-sidebar-item">
                            <a href="{{ route('productos.index') }}" class="adm-sidebar-link {{ $navActive === 'productos' ? 'is-active' : '' }}">
                                Productos
                            </a>
                        </li>
                    </ul>
                </details>
            </li>
        </ul>
    </nav>

    <div class="adm-sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="adm-sidebar-logout-button">Salir</button>
        </form>
    </div>
</aside>
