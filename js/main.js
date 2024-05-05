// Función para dar formato a un número como moneda
function formatCurrency(input) {
  // Obtener el valor del campo de entrada
  let value = input.value;
  // Reemplazar cualquier carácter que no sea un dígito o un punto decimal por una cadena vacía
  value = value.replace(/[^\d.]/g, "");
  // Dividir el valor en partes separando los decimales
  let parts = value.split(".");
  // Formatear la parte entera del número con comas cada tres dígitos
  parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  // Unir las partes nuevamente con el punto decimal
  input.value = parts.join(".");
}

// Obtener el campo de entrada
const inputCredit = document.getElementById("montodPrestamo");

// Escuchar el evento input para formatear el valor mientras se escribe
inputCredit.addEventListener("input", function () {
  formatCurrency(this);
});

$(window)
  .on("load resize ", function () {
    var scrollWidth =
      $(".tbl-content").width() - $(".tbl-content table").width();
    $(".tbl-header").css({ "padding-right": scrollWidth });
  })
  .resize();

function mostrarDatos() {
  const datosContent = document.querySelector(".datos-content");
  const simulacionContent = document.querySelector(".simulacion-content");
  const datosList = document.querySelector(".datos");
  const simulacionList = document.querySelector(".simulacion");

  datosContent.style.display = "block";
  simulacionContent.style.display = "none";
  datosList.classList.add("active");
  simulacionList.classList.remove("active");
}

function mostrarSimulacion() {
  const datosContent = document.querySelector(".datos-content");
  const simulacionContent = document.querySelector(".simulacion-content");
  const datosList = document.querySelector(".datos");
  const simulacionList = document.querySelector(".simulacion");

  datosContent.style.display = "none";
  simulacionContent.style.display = "block";
  datosList.classList.remove("active");
  simulacionList.classList.add("active");
}

//   MOSTRAR DATOS DE SIMULACIONES GENERADAS
function obtenerDatos() {
  let input = document.getElementById("campo").value;
  let content = document.getElementById("contentTable");
  let url = "mostrarSimulacion.php";
  let formData = new FormData();
  formData.append("campo", input);

  fetch(url, {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      content.innerHTML = data;
    })
    .catch((err) => console.log(err));
}

