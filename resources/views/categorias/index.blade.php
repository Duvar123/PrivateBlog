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
                @if (\App\Helpers\RolHelper::isAuthorized('createCategorias'))
                <a href="{{ route('categorias.create') }}" class="learn-more learn-more--sm">Crear categoría +</a>
                @endif
            </div>

            @include('partials.adm-filter-form', [
                'action' => route('categorias.index'),
                'placeholder' => 'Buscar categoría…',
                'data' => $data,
            ])

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
                                <span class="adm-row-label">
                                    @php
                                        $catIcon = 'default';
                                        if ($categoria->nombre === 'Bebidas') {
                                            $catIcon = 'bebidas';
                                        } elseif ($categoria->nombre === 'Snacks') {
                                            $catIcon = 'snacks';
                                        } elseif ($categoria->nombre === 'Lácteos') {
                                            $catIcon = 'lacteos';
                                        } elseif ($categoria->nombre === 'Frutas') {
                                            $catIcon = 'frutas';
                                        }
                                    @endphp
                                    @include('partials.adm-catalog-icon', ['icon' => $catIcon])
                                    {{ $categoria->nombre }}
                                </span>
                            </td>
                            <td>
                                <div class="adm-table-actions" role="group" aria-label="Acciones por fila">
                                    @if (\App\Helpers\RolHelper::isAuthorized('updateCategorias'))
                                    <a href="{{ route('categorias.edit', $categoria) }}" class="learn-more learn-more--sm learn-more--gold">Editar</a>
                                    @endif
                                    @if (\App\Helpers\RolHelper::isAuthorized('deleteCategorias'))
                                    <form class="adm-delete-form" action="{{ route('categorias.destroy', $categoria) }}" method="POST" onsubmit="return confirm('¿Seguro que quieres borrar esta categoría? Se borrarán los productos que dependan de ella.');">
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
                            <td colspan="3">No hay categorías.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <p style="margin-top:1rem;font-size:14px;opacity:.85;">Total: {{ $categorias->total() }} categoría(s)</p>

            <div style="margin-top:1rem;">
                {{ $categorias->appends(request()->except('page'))->links() }}
            </div>
        </main>
    </div>
</div>
@endsection
