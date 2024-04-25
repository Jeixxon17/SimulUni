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
          <input name="plazo" id="plazoCredito" class="input-credit">
          <p>Meses</p>
        </div>
        <div class="credit">
          <label for="ingresosMensuales" class="label-credit">Ingresos Mensuales</label>
          <p>$</p><input type="number" id="ingresosMensuales" class="input-credit" name="ingresos">
        </div>
        <input type="hidden" id="tipoCredito" name="tipoCredito" value="1">
        <button type="button" onclick="calcularCredito()">Generar Simulacion</button>
      </div>
      <div id="resultadoSimulacion"></div>
      <div id="tablaAmortizacion"></div>
    </section>
  </div>

  <!-- JavaScript -->
  <script>
    function calcularCredito() {
  const monto = parseFloat(document.getElementById('montoPrestamo').value);
  const tasa = parseFloat(document.getElementById('Interes').value) / 100 / 12;
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

  // Preparar la tabla de amortización
  let tabla = '<div class="tbl-header"><table cellpadding="0" cellspacing="0" border="0"><tr><th>Cuota</th><th>Capital</th><th>Interés</th><th>Saldo</th></tr><table></div>';

  for (let i = 1; i <= plazo; i++) {
    const interesPago = saldo * tasa;
    const capitalPago = cuota - interesPago;
    saldo -= capitalPago;

    // Añadir fila a la tabla
    tabla += `<div class="tbl-content"><table cellpadding="0" cellspacing="0" border="0"><tr>
              <td>${i}</td>
              <td>${Math.round(capitalPago)}</td>
              <td>${Math.round(interesPago)}</td>
              <td>${Math.round(saldo)}</td>
            </tr></table></div>`;
  }

  // Mostrar resultado de la simulación y tabla de amortización
  document.getElementById('resultadoSimulacion').innerHTML = `<p>Por un crédito de: $${monto}, pagarías una cuota mensual por un valor de: $${cuota.toFixed(2)}</p>`;
  document.getElementById('tablaAmortizacion').innerHTML = tabla;

      // Crear el botón
    const button = document.createElement('button');
    button.type = 'button';
    button.innerText = 'Guardar Simulacion';
    document.body.appendChild(button);

    // Agregar un evento de clic al botón
    button.addEventListener('click', function() {
        // Crear un objeto con los datos de la simulación
        const simulacionData = {
    monto: monto,
    tasa: tasa * 12 * 100, // Convertir la tasa a tasa anual
    plazo: plazo,
    ingresos: ingresos,
    cuota: cuota,
    tipoCredito: document.getElementById('tipoCredito').value // Agregar el valor del tipo de crédito
};

        // Realizar una solicitud AJAX al archivo guardarSimulacion.php
        const xhr = new XMLHttpRequest();
xhr.open('POST', 'php/guardarSimulacion.php', true); // Abrir la conexión primero
xhr.setRequestHeader('Content-Type', 'application/json');
xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        console.log(xhr.responseText); // Registro de la respuesta del servidor
    }
};

xhr.send(JSON.stringify(simulacionData)); // Enviar los datos después de abrir la conexión

    //     // Enviar los datos como parámetros codificados en la URL
    //     const params = new URLSearchParams();
    //     for (const key in simulacionData) {
    //         params.append(key, simulacionData[key]);
    //     }
    //     xhr.send(params.toString());
     });
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
