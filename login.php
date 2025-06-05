<?php
require 'db.php';

$mensaje = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? '');
    $password = trim($_POST["password"] ?? '');

    $stmt = $pdo->prepare("SELECT * FROM users WHERE nombre = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user["password"])) {
        session_start();
        $_SESSION["usuario"] = $user["nombre"];
        header("Location: index.php");
        exit;
    } else {
        $mensaje = "Usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Pizza Nova</title>
    <link rel="stylesheet" href="styles/login.css">
</head>
<body>
    <div class="login-container">
        <h1 class="logo">🍕 Pizza Nova</h1>
        <h2>Iniciar Sesión</h2>

        <?php if (!empty($mensaje)): ?>
            <p class="mensaje"><?= $mensaje ?></p>
        <?php endif; ?>

        <form method="post" class="login-form">
            <label for="username">Usuario:</label>
            <input type="text" name="username" id="username" required>

            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" required>

            <button type="submit">Ingresar</button>
        </form>

        <p class="register-link">¿No tenés cuenta? <a href="register.php">Registrate acá</a></p>
    </div>
</body>
</html>
