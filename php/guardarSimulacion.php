<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['nombre'])) {
    echo '<script>alert("No se ha iniciado sesión");</script>';
    header("location: index.php");
    exit();
}

// Conexión a la base de datos
include("../db/database.php");

// Obtener los datos de la simulación del cuerpo de la solicitud JSON
$jsonData = file_get_contents('php://input');
$simulacionData = json_decode($jsonData, true);

$monto = $simulacionData['monto'];
$tasa = $simulacionData['tasa'];
$plazo = $simulacionData['plazo'];
$ingresos = $simulacionData['ingresos'];
$cuota = $simulacionData['cuota'];
$tipoCredito = $simulacionData['tipoCredito'];

// Calcular los valores de total_intereses y abono_capital
$total_intereses = $cuota * $plazo - $monto;
$abono_capital = $monto;

// Suponiendo que $_SESSION['usuario_id'] contiene el ID del usuario actual
$id_usuario = $_SESSION['usuario_id'];

// Insertar los datos en la base de datos
$stmt = $conexionDB->prepare("INSERT INTO simulaciones (id_usuario, monto_prestamo, tasa_interes_anual, plazo_meses, frecuencia_pago, total_intereses, abono_capital, pago_mensual, tipo_credito_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$frecuenciaPago = 'Mensual';
$stmt->bind_param("iddsiiddi", $id_usuario, $monto, $tasa, $plazo, $frecuenciaPago, $total_intereses, $abono_capital, $cuota, $tipoCredito);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo '<script>alert("Simulación guardada exitosamente");</script>';
} else {
    echo "Error al guardar la simulación";
}

// Cerrar la conexión y liberar recursos
$stmt->close();
$conexionDB->close();
?>