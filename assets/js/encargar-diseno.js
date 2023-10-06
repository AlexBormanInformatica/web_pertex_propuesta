//Dinamismo del formulario encargar-diseño
//Global de la tecnica
const selectProducto = document.getElementById('tecnica');
const inputCantidad = document.getElementById('cantidad');

(function ($) {

  //Si vienen del producto, por ejemplo el botón "Comprar mobtrans"->Cargar formulario automaticamente con el mobtrans elegido
  // Obtén el parámetro "prd" de la URL
  const urlParams = new URLSearchParams(window.location.search);
  const productoSeleccionado = urlParams.get('prd');
  //Marcar elección de técnica
  selectProducto.value = productoSeleccionado;

  // Paso 1: elegir la técnica
  // Detecta el cambio en el elemento <select> de la técnica
  selectProducto.addEventListener('change', function () {
    // Relleno los campos de la tabla resumen
    // La técnica elegida
    document.getElementById('resumenTecnica').innerText = $('#tecnica option:selected').text().trim();
    // El molde de la técnica elegida
    document.getElementById('resumenMoldeProducto').innerText = $('select[name="tecnica"] :selected').attr('class').split(' ')[1] + " €";

    //Verifico si los campos de la parte 1 están completos
    verificarPaso1();

    cargarCamposProducto();
  });

  // Detecta cuando escriban en el <input> cantidad
  inputCantidad.addEventListener('input', function () {
    // Realiza una solicitud AJAX al servidor para enviar el ID del producto y obtener la cantidad minima del producto
    $.ajax({
      method: "POST",
      url: "funciones/functions.php",
      data: {
        cantidadMinima: "", idproducto: $('select[name="tecnica"] :selected').val()
      }
    }).done(function (response) {
      //Verifico que la cantidad introducida sea mayor que el mínimo de la técncia
      console.log(response);
      if (inputCantidad.value > 0 && inputCantidad.value >= response) {
        // Relleno los campos de la tabla resumen
        // La cantidad introducida 
        document.getElementById('resumenCantidad').innerText = inputCantidad.value;

        verificarPaso1();
      } else {
        $('#errorCantidad').show();
        $('#errorCantidad').text("La cantidad mínima debe ser de " + response);
      }
    });
  });


  //Sabiendo la tecnica seleccionada dentro del paso 1, cargamos los siguientes pasos con la información necesaria


})(jQuery);

function verificarPaso1() {
  // Encuentra el elemento por su clase
  const elemento = document.querySelector('.paso1');

  if (selectProducto.value != "" && inputCantidad.value > 0) {
    // Cambia la clase
    elemento.classList.remove('paso-incompleto');
    elemento.classList.add('paso-completo');

    // Cambia el contenido de texto
    elemento.textContent = 'COMPLETO';
  } else {
    // Cambia la clase
    elemento.classList.remove('paso-completo');
    elemento.classList.add('paso-incompleto');

    // Cambia el contenido de texto
    elemento.textContent = 'INCOMPLETO';
  }
}

function cargarCamposProducto() {
  // Muestro el icono de informacion de la técnica
  // $('#informacionDeLaTecnica').show();


}

// Función para actualizar la tabla (resumen/presupuesto) según las selecciones del usuario
function actualizarTabla() {
  // Referencias de las celdas que necesitas actualizar
  const paso1 = document.getElementById('paso1');
  const paso2 = document.getElementById('paso2');
  const paso3 = document.getElementById('paso3');
  const paso4 = document.getElementById('paso4');
  const subtotal = document.getElementById('subtotal');

  // Simula las selecciones del usuario (puedes obtener estos valores de tu formulario)
  const seleccionPaso1 = {
    tecnica: document.getElementById('tecnica').value,
    molde: document.getElementById('molde').value,
    cantidad: document.getElementById('cantidad').value,
  };

  const seleccionPaso2 = {
    ancho: document.getElementById('tecnica').value,
    alto: document.getElementById('tecnica').value,
    superficie: document.getElementById('tecnica').value,
    precio: document.getElementById('tecnica').value,
  };

  const seleccionPaso3 = {
    ancho: document.getElementById('tecnica').value,
    alto: document.getElementById('tecnica').value,
    superficie: document.getElementById('tecnica').value,
    precio: document.getElementById('tecnica').value,
  };

  const seleccionPaso4 = {
    ancho: document.getElementById('tecnica').value,
    alto: document.getElementById('tecnica').value,
    superficie: document.getElementById('tecnica').value,
    precio: document.getElementById('tecnica').value,
  };

  // Actualiza las celdas con los datos seleccionados
  paso1.innerHTML = `
      <td>Técnica: ${seleccionPaso1.tecnica}</td>
      <td>Molde del producto</td>
      <td>${seleccionPaso1.molde}</td>
    `;

  paso2.innerHTML = `
      <td>Ancho: ${seleccionPaso2.ancho}</td>
      <td>Alto: ${seleccionPaso2.alto}</td>
      <td>Superficie: ${seleccionPaso2.superficie}</td>
      <td>Precio (6,845€/ud): ${seleccionPaso2.precio}</td>
    `;

  paso3.innerHTML = `
      <td>N/A</td>
      <td></td>
    `;

  paso4.innerHTML = `
      <td></td>
      <td></td>
    `;

  // Actualiza el subtotal
  subtotal.innerHTML = `
      <th colspan="2" style="text-align: right;">SUBTOTAL</th>
      <th>704,500 €</th>
    `;
}