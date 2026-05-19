@extends('layouts.dashboard')

@section('title')

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
                <a href="{{ route('users.create') }}" class="learn-more learn-more--sm">Crear usuario +</a>
            </div>

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
                            <td>{{ $u-> rol_id }}</td>
                            <td>
                                <div class="adm-table-actions" role="group" aria-label="Acciones por fila">
                                    <a href="{{ route('users.edit', $u) }}" class="learn-more learn-more--sm learn-more--gold">Editar</a>
                                    @if ($u->id !== auth()->id())
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

            <p style="margin-top:1rem;font-size:14px;opacity:.85;">Total: {{ $users->count() }} usuario(s)</p>
        </main>
    </div>
</div>
@endsection
