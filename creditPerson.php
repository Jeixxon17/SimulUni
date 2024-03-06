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
            <h1>!Hola <?php echo $_SESSION['nombre'] ?>¡ </h1>
          </div>
          <div class="main-skills">
            <div class="card">
              <i class="fas fa-laptop-code"></i>
              <h3>Web developemt</h3>
              <p>Join Over 1 million Students.</p>
              <button>Get Started</button>
            </div>
          </div>
    
          <section class="main-course">
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
          </section>
        </section>
      </div>
    </body>
    </html></span>