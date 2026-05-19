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
                @if (\App\Helpers\RolHelper::isAuthorized('createRoles'))
                <a href="{{ route('roles.create') }}" class="learn-more learn-more--sm">Crear rol +</a>
                @endif
            </div>

            @include('partials.adm-filter-form', [
                'action' => route('roles.index'),
                'placeholder' => 'Buscar rol…',
                'data' => $data,
            ])

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
                        @forelse ($rols as $rol)
                        <tr>
                            <td>{{ $rol->id }}</td>
                            <td>{{ $rol->name }}</td>
                            <td>
                                <div class="adm-table-actions" role="group" aria-label="Acciones por fila">
                                    @if (\App\Helpers\RolHelper::isAuthorized('updateRoles'))
                                    <a href="{{ route('roles.edit', $rol) }}" class="learn-more learn-more--sm learn-more--gold">Editar</a>
                                    @endif
                                    @if (\App\Helpers\RolHelper::isAuthorized('deleteRoles'))
                                    <form class="adm-delete-form" action="{{ route('roles.destroy', $rol) }}" method="POST" onsubmit="return confirm('¿Seguro que quieres borrar este rol?');">
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
                            <td colspan="3">No hay roles.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <p style="margin-top:1rem;font-size:14px;opacity:.85;">Total: {{ $rols->total() }} rol(es)</p>

            <div style="margin-top:1rem;">
                {{ $rols->appends(request()->except('page'))->links() }}
            </div>
        </main>
    </div>
</div>
@endsection
