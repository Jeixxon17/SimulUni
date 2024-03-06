<?php
    require('db/database.php');
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8" />
      <title>OmniCred | Inicio</title>
      <link rel="stylesheet" href="style/style.css" />
      <link rel="shortcut icon" href="img/Omnicred.ico" type="image/x-icon">
      <!-- Font Awesome Cdn Link -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    </head>
    <body id="body-login">
        <main>
            <input type="checkbox" id="chk" aria-hidden="true">
            
            <div class="signup">
                <form action="php/registrarUsuario.php" method="post">
                    <label for="chk" aria-hidden="true">Registrate</label>
                    <input type="text" name="nombre" id="" placeholder="Ingrese su Nombre" required>
                    <input type="email" name="email" placeholder="Ingrese su correo" required>
                    <input type="password" name="contra" placeholder="Ingrese su contraseña" required>
                    <input type="password" name="confirmacontra" placeholder="Ingrese nuevamente la contraseña" required>
                    <button>Registrarse</button>
                </form>
            </div>
            <div class="login">
                <form action="php/iniciarsesion.php" method="post">
                    <label for="chk" aria-hidden="true">Inicia Sesion</label>
                    <input type="email" name="email" placeholder="Ingrese su correo" required>
                    <input type="password" name="contra" placeholder="Ingrese su contraseña" required>
                    <button>Ingresar</button>
                    <p>Aun no tiene una cuenta <a href="">Crear una</a>.</p>
                </form>
            </div>
        </main>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </html>