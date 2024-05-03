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

$(document).ready(function() {
    // Evento click para los enlaces de eliminar simulación
    $('a[href^="php/eliminarSimulacion.php?id="]').on('click', function(event) {
        event.preventDefault(); // Evita que se siga el enlace

        // Obtener el id del registro a eliminar
        var id = $(this).attr('href').split('=')[1];

        // Mostrar la alerta de confirmación
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Esta acción no se puede deshacer',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Enviar la solicitud AJAX para eliminar el registro
                $.ajax({
                    type: 'GET',
                    url: 'php/eliminarSimulacion.php?id=' + id,
                    success: function(response) {
                        // Mostrar la alerta según la respuesta del servidor
                        if (response == 'exito') {
                            Swal.fire('¡Éxito!', 'El registro ha sido eliminado', 'success').then(function() {
                                window.location = 'configuration.php'; // Redirecciona al index después de cerrar la alerta
                            });
                        } else {
                            Swal.fire('¡Error!', response, 'error');
                        }
                    }
                });
            }
        });
    });
});
