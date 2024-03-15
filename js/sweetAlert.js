// Funcion AJAX con Sweet Alert para el formulario de Registrar Usuario en Index.php
$(document).ready(function() {
    $('#registro-form').submit(function(event) {
        event.preventDefault(); // Evita que el formulario se envíe de forma tradicional

        // Obtener los datos del formulario
        var formData = $(this).serialize();

        // Enviar los datos mediante AJAX al script de registro
        $.ajax({
            type: 'POST',
            url: 'php/registrarUsuario.php',
            data: formData,
            success: function(response) {
                // Mostrar la alerta según la respuesta del servidor
                if (response == 'exito') {
                    Swal.fire('¡Éxito!', 'El usuario se registró correctamente.', 'success').then(function() {
                        window.location = 'index.php'; // Redirecciona al index después de cerrar la alerta
                    });
                } else {
                    Swal.fire('¡Error!', response, 'error'); // Muestra el mensaje de error devuelto por el servidor
                }
            }
        });
    });
});


// Funcion AJAX con Sweet Alert para el formulario de Iniciar sesion en Index.php
$(document).ready(function() {
    $('#iniciar-form').submit(function(event) {
        event.preventDefault(); // Evita que el formulario se envíe de forma tradicional

        // Obtener los datos del formulario
        var formData = $(this).serialize();

        // Enviar los datos mediante AJAX al script de registro
        $.ajax({
            type: 'POST',
            url: 'php/iniciarsesion.php',
            data: formData,
            success: function(response) {
                // Mostrar la alerta según la respuesta del servidor
                if (response == 'exito') {
                    window.location = 'dashboard.php';
                } else {
                    Swal.fire('¡Error!', response, 'error').then(function() {
                        window.location = 'index.php'; // Redirecciona al index después de cerrar la alerta
                    });
                }
            }
        });
    });
});