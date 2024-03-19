// Función para dar formato a un número como moneda
function formatCurrency(input) {
    // Obtener el valor del campo de entrada
    let value = input.value;
    // Reemplazar cualquier carácter que no sea un dígito o un punto decimal por una cadena vacía
    value = value.replace(/[^\d.]/g, '');
    // Dividir el valor en partes separando los decimales
    let parts = value.split('.');
    // Formatear la parte entera del número con comas cada tres dígitos
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    // Unir las partes nuevamente con el punto decimal
    input.value = parts.join('.');
}

// Obtener el campo de entrada
const inputCredit = document.getElementById('montodPrestamo');

// Escuchar el evento input para formatear el valor mientras se escribe
inputCredit.addEventListener('input', function () {
    formatCurrency(this);
});