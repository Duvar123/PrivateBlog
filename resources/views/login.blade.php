<<<<<<< HEAD
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

<div class="login-container">
    <h2>Iniciar Sesión</h2>

    @if ($errors->any())
        <div style="color:red; text-align:center;">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="/login">
        @csrf

        <div class="input-group">
            <label>Correo</label>
            <input type="email" name="email" required>
        </div>

        <div class="input-group">
            <label>Contraseña</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit" class="login-btn">Entrar</button>
    </form>
</div>

</body>
</html>
=======
@extends('layouts.auth')

@section('title')

@section('content')
<div class="mm-auth-wrap mm-auth-wrap--uv">
    <div class="mm-uv-container">
        <div class="mm-uv-login-box">
            <form class="mm-uv-form" method="POST" action="{{ url('/login') }}">
                @csrf
                @include('partials.auth-form-logo')
                <span class="mm-uv-header">¡Bienvenido!</span>

                @if (session('status'))
                    <div class="mm-uv-alert mm-uv-alert--ok" role="status">{{ session('status') }}</div>
                @endif
                @if ($errors->any())
                    <div class="mm-uv-alert" role="alert">{{ $errors->first() }}</div>
                @endif

                <input id="email" class="mm-uv-input" type="email" name="email" value="{{ old('email') }}" placeholder="Correo" required autocomplete="email" aria-label="Correo">
                <input id="password" class="mm-uv-input" type="password" name="password" placeholder="Contraseña" required autocomplete="current-password" aria-label="Contraseña">

                <button type="submit" class="mm-uv-button mm-uv-sign-in">Entrar</button>

                <p class="mm-uv-footer">
                    ¿No tienes cuenta?
                    <a href="{{ route('register') }}" class="mm-uv-link">Regístrate</a>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection
>>>>>>> main
