@extends('layouts.dashboard')

@section('title', 'Productos')

@section('content')
<div class="adm-app">
    <div class="adm-body">
        @include('partials.adm-sidebar', ['navActive' => 'productos'])

        <main class="adm-main">
            @if (session('success'))
                <div class="mm-alert" role="status" style="background:#e8f5e9;color:#1b5e20;margin-bottom:1rem;">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="mm-alert" role="alert" style="margin-bottom:1rem;">{{ session('error') }}</div>
            @endif

            <div class="adm-main-head">
                <h1 class="adm-main-title">Lista de productos</h1>
                <a href="{{ route('productos.create') }}" class="learn-more learn-more--sm">Crear producto +</a>
            </div>

            <input type="search" id="adm-prod-search" class="adm-catalog-search" placeholder="Buscar producto…" autocomplete="off" aria-label="Buscar producto">

            <div class="adm-table-wrap">
                <table class="adm-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Producto</th>
                            <th>Categoría</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($productos as $producto)
                        <tr>
                            <td>{{ $producto->id }}</td>
                            <td>
                                @if ($producto->nombre === 'Agua Mineral') 💧
                                @elseif ($producto->nombre === 'Manzana Roja') 🍎
                                @elseif ($producto->nombre === 'Yogur Natural') 🥛
                                @elseif ($producto->nombre === 'Papas Fritas') 🍟
                                @else 📦
                                @endif
                                {{ $producto->nombre }}
                            </td>
                            <td>
                                @php $cn = $producto->categoria->nombre ?? ''; @endphp
                                <span class="adm-cat-badge
                                    @if ($cn === 'Bebidas') adm-cat-badge--bebidas
                                    @elseif ($cn === 'Frutas') adm-cat-badge--frutas
                                    @elseif ($cn === 'Lácteos') adm-cat-badge--lacteos
                                    @elseif ($cn === 'Snacks') adm-cat-badge--snacks
                                    @else adm-cat-badge--default
                                    @endif
                                ">{{ $cn }}</span>
                            </td>
                            <td>
                                <div class="adm-table-actions" role="group" aria-label="Acciones por fila">
                                    <a href="{{ route('productos.edit', $producto) }}" class="learn-more learn-more--sm learn-more--gold">Editar</a>
                                    <form class="adm-delete-form" action="{{ route('productos.destroy', $producto) }}" method="POST" onsubmit="return confirm('¿Seguro que quieres borrar este producto?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="learn-more learn-more--sm learn-more--red">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">No hay productos.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <p style="margin-top:1rem;font-size:14px;opacity:.85;">Total: {{ $productos->count() }} producto(s)</p>
        </main>
    </div>
</div>
<script>
(function () {
    var input = document.getElementById('adm-prod-search');
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
