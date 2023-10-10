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

    //Verifico la cantidad(si existe) según la técnica
    //Verifico si los campos de la parte 1 están completos
    verificarCantidad();

    //Cargo los campos de la técnica para cada paso
    cargarCamposSegunTecnica();

    //Sumo los precios para el subtotal
    sumaSubtotal();
  });

  // Detecta cuando escriban en el <input> cantidad
  inputCantidad.addEventListener('input', function () {
    //Verifico la cantidad(si existe) según la técnica
    //Verifico si los campos de la parte 1 están completos
    verificarCantidad();

    //Como de la cantidad depende el precio del producto (y bases, si desea el usuario), recalculo
    //los precios con la nueva cantidad
    calcularPrecios();
  });


  //Sabiendo la tecnica seleccionada dentro del paso 1, cargamos los siguientes pasos con la información necesaria


})(jQuery);


function cargarCamposSegunTecnica() {
  // Para el paso 2 complementos

  //¿Puede tener topes?
  if ($('select[name="tecnica"] :selected').attr('class').split(' ')[5] == 1) {
    $('#topePulsera').show();
  } else {
    //¿El producto admite base? Si es así ¿qué tipo de base admite?
    $.ajax({
      method: "POST",
      url: "funciones/functions.php",
      dataType: 'json',
      data: {
        buscarBases: "", idproducto: $('select[name="tecnica"] :selected').val()
      }
    }).done(function (response) {
      //Verifico que la cantidad introducida sea mayor que el mínimo de la técncia
      for (var i = 0; i < response.length; i++) {
        console.log(response[i]);
      }
      
      });
  }



}

/**
 * Por medio de una solicitud AJAX busco en la BBDD la cantidad mínima para la técnica elegida y la comparo con la 
 * que introduce el usuario. 
 */
function verificarCantidad() {
  // Realiza una solicitud AJAX al servidor para enviar el ID del producto y obtener la cantidad minima del producto
  $.ajax({
    method: "POST",
    url: "funciones/functions.php",
    data: {
      cantidadMinima: "", idproducto: $('select[name="tecnica"] :selected').val()
    }
  }).done(function (response) {
    //Verifico que la cantidad introducida sea mayor que el mínimo de la técncia
    response = response.trim();
    if (parseInt(inputCantidad.value) > 0 && parseInt(inputCantidad.value) >= parseInt(response)) {
      //Oculto el texto de error
      $('#errorCantidad').hide();
      // Relleno los campos de la tabla resumen
      // La cantidad introducida 
      document.getElementById('resumenCantidad').innerText = inputCantidad.value;
    } else {
      //Limpio el campo de la tabla resumen
      document.getElementById('resumenCantidad').innerText = "";
      //Asigno texto de error y lo muestro
      $('#errorCantidad').text("La cantidad mínima debe ser de " + response);
      $('#errorCantidad').show();
    }

    //Por último verifico todo el paso 1
    verificarPaso1();
  });
}

/**
 * Si hay una técnica elegida, y cantidad correctamente asignada, el paso 1 pasa a COMPLETO
 */
function verificarPaso1() {
  // Encuentra el elemento por su clase
  const elemento = document.querySelector('.paso1');

  if (selectProducto.value != "" && document.getElementById('resumenCantidad').innerText != "") {
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


function sumaSubtotal() {
  // Filas de la tabla resumen/presupuesto
  var filas = document.querySelectorAll('table tr');
  // Variable para almacenar la suma
  var suma = 0;

  // Recorre las filas de la tabla
  for (var i = 0; i < filas.length; i++) {
    // Obtén la tercera celda de la fila actual
    var terceraCelda = filas[i].cells[1];
    // Verifica si la tercera celda existe
    if (terceraCelda) {
      // Busca el elemento span dentro de la tercera celda
      var spanPrecio = terceraCelda.querySelector('span');
      // Verifica si el elemento span existe y tiene contenido
      if (spanPrecio) {
        var precioTexto = spanPrecio.textContent.trim();
        // Verifica si el precio no está vacío y contiene el símbolo €
        if (precioTexto !== '') {
          // Extrae el número del texto y lo convierte a un número flotante
          var precio = parseFloat(precioTexto.replace('€', '').trim());

          // Verifica que el resultado sea un número válido
          if (!isNaN(precio)) {
            // Suma el precio al subtotal
            suma += precio;
          }
        }
      }
    }
  }

  // Relleno el campo del subtotal de la tabla
  document.getElementById('resumenSubtotal').innerText = suma + " €";
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