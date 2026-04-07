@extends('layouts.auth')

@section('title', 'Registro')

@section('content')
<div class="mm-auth-wrap mm-auth-wrap--uv">
    <div class="mm-uv-container mm-uv-container--auto">
        <div class="mm-uv-login-box">
            <form class="mm-uv-form" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf
                @include('partials.auth-form-logo')
                <span class="mm-uv-header">Crear cuenta</span>

                @if ($errors->any())
                    <div class="mm-uv-alert" role="alert">{{ $errors->first() }}</div>
                @endif

                <input id="name" class="mm-uv-input" type="text" name="name" value="{{ old('name') }}" placeholder="Nombre" required autocomplete="name" aria-label="Nombre">
                <input id="last_name" class="mm-uv-input" type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Apellido" required autocomplete="family-name" aria-label="Apellido">
                <input id="email" class="mm-uv-input" type="email" name="email" value="{{ old('email') }}" placeholder="Correo" required autocomplete="email" aria-label="Correo">
                <input id="password" class="mm-uv-input" type="password" name="password" placeholder="Contraseña" required autocomplete="new-password" aria-label="Contraseña">
                <input id="password_confirmation" class="mm-uv-input" type="password" name="password_confirmation" placeholder="Confirmar contraseña" required autocomplete="new-password" aria-label="Confirmar contraseña">

                <label class="mm-uv-file-label" for="avatar">Foto (opcional)</label>
                <input id="avatar" class="mm-uv-input mm-uv-input--file" type="file" name="avatar" accept="image/*">

                <button type="submit" class="mm-uv-button mm-uv-sign-in">Registrarse</button>

                <p class="mm-uv-footer">
                    ¿Ya tienes cuenta?
                    <a href="{{ route('login') }}" class="mm-uv-link">Iniciar sesión</a>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection
