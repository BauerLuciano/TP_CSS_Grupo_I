<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST["nombre"]);
    $email = htmlspecialchars($_POST["email"]);
    $asunto = htmlspecialchars($_POST["asunto"]);
    $mensaje = htmlspecialchars($_POST["mensaje"]);

    // Aquí podrías enviar un correo o guardar en una base de datos

    echo "<h2>Gracias por contactarnos, $nombre!</h2>";
    echo "<p>Hemos recibido tu mensaje con el asunto: <strong>$asunto</strong></p>";
    echo "<p>Nos pondremos en contacto contigo a la brevedad a <strong>$email</strong>.</p>";
    echo "<a href='index.php'>Volver al sitio</a>";
} else {
    echo "Acceso no válido.";
}
?>
