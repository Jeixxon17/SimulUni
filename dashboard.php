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
  <title>Omnicred | Dashboard</title>
  <link rel="stylesheet" href="style/style.css" />
  <link rel="shortcut icon" href="img/Omnicred.ico" type="image/x-icon">
  <!-- Font Awesome Cdn Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
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
        <h1>¡Hola <?php echo $_SESSION['nombre']; ?>!</h1>
    </div>
    <section class="main-dashboard">
        <div class="main-box">
            <h1>Bienvenido a nuestro simulador de crédito</h1>
                <div class="box-dashboard">
                <h3>Esto es OmniCred Simulation</h3>
                    <p>En nuestro Simulador de Crédito, estamos aquí para ayudarte a tomar decisiones financieras inteligentes y bien informadas. Ya sea que estés buscando un crédito personal, hipotecario o automotriz, nuestra plataforma te brinda las herramientas necesarias para entender tus opciones y encontrar la mejor solución para tus necesidades.</p>
                    <p>Con nuestra interfaz fácil de usar y nuestros poderosos cálculos, podrás visualizar rápidamente cómo diferentes variables, como el monto del préstamo, la tasa de interés y el plazo, afectan tus pagos mensuales y el total de intereses pagados. ¡Prepárate para tomar el control de tus finanzas!</p>
                <div class="box">
                      <a href="creditPerson.php"><i class="fas fa-wallet"></i></a>
                      <h2>Credito Personal</h2>
                    </div>
                </div>
        </div>
    </section>
</section>

      </div>
    </body>
    </html></span>