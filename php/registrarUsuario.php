<?php
session_start();
include('../db/database.php');

$nameUser = $_POST['nombre'];
$emailUser = $_POST['email'];
$passwordUser = $_POST['contra'];
$confirmPass = $_POST['confirmacontra'];

// Verificar si el correo electrónico ya está registrado
$stmt = $conexionDB->prepare("SELECT id FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $emailUser);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // El correo electrónico ya está registrado
    echo "Este correo ya está registrado. Por favor, utiliza otro correo.";
} else {
    // Si las contraseñas coinciden, proceder con el registro
    if ($confirmPass === $passwordUser) {
        $encripPass = password_hash($passwordUser, PASSWORD_DEFAULT);
        $query = "INSERT INTO usuarios(nombre,email,contrasena) VALUES ('$nameUser', '$emailUser', '$encripPass')";
        $execute = mysqli_query($conexionDB, $query);

        if ($execute) {
            echo 'exito'; // Registro exitoso
        } else {
            echo 'Error al registrar usuario. Por favor, inténtalo de nuevo.';
        }
    } else {
        // Las contraseñas no coinciden
        echo 'Las Contraseñas No Coinciden';
    }
}

mysqli_close($conexionDB);
?>
