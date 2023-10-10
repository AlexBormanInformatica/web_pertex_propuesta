//Dinamismo del formulario encargar-diseño
//Global de la tecnica
const selectProducto = document.getElementById('tecnica');
const inputCantidad = document.getElementById('cantidad');
const elementosBase = document.getElementsByName('base');
const anchoProductoInput = document.getElementById('anchoProductoInput');
const altoProducto = document.getElementById('altoProducto');
const anchoProductoSelect = document.getElementById('anchoProductoSelect');
var anchoInt = 0;
var altoInt = 0;

// Listener de los campos y dinamismo del formulario
(function ($) {
  //Si vienen del producto, por ejemplo el botón "Comprar mobtrans"->Cargar formulario automaticamente con el mobtrans elegido
  // Obtén el parámetro "prd" de la URL
  const urlParams = new URLSearchParams(window.location.search);
  const productoSeleccionado = urlParams.get('prd');
  //Marcar elección de técnica
  selectProducto.value = productoSeleccionado;

  // PASO 1: elegir la técnica + cantidad --------------------------------------------------------------------//
  // Detecta el cambio en el elemento <select> de la técnica
  selectProducto.addEventListener('change', function () {
    $('#hrefTecnica').show();
    //Enlace para más información
    document.getElementById('nombreTecnica').innerText = $('#tecnica option:selected').text().trim();
    document.getElementById('hrefTecnica').href = $('select[name="tecnica"] :selected').closest('optgroup').attr('label').toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, '');

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
    sumaSubtotal();
  });
  // FIN PASO 1 ------------------------------------------------------------------------------------------//

  // PASO 2: medidas-------------------------------------------------------------------------------------//
  //Detecta cuando escriban en el input ancho
  anchoProductoInput.addEventListener('input', function () {
    anchoInt = parseInt(anchoProductoInput.value);
    //Como los valores de minimos y maximos están almacenados en centimetros, multiplico *10 para manejarlo en milimetro
    var minimoIntAncho = parseInt($('select[name="tecnica"] :selected').attr('class').split(' ')[6]) * 10;
    var maximoIntAncho = parseInt($('select[name="tecnica"] :selected').attr('class').split(' ')[9]) * 10;
    //Si el ancho y alto no están vacíos, verifico que el ancho esté dentro el min y max, el alto dentro del min y max
    //Si es correcto el ancho y alto, calculo la superficie y calculo el precio
    /*
    [6] ancho minimo
    [7] alto minimo
    [8] ancho maximo
    [9] alto maximo
    */
    if (anchoInt >= minimoIntAncho && anchoInt <= maximoIntAncho) {
      //El ancho del input está dentro del mínimo y máximo de la técnica.
      anchoProductoInput.classList.remove('input-error');
      $('#errorAnchoProducto').hide();

      //Si altoInt y anchoInt > 0, calculo superficie y precio
      if (anchoInt > 0 && anchoInt > 0) {
        calcularSuperficieProducto();
      }
    } else {
      //El ancho del input está fuera del mínimo y máximo de la técnica. Saco mensaje de error.
      anchoProductoInput.classList.add('input-error');
      $('#errorAnchoProducto').text("El ancho debe ser mínimo " + minimoIntAncho + " milímetros y máximo " + maximoIntAncho + "milímetros");
      $('#errorAnchoProducto').show();
    }
  });

  //Detecta cuando seleccionan en el select ancho
  anchoProductoSelect.addEventListener('change', function () {

  });

  //Detecta cuando escriban en el input alto
  altoProducto.addEventListener('input', function () {
    altoInt = parseInt(altoProducto.value);
    //Como los valores de minimos y maximos están almacenados en centimetros, multiplico *10 para manejarlo en milimetro
    var minimoIntAlto = parseInt($('select[name="tecnica"] :selected').attr('class').split(' ')[7]) * 10;
    var maximoIntAlto = parseInt($('select[name="tecnica"] :selected').attr('class').split(' ')[9]) * 10;
    //Si el ancho y alto no están vacíos, verifico que el ancho esté dentro el min y max, el alto dentro del min y max
    //Si es correcto el ancho y alto, calculo la superficie y calculo el precio
    /*
    [6] ancho minimo
    [7] alto minimo
    [8] ancho maximo
    [9] alto maximo
    */
    if (altoInt >= minimoIntAlto && altoInt <= maximoIntAlto) {
      //El ancho del input está dentro del mínimo y máximo de la técnica.
      altoProducto.classList.remove('input-error');
      $('#errorAltoProducto').hide();

      //Si altoInt y anchoInt > 0, calculo superficie y precio
      if (altoInt > 0 && altoInt > 0) {
        calcularSuperficieProducto();
      }
    } else {
      //El ancho del input está fuera del mínimo y máximo de la técnica. Saco mensaje de error.
      altoProducto.classList.add('input-error');
      $('#errorAltoProducto').text("El alto debe ser mínimo " + minimoIntAlto + " milímetros y máximo " + maximoIntAlto + "milímetros");
      $('#errorAltoProducto').show();
    }
  });

  // FIN PASO 2: medidas--------------------------------------------------------------------------------//

  // PASO 3: complementos (bases y topes)--------------------------------------------------------------//
  //Detecta cuando seleccionen una base en el paso 3
  // Itera a través de la colección y agrega un evento a cada elemento
  for (var i = 0; i < elementosBase.length; i++) {
    elementosBase[i].addEventListener('input', function () {
      // Tu código de manejo de evento aquí
      // Obtén una referencia al elemento con el id 'paso3_rowspan'
      var thElement = document.getElementById('paso3_rowspan');
      // Cambia el valor de rowspan a un nuevo valor deseado
      thElement.rowSpan = "";

      //Oculto y vacío los campos primero
      $('#tdTipoBase').hide();
      $('#tdAnchoBase').hide();
      $('#tdAltoBase').hide();
      $('#tdSuperficieBase').hide();
      $('#tdColorBase').hide();
      document.getElementById('resumenTipoBase').innerText = "";
      thElement.rowSpan = "1";

      //Relleno el resumen depende la base elegida
      switch (this.value) {
        case "tela":
          $('#tdTipoBase').show();
          $('#tdAnchoBase').show();
          $('#tdAltoBase').show();
          $('#tdSuperficieBase').show();
          $('#tdColorBase').show();
          document.getElementById('resumenTipoBase').innerText = "Tela";
          thElement.rowSpan = "5";
          verificarBaseTela();
          break;
        case "gancho":
          $('#tdTipoBase').show();
          $('#tdColorBase').show();
          document.getElementById('resumenTipoBase').innerText = "Cierre gancho";
          thElement.rowSpan = "2";
          verificarBaseGancho();
          break;
        case "ganchopelo":
          $('#tdTipoBase').show();
          $('#tdColorBase').show();
          document.getElementById('resumenTipoBase').innerText = "Cierre gancho + pelo";
          thElement.rowSpan = "2";
          verificarBaseGancho();
          break;

      }

      verificarPaso3();
      //Calculo el precio si elige una base
      // calcularPrecios();
      sumaSubtotal();
    });
  }
  // FIN PASO 3-----------------------------------------------------------------------------------------------//

})(jQuery);

//----------------------------------------------------------------FUNCIONES----------------------------------------------------------------
function cargarCamposSegunTecnica() {
  // --------------------Para el PASO 2 diseño---------------------------
  //Oculto todos los campos primero
  $('#anchoPorAlto').hide(); //Div de medidas
  $('#divInputAncho').hide(); // Div de ancho (input)
  $('#divSelectAncho').hide(); // Div de ancho (select)

  // ¿La técnica seleccionada tiene ancho y alto (mínimos y máximos)? Sí = habilitar div medidas, No = deshabilito div medidas
  // [9] alto máximo = "" = sin medidas
  if ($('select[name="tecnica"] :selected').attr('class').split(' ')[9] == "") {
    $('#anchoPorAlto').hide();
  } else {
    $('#anchoPorAlto').show();

    if ($('select[name="tecnica"] :selected').attr('class').split(' ')[6] == "") {
      // [9] ancho mínimo = "" = el ancho se selecciona
      $('#divInputAncho').hide();
      $('#divSelectAncho').show();
    } else {
      // [9] ancho mínimo != "" = el ancho se escribe
      $('#divInputAncho').show();
      $('#divSelectAncho').hide();
    }


  }

  //¿El producto tiene formas? Sí = habilito las formas correspondientes al producto seleccionado
  $.ajax({
    method: "POST",
    url: "funciones/functions.php",
    dataType: 'json',
    data: {
      buscarFormas: "", idproducto: $('select[name="tecnica"] :selected').val()
    }
  }).done(function (response) {
    // if (response.length > 0) {
    //   for (var i = 0; i < response.length; i++) {
    //     //Muestro el div para la base
    //     $('#selectBase').show();

    //     //Muestro el o los div correspondientes segun la tecnica elgida
    //     switch (response[i]["id_complementos"].toString()) {
    //       case '1':
    //         $('#divTela').show();
    //         break;
    //       case '2':
    //         $('#divGancho').show();
    //         break;
    //       case '3':
    //         $('#divGanchoPelo').show();
    //         break;
    //     }
    //     $('#divSinBase').show();
    //   }

    // } else {
    //   $('#sincomplemento').show();
    // }

  });


  // --------------------Para el PASO 3 complementos---------------------------

  //Oculto todos los campos primero
  $('#topePulsera').hide(); //Div de topes
  $('#selectBase').hide(); // Div de bases
  $('#divTela').hide(); // Div base de tela
  $('#divGancho').hide(); // Div base de cierre gancho
  $('#divGanchoPelo').hide(); // Div base de cierre gancho + pelo
  $('#divSinBase').hide(); // Div sin base
  $('#sincomplemento').hide(); // Div sin complementos disponibles

  //¿Puede tener topes?
  //  [5] Tope == 1 = Sí
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
      if (response.length > 0) {
        for (var i = 0; i < response.length; i++) {
          //Muestro el div para la base
          $('#selectBase').show();

          //Muestro el o los div correspondientes segun la tecnica elgida
          switch (response[i]["id_complementos"].toString()) {
            case '1':
              $('#divTela').show();
              break;
            case '2':
              $('#divGancho').show();
              break;
            case '3':
              $('#divGanchoPelo').show();
              break;
          }
          $('#divSinBase').show();
        }

      } else {
        $('#sincomplemento').show();
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
      inputCantidad.classList.remove('input-error');
      //Oculto el texto de error
      $('#errorCantidad').hide();
      // Relleno los campos de la tabla resumen
      // La cantidad introducida 
      document.getElementById('resumenCantidad').innerText = inputCantidad.value;
    } else {
      inputCantidad.classList.add('input-error');
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
    pasoCompleto(elemento);
  } else {
    pasoIncompleto(elemento);
  }
}

/**
 * Si no hay complemento = COMPLETO
 * Si elige base de tela, las medidas son correctar y ha elegido color = COMPLETO
 * Si elige base de cierre gancho o cirre gancho + pelo y ha elegido color = COMPLETO
 */
function verificarPaso3() {
  // Encuentra el elemento por su clase
  const elemento = document.querySelector('.paso3');

  //Si ha elegido base de tela
  //Verifico que tenga las medidas (superficie) y haya elegido el color de la tela
  if (document.getElementById('resumenTipoBase').innerText == "Tela" &&
    document.getElementById('resumenSuperficieBase').innerText != "" &&
    document.getElementById('resumenColorBase').innerText != "") {
    pasoCompleto(elemento);
  } else if ((document.getElementById('resumenTipoBase').innerText == "Cierre gancho" &&
    document.getElementById('resumenColorBase').innerText != "") || (
      document.getElementById('resumenTipoBase').innerText == "Cierre gancho + pelo" &&
      document.getElementById('resumenColorBase').innerText != "")) {
    //Si ha elegido gancho o gancho pelo
    //Verifico que haya elegido el color
    pasoCompleto(elemento);
  } else if (document.getElementById('resumenCantidadTopes').innerText != "") {
    pasoCompleto(elemento);
  } else if (document.getElementById('resumenTipoBase').innerText == "") {
    pasoCompleto(elemento);
  }
}


function sumaSubtotal() {
  // Filas de la tabla resumen/presupuesto
  var filas = document.querySelectorAll('table tr');
  // Variable para almacenar la suma
  var suma = 0;

  // Recorre las filas de la tabla
  for (var i = 0; i < filas.length - 1; i++) {
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

function verificarBaseTela() {
  //En el caso de base de tela, se verifica primero las medidas:
  //El mínimo 
}


function pasoCompleto(elemento) {
  // Cambia la clasae
  elemento.classList.remove('paso-incompleto');
  elemento.classList.add('paso-completo');

  // Cambia el contenido de texto
  elemento.textContent = 'COMPLETO';
}

function pasoIncompleto(elemento) {
  // Cambia la clase
  elemento.classList.remove('paso-completo');
  elemento.classList.add('paso-incompleto');

  // Cambia el contenido de texto
  elemento.textContent = 'INCOMPLETO';
}

function calcularPrecios() {

}

function calcularSuperficieProducto() {

}