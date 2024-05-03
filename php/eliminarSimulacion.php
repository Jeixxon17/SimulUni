<?php
// Iniciar sesión y conexión a la base de datos
session_start();
include('../db/database.php');

// Obtener el id del registro a eliminar
$id = $_GET['id'];

// Verificar si el usuario está autorizado para eliminar el registro
$id_usuario_logueado = $_SESSION['usuario_id'];
$sql_verificar = "SELECT COUNT(*) FROM simulaciones WHERE id = '$id' AND id_usuario = '$id_usuario_logueado'";
$resultado_verificar = mysqli_query($conexionDB, $sql_verificar);
$registro_existe = mysqli_fetch_row($resultado_verificar)[0];

if ($registro_existe > 0) {
    // El registro pertenece al usuario logueado, proceder con la eliminación
    $sql_eliminar = "DELETE FROM simulaciones WHERE id = $id";
    $resultado_eliminar = mysqli_query($conexionDB, $sql_eliminar);

    if ($resultado_eliminar) {
        // Registro eliminado exitosamente
        echo "exito";
    } else {
        // Error al eliminar el registro
        echo "Error al eliminar el registro: " . mysqli_error($conexionDB);
    }
} else {
    // El registro no pertenece al usuario logueado
    echo "No tienes permiso para eliminar este registro.";
}
?>