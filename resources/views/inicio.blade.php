<?php
// Aquí puedes procesar el formulario más adelante
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Ejemplo básico (luego lo puedes conectar a BD)
    if ($email == "admin@gmail.com" && $password == "1234") {
        echo "<p style='color:green; text-align:center;'>Inicio de sesión exitoso</p>";
    } else {
        echo "<p style='color:red; text-align:center;'>Datos incorrectos</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login PHP</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="login-container">
    <h2>Iniciar Sesión</h2>

    <form method="POST" action="">
        <div class="input-group">
            <label for="email">Correo electrónico</label>
            <input type="email" name="email" required>
        </div>

        <div class="input-group">
            <label for="password">Contraseña</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit" class="login-btn">Entrar</button>
    </form>

    <div class="extra-links">
        <p><a href="#">¿Olvidaste tu contraseña?</a></p>
        <p><a href="#">Crear cuenta</a></p>
    </div>
</div>

</body>
</html>
