<?php
session_start();
include("../db/database.php");

$emailUser = $_POST['email'];
$passwordUser = $_POST['contra'];

// Consulta preparada para evitar inyección SQL
$stmt = $conexionDB->prepare("SELECT id, nombre, contrasena FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $emailUser);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    // Verificar la contraseña encriptada
    if (password_verify($passwordUser, $row['contrasena'])) {
        $_SESSION['usuario_id'] = $row['id'];
        $_SESSION['nombre'] = $row['nombre'];
        header("location: ../dashboard.php");
        exit;
    } else {
        // Contraseña incorrecta
        echo '<script>alert("La contraseña es incorrecta");window.location = "../index.php";</script>';
    }
} else {
    // Usuario no encontrado
    echo '<script>alert("El usuario no fue encontrado");window.location = "../index.php";</script>';
}

$stmt->close();
$conexionDB->close();

