@extends('layouts.auth')

@section('title', 'Entrar')

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
