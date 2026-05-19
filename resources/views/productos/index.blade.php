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
                @if (\App\Helpers\RolHelper::isAuthorized('createProductos'))
                <a href="{{ route('productos.create') }}" class="learn-more learn-more--sm">Crear producto +</a>
                @endif
            </div>

            @include('partials.adm-filter-form', [
                'action' => route('productos.index'),
                'placeholder' => 'Buscar producto o categoría…',
                'data' => $data,
            ])

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
                                <span class="adm-row-label">
                                    @php
                                        $cnProd = $producto->categoria->nombre ?? '';
                                        $prodIcon = 'default';
                                        if ($producto->nombre === 'Agua Mineral') {
                                            $prodIcon = 'agua';
                                        } elseif ($cnProd === 'Bebidas') {
                                            $prodIcon = 'bebidas';
                                        } elseif ($cnProd === 'Snacks') {
                                            $prodIcon = 'snacks';
                                        } elseif ($cnProd === 'Lácteos') {
                                            $prodIcon = 'lacteos';
                                        } elseif ($cnProd === 'Frutas') {
                                            $prodIcon = 'frutas';
                                        }
                                    @endphp
                                    @include('partials.adm-catalog-icon', ['icon' => $prodIcon])
                                    {{ $producto->nombre }}
                                </span>
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
                                    @if (\App\Helpers\RolHelper::isAuthorized('updateProductos'))
                                    <a href="{{ route('productos.edit', $producto) }}" class="learn-more learn-more--sm learn-more--gold">Editar</a>
                                    @endif
                                    @if (\App\Helpers\RolHelper::isAuthorized('deleteProductos'))
                                    <form class="adm-delete-form" action="{{ route('productos.destroy', $producto) }}" method="POST" onsubmit="return confirm('¿Seguro que quieres borrar este producto?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="learn-more learn-more--sm learn-more--red">Eliminar</button>
                                    </form>
                                    @endif
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

            <p style="margin-top:1rem;font-size:14px;opacity:.85;">Total: {{ $productos->total() }} producto(s)</p>

            <div style="margin-top:1rem;">
                {{ $productos->appends(request()->except('page'))->links() }}
            </div>
        </main>
    </div>
</div>
@endsection
