<?php

    session_start();

    include("../db/database.php");

    $emailUser = $_POST['email'];
    $passwordUser = $_POST['contra'];

    $login = mysqli_query($conexionDB, "SELECT * FROM usuarios WHERE email='$emailUser' and contrasena='$passwordUser'");
    
    if ($login) {
        $_SESSION['nombre'] = $emailUser;
        header("location: ../dashboard.php");
        exit;
    }else{
        echo '<script>
                alert("El usuario no fue encontrado");
                window.location = "../index.php";
            </script>';
            exit;
    }
?>