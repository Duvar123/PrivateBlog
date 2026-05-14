@extends('layouts.dashboard')

@section('title', 'Roles')

@section('content')
<div class="adm-app">
    <div class="adm-body">
        @include('partials.adm-sidebar', ['navActive' => 'roles'])

        <main class="adm-main">
            @if (session('success'))
                <div class="mm-alert" role="status" style="background:#e8f5e9;color:#1b5e20;margin-bottom:1rem;">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="mm-alert" role="alert" style="margin-bottom:1rem;">{{ session('error') }}</div>
            @endif

            <div class="adm-main-head">
                <h1 class="adm-main-title">Lista de roles</h1>
                <a href="{{ route('roles.create') }}" class="learn-more learn-more--sm">Crear rol +</a>
            </div>

            <input type="search" id="adm-role-search" class="adm-catalog-search" placeholder="Buscar rol…" autocomplete="off" aria-label="Buscar rol">

            <div class="adm-table-wrap">
                <table class="adm-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->nombre }}</td>
                            <td>
                                @if (in_array($role->nombre, ['Administrador', 'Usuario'], true))
                                    <span class="adm-action-you">(rol base)</span>
                                @else
                                    <div class="adm-table-actions" role="group" aria-label="Acciones por fila">
                                        <a href="{{ route('roles.edit', $role) }}" class="learn-more learn-more--sm learn-more--gold">Editar</a>
                                        <form class="adm-delete-form" action="{{ route('roles.destroy', $role) }}" method="POST" onsubmit="return confirm('¿Seguro que quieres borrar este rol?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="learn-more learn-more--sm learn-more--red">Eliminar</button>
                                        </form>
                                    </div>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3">No hay roles.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <p style="margin-top:1rem;font-size:14px;opacity:.85;">Total: {{ $roles->count() }} rol(es)</p>
        </main>
    </div>
</div>
<script>
(function () {
    var input = document.getElementById('adm-role-search');
    var tbody = document.querySelector('.adm-main .adm-table tbody');
    if (!input || !tbody) return;
    input.addEventListener('input', function () {
        var q = (input.value || '').toLowerCase().trim();
        tbody.querySelectorAll('tr').forEach(function (tr) {
            if (tr.querySelector('td[colspan]')) return;
            tr.style.display = !q || tr.textContent.toLowerCase().indexOf(q) !== -1 ? '' : 'none';
        });
    });
})();
</script>
@endsection
