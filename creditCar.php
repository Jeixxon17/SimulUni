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
        <h1>Simula tu crédito automotriz</h1>
      </div>
      <div class="main-credit">
        <div class="credit">
          <label for="precioVehiculo" class="label-credit">Precio del Vehículo</label>
          <p>$</p><input type="number" id="precioVehiculo" class="input-credit">
        </div>
        <div class="credit">
          <label for="cuotaInicialAutomotriz" class="label-credit">Cuota Inicial</label>
          <p>$</p><input type="number" id="cuotaInicialAutomotriz" class="input-credit">
        </div>
        <div class="credit">
          <label for="plazoAutomotriz" class="label-credit">Plazo (Años)</label>
          <select id="plazoAutomotriz" class="input-credit">
            <option value="2">2 años</option>
            <option value="3">3 años</option>
            <option value="4">4 años</option>
            <option value="5">5 años</option>
            <option value="6">6 años</option>
          </select>
        </div>
        <div class="credit">
          <label for="tasaAutomotriz" class="label-credit">Tasa de Interés</label>
          <input type="number" id="tasaAutomotriz" class="input-credit" min="0.01" step="0.01">
          <p>%</p>
        </div>
        <button type="button" onclick="calcularCreditoAutomotriz()">Generar Simulación</button>
      </div>
<div id="resultadoSimulacionAutomotriz"></div>
<div id="tablaAmortizacionAutomotriz"></div>


  <!-- Tu JavaScript y otros enlaces aquí -->
  <script>

function calcularCreditoAutomotriz() {
    const precioVehiculo = parseFloat(document.getElementById('precioVehiculo').value);
    const cuotaInicial = parseFloat(document.getElementById('cuotaInicialAutomotriz').value);
    const monto = precioVehiculo - cuotaInicial;
    const tasa = parseFloat(document.getElementById('tasaAutomotriz').value) / 100 / 12;
    const plazo = parseInt(document.getElementById('plazoAutomotriz').value) * 12;

    if (isNaN(precioVehiculo) || isNaN(cuotaInicial) || isNaN(monto) || isNaN(tasa) || isNaN(plazo)) {
        alert('Por favor, completa todos los campos con valores válidos.');
        return;
    }

    const cuota = (monto * tasa) / (1 - Math.pow(1 + tasa, -plazo));
    let saldo = monto;
    let tabla = '<table><tr><th>Cuota</th><th>Capital</th><th>Interés</th><th>Saldo</th></tr>';

    for (let i = 1; i <= plazo; i++) {
        let interesPago = saldo * tasa;
        let capitalPago = cuota - interesPago;
        saldo -= capitalPago;
        tabla += `<tr>
                    <td>${i}</td>
                    <td>${capitalPago.toFixed(2)}</td>
                    <td>${interesPago.toFixed(2)}</td>
                    <td>${saldo.toFixed(2)}</td>
                  </tr>`;
    }
    tabla += '</table>';
    document.getElementById('tablaAmortizacionAutomotriz').innerHTML = tabla;
}


  </script>

  <!-- Principal JavaScript -->
  <script src="js/main.js"></script>

  <!-- TippyJS -->
  <script src="https://unpkg.com/popper.js@1"></script>
  <script src="https://unpkg.com/tippy.js@5"></script>
  <script src="js/tippy.js"></script>

</body>

</html>