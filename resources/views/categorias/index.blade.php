@extends('layouts.dashboard')

@section('title', 'Categorías')

@section('content')
<div class="adm-app">
    <div class="adm-body">
        @include('partials.adm-sidebar', ['navActive' => 'categorias'])

        <main class="adm-main">
            @if (session('success'))
                <div class="mm-alert" role="status" style="background:#e8f5e9;color:#1b5e20;margin-bottom:1rem;">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="mm-alert" role="alert" style="margin-bottom:1rem;">{{ session('error') }}</div>
            @endif

            <div class="adm-main-head">
                <h1 class="adm-main-title">Lista de categorías</h1>
                <a href="{{ route('categorias.create') }}" class="learn-more learn-more--sm">Crear categoría +</a>
            </div>

            <input type="search" id="adm-cat-search" class="adm-catalog-search" placeholder="Buscar categoría…" autocomplete="off" aria-label="Buscar categoría">

            <div class="adm-table-wrap">
                <table class="adm-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Categoría</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categorias as $categoria)
                        <tr>
                            <td>{{ $categoria->id }}</td>
                            <td>
                                @if ($categoria->nombre === 'Bebidas') 🥤
                                @elseif ($categoria->nombre === 'Snacks') 🍟
                                @elseif ($categoria->nombre === 'Lácteos') 🥛
                                @elseif ($categoria->nombre === 'Frutas') 🍎
                                @else 📦
                                @endif
                                {{ $categoria->nombre }}
                            </td>
                            <td>
                                <div class="adm-table-actions" role="group" aria-label="Acciones por fila">
                                    <a href="{{ route('categorias.edit', $categoria) }}" class="learn-more learn-more--sm learn-more--gold">Editar</a>
                                    <form class="adm-delete-form" action="{{ route('categorias.destroy', $categoria) }}" method="POST" onsubmit="return confirm('¿Seguro que quieres borrar esta categoría? Se borrarán los productos que dependan de ella.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="learn-more learn-more--sm learn-more--red">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3">No hay categorías.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <p style="margin-top:1rem;font-size:14px;opacity:.85;">Total: {{ $categorias->count() }} categoría(s)</p>
        </main>
    </div>
</div>
<script>
(function () {
    var input = document.getElementById('adm-cat-search');
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
