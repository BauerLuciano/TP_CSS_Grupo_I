<?php
// Procesamiento del formulario
$mensaje_enviado = false;
$error = "";
$nombre = "";
$email = "";
$asunto = "";
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars(trim($_POST["nombre"] ?? ''));
    $email = htmlspecialchars(trim($_POST["email"] ?? ''));
    $asunto = htmlspecialchars(trim($_POST["asunto"] ?? ''));
    $mensaje = htmlspecialchars(trim($_POST["mensaje"] ?? ''));

    // Validar email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Correo inválido.";
    } elseif (empty($nombre) || empty($asunto) || empty($mensaje)) {
        $error = "Por favor complete todos los campos.";
    } else {
        // Aquí podés enviar mail o guardar datos

        $mensaje_enviado = true;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Grupo Pizza Nova" />
    <meta
      name="description"
      content="Pizza Nova: Pizzería artesanal en tu barrio. ¡El verdadero sabor italiano!"
    />
    <title>Pizza Nova | Pizzería Artesanal</title>
    <link rel="stylesheet" href="./src/styles/style.css" />
    <script src="src/js/script.js" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Pacifico&family=Roboto&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <!-- HEADER -->
    <header class="header">
      <div class="header-content">
        <h1 class="logo">🍕 Pizza Nova</h1>
        <p class="slogan">El sabor de la verdadera Pizza!!</p>
      </div>
    </header>

    <!-- NAV -->
    <nav class="navbar">
      <ul>
        <li><a href="#menu">Menú</a></li>
        <li><a href="#nosotros">Nosotros</a></li>
        <li><a href="#contacto">Contacto</a></li>
      </ul>
    </nav>

    <!-- MAIN -->
    <main>
      <!-- SECCIÓN MENU -->
      <section id="menu" class="seccion-menu">
        <h2>Menú de Pizzas</h2>
        <div class="menu-cards">
          <div class="card">
            <h3>Muzzarella</h3>
            <p>Queso, salsa, orégano, aceite de oliva</p>
            <span class="precio">$7500</span>
          </div>
          <div class="card">
            <h3>Napolitana</h3>
            <p>Tomate natural, ajo, albahaca, aceite de oliva</p>
            <span class="precio">$7800</span>
          </div>
          <div class="card">
            <h3>Especial</h3>
            <p>Jamón, morrón, huevo, aceite de oliva</p>
            <span class="precio">$8500</span>
          </div>
        </div>
      </section>

      <!-- GALERÍA DE IMÁGENES -->
      <section class="galeria">
        <h2>🍕 <u>Nuestras Pizzas</u></h2>
        <div class="galeria-contenedor">
          <figure>
            <img src="./src/img/muzza.jpg" alt="Pizza Muzzarella" />
            <figcaption>Muzzarella Clásica</figcaption>
          </figure>
          <figure>
            <img
              src="./src/img/pizza-jamon-y-morron.jpg"
              alt="Pizza Jamón y Morrón"
            />
            <figcaption>Especial con Morrón</figcaption>
          </figure>
          <figure>
            <img src="./src/img/napo.jpeg" alt="Pizza Napolitana" />
            <figcaption>Napolitana con Albahaca</figcaption>
          </figure>
        </div>
      </section>

      <!-- NOSOTROS -->
      <section id="nosotros" class="nosotros">
        <h2>Sobre Nosotros</h2>
        <article>
          <p>
            En <strong>Pizza Nova</strong> cocinamos con amor desde 2022.
            Nuestro compromiso es ofrecer pizzas artesanales con ingredientes
            frescos y sabores auténticos.
          </p>
          <div class="nosotros-img">
            <figure>
              <img src="./src/img/nova.jpeg" alt="Nuestro local" />
              <figcaption>Nuestro lugar</figcaption>
            </figure>
          </div>
          <section class="nuestras-especialidades">
            <h3>Nuestras especialidades:</h3>
            <ul>
              <li>Pizzas a la piedra</li>
              <li>Postres caseros como tiramisú</li>
              <li>Masa madre horneada al momento</li>
            </ul>
          </section>
        </article>
        <aside class="dato-curioso">
          <strong>🍴 Dato Curioso:</strong> ¡Nuestra salsa secreta fue premiada
          como la mejor de Misiones en 2023!
        </aside>
      </section>

      <!-- TESTIMONIOS -->
      <section class="testimonios">
        <h2>❤️ Opiniones de nuestros clientes</h2>
        <div class="testimonial-cards">
          <blockquote>
            <p>"¡Una pizza increíble! Se siente el amor en cada mordida."</p>
            <cite>- Marcos R.</cite>
          </blockquote>
          <blockquote>
            <p>"La mejor napolitana que probé fuera de Italia."</p>
            <cite>- Carla M.</cite>
          </blockquote>
        </div>
      </section>

      <!-- FORMULARIO DE CONTACTO -->
      <section class="formulario-contacto" id="contacto">
        <h2>📞 Contacto</h2>

        <?php if ($mensaje_enviado): ?>
            <div class="mensaje-exito" style="background:#d4edda; padding:15px; border-radius:5px; margin-bottom:20px;">
              <h3>Gracias por contactarnos, <?= $nombre ?>!</h3>
              <p>Hemos recibido tu mensaje con el asunto: <strong><?= $asunto ?></strong></p>
              <p>Nos pondremos en contacto contigo a la brevedad a <strong><?= $email ?></strong>.</p>
              <a href="index.php">Volver al sitio</a>
            </div>
        <?php else: ?>
          <form action="index.php" method="POST" novalidate>
            <label for="nombre">Nombre:</label>
            <input
              type="text"
              id="nombre"
              name="nombre"
              required
              value="<?= htmlspecialchars($nombre) ?>"
            />

            <label for="email">Correo:</label>
            <input
              type="email"
              id="email"
              name="email"
              required
              value="<?= htmlspecialchars($email) ?>"
            />

            <label for="asunto">Asunto:</label>
            <select id="asunto" name="asunto" required>
              <option value="" disabled <?= empty($asunto) ? "selected" : "" ?>>
                Selecciona un asunto
              </option>
              <option
                value="Consulta sobre productos"
                <?= ($asunto == "Consulta sobre productos") ? "selected" : "" ?>
              >
                Consulta sobre productos
              </option>
              <option
                value="Problema con un pedido"
                <?= ($asunto == "Problema con un pedido") ? "selected" : "" ?>
              >
                Problema con un pedido
              </option>
              <option
                value="Sugerencia o comentario"
                <?= ($asunto == "Sugerencia o comentario") ? "selected" : "" ?>
              >
                Sugerencia o comentario
              </option>
            </select>

            <label for="mensaje">Mensaje:</label>
            <textarea
              id="mensaje"
              name="mensaje"
              rows="4"
              required
            ><?= htmlspecialchars($mensaje) ?></textarea>

            <?php if ($error): ?>
              <p style="color: red;"><?= $error ?></p>
            <?php endif; ?>

            <button type="submit">Enviar mensaje</button>
          </form>
        <?php endif; ?>

      </section>
    </main>

    <!-- FOOTER -->
    <footer class="footer">
      <div class="footer-info">
        <p>📍 Av. Las Heras, Apóstoles</p>
        <p>📱 WhatsApp: 3758-441143</p>
        <p>
          🌐
          <a href="https://instagram.com/pizzanova" target="_blank"
            >@pizzanova</a
          >
        </p>
      </div>
      <p class="copyright">© 2025 Pizza Nova. Todos los derechos reservados.</p>
      <br />
      <p class="integrantes">Integrantes:</p>
      <ul>
        <li>Matias Maciel</li>
        <li>Leonel Carballo</li>
        <li>Luciano Bauer</li>
        <li>Ricardo Olivieri</li>
      </ul>
    </footer>
  </body>
</html>
