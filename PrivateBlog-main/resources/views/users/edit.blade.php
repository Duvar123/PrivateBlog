@extends('layouts.dashboard')

@section('title', 'Editar usuario')

@section('content')
<div class="adm-app">
    <div class="adm-body">
        @include('partials.adm-sidebar', ['navActive' => 'users'])

        <main class="adm-main adm-main--form-page">
            <div class="adm-form-shell">
                <header class="adm-form-header">
                    <h1 class="adm-main-title">Editar usuario</h1>
                </header>

                <div class="adm-form-card">
                    @if ($errors->any())
                        <div class="mm-alert" role="alert">{{ $errors->first() }}</div>
                    @endif

                    <form method="POST" action="{{ route('users.update', $user) }}" enctype="multipart/form-data" class="adm-crud-form">
                        @csrf
                        @method('PUT')
                        <div class="mm-field">
                            <label for="name">Nombre</label>
                            <input id="name" type="text" name="name" value="{{ old('name', $firstName) }}" required autocomplete="given-name">
                        </div>
                        <div class="mm-field">
                            <label for="last_name">Apellido</label>
                            <input id="last_name" type="text" name="last_name" value="{{ old('last_name', $lastName) }}" required autocomplete="family-name">
                        </div>
                        <div class="mm-field">
                            <label for="email">Correo</label>
                            <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">
                        </div>
                        <div class="mm-field">
                            <label for="password">Nueva contraseña <span class="adm-form-optional">(opcional)</span></label>
                            <input id="password" type="password" name="password" autocomplete="new-password">
                        </div>
                        <div class="mm-field">
                            <label for="password_confirmation">Confirmar nueva contraseña</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" autocomplete="new-password">
                        </div>
                        <div class="mm-field">
                            <label for="avatar">Cambiar foto</label>
                            @if ($user->avatar)
                                <p class="adm-form-preview">Foto actual</p>
                                <img src="{{ asset('storage/'.$user->avatar) }}" alt="" width="72" height="72" class="adm-form-preview-img">
                            @endif
                            <input id="avatar" type="file" name="avatar" accept="image/*">
                        </div>
                        <div class="adm-crud-form-actions">
                            <button type="submit" class="learn-more learn-more--sm">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
