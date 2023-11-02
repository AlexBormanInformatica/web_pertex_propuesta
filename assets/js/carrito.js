// Obtén una referencia al "Seleccionar todos" y a todos los checkboxes de fila.
const seleccionarTodos = document.getElementById("seleccionar-todos");
const checkboxesFilas = document.querySelectorAll(".seleccionar-fila");
const spanSumaSubtotal = document.getElementById("sumaSubtotal");

// Agrega un controlador de eventos al "Seleccionar todos" para manejar los clics.
seleccionarTodos.addEventListener("click", function () {
    // Recorre todos los checkboxes de fila y establece su estado de marcado según el "Seleccionar todos".
    checkboxesFilas.forEach(function (checkbox) {
        checkbox.checked = seleccionarTodos.checked;
        calcularSumaSubtotal();
    });
});

// Agrega un controlador de eventos a cada checkbox de fila.
checkboxesFilas.forEach(function (checkbox) {
    checkbox.addEventListener("click", function () {
        // Verifica si todos los checkboxes de fila están marcados.
        const todosMarcados = Array.from(checkboxesFilas).every((cb) => cb.checked);
        // Marca o desmarca el "Seleccionar todos" en función de la condición.
        seleccionarTodos.checked = todosMarcados;
        calcularSumaSubtotal();
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