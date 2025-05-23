// Selección de elementos
const formulario = document.querySelector(".formulario-contacto form");
const textarea = document.getElementById("mensaje");
const contador = document.getElementById("contador");
const botonSubmit = formulario.querySelector('button[type="submit"]'); // botón submit

// ------------------------
// Validar email
function validarEmail(email) {
  return /\S+@\S+\.\S+/.test(email);
}

// Calcular descuento
function calcularDescuento(precio, porcentaje) {
  return precio - (precio * porcentaje / 100);
}

// Generar mensaje
function generarMensaje(nombre, asunto) {
  return `Gracias ${nombre} por contactarnos sobre: ${asunto}. Te responderemos pronto.`;
}

// Probar función calcularDescuento en consola
console.log("Descuentos:");
console.log(calcularDescuento(10000, 10)); // 9000
console.log(calcularDescuento(7500, 20));  // 6000
console.log(calcularDescuento(8500, 15));  // 7225

// ------------------------
// Contador de caracteres
textarea.addEventListener("input", () => {
  contador.textContent = `${textarea.value.length} caracteres`;
});

// ------------------------
// Animaciones botón submit con JS puro

// Variables para control de intervalo
let intervaloArcoiris = null;

function colorArcoiris(t) {
  // Genera un color arcoiris basado en tiempo t
  const r = Math.floor(Math.sin(t) * 127 + 128);
  const g = Math.floor(Math.sin(t + 2) * 127 + 128);
  const b = Math.floor(Math.sin(t + 4) * 127 + 128);
  return `rgb(${r},${g},${b})`;
}

// mouseenter y mouseleave para escala y sombra (sin afectar fondo)
botonSubmit.addEventListener('mouseenter', () => {
  botonSubmit.style.transform = 'scale(1.05)';
  botonSubmit.style.boxShadow = '0 5px 15px rgba(0, 91, 187, 0.4)';
});

botonSubmit.addEventListener('mouseleave', () => {
  botonSubmit.style.transform = 'scale(1)';
  botonSubmit.style.boxShadow = 'none';
  botonSubmit.style.backgroundColor = '#007BFF'; // color original
  botonSubmit.style.border = 'none'; // quitar borde si quedó
  // Detener animación arcoiris si estaba activa
  if (intervaloArcoiris) {
    clearInterval(intervaloArcoiris);
    intervaloArcoiris = null;
  }
});

// mousedown y mouseup para efecto clic
botonSubmit.addEventListener('mousedown', () => {
  botonSubmit.style.transform = 'scale(0.95)';
  botonSubmit.style.boxShadow = '0 3px 8px rgba(0, 61, 128, 0.6)';
  botonSubmit.style.backgroundColor = '#003d80';
});

botonSubmit.addEventListener('mouseup', () => {
  botonSubmit.style.transform = 'scale(1.05)';
  botonSubmit.style.boxShadow = '0 5px 15px rgba(0, 91, 187, 0.4)';
  botonSubmit.style.backgroundColor = '#0056b3';
});

// Animación color arcoiris con mouseover y mouseout
botonSubmit.addEventListener('mouseover', () => {
  let t = 0;
  // Iniciar intervalo para cambiar color cada 100ms
  if (!intervaloArcoiris) {
    intervaloArcoiris = setInterval(() => {
      botonSubmit.style.backgroundColor = colorArcoiris(t);
      t += 0.3;
    }, 100);
  }
});

botonSubmit.addEventListener('mouseout', () => {
  // Detener intervalo y volver a color original
  if (intervaloArcoiris) {
    clearInterval(intervaloArcoiris);
    intervaloArcoiris = null;
  }
  botonSubmit.style.backgroundColor = '#007BFF'; // color original azul
  botonSubmit.style.border = 'none';
  botonSubmit.style.transform = 'scale(1)';
  botonSubmit.style.boxShadow = 'none';
});

// ------------------------
// Evento submit del formulario
formulario.addEventListener("submit", function(event) {
  event.preventDefault();

  const nombre = document.getElementById("nombre").value;
  const asunto = document.getElementById("asunto").value;
  const email = formulario.querySelector("input[type='email']")?.value;

  let mensajeEstado = document.getElementById("mensaje-estado");

  if (!mensajeEstado) {
    mensajeEstado = document.createElement("p");
    mensajeEstado.id = "mensaje-estado";
    formulario.appendChild(mensajeEstado);
  }

  // Validar email
  if (email && !validarEmail(email)) {
    mensajeEstado.textContent = "El email ingresado no es válido.";
    return;
  }

  // Mostrar mensaje generado
  const mensajeGenerado = generarMensaje(nombre, asunto);
  mensajeEstado.textContent = mensajeGenerado;
  console.log(`Mensaje: ${mensajeGenerado}`);
});
