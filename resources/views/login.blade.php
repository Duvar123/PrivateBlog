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
