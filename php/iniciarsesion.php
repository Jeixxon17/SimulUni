<?php
session_start();
include("../db/database.php");

$emailUser = $_POST['email'];
$passwordUser = $_POST['contra'];

// Consulta preparada para evitar inyección SQL
$stmt = $conexionDB->prepare("SELECT id, nombre, email, contrasena FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $emailUser);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    // Verificar la contraseña encriptada
    if (password_verify($passwordUser, $row['contrasena'])) {
        $_SESSION['usuario_id'] = $row['id'];
        $_SESSION['nombre'] = $row['nombre'];
        $_SESSION['email'] = $row['email'];
        echo 'exito';
        exit;
    } else {
        // Contraseña incorrecta
        echo 'La contraseña es incorrecta';
    }
} else {
    // Usuario no encontrado
    echo 'El usuario no fue encontrado';
}

$stmt->close();
$conexionDB->close();

