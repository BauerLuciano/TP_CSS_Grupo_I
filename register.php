<?php
require 'db.php';

$mensaje = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? '');
    $password = trim($_POST["password"] ?? '');

    if (empty($username) || empty($password)) {
        $mensaje = "Todos los campos son obligatorios.";
    } else {
        // Verificar si ya existe
        $stmt = $pdo->prepare("SELECT id FROM users WHERE nombre = ?");
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            $mensaje = "El usuario ya existe.";
        } else {
            // Hashear la contraseña
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insertar en la base
            $stmt = $pdo->prepare("INSERT INTO users (nombre, password) VALUES (?, ?)");
            if ($stmt->execute([$username, $hashedPassword])) {
                $mensaje = "Usuario registrado correctamente. <a href='login.php'>Iniciar sesión</a>";
            } else {
                $mensaje = "Error al registrar el usuario.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - Pizza Nova</title>
    <link rel="stylesheet" href="styles/register.css">
</head>
<body>
    <div class="register-container">
        <h1 class="logo">🍕 Pizza Nova</h1>
        <h2>Registro</h2>

        <?php if (!empty($mensaje)): ?>
            <p class="mensaje"><?= $mensaje ?></p>
        <?php endif; ?>

        <form method="post" class="register-form">
            <label for="username">Usuario:</label>
            <input type="text" name="username" id="username" required>

            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" required>

            <button type="submit">Registrarse</button>
        </form>

        <p class="login-link">¿Ya tenés cuenta? <a href="login.php">Iniciá sesión</a></p>
    </div>
</body>
</html>
