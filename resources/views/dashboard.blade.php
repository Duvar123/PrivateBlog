@extends('layouts.dashboard')

@section('title', 'Lista de usuarios')

@section('content')
<div class="adm-app">
    <div class="adm-body">
        @include('partials.adm-sidebar', ['navActive' => 'users'])

        <main class="adm-main">
            @if (session('success'))
                <div class="mm-alert" role="status" style="background:#e8f5e9;color:#1b5e20;margin-bottom:1rem;">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="mm-alert" role="alert" style="margin-bottom:1rem;">{{ session('error') }}</div>
            @endif

            <div class="adm-main-head">
                <h1 class="adm-main-title">Lista de usuarios</h1>
                @if (\App\Helpers\RolHelper::isAuthorized('createUsers'))
                <a href="{{ route('users.create') }}" class="learn-more learn-more--sm">Crear usuario +</a>
                @endif
            </div>

            @include('partials.adm-filter-form', [
                'action' => route('dashboard'),
                'placeholder' => 'Buscar por nombre o email…',
                'data' => $data,
            ])

            <div class="adm-table-wrap">
                <table class="adm-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $u)
                        <tr>
                            <td>{{ $u->id }}</td>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->email }}</td>
                            <td>{{ $u->role->name ?? '—' }}</td>
                            <td>
                                <div class="adm-table-actions" role="group" aria-label="Acciones por fila">
                                    @if (\App\Helpers\RolHelper::isAuthorized('updateUsers'))
                                    <a href="{{ route('users.edit', $u) }}" class="learn-more learn-more--sm learn-more--gold">Editar</a>
                                    @endif
                                    @if ($u->id !== auth()->id() && \App\Helpers\RolHelper::isAuthorized('deleteUsers'))
                                    <form class="adm-delete-form" action="{{ route('users.destroy', $u) }}" method="POST" onsubmit="return confirm('¿Seguro que quieres borrar este usuario?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="learn-more learn-more--sm learn-more--red">Eliminar</button>
                                    </form>
                                    @else
                                    <span class="adm-action-you">(tú)</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">No hay usuarios.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <p style="margin-top:1rem;font-size:14px;opacity:.85;">Total: {{ $users->total() }} usuario(s)</p>

            <div style="margin-top:1rem;">
                {{ $users->appends(request()->except('page'))->links() }}
            </div>
        </main>
    </div>
</div>
@endsection
