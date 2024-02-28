<?php
    include('../db/database.php');

            $nameUser = $_POST['nombre'];
            $emailUser = $_POST['email'];
            $passwordUser = $_POST['contra'];
            $confirmPass = $_POST['confirmacontra'];
            
        
            if ($confirmPass === $passwordUser) {
                $encripPass = password_hash($passwordUser, PASSWORD_DEFAULT);
        
                $query = "INSERT INTO usuarios(nombre,email,contrasena)
                        VALUES ('$nameUser', '$emailUser', '$encripPass')";
            }else{
                echo '<script>
                        alert("Las Contraseñas No Coinciden");
                        window.location = "../index.php";
                    </script>';
            }
        
            $execute = mysqli_query($conexionDB ,$query);
            if ($execute ) {
                echo '<script>
                        alert("Usuario Ingresado Correctamente");
                        window.location = "../index.php";
                    </script>';
            }
        
            mysqli_close($conexionDB);
?>