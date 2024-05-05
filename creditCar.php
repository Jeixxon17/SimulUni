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
  <!-- Sweet Alert CDN Script -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Script Funcionamiento AJAX -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        <input type="hidden" id="tipoCredito" name="tipoCredito" value="3">
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
            Swal.fire({
              icon: "error",
              title: "Datos vacios",
              text: "Por favor ingresa datos a los campos"
            });
            return;
          }

          if (precioVehiculo < 10000000) {
            Swal.fire({
              icon: "error",
              title: "Valor de propiedad insuficiente",
              text: "Ingresa por favor un valor mayor o igual a $10 millones!"
            });
          } else {
            const cuota = (monto * tasa) / (1 - Math.pow(1 + tasa, -plazo));
            let saldo = monto;
            let tabla = '<table><tr><th>Cuota</th><th>Capital</th><th>Interés</th><th>Saldo</th></tr>';

            for (let i = 1; i <= plazo; i++) {
              const interesPago = saldo * tasa;
              const capitalPago = cuota - interesPago;
              saldo -= capitalPago;
              tabla += `<div class="tbl-content"><table cellpadding="0" cellspacing="0" border="0"><tr>
            <td>${i}</td>
            <td>${Math.round(capitalPago)}</td>
            <td>${Math.round(interesPago)}</td>
            <td>${Math.round(saldo)}</td>
          </tr></table></div>`;
            }

            document.getElementById('resultadoSimulacionAutomotriz').innerHTML = `<p>El valor a pagar del credito total es de: $${monto}, pagarías una cuota mensual por un valor de: $${Math.round(cuota)}</p>`;
            document.getElementById('tablaAmortizacionAutomotriz').innerHTML = tabla;
            // Crear el botón de guardar simulación
            const button = document.createElement('button');
            button.type = 'button';
            button.innerText = "Guardar Simulacion";
            document.body.appendChild(button);

            // Agregar evento de clic al botón
            button.addEventListener('click', function() {
              // Mostrar la alerta antes de guardar la simulación
              Swal.fire({
                icon: "question",
                title: "¿Deseas guardar esta simulacion?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Guardar",
                denyButtonText: `De momento no guardar`
              }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                  // Crear un objeto con los datos de la simulación
                  const simulacionData = {
                    monto: monto,
                    tasa: tasa * 12 * 100, // Convertir la tasa a tasa anual
                    plazo: plazo,
                    cuota: cuota,
                    tipoCredito: document.getElementById('tipoCredito').value // Agregar el valor del tipo de crédito
                  };

                  // Realizar una solicitud AJAX al archivo guardarSimulacion.php
                  const xhr = new XMLHttpRequest();
                  xhr.open('POST', 'php/guardarSimulacion.php', true); // Abrir la conexión primero
                  xhr.setRequestHeader('Content-Type', 'application/json');
                  xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                      if (xhr.status === 200) {
                        const response = JSON.parse(xhr.responseText); // Parsear la respuesta JSON
                        if (response.success) {
                          Swal.fire({
                            icon: 'success',
                            title: 'Simulacion Guardada Correctamente',
                          });
                        } else {
                          Swal.fire({
                            icon: 'error',
                            title: 'Algo ha salido mal :(',
                            text: response.message,
                          });
                        }
                      } else {
                        Swal.fire({
                          icon: 'error',
                          title: 'Error',
                          text: 'There was a problem processing the request.',
                        });
                      }
                    }
                  };

                  xhr.send(JSON.stringify(simulacionData)); // Enviar los datos después de abrir la conexión
                } else if (result.isDenied) {
                  Swal.fire("Esta simulacion no se guardo", "", "info");
                }
              });
            });

          }
        }
      </script>

      <!-- Principal JavaScript -->
      <script src="js/main.js"></script>
      <script src="js/sweetAlert.js"></script>

      <!-- TippyJS -->
      <script src="https://unpkg.com/popper.js@1"></script>
      <script src="https://unpkg.com/tippy.js@5"></script>
      <script src="js/tippy.js"></script>

</body>

</html>