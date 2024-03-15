<?php
session_start();

if (!isset($_SESSION['nombre'])) {
  echo '<script>alert("No se ha iniciado sesión");</script>';
  header("location: index.php");
  exit();
}

if (isset($_POST['logout'])) {
  session_unset();
  session_destroy();
  header("location: index.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Credito Personal | OmniCred</title>
  <link rel="stylesheet" href="style/style.css" />
  <link rel="shortcut icon" href="img/Omnicred.ico" type="image/x-icon">
  <!-- Font Awesome Cdn Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>

<body>
  <div class="container">
    <form method="post" style="display: none;" id="logoutForm">
      <input type="hidden" name="logout" value="1">
    </form>
    <nav>
      <ul>
        <li><a href="#" class="logo">
            <img src="img/Omnicred.jpeg" alt="">
            <span class="nav-item">OmniCred</span>
          </a></li>
        <li><a href="dashboard.php">
            <i class="fas fa-info-circle"></i>
            <span class="nav-item">Inicio</span>
          </a></li>
        <li><a href="creditPerson.php">
            <i class="fas fa-wallet"></i>
            <span class="nav-item">Credito Personal</span>
          </a></li>
        <li><a href="">
            <i class="fas fa-home"></i>
            <span class="nav-item">Credito Hipotecario</span>
          </a></li>
        <li><a href="">
            <i class="fas fa-car"></i>
            <span class="nav-item">Credito Automotriz</span>
          </a></li>
        <li><a href="">
            <i class="fas fa-cog"></i>
            <span class="nav-item">Configuracion</span>
          </a></li>
        <li><a href="#" class="logout" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
            <i class="fas fa-sign-out-alt"></i>
            <span class="nav-item">Log out</span>
          </a></li>
      </ul>
    </nav>

    <section class="main">
      <div class="main-top">
        <h1>Simula tu crédito personal</h1>
      </div>
      <div class="main-credit">
        <div class="credit">
          <label for="" class="label-credit">Monto Préstamo <i class="fas fa-question-circle" id="montoPrestamoTippy"></i></label>
          <p>$</p><input type="text" id="montoPrestamo" class="input-credit">
        </div>
        <div class="credit">
          <label for="" class="label-credit">Tasa de Interés <i class="fas fa-question-circle" id="tasaInteres"></i></label>
          <input type="number" class="input-credit">
          <p>%</p>
        </div>
        <div class="credit">
          <label for="" class="label-credit">Plazo <i class="fas fa-question-circle" id="plazoMensual"></i></label>
          <select name="" id="" class="input-credit">
            <option value="0">Elige el plazo</option>
            <option value="">1 mes</option>
            <option value="">2 mes</option>
            <option value="">3 mes</option>
            <option value="">4 mes</option>
          </select>
        </div>
        <div class="credit">
          <label for="" class="label-credit">Frecuencia de pago <i class="fas fa-question-circle" id="frecuenciaPago"></i></label>
          <select name="" id="" class="input-credit">
            <option value="0">Elige la frecuencia de pago</option>
            <option value="">Diario</option>
            <option value="">Quincenal</option>
            <option value="">Mensual</option>
            <option value="">Anual</option>
          </select>
        </div>
        <button>Generar Simulacion</button>
      </div>
  </div>

  <!-- <section class="main-course">
    <h1>My courses</h1>
    <div class="course-box">
      <ul>
        <li class="active">In progress</li>
        <li>explore</li>
        <li>incoming</li>
        <li>finished</li>
      </ul>
      <div class="course">
        <div class="box">
          <h3>HTML</h3>
          <p>80% - progress</p>
          <button>continue</button>
          <i class="fab fa-html5 html"></i>
        </div>
      </div>
    </div>
  </section> -->
  </section>
  </div>
</body>
<script>
  // Función para dar formato a un número como moneda
  function formatCurrency(input) {
    // Obtener el valor del campo de entrada
    let value = input.value;
    // Reemplazar cualquier carácter que no sea un dígito o un punto decimal por una cadena vacía
    value = value.replace(/[^\d.]/g, '');
    // Dividir el valor en partes separando los decimales
    let parts = value.split('.');
    // Formatear la parte entera del número con comas cada tres dígitos
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    // Unir las partes nuevamente con el punto decimal
    input.value = parts.join('.');
  }

  // Obtener el campo de entrada
  const inputCredit = document.getElementById('montoPrestamo');

  // Escuchar el evento input para formatear el valor mientras se escribe
  inputCredit.addEventListener('input', function() {
    formatCurrency(this);
  });
</script>

<!-- TippyJS -->
<script src="https://unpkg.com/popper.js@1"></script>
<script src="https://unpkg.com/tippy.js@5"></script>
<script src="js/tippy.js"></script>

</html>