@php
    $navActive = $navActive ?? '';
@endphp
<aside class="adm-sidebar">
    <header class="adm-sidebar-header">
        <a href="{{ route('dashboard') }}" class="adm-sidebar-brand">Brand</a>
    </header>

    <div class="adm-sidebar-user-card">
        <img src="https://images.unsplash.com/photo-1734122415415-88cb1d7d5dc0?q=80&w=320&h=320&auto=format&fit=facearea&facepad=3&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Avatar" class="adm-sidebar-avatar">
        <div>
            <p class="adm-sidebar-user-name">Mia Hudson</p>
            <p class="adm-sidebar-user-role">Administrator</p>
        </div>
    </div>

    <nav class="adm-sidebar-nav" aria-label="Main navigation">
        <ul class="adm-sidebar-menu">
            <li class="adm-sidebar-item">
                <a href="{{ route('dashboard') }}" class="adm-sidebar-link {{ in_array($navActive, ['dashboard', 'users']) ? 'is-active' : '' }}">
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
            <li class="adm-sidebar-group">
                <details>
                    <summary class="adm-sidebar-link summary-link">
                        <span class="adm-sidebar-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10.5V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v4.5"/><path d="M7 21h10"/><path d="M12 17v4"/></svg>
                        </span>
                        Account
                        <span class="adm-sidebar-caret" aria-hidden="true">▾</span>
                    </summary>
                    <ul class="adm-sidebar-submenu">
                        <li class="adm-sidebar-item">
                            <a href="#" class="adm-sidebar-link">My account</a>
                        </li>
                        <li class="adm-sidebar-item">
                            <a href="#" class="adm-sidebar-link">Settings</a>
                        </li>
                    </ul>
                </details>
            </li>
            <li class="adm-sidebar-group">
                <details>
                    <summary class="adm-sidebar-link summary-link">
                        <span class="adm-sidebar-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16v16H4z"/><path d="M8 2v6"/><path d="M16 2v6"/></svg>
                        </span>
                        Projects
                        <span class="adm-sidebar-caret" aria-hidden="true">▾</span>
                    </summary>
                    <ul class="adm-sidebar-submenu">
                        <li class="adm-sidebar-item">
                            <a href="#" class="adm-sidebar-link">Link 1</a>
                        </li>
                        <li class="adm-sidebar-item">
                            <a href="#" class="adm-sidebar-link">Link 2</a>
                        </li>
                    </ul>
                </details>
            </li>
            <li class="adm-sidebar-item">
                <a href="#" class="adm-sidebar-link">
                    <span class="adm-sidebar-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="16" rx="2" ry="2"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </span>
                    Calendar
                    <span class="adm-sidebar-badge">New</span>
                </a>
            </li>
            <li class="adm-sidebar-item">
                <a href="#" class="adm-sidebar-link">
                    <span class="adm-sidebar-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 4H7a2 2 0 0 0-2 2v14l6-3 6 3 6-3V6a2 2 0 0 0-2-2Z"/></svg>
                    </span>
                    Documentation
                </a>
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
