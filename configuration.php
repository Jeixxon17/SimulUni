<?php
include('db/database.php');
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
                <li><a href="#">
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
            <section class="main-course">
                <div class="course-box">
                    <ul>
                        <li class="active datos" onclick="mostrarDatos()">Datos Basicos</li>
                        <li class="simulacion" onclick="mostrarSimulacion()">Simulaciones</li>
                    </ul>
                    <div class="datos-content">
                        <label for="">Nombre: <?php echo $_SESSION['nombre']; ?></label>
                        <label for="">Correo: <?php echo $_SESSION['email']; ?></label>

                    </div>

                    <div class="simulacion-content">
                        <table>
                            <thead>
                                <th>Monto Prestamo</th>
                                <th>Tasa Interes</th>
                                <th>Plazo en meses</th>
                                <th>Total Intereses</th>
                                <th>Pago Mensual</th>
                                <th>Tipo Credito</th>
                                <th>Visualizar</th>
                                <th>Eliminar</th>
                            </thead>
                            <?php
                            $id_usuario_logueado = $_SESSION['usuario_id'];
                            $sql = "SELECT s.`monto_prestamo`,s.`tasa_interes_anual`,s.`plazo_meses`,s.`total_intereses`,s.`pago_mensual`,tc.`nombreCredito`FROM`simulaciones` s JOIN`tipo_credito` tc ON s.`tipo_credito_id` = tc.`id_tipoCredito`WHERE s.`id_usuario` = '$id_usuario_logueado';";
                            $result = mysqli_query($conexionDB, $sql);

                            while ($mostrar = mysqli_fetch_array($result)) {

                            ?>
                                <tbody class="contentTable" id="contentTable">
                                    <td><?php echo $mostrar['monto_prestamo'] ?></td>
                                    <td><?php echo $mostrar['tasa_interes_anual'] ?></td>
                                    <td><?php echo $mostrar['plazo_meses'] ?></td>
                                    <td><?php echo $mostrar['total_intereses'] ?></td>
                                    <td><?php echo $mostrar['pago_mensual'] ?></td>
                                    <td><?php echo $mostrar['nombreCredito'] ?></td>
                                    <td><a href=""><i class="fas fa-eye"></i></a></td>
                                    <td><a href=""><i class="fas fa-trash"></i></a></td>
                                </tbody>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </section>
        </section>
    </div>

    <script src="js/main.js"></script>
</body>

</html>