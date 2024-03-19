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
        <h1>Simula tu crédito hipotecario</h1>
      </div>
      <div class="main-credit">
        <div class="credit">
          <label for="valorPropiedad" class="label-credit">Valor de la Propiedad</label>
          <p>$</p><input type="number" id="valorPropiedad" class="input-credit">
        </div>
        <div class="credit">
          <label for="cuotaInicialHipotecario" class="label-credit">Cuota Inicial</label>
          <p>$</p><input type="number" id="cuotaInicialHipotecario" class="input-credit">
        </div>
        <div class="credit">
          <label for="plazoHipotecario" class="label-credit">Plazo del Crédito (Años)</label>
          <select id="plazoHipotecario" class="input-credit">
            <option value="5">5 años</option>
            <option value="10">10 años</option>
            <option value="15">15 años</option>
            <option value="20">20 años</option>
            <option value="25">25 años</option>
            <option value="30">30 años</option>
          </select>
        </div>
        <div class="credit">
          <label for="tasaHipotecaria" class="label-credit">Tasa de Interés</label>
          <input type="number" id="tasaHipotecaria" class="input-credit" min="0.01" step="0.01">
          <p>%</p>
        </div>
        <button type="button" onclick="calcularCreditoHipotecario()">Generar Simulación</button>
    </div>
    <div id="resultadoSimulacionHipotecario"></div>
    <div id="tablaAmortizacionHipotecario"></div>



  <!-- Tu JavaScript y otros enlaces aquí -->
  <script>

function calcularCreditoHipotecario() {
    const valorPropiedad = parseFloat(document.getElementById('valorPropiedad').value);
    const cuotaInicial = parseFloat(document.getElementById('cuotaInicialHipotecario').value);
    const monto = valorPropiedad - cuotaInicial;
    const tasa = parseFloat(document.getElementById('tasaHipotecaria').value) / 100 / 12;
    const plazo = parseInt(document.getElementById('plazoHipotecario').value) * 12;

    if (isNaN(valorPropiedad) || isNaN(cuotaInicial) || isNaN(monto) || isNaN(tasa) || isNaN(plazo)) {
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
    document.getElementById('tablaAmortizacionHipotecario').innerHTML = tabla;
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