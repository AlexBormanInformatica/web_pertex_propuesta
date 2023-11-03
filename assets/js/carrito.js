// Obtén una referencia al "Seleccionar todos" y a todos los checkboxes de fila.
const seleccionarTodos = document.getElementById("seleccionar-todos");
const checkboxesFilas = document.querySelectorAll(".seleccionar-fila");
const spanSumaSubtotal = document.getElementById("sumaSubtotal");
const btnPagar = document.getElementById("btnPagar"); // Agrega una referencia al botón de pagar.
// Convierte la NodeList en un array.
const checkboxesArray = Array.from(checkboxesFilas);

// Agrega un controlador de eventos al "Seleccionar todos" para manejar los clics.
seleccionarTodos.addEventListener("click", function () {
    // Recorre todos los checkboxes de fila y establece su estado de marcado según el "Seleccionar todos".
    checkboxesArray.forEach(function (checkbox) {
        checkbox.checked = seleccionarTodos.checked;
        calcularSumaSubtotal();
    });
    // Habilita o deshabilita el botón de pagar según si al menos un checkbox está marcado.
    btnPagar.disabled = !checkboxesArray.some((cb) => cb.checked);
});

// Agrega un controlador de eventos a cada checkbox de fila.
checkboxesArray.forEach(function (checkbox) {
    checkbox.addEventListener("click", function () {
        // Verifica si todos los checkboxes de fila están marcados.
        const todosMarcados = checkboxesArray.every((cb) => cb.checked);
        // Marca o desmarca el "Seleccionar todos" en función de la condición.
        seleccionarTodos.checked = todosMarcados;
        calcularSumaSubtotal();
        // Habilita o deshabilita el botón de pagar según si al menos un checkbox está marcado.
        btnPagar.disabled = !checkboxesArray.some((cb) => cb.checked);
    });
});

// Función para calcular la suma del subtotal.
function calcularSumaSubtotal() {
    let suma = 0;

    // Recorre todas las filas y suma los subtotales de las filas seleccionadas.
    checkboxesFilas.forEach(function (checkbox, index) {
        if (checkbox.checked) {
            const fila = checkbox.parentElement.parentElement;
            const subtotal = parseFloat(fila.lastElementChild.textContent.replace('€', '').replace(',', '.').trim());
            suma += subtotal;
        }
    });

    // Muestra la suma en el span.
    spanSumaSubtotal.textContent = "€" + suma.toFixed(2).toString().replace('.', ',');
}

document.addEventListener("DOMContentLoaded", function () {
    // Seleccionar el formulario y los campos ocultos
    const formularioPago = document.getElementById("formularioPago");
    const disenosInput = document.getElementById("disenosInput");
    const subtotalInput = document.getElementById("subtotalInput");

    // Manejar el clic en el botón "Pagar"
    formularioPago.addEventListener("submit", function (event) {
        event.preventDefault();

        const filasSeleccionadas = document.querySelectorAll(".seleccionar-fila:checked");
        const idsDisenos = [];
        let sumaSubtotal = 0;

        // Obtener los números de diseño y sumar los subtotales de las filas seleccionadas
        filasSeleccionadas.forEach(function (fila) {
            const numeroDiseno = fila.closest("tr").querySelector("td:nth-child(2)").textContent;
            const subtotal = parseFloat(fila.closest("tr").querySelector("td:nth-child(5)").textContent.replace("€", "").replace(",", "."));
            idsDisenos.push(numeroDiseno);
            sumaSubtotal += subtotal;
        });

        // Establecer los valores de los campos ocultos
        disenosInput.value = idsDisenos.join(",");
        subtotalInput.value = sumaSubtotal;

        // Enviar el formulario
        formularioPago.submit();
    });
});