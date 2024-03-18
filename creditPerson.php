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
        <li><a href="creditHouse.php">
            <i class="fas fa-home"></i>
            <span class="nav-item">Credito Hipotecario</span>
          </a></li>
        <li><a href="creditCar.php">
            <i class="fas fa-car"></i>
            <span class="nav-item">Credito Automotriz</span>
          </a></li>
        <li><a href="configuration.php">
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
          <label for="montoPrestamo" class="label-credit">Monto Préstamo<i class="fas fa-question-circle" id="montoPrestamoTippy"></i></label>
          <p>$</p><input type="number" id="montoPrestamo" class="input-credit" name="monto">
        </div>
        <div class="credit">
          <label for="tasaInteres" class="label-credit">Tasa de Interés <i class="fas fa-question-circle" id="tasaInteres"></i></label>
          <input type="number" id="Interes" class="input-credit" name="tasa" min="0.01" step="0.01">
          <p>%</p>
        </div>
        <div class="credit">
          <label for="plazoCredito" class="label-credit">Plazo <i class="fas fa-question-circle" id="plazoMensual"></i></label>
          <input name="plazo" id="plazoCredito" class="input-credit"><p>Meses</p>
        </div>
        <!-- <div class="credit">
          <label for="" class="label-credit">Frecuencia de pago <i class="fas fa-question-circle" id="frecuenciaPago"></i></label>
          <select name="" id="" class="input-credit">
            <option value="0">Elige la frecuencia de pago</option>
            <option value="">Diario</option>
            <option value="">Quincenal</option>
            <option value="">Mensual</option>
            <option value="">Anual</option>
          </select>
        </div> -->
        <div class="credit">
          <label for="ingresosMensuales" class="label-credit">Ingresos Mensuales</label>
          <p>$</p><input type="number" id="ingresosMensuales" class="input-credit" name="ingresos">
        </div>
        <button type="button" onclick="calcularCredito()">Generar Simulacion</button>
      </div>
      <div id="resultadoSimulacion"></div>
      <div id="tablaAmortizacion"></div>

  </div>

  <!-- Tu JavaScript y otros enlaces aquí -->
  <script>

  function calcularCredito() {
    const monto = parseFloat(document.getElementById('montoPrestamo').value);
    const tasa = parseFloat(document.getElementById('Interes').value) / 100 / 12; // Asegúrate de que este sea el ID correcto para la tasa de interés
    const plazo = parseInt(document.getElementById('plazoCredito').value);
    const ingresos = parseFloat(document.getElementById('ingresosMensuales').value);

    // Validar entradas
    if (isNaN(monto) || isNaN(tasa) || isNaN(plazo) || isNaN(ingresos)) {
        alert('Por favor, completa todos los campos con valores válidos.');
        return;
    }

    // Cálculo de la cuota mensual
    const cuota = (monto * tasa) / (1 - Math.pow(1 + tasa, -plazo));
    let saldo = monto;
    let totalInteres = 0;
    let totalCapital = 0;

    // Preparar la tabla de amortización
    let tabla = '<table><tr><th>Cuota</th><th>Capital</th><th>Interés</th><th>Saldo</th></tr>';

    for (let i = 1; i <= plazo; i++) {
        const interesPago = saldo * tasa;
        const capitalPago = cuota - interesPago;
        saldo -= capitalPago;
        totalInteres += interesPago;
        totalCapital += capitalPago;

        // Añadir fila a la tabla
        tabla += `<tr>
                    <td>${i}</td>
                    <td>${capitalPago.toFixed(2)}</td>
                    <td>${interesPago.toFixed(2)}</td>
                    <td>${saldo.toFixed(2)}</td>
                  </tr>`;
    }

    tabla += '</table>';

    const porcentajeIngresos = cuota / ingresos;
    let resultado = `<p>Por un crédito de: $${monto}, pagarías una cuota mensual por un valor de: $${cuota.toFixed(2)}</p>`;
    if (porcentajeIngresos > 0.30) {
        resultado += `<p style="color: red;">Advertencia: La cuota supera el 30% de tus ingresos mensuales.</p>`;
    }

    document.getElementById('resultadoSimulacion').innerHTML = resultado;
    document.getElementById('tablaAmortizacion').innerHTML = tabla;
  } 

</script>

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
  <!-- Principal JavaScript -->
  <script src="js/main.js"></script>

  <!-- TippyJS -->
  <script src="https://unpkg.com/popper.js@1"></script>
  <script src="https://unpkg.com/tippy.js@5"></script>
  <script src="js/tippy.js"></script>

</body>

</html>