//Dinamismo del formulario encargar-diseño

//Globales del formulario
const selectProducto = document.getElementById('tecnica');
const inputCantidad = document.getElementById('cantidad');
const elementosBase = document.getElementsByName('base');
const elementosTope = document.getElementsByName('tope');
const elementosFormas = document.getElementsByName('formas');
const anchoProductoInput = document.getElementById('anchoProductoInput');
const altoProducto = document.getElementById('altoProducto');
const anchoProductoSelect = document.getElementById('anchoProductoSelect');
const anchoBaseInput = document.getElementById('anchoBaseInput');
const altoBaseInput = document.getElementById('altoBaseInput');
const inputCantidadTopes = document.getElementById('cantidadTopes');
//Valores
var coloresSeleccionados = [];
var colorMetalSeleccionado = [];
var colorPielSeleccionado = [];
var colorBaseSeleccionado = [];
var maximoColores = 0;
var anchoInt = 0;
var altoInt = 0;
var superficie = 0;
var anchoBaseInt = 0;
var altoBaseInt = 0;
var superficieBase = 0;
//Tabla resumen
var paso1_rowspan = document.getElementById('paso1_rowspan');
var paso2_rowspan = document.getElementById('paso2_rowspan');
var paso3_rowspan = document.getElementById('paso3_rowspan');
var paso4_rowspan = document.getElementById('paso4_rowspan');
//Booleanos que determinarán qué necesita según la técnica
var colores_limitados = false;
var colorPiel = false;
var colorMetal = false;
var medidas = false;
var forma = false;
var medidasBase = false;
var colorBase = false;
var cantidadTopes = false;


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
    sumaSubtotal();
  });

  /*
  Detectar cambios en los colores a elegir del paso 1
  */
  document.getElementById("coloresProducto").addEventListener("change", function (event) {
    //Verifico que la selección sea de los colores
    if (event.target.type === "checkbox" && event.target.name === "colores") {
      const valor = event.target.value;

      if (event.target.checked) {
        //Si esta seleccionado y la lista aun no está llena, lo agrego
        if (coloresSeleccionados.length < maximoColores) {
          coloresSeleccionados.push(valor);
        } else {
          //Si la lista está llena saco un mensaje "No puedes seleccioanr más de X colores"
          event.target.checked = false;
        }
      } else {
        //Si no es seleccion, lo elimino de la lista
        const index = coloresSeleccionados.indexOf(valor);
        if (index > -1) {
          coloresSeleccionados.splice(index, 1);
        }
      }

      //Imprimo la lista en la tabla resumen
      document.getElementById('resumenColores').innerText = coloresSeleccionados;

    }
    verificarPaso1();
  });

  /*
  Detectar cambios en los colores a elegir para el soporte de piel del paso 1
  */
  document.getElementById("coloresPiel").addEventListener("change", function (event) {
    //Verifico que la selección sea de los colores
    if (event.target.type === "checkbox" && event.target.name === "colorpiel") {
      const valor = event.target.value;

      if (event.target.checked) {
        //Si esta seleccionado y la lista aun no está llena, lo agrego
        if (colorPielSeleccionado.length < 1) {
          colorPielSeleccionado.push(valor);
        } else {
          //Si la lista está llena saco un mensaje "No puedes seleccioanr más de X colores"
          event.target.checked = false;
        }
      } else {
        //Si no es seleccion, lo elimino de la lista
        const index = colorPielSeleccionado.indexOf(valor);
        if (index > -1) {
          colorPielSeleccionado.splice(index, 1);
        }
      }

      //Imprimo la lista en la tabla resumen
      document.getElementById('resumenColorPiel').innerText = colorPielSeleccionado;

    }
    verificarPaso1();
  });

  /*
  Detectar cambios en los colores a elegir para le modulo de metal del paso 1
  */
  document.getElementById("coloresMetal").addEventListener("change", function (event) {
    //Verifico que la selección sea de los colores
    if (event.target.type === "checkbox" && event.target.name === "colormetal") {
      const valor = event.target.value;

      if (event.target.checked) {
        //Si esta seleccionado y la lista aun no está llena, lo agrego
        if (colorMetalSeleccionado.length < 1) {
          colorMetalSeleccionado.push(valor);
        } else {
          //Si la lista está llena saco un mensaje "No puedes seleccioanr más de X colores"
          event.target.checked = false;
        }
      } else {
        //Si no es seleccion, lo elimino de la lista
        const index = colorMetalSeleccionado.indexOf(valor);
        if (index > -1) {
          colorMetalSeleccionado.splice(index, 1);
        }
      }

      //Imprimo la lista en la tabla resumen
      document.getElementById('resumenColorMetal').innerText = colorMetalSeleccionado;

    }
    verificarPaso1();
  });
  // FIN PASO 1 ------------------------------------------------------------------------------------------//

  // PASO 2: medidas-------------------------------------------------------------------------------------//
  //Detecta cuando escriban en el input ancho
  anchoProductoInput.addEventListener('input', function () {
    anchoInt = parseInt(anchoProductoInput.value);
    //Como los valores de minimos y maximos están almacenados en centimetros, multiplico *10 para manejarlo en milimetro
    var minimoIntAncho = parseInt($('select[name="tecnica"] :selected').attr('class').split(' ')[5]) * 10;
    var maximoIntAncho = parseInt($('select[name="tecnica"] :selected').attr('class').split(' ')[7]) * 10;
    //Si el ancho y alto no están vacíos, verifico que el ancho esté dentro el min y max, el alto dentro del min y max
    //Si es correcto el ancho y alto, calculo la superficie y calculo el precio
    /*
    [5] ancho minimo
    [6] alto minimo
    [7] ancho maximo
    [8] alto maximo
    */
    if (anchoInt >= minimoIntAncho && anchoInt <= maximoIntAncho) {
      //El ancho del input está dentro del mínimo y máximo de la técnica.
      anchoProductoInput.classList.remove('input-error');
      $('#errorAnchoProducto').hide();

      //Si altoInt y anchoInt > 0, calculo superficie y precio
      if (altoInt != "" && anchoInt != "" && altoInt > 0 && altoInt > 0 && document.getElementById('resumenCantidad').innerText != "") {
        calcularSuperficieProducto();
      } else {
        limpiarPaso2Medidas();
      }
    } else {
      limpiarPaso2Medidas();
      //El ancho del input está fuera del mínimo y máximo de la técnica. Saco mensaje de error.
      anchoProductoInput.classList.add('input-error');
      $('#errorAnchoProducto').text("El ancho debe ser mínimo " + minimoIntAncho + " milímetros y máximo " + maximoIntAncho + " milímetros");
      $('#errorAnchoProducto').show();
    }
  });

  //Detecta cuando seleccionan en el select ancho
  anchoProductoSelect.addEventListener('change', function () {
    anchoInt = parseInt(anchoProductoSelect.value);
    if (anchoInt != "") {
      //Ha seleccionado un ancho del select
      anchoProductoSelect.classList.remove('input-error');
      $('#errorAnchoProducto').hide();

      //Si altoInt y anchoInt > 0, calculo superficie y precio
      if (altoInt != "" && anchoInt != "" && altoInt > 0 && altoInt > 0 && document.getElementById('resumenCantidad').innerText != "") {
        calcularSuperficieProducto();
      } else {
        limpiarPaso2Medidas();
      }
    } else {
      limpiarPaso2Medidas();
      //El ancho del input está fuera del mínimo y máximo de la técnica. Saco mensaje de error.
      anchoProductoSelect.classList.add('input-error');
      $('#errorAnchoProducto').text("Selecciona el ancho.");
      $('#errorAnchoProducto').show();
    }
  });

  //Detecta cuando escriban en el input alto
  altoProducto.addEventListener('input', function () {
    altoInt = parseInt(altoProducto.value);
    //Como los valores de minimos y maximos están almacenados en centimetros, multiplico *10 para manejarlo en milimetro
    var minimoIntAlto = parseInt($('select[name="tecnica"] :selected').attr('class').split(' ')[6]) * 10;
    var maximoIntAlto = parseInt($('select[name="tecnica"] :selected').attr('class').split(' ')[8]) * 10;
    //Si el ancho y alto no están vacíos, verifico que el ancho esté dentro el min y max, el alto dentro del min y max
    //Si es correcto el ancho y alto, calculo la superficie y calculo el precio
    /*
    [5] ancho minimo
    [6] alto minimo
    [7] ancho maximo
    [8] alto maximo
    */
    if (altoInt >= minimoIntAlto && altoInt <= maximoIntAlto) {
      //El ancho del input está dentro del mínimo y máximo de la técnica.
      altoProducto.classList.remove('input-error');
      $('#errorAltoProducto').hide();

      //Si altoInt y anchoInt > 0, calculo superficie y precio
      if (altoInt != "" && anchoInt != "" && altoInt > 0 && altoInt > 0 && document.getElementById('resumenCantidad').innerText != "") {
        calcularSuperficieProducto();
      } else {
        limpiarPaso2Medidas();
      }
    } else {
      limpiarPaso2Medidas();
      //El ancho del input está fuera del mínimo y máximo de la técnica. Saco mensaje de error.
      altoProducto.classList.add('input-error');
      $('#errorAltoProducto').text("El alto debe ser mínimo " + minimoIntAlto + " milímetros y máximo " + maximoIntAlto + " milímetros");
      $('#errorAltoProducto').show();
    }
  });

  // Detecta cuando seleccionen una forma
  // Itera a través de la colección y agrega un evento a cada elemento
  for (var i = 0; i < elementosFormas.length; i++) {
    elementosFormas[i].addEventListener('input', function () {
      if (this.checked) {
        var nombreForma = $(this).closest('div').find('p').text();
        document.getElementById('resumenFormaProducto').innerText = nombreForma;

        //Busco si el precio va por la forma, y lo meustro de ser asi
        $.ajax({
          method: "POST",
          url: "funciones/functions.php",
          data: {
            precioPorForma: "", id_producto: $('select[name="tecnica"] :selected').val(), cantidad: inputCantidad.value, id_forma: this.value
          }
        }).done(function (response) {
          response = response.trim();

          //Relleno los campos
          if (response != "") {
            document.getElementById('resumenPPU').innerText = response.replace(".", ",");
            document.getElementById('resumenPrecioProducto').innerText = (parseFloat(response) * parseInt(inputCantidad.value)).toFixed(2).replace(".", ",") + " €";
          }

          //Por último verifico todo el paso 2
          verificarPaso2();
        });
      }
    });
  }
  // FIN PASO 2: medidas--------------------------------------------------------------------------------//

  // PASO 3: complementos (bases y topes)--------------------------------------------------------------//
  // Detecta cuando seleccionen una base en el paso 3
  // Itera a través de la colección y agrega un evento a cada elemento
  for (var i = 0; i < elementosBase.length; i++) {
    elementosBase[i].addEventListener('input', function () {
      // Referencia al elemento con el id 'paso3_rowspan'
      // Cambia el valor de rowspan a un nuevo valor deseado
      colorBaseSeleccionado.length = 0; // Vacio la lista de colores 
      document.getElementById('resumenColorBase').innerText = colorBaseSeleccionado; // Asigno la lista vacia
      paso3_rowspan.rowSpan = "";
      medidasBase = false;
      colorBase = false;
      superficieBase = 0;
      anchoBaseInt = 0;
      altoBaseInt = 0;
      //Oculto y vacío los campos primero
      limpiarBaseTelaMedidas();
      $('#tdTipoBase').hide();// Tipo de base (resumen)
      $('#divMedidasTela').hide();// Div medidas de la tela
      $('#tdAnchoBase').hide();// Ancho base de tela (resumen)
      $('#tdAltoBase').hide();// Alto base de tela (resumen)
      $('#tdSuperficieBase').hide(); // Superficie base de tela (resumen)
      $('#tdColorBase').hide();//Color base (resumen)
      $('#tdMoldeBase').hide();// Molde de la base(resumen)
      $('#tdPrecioComplemento').hide();// Precio de la base(resumen)
      $('#divColoresBase').hide();//Div colores
      document.getElementById('resumenPrecioComplemento').innerText = "";
      document.getElementById('resumenTipoBase').innerText = "";
      paso3_rowspan.rowSpan = "1";

      //Busco los colores de la base elegida y relleno el div
      $.ajax({
        method: "POST",
        url: "funciones/functions.php",
        dataType: 'json',
        data: {
          buscarColorBase: "", idbase: this.value
        }
      }).done(function (response) {
        // Obtén el contenedor donde deseas mostrar los colores
        const colorContainer = document.getElementById("coloresBase");
        colorContainer.innerHTML = "";
        // Recorre el arreglo de colores y crea elementos <div>
        response.forEach((color, index) => {
          // Accede a las propiedades RGB de cada objeto de color
          const rgb_R = color[0].rgb_R;
          const rgb_G = color[0].rgb_G;
          const rgb_B = color[0].rgb_B;
          const nombre = color[0].nombre;
          const id = color[0].id;

          // Crea un nuevo elemento div
          const colorDiv = document.createElement('div');
          colorDiv.className = `colores col-lg-color col-md-4 col-sm-6`;

          // Crea un elemento label
          const label = document.createElement('label');
          label.className = 'cuadrado';
          label.setAttribute('data-title', `${nombre}`);

          // Crea un elemento input (checkbox)
          const checkbox = document.createElement('input');
          checkbox.name = 'colorbase';
          checkbox.id = `${nombre}`;
          checkbox.value = `${nombre}`;
          checkbox.type = 'checkbox';

          // Crea un elemento span para el checkmark
          const checkmark = document.createElement('span');
          checkmark.className = 'checkmark';
          // Establece el color de fondo del elemento <div> utilizando los valores RGB
          const rgbColor = `rgb(${rgb_R}, ${rgb_G}, ${rgb_B})`;
          checkmark.style.backgroundColor = rgbColor;

          // Agrega el checkbox y el checkmark al label
          label.appendChild(checkbox);
          label.appendChild(checkmark);

          // Agrega el label al div de color
          colorDiv.appendChild(label);
          // Agrega el elemento <div> al contenedor
          colorContainer.appendChild(colorDiv);
        });
      })

      //Busco el molde de la base elegida y relleno el campo + suma del subtotal
      $.ajax({
        method: "POST",
        url: "funciones/functions.php",
        dataType: 'json',
        data: {
          buscarMoldeBase: "", idbase: this.value
        }
      }).done(function (response) {
        document.getElementById("resumenMoldeBase").innerText = response.toString().trim() + " €";
        sumaSubtotal();
      });

      //Relleno el resumen depende la base elegida
      switch (this.value) {
        case "1":
          superficieBase = 0;
          medidasBase = true;
          colorBase = true;
          $('#divColoresBase').show();
          $('#divMedidasTela').show();
          $('#tdTipoBase').show();
          $('#tdAnchoBase').show();
          $('#tdAltoBase').show();
          $('#tdSuperficieBase').show();
          $('#tdColorBase').show();
          $('#tdMoldeBase').show();
          $('#tdPrecioComplemento').show();
          document.getElementById('resumenTipoBase').innerText = "Tela";
          paso3_rowspan.rowSpan = "7";
          pasoIncompleto(document.querySelector('.paso3'));
          calcularSuperficieTela();
          break;
        case "2":
          superficieBase = superficie;
          colorBase = true;
          $('#divColoresBase').show();
          $('#tdTipoBase').show();
          $('#tdColorBase').show();
          $('#tdMoldeBase').show();
          $('#tdPrecioComplemento').show();
          document.getElementById('resumenTipoBase').innerText = "Cierre gancho";
          paso3_rowspan.rowSpan = "4";
          pasoIncompleto(document.querySelector('.paso3'));
          break;
        case "3":
          superficieBase = superficie;
          colorBase = true;
          $('#divColoresBase').show();
          $('#tdTipoBase').show();
          $('#tdColorBase').show();
          $('#tdMoldeBase').show();
          $('#tdPrecioComplemento').show();
          document.getElementById('resumenTipoBase').innerText = "Cierre gancho + pelo";
          paso3_rowspan.rowSpan = "4";
          pasoIncompleto(document.querySelector('.paso3'));
          break;
      }

      verificarPaso3();
      //Calculo el precio si elige una base
      sumaSubtotal();
    });
  }

  //Detecto cuando escriben en el ancho de la base y la verifico
  anchoBaseInput.addEventListener('input', function () {
    anchoBaseInt = parseInt(anchoBaseInput.value);

    //El ancho de la base debe ser igual o mayor que le ancho del producto
    if (anchoBaseInt >= anchoInt) {
      anchoBaseInput.classList.remove('input-error');
      $('#errorAnchoBase').hide();

      //Si altoInt y anchoBaseInt > 0, calculo superficie y precio
      if (altoBaseInt != "" && anchoBaseInt != "" && altoBaseInt > 0 && altoBaseInt > 0 && document.getElementById('resumenCantidad').innerText != "") {
        calcularSuperficieTela();
      }
    } else {
      //El ancho del input está fuera del mínimo y máximo de la técnica. Saco mensaje de error.
      anchoBaseInput.classList.add('input-error');
      $('#errorAnchoBase').text("El ancho de la base debe ser igual o mayor que el ancho del diseño.");
      $('#errorAnchoBase').show();
    }
  });

  //Detecto cuando escriben en el alto de la base y la verifico
  altoBaseInput.addEventListener('input', function () {
    altoBaseInt = parseInt(altoBaseInput.value);

    //El alto de la base debe ser igual o mayor que le alto del producto
    if (altoBaseInt >= altoInt) {
      //El ancho del input está dentro del mínimo y máximo de la técnica.
      altoBaseInput.classList.remove('input-error');
      $('#errorAltoBase').hide();

      //Si altoBaseInt y anchoBaseInt > 0, calculo superficie y precio
      if (altoBaseInt != "" && anchoBaseInt != "" && altoBaseInt > 0 && altoBaseInt > 0 && document.getElementById('resumenCantidad').innerText != "") {
        calcularSuperficieTela();
      } 
    } else {
      //El ancho del input está fuera del mínimo y máximo de la técnica. Saco mensaje de error.
      altoBaseInput.classList.add('input-error');
      $('#errorAltoBase').text("El alto de la base debe ser igual o mayor que el alto del diseño.");
      $('#errorAltoBase').show();
    }
  });

  /*
  Detectar cambios en los colores a elegir para la base
  */
  document.getElementById("coloresBase").addEventListener("change", function (event) {
    //Verifico que la selección sea de los colores
    if (event.target.type === "checkbox" && event.target.name === "colorbase") {
      const valor = event.target.value;

      if (event.target.checked) {
        //Si esta seleccionado y la lista aun no está llena, lo agrego
        if (colorBaseSeleccionado.length < 1) {
          colorBaseSeleccionado.push(valor);
        } else {
          //Si la lista está llena saco un mensaje "No puedes seleccioanr más de X colores"
          event.target.checked = false;
        }
      } else {
        //Si no es seleccion, lo elimino de la lista
        const index = colorBaseSeleccionado.indexOf(valor);
        if (index > -1) {
          colorBaseSeleccionado.splice(index, 1);
        }
      }

      //Imprimo la lista en la tabla resumen
      document.getElementById('resumenColorBase').innerText = colorBaseSeleccionado;

    }
    verificarPaso3();
  });

  // Detecta cuando marquen si quiere tope o no
  // Itera a través de la colección y agrega un evento a cada elemento
  for (var i = 0; i < elementosTope.length; i++) {
    elementosTope[i].addEventListener('input', function () {
      switch (this.value) {
        case "1":// Sí quiere topes
          cantidadTopes = true;
          $('#divCantidadTopes').show();
          $('#tdCantidadTopes').show();
          $('#tdPrecioComplemento').show();
          paso3_rowspan.rowSpan = "2";
          pasoIncompleto(document.querySelector('.paso3'));
          break;
        case "0":// No quiere topes
          document.getElementById("resumenPPUComplemento").innerText = "";
          document.getElementById("resumenPrecioComplemento").innerText = "";
          document.getElementById("cantidadTopes").value = "";
          $('#divCantidadTopes').hide();
          $('#tdCantidadTopes').hide();
          $('#tdPrecioComplemento').hide();
          paso3_rowspan.rowSpan = "1";
          pasoCompleto(document.querySelector('.paso3'));
          break;
      }
    });
  }

  // Detecta cuando escriban en el <input> cantidadTopes
  inputCantidadTopes.addEventListener('input', function () {
    //Verifico la cantidad(si existe) según la técnica
    //Verifico si los campos de la parte 1 están completos
    verificarCantidadTopes();

    //Como de la cantidad depende el precio del producto (y bases, si desea el usuario), recalculo
    //los precios con la nueva cantidad
    sumaSubtotal();
  });
  // FIN PASO 3-----------------------------------------------------------------------------------------------//

  // PASO 4: imagen -----------------------------------------------------------------------------------------//
  //Verifica el archivo subido
  const archivoInput = document.getElementById("archivo");
  archivoInput.addEventListener("change", function () {
    $('#tamano-incorrecto').hide();
    $('#extension-incorrecta').hide();
    $('#imagen-correcta').hide();
    var error = false;
    var fileSize = archivoInput.files[0].size;
    var fileName = archivoInput.files[0].name;
    var ext = fileName.split('.').pop();

    /* filesize es dado en Byte
        Tamaño máximo del archivo 100Megabyte = 1e+8 Byte
    */

    if (fileSize > 1e+8) {//Tamaño del archivo
      $('#tamano-incorrecto').show();
      archivoInput.value = '';
      error = true;
    } else {
      // Convertimos en minúscula porque la extensión del archivo puede estar en mayúscula
      ext = ext.toLowerCase();

      switch (ext) {//Extensiones permitidas
        case 'ai':
        case 'pdf':
        case 'eps':
        case 'svg':
        case 'psd':
        case 'jpg':
        case 'png':
        case 'tif':
        case 'bmp': break;
        default:
          $('#extension-incorrecta').show();
          archivoInput.value = '';
          error = true;
      }
    }
    if (error == false) {
      $('#imagen-correcta').show();
      document.getElementById("resumenImagen").innerText = archivoInput.files[0].name;
      pasoCompleto(document.querySelector('.paso4'));
    } else {
      document.getElementById("resumenImagen").innerText = "";
      pasoIncompleto(document.querySelector('.paso4'));
    }
    verificar4Completos();
  });
  // FIN PASO 4-----------------------------------------------------------------------------------------------//

  // Agrega un manejador de eventos para detectar cuando el botón se deshabilita
  const miBoton = document.getElementById('encargarDiseno');
  miBoton.addEventListener('change', function () {
    if (miBoton.disabled) {
      miBoton.innerText = "FALTAN CAMPOS POR COMPLETAR";
    } else {
      miBoton.innerText = "ENCARGAR DISEÑO";
    }
  });
})(jQuery);

//----------------------------------------------------------------FUNCIONES----------------------------------------------------------------
function cargarCamposSegunTecnica() {
  // --------------------Para el PASO 1---------------------------
  //Oculto los campos y vacío primero
  paso1_rowspan.rowSpan = 3;// El rowspan lo pongo a 3
  coloresSeleccionados.length = 0; // Vacio la lista de colores 
  document.getElementById('resumenColores').innerText = coloresSeleccionados; // Asigno la lista vacia
  colorMetalSeleccionado.length = 0; //Vacio la lista de color metal
  document.getElementById('resumenColorMetal').innerText = colorMetalSeleccionado;// Asigno la lista vacia
  colorPielSeleccionado.length = 0;//Vacio la lista de color piel
  document.getElementById('resumenColorPiel').innerText = colorPielSeleccionado;// Asigno la lista vacia

  colores_limitados = false;
  colorMetal = false;
  colorPiel = false;

  $('#divColores').hide(); //Div de colores limitados
  $('#divColoresMetal').hide(); // Div de colores metalicos
  $('#divColoresPiel').hide(); // Div de colores pieles
  $('#tdColores').hide(); // Div colores (resumen)
  $('#tdColorPiel').hide(); // Div color piel (resumen)
  $('#tdColorMetal').hide(); // Div color metal (resumen)

  $('#textoCMYK').hide();// Div con texto para tecnicas que se basan en CMYK
  $('#textoPantone').hide();// Div con texto para tecnicas que se basan en PANTONE
  $('#txtImagen1').show(); // Div texto imagenes en formato png o jpg
  $('#txtImagen2').show(); // Div texto pdf
  $('#txtImagen3').show(); // Div texto diseño vectorizado
  $('#divTxtAdvertenciaColores').hide(); // Div advertencia de no elegir color
  $('#textoCodigosColor').hide(); // Div texto que pueden escribir codigos de color

  //[2] cmyk
  //Si es colores cmyk elige imagen
  if ($('select[name="tecnica"] :selected').attr('class').split(' ')[2] == 1) {
    $('#textoCMYK').show();// Div con texto para tecnicas que se basan en CMYK
    $('#textoPantone').hide();// Div con texto para tecnicas que se basan en PANTONE
    $('#txtImagen1').show(); // Div texto imagenes en formato png o jpg
    $('#txtImagen2').show(); // Div texto pdf
    $('#txtImagen3').show(); // Div texto diseño vectorizado
    $('#divTxtAdvertenciaColores').hide(); // Div advertencia de no elegir color
    $('#textoCodigosColor').show(); // Div texto que pueden escribir codigos de color
  }

  //[9] colores_pantone
  //Si es colores pantone puede subir imagen y elegir colores de la paleta generada, 
  //escribir los codigos deseados o ninguno (los definira el diseñador con el archivo adjunto)
  if ($('select[name="tecnica"] :selected').attr('class').split(' ')[9] == 1) {
    $('#textoCMYK').hide();// Div con texto para tecnicas que se basan en CMYK
    $('#textoPantone').show();// Div con texto para tecnicas que se basan en PANTONE
    $('#txtImagen1').show(); // Div texto imagenes en formato png o jpg
    $('#txtImagen2').show(); // Div texto pdf
    $('#txtImagen3').show(); // Div texto diseño vectorizado
    $('#divTxtAdvertenciaColores').show(); // Div advertencia de no elegir color
    $('#textoCodigosColor').show(); // Div texto que pueden escribir codigos de color
  }

  //[3] colores_limitados
  //Si es colores a 1 saco los colores a elegir
  if ($('select[name="tecnica"] :selected').attr('class').split(' ')[3] == 1) {
    colores_limitados = true;
    //Relleno campos y muestro el div de los colores disponibles
    maximoColores = parseInt($('select[name="tecnica"] :selected').attr('class').split(' ')[0]);
    const spanMaxColores = document.getElementsByClassName('maximoColores');
    // Recorrer los elementos y asignar el valor
    for (let i = 0; i < spanMaxColores.length; i++) {
      spanMaxColores[i].innerText = maximoColores;
    }

    //Busco los colores y los pongo en el div de colores
    $.ajax({
      method: "POST",
      url: "funciones/functions.php",
      dataType: 'json',
      data: {
        buscarColores: "", id_producto: $('select[name="tecnica"] :selected').val()
      }
    }).done(function (response) {
      // Obtén el contenedor donde deseas mostrar los colores
      const colorContainer = document.getElementById("coloresProducto");
      colorContainer.innerHTML = "";
      // Recorre el arreglo de colores y crea elementos <div>
      response.forEach((color, index) => {
        // Accede a las propiedades RGB de cada objeto de color
        const rgb_R = color[0].rgb_R;
        const rgb_G = color[0].rgb_G;
        const rgb_B = color[0].rgb_B;
        const nombre = color[0].nombre;

        // Crea un nuevo elemento div
        const colorDiv = document.createElement('div');
        colorDiv.className = `colores col-lg-color col-md-4 col-sm-6`;

        // Crea un elemento label
        const label = document.createElement('label');
        label.className = 'cuadrado';
        label.setAttribute('data-title', `${nombre}`);

        // Crea un elemento input (checkbox)
        const checkbox = document.createElement('input');
        checkbox.name = 'colores';
        checkbox.id = `${nombre}`;
        checkbox.value = `${nombre}`;
        checkbox.type = 'checkbox';

        // Crea un elemento span para el checkmark
        const checkmark = document.createElement('span');
        checkmark.className = 'checkmark';
        // Establece el color de fondo del elemento <div> utilizando los valores RGB
        const rgbColor = `rgb(${rgb_R}, ${rgb_G}, ${rgb_B})`;
        checkmark.style.backgroundColor = rgbColor;

        // Agrega el checkbox y el checkmark al label
        label.appendChild(checkbox);
        label.appendChild(checkmark);

        // Agrega el label al div de color
        colorDiv.appendChild(label);
        // Agrega el elemento <div> al contenedor
        colorContainer.appendChild(colorDiv);
      });
    })
    paso1_rowspan.rowSpan = paso1_rowspan.rowSpan + 1;
    $('#tdColores').show();
    $('#divColores').show();

    $('#textoCMYK').hide();// Div con texto para tecnicas que se basan en CMYK
    $('#textoPantone').hide();// Div con texto para tecnicas que se basan en PANTONE
    $('#txtImagen1').show(); // Div texto imagenes en formato png o jpg
    $('#txtImagen2').show(); // Div texto pdf
    $('#txtImagen3').show(); // Div texto diseño vectorizado
    $('#divTxtAdvertenciaColores').hide(); // Div advertencia de no elegir color
    $('#textoCodigosColor').show(); // Div texto que pueden escribir codigos de color
  }

  //Busco si tiene modulo de metal
  $.ajax({
    method: "POST",
    url: "funciones/functions.php",
    dataType: 'json',
    data: {
      buscarMetal: "", id_producto: $('select[name="tecnica"] :selected').val()
    }
  }).done(function (response) {
    //Si regresa algo, es que tiene
    if (response.length === 0) {
    } else {
      colorMetal = true;
      // Obtén el contenedor donde deseas mostrar los colores
      const colorContainer = document.getElementById("coloresMetal");
      colorContainer.innerHTML = "";
      // Recorre el arreglo de colores y crea elementos <div>
      response.forEach((color, index) => {
        // Accede a las propiedades RGB de cada objeto de color
        const rgb_R = color[0].rgb_R;
        const rgb_G = color[0].rgb_G;
        const rgb_B = color[0].rgb_B;
        const nombre = color[0].nombre;

        // Crea un nuevo elemento div
        const colorDiv = document.createElement('div');
        colorDiv.className = `metalicos col-lg-color col-md-4 col-sm-6`;

        // Crea un elemento label
        const label = document.createElement('label');
        label.className = 'cuadrado';
        label.setAttribute('data-title', `${nombre}`);

        // Crea un elemento input (checkbox)
        const checkbox = document.createElement('input');
        checkbox.name = 'colormetal';
        checkbox.id = `${nombre}`;
        checkbox.value = `${nombre}`;
        checkbox.type = 'checkbox';

        // Crea un elemento span para el checkmark
        const checkmark = document.createElement('span');
        checkmark.className = 'checkmark';
        // Establece el color de fondo del elemento <div> utilizando los valores RGB
        const rgbColor = `rgb(${rgb_R}, ${rgb_G}, ${rgb_B})`;
        checkmark.style.backgroundColor = rgbColor;

        // Agrega el checkbox y el checkmark al label
        label.appendChild(checkbox);
        label.appendChild(checkmark);

        // Agrega el label al div de color
        colorDiv.appendChild(label);
        // Agrega el elemento <div> al contenedor
        colorContainer.appendChild(colorDiv);
      });
      paso1_rowspan.rowSpan = paso1_rowspan.rowSpan + 1;
      $('#tdColorMetal').show();
      $('#divColoresMetal').show();
    }
  });

  //Busco si tiene modulo de piel
  $.ajax({
    method: "POST",
    url: "funciones/functions.php",
    dataType: 'json',
    data: {
      buscarPiel: "", id_producto: $('select[name="tecnica"] :selected').val()
    }
  }).done(function (response) {
    //Si regresa algo, es que tiene
    if (response.length === 0) {
    } else {
      colorPiel = true;
      // Obtén el contenedor donde deseas mostrar los colores
      const colorContainer = document.getElementById("coloresPiel");
      colorContainer.innerHTML = "";
      // Recorre el arreglo de colores y crea elementos <div>
      response.forEach((color, index) => {
        // Accede a las propiedades RGB de cada objeto de color
        const rgb_R = color[0].rgb_R;
        const rgb_G = color[0].rgb_G;
        const rgb_B = color[0].rgb_B;
        const nombre = color[0].nombre;

        // Crea un nuevo elemento div
        const colorDiv = document.createElement('div');
        colorDiv.className = `pieles col-lg-color col-md-4 col-sm-6`;

        // Crea un elemento label
        const label = document.createElement('label');
        label.className = 'cuadrado';
        label.setAttribute('data-title', `${nombre}`);

        // Crea un elemento input (checkbox)
        const checkbox = document.createElement('input');
        checkbox.name = 'colorpiel';
        checkbox.id = `${nombre}`;
        checkbox.value = `${nombre}`;
        checkbox.type = 'checkbox';

        // Crea un elemento span para el checkmark
        const checkmark = document.createElement('span');
        checkmark.className = 'checkmark';
        // Establece el color de fondo del elemento <div> utilizando los valores RGB
        const rgbColor = `rgb(${rgb_R}, ${rgb_G}, ${rgb_B})`;
        checkmark.style.backgroundColor = rgbColor;

        // Agrega el checkbox y el checkmark al label
        label.appendChild(checkbox);
        label.appendChild(checkmark);

        // Agrega el label al div de color
        colorDiv.appendChild(label);
        // Agrega el elemento <div> al contenedor
        colorContainer.appendChild(colorDiv);
      });
      paso1_rowspan.rowSpan = paso1_rowspan.rowSpan + 1;
      $('#tdColorPiel').show();
      $('#divColoresPiel').show();
    }
  });

  // --------------------Para el PASO 2 diseño---------------------------
  medidas = false;
  forma = false;
  //Oculto todos los campos primero
  $('#anchoPorAlto').hide(); //Div de medidas
  $('#divInputAncho').hide(); // Div de ancho (input)
  $('#divSelectAncho').hide(); // Div de ancho (select)
  $('#tdAnchoProducto').hide(); // Div de ancho (resumen)
  $('#tdAltoProducto').hide(); // Div de alto (resumen)
  $('#tdSuperficieProducto').hide(); // Div de superficie (resumen)
  $('#divFormas').hide(); // Div de formas
  $('#tdFormaProducto').hide(); // Div de formas (resumen)
  // Recorre la lista de elementos y oculto todos
  document.querySelectorAll(".divCadaForma").forEach(function (elemento) {
    elemento.style.display = "none";
  });

  //Vacío las medidas
  anchoProductoInput.value = "";
  altoProducto.value = "";
  anchoProductoSelect.selectedIndex = 0;
  anchoInt = 0;
  altoInt = 0;
  //Vacío los campos y los marco incompleto
  limpiarPaso2Medidas();
  document.getElementById("resumenFormaProducto").innerText = "";
  pasoIncompleto(document.querySelector('.paso2'));

  // ¿La técnica seleccionada tiene ancho y alto (mínimos y máximos)? Sí = habilitar div medidas, No = deshabilito div medidas
  // [8] alto máximo = "" = sin medidas
  if ($('select[name="tecnica"] :selected').attr('class').split(' ')[8] == "") {
    $('#anchoPorAlto').hide();
    $('#tdAnchoProducto').hide();
    $('#tdAltoProducto').hide();
    $('#tdSuperficieProducto').hide();
    paso2_rowspan.rowSpan = "1";
  } else {
    medidas = true;
    paso2_rowspan.rowSpan = "4";

    $('#anchoPorAlto').show();
    $('#tdAnchoProducto').show();
    $('#tdAltoProducto').show();
    $('#tdSuperficieProducto').show();

    if ($('select[name="tecnica"] :selected').attr('class').split(' ')[5] == "") {
      // [5] ancho mínimo = "" = el ancho se selecciona
      $('#divInputAncho').hide();
      $('#divSelectAncho').show();
    } else {
      // [5] ancho mínimo != "" = el ancho se escribe
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
      buscarFormas: "", id_producto: $('select[name="tecnica"] :selected').val()
    }
  }).done(function (response) {
    if (response.length > 0) {// Si tiene formas
      forma = true;
      //Muestro el div para las formas
      $('#divFormas').show();
      $('#tdFormaProducto').show();
      paso2_rowspan.rowSpan = paso2_rowspan.rowSpan + 1;

      //Recorro el response y muestro cada div correspondiente
      for (var i = 0; i < response.length; i++) {
        document.getElementById("forma" + response[i].id_forma.toString()).style.display = "block";
      }
    }
  });


  // --------------------Para el PASO 3 complementos---------------------------
  colorBaseSeleccionado.length = 0; // Vacio la lista de colores 
  document.getElementById('resumenPPUComplemento').innerText = "";
  document.getElementById('resumenPrecioComplemento').innerText = "";
  document.getElementById("cantidadTopes").value = "";
  document.getElementById('resumenMoldeBase').innerText = "";
  document.getElementById('resumenColorBase').innerText = colorBaseSeleccionado; // Asigno la lista vacia
  medidasBase = false;
  colorBase = false;
  cantidadTopes = false;
  anchoBaseInt = 0;
  altoBaseInt = 0;
  pasoCompleto(document.querySelector('.paso3'));
  //Oculto todos los campos primero
  limpiarBaseTelaMedidas();
  // Recorre la lista de elementos y quita la clase "seleccionado"
  document.querySelectorAll(".seleccionado").forEach(function (elemento) {
    elemento.classList.remove("seleccionado");
  });
  document.getElementById("sinbase").checked = true;
  document.getElementById("divSinBase").classList.add("seleccionado");// Agrega la clase "seleccionado" al div
  document.getElementById("noTopePulsera").checked = true;
  document.getElementById("divNoTopePulsera").classList.add("seleccionado");// Agrega la clase "seleccionado" al div
  $('#topePulsera').hide(); //Div de topes
  $('#selectBase').hide(); // Div de bases
  $('#divTela').hide(); // Div base de tela
  $('#divGancho').hide(); // Div base de cierre gancho
  $('#divGanchoPelo').hide(); // Div base de cierre gancho + pelo
  $('#divSinBase').hide(); // Div sin base
  $('#sincomplemento').hide(); // Div sin complemento
  $('#tdTipoBase').hide(); // Div tipo base (resumen)
  $('#tdAnchoBase').hide(); // Div ancho base (resumen)
  $('#tdAltoBase').hide(); // Div alto base (resumen)
  $('#tdSuperficieBase').hide(); // Div  superficie base (resumen)
  $('#tdColorBase').hide(); // Div color base (resumen)
  $('#tdMoldeBase').hide(); // Div molde base (resumen)
  $('#tdPrecioComplemento').hide(); // Div precio base (resumen)
  $('#tdCantidadTopes').hide(); // Div cantidad topes (resumen)
  $('#tdPrecioTopes').hide(); // Div precio topes (resumen)
  paso3_rowspan.rowSpan = 1;

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
        buscarBases: "", id_producto: $('select[name="tecnica"] :selected').val()
      }
    }).done(function (response) {
      if (response.length > 0) {
        for (var i = 0; i < response.length; i++) {
          //Muestro el div para la base
          $('#selectBase').show();

          //Muestro el o los div correspondientes segun la tecnica elgida
          switch (response[i]["id_complemento"].toString()) {
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

  // --------------------Para el PASO 4---------------------------
  $('#tamano-incorrecto').hide();
  $('#extension-incorrecta').hide();
  $('#imagen-correcta').hide();
  document.getElementById("resumenImagen").innerText = "";
  document.getElementById("archivo").value = '';
  pasoIncompleto(document.querySelector('.paso4'));
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
      cantidadMinima: "", id_producto: $('select[name="tecnica"] :selected').val()
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
      if (altoInt != "" && anchoInt != "" && altoInt > 0 && anchoInt > 0) {
        calcularSuperficieProducto();
      }

      if (medidas == false && forma == false) {
        $('#divMensajeDiseno').show();

        // Busco la superficie y la cantidad en la tabla de precios y si es correcto, lo reflejo a la tabla de resumen-presupuesto
        $.ajax({
          method: "POST",
          url: "funciones/functions.php",
          data: {
            precio: "", id_producto: $('select[name="tecnica"] :selected').val(), cantidad: inputCantidad.value, superficie: null
          }
        }).done(function (response) {
          console.log("response=" + response);
          response = response.trim();

          //Relleno los campos
          if (response != "") {
            document.getElementById('resumenPPU').innerText = response.replace(".", ",");
            document.getElementById('resumenPrecioProducto').innerText = (parseFloat(response) * parseInt(inputCantidad.value)).toFixed(2).replace(".", ",") + " €";
          }
          const elemento = document.querySelector('.paso2');
          pasoCompleto(elemento);
          sumaSubtotal();
        }).fail(function (jqXHR, textStatus, errorThrown) {
          console.error("Error en la solicitud AJAX: " + errorThrown);
        });
      }
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
  var bool = true;

  // Encuentra el elemento por su clase
  const elemento = document.querySelector('.paso1');

  if (selectProducto.value != "" && document.getElementById('resumenCantidad').innerText != "") {
  } else {
    bool = false;
  }

  //Color a elegir
  if (colores_limitados == true) {
    //Si debe elegir colores, que sea al menos uno
    if (document.getElementById('resumenColores').innerText != "") {
    } else {
      bool = false;
    }
  }

  //Color piel a elegir
  if (colorPiel == true) {
    //Si debe elegir color
    if (document.getElementById('resumenColorPiel').innerText != "") {
    } else {
      bool = false;
    }
  }

  //Color metal a elegir
  if (colorMetal == true) {
    //Si debe elegir color
    if (document.getElementById('resumenColorMetal').innerText != "") {
    } else {
      bool = false;
    }
  }

  if (bool === true) {
    pasoCompleto(elemento);
  } else {
    pasoIncompleto(elemento);
  }
}

/**
 * Si las medidas son correctas (ancho, alto, superficie -> precio)
 * Si ha elegido forma
 * O si no aplica ninguna de las dos
 */
function verificarPaso2() {
  var bool = true;

  //Con forma
  if (forma == true) {
    //Si requiere forma, verifico que haya elegido una forma
    if (document.getElementById('resumenFormaProducto').innerText != "") {
    } else {
      bool = false;
    }
  }
  // Con medidas
  if (medidas == true) {
    //Si lleva medidas y son correctas
    if (document.getElementById('resumenSuperficieProducto').innerText != "" &&
      document.getElementById('resumenPPU').innerText != "" &&
      document.getElementById('resumenPrecioProducto').innerText != "") {
    } else {
      bool = false;
    }
  }

  const elemento = document.querySelector('.paso2');
  if (bool === true) {
    pasoCompleto(elemento);
    sumaSubtotal();
  } else {
    pasoIncompleto(elemento);
  }

}

/**
 * Compruebo que los 4 pasos estén COMPLETO para habilitar el boton de encargar diseño
 */
function  verificar4Completos() {
  var bool = true;

  if (document.querySelector(".paso1").classList.contains("paso-incompleto")) {
    bool = false;
  }
  if (document.querySelector(".paso2").classList.contains("paso-incompleto")) {
    bool = false;
  }
  if (document.querySelector(".paso3").classList.contains("paso-incompleto")) {
    bool = false;
  }
  if (document.querySelector(".paso4").classList.contains("paso-incompleto")) {
    bool = false;
  }

  if (bool === true) {
    document.getElementById("encargarDiseno").removeAttribute("disabled"); // Habilita el botón
    document.getElementById("encargarDiseno").textContent = "ENCARGAR DISEÑO"; // Cambia el texto del botón
  } else {
    document.getElementById("encargarDiseno").setAttribute("disabled", "true"); // Deshabilita el botón
    document.getElementById("encargarDiseno").textContent = "FALTAN CAMPOS POR COMPLETAR"; // Cambia el texto del botón
  }
}

/**
 * Si no hay complemento = COMPLETO
 * Si elige base de tela, las medidas son correctar y ha elegido color = COMPLETO
 * Si elige base de cierre gancho o cirre gancho + pelo y ha elegido color = COMPLETO
 * Si elige tope e indica la cantidad = COMPLETO
 */
function verificarPaso3() {
  var bool = true;
  // Encuentra el elemento por su clase
  const elemento = document.querySelector('.paso3');

  //Si ha elegido base de tela
  //Verifico que tenga las medidas (superficie) y haya elegido el color de la tela
  if (document.getElementById('resumenTipoBase').innerText == "Tela" &&
    document.getElementById('resumenSuperficieBase').innerText != "" &&
    document.getElementById('resumenColorBase').innerText != "") {
  } else if ((document.getElementById('resumenTipoBase').innerText == "Cierre gancho" &&
    document.getElementById('resumenColorBase').innerText != "") || (
      document.getElementById('resumenTipoBase').innerText == "Cierre gancho + pelo" &&
      document.getElementById('resumenColorBase').innerText != "")) {
    //Si ha elegido gancho o gancho pelo
    //Verifico que haya elegido el color
  } else if (document.getElementById('resumenCantidadTopes').innerText != "") {
  } else if (document.getElementById('resumenTipoBase').innerText == "") {
  } else {
    bool = false;
  }

  if (bool === true) {
    pasoCompleto(elemento);
    sumaSubtotal();
  } else {
    pasoIncompleto(elemento);
  }
}

function sumaSubtotal() {
  var moldeProducto = parseFloat(document.getElementById('resumenMoldeProducto').innerText.replace('€', '').replace(',', '.').trim());
  var precioProducto = parseFloat(document.getElementById('resumenPrecioProducto').innerText.replace('€', '').replace(',', '.').trim());
  var moldeBase = parseFloat(document.getElementById('resumenMoldeBase').innerText.replace('€', '').replace(',', '.').trim());
  var precioComplemento = parseFloat(document.getElementById('resumenPrecioComplemento').innerText.replace('€', '').replace(',', '.').trim());

  var suma = 0;
  var sumaMoldes = 0;
  if (!isNaN(moldeProducto)) {
    suma += moldeProducto;
    sumaMoldes += moldeProducto;
  }

  if (!isNaN(precioProducto)) {
    suma += precioProducto;
  }

  if (!isNaN(moldeBase)) {
    suma += moldeBase;
    sumaMoldes += moldeBase;
  }

  if (!isNaN(precioComplemento)) {
    suma += precioComplemento;
  }

  // Relleno el campo del subtotal de la tabla
  document.getElementById('resumenSubtotal').innerText = suma.toFixed(2).toString().replace('.', ',') + " €";

  //Relleno los campos ocultos
  document.getElementById('precioMoldes').value = sumaMoldes.toFixed(2);
  document.getElementById('precioSubtotal').value = suma.toFixed(2);
}

function calcularSuperficieTela() {
  superficieBase = ((anchoBaseInt / 10) * (altoBaseInt / 10)).toFixed(2); // Lo divido entre 10 para pasarlo a centimetros

  // Busco la superficieBase y la cantidad en la tabla de precios y si es correcto, lo reflejo a la tabla de resumen-presupuesto
  $.ajax({
    method: "POST",
    url: "funciones/functions.php",
    data: {
      precio: "", id_producto: 0, id_complemento: 1, cantidad: inputCantidad.value, superficie: superficieBase
    }
  }).done(function (response) {
    response = response.trim();

    //Relleno los campos
    if (response != "") {
      document.getElementById('resumenAnchoBase').innerText = (anchoBaseInt / 10).toString().replace(".", ",") + "cm";
      document.getElementById('resumenAltoBase').innerText = (altoBaseInt / 10).toString().replace(".", ",") + "cm";
      document.getElementById('resumenSuperficieBase').innerHTML = superficieBase.toString().replace(".", ",") + "cm<sup>2</sup>";
      document.getElementById('resumenPPUComplemento').innerText = response.replace(".", ",");
      document.getElementById('resumenPrecioComplemento').innerText = (parseFloat(response) * parseInt(inputCantidad.value)).toFixed(2).replace(".", ",") + " €";
    } else {
      limpiarBaseTelaMedidas();
    }

    //Por último verifico todo el paso 2
    verificarPaso3();
  });
}


function pasoCompleto(elemento) {
  // Cambia la clasae
  elemento.classList.remove('paso-incompleto');
  elemento.classList.add('paso-completo');

  // Cambia el contenido de texto
  elemento.textContent = 'COMPLETO';

  // Elementos de navegación de las pestañas
  var elementosNavegacion = document.querySelectorAll(".nav-link");
  elementosNavegacion.forEach(function (elemento) {
    // Verifica si el elemento actual tiene la clase "active"
    if (elemento.classList.contains("active")) {
      var idDelElementoActivo = elemento.getAttribute("id");
      var boton = document.getElementById("v-pills-next-tab");

      // Verifico si el paso en el que estoy esta COMPLETO, para habilitar el botón de SIGUIENTE PASO
      switch (idDelElementoActivo) {
        case "nav-paso1":
          if (document.querySelector(".paso1").classList.contains("paso-completo")) {
            boton.removeAttribute("disabled"); // Habilita el botón
            boton.textContent = "SIGUIENTE PASO";  // Cambia el texto del botón
          }
          break;

        case "nav-paso2":
          if (document.querySelector(".paso2").classList.contains("paso-completo")) {
            boton.removeAttribute("disabled"); // Habilita el botón
            boton.textContent = "SIGUIENTE PASO";  // Cambia el texto del botón
          }
          break;

        case "nav-paso3":
          if (document.querySelector(".paso3").classList.contains("paso-completo")) {
            boton.removeAttribute("disabled"); // Habilita el botón
            boton.textContent = "SIGUIENTE PASO";  // Cambia el texto del botón
          }
          break;

        case "nav-paso4":
          if (document.querySelector(".paso3").classList.contains("paso-completo")) {
            document.getElementById("encargarDiseno").removeAttribute("disabled"); // Habilita el botón
            document.getElementById("encargarDiseno").textContent = "ENCARGAR DISEÑO";  // Cambia el texto del botón
          }
          break;
      }
    }
  });
}

function pasoIncompleto(elemento) {
  // Cambia la clase
  elemento.classList.remove('paso-completo');
  elemento.classList.add('paso-incompleto');

  // Cambia el contenido de texto
  elemento.textContent = 'INCOMPLETO';

  // Elementos de navegación de las pestañas
  var elementosNavegacion = document.querySelectorAll(".nav-link");
  elementosNavegacion.forEach(function (elemento) {
    // Verifica si el elemento actual tiene la clase "active"
    if (elemento.classList.contains("active")) {
      var idDelElementoActivo = elemento.getAttribute("id");
      var boton = document.getElementById("v-pills-next-tab");

      // Verifico si el paso en el que estoy esta INCOMPLETO, para deshabilitar el botón
      switch (idDelElementoActivo) {
        case "nav-paso1":
          if (document.querySelector(".paso1").classList.contains("paso-incompleto")) {
            boton.setAttribute("disabled", "true");// Deshabilita el botón
            boton.textContent = "FALTAN CAMPOS POR COMPLETAR";  // Cambia el texto del botón
          }
          break;

        case "nav-paso2":
          if (document.querySelector(".paso2").classList.contains("paso-incompleto")) {
            boton.setAttribute("disabled", "true");// Deshabilita el botón
            boton.textContent = "FALTAN CAMPOS POR COMPLETAR";  // Cambia el texto del botón
          }
          break;

        case "nav-paso3":
          if (document.querySelector(".paso3").classList.contains("paso-incompleto")) {
            boton.setAttribute("disabled", "true");// Deshabilita el botón
            boton.textContent = "FALTAN CAMPOS POR COMPLETAR";  // Cambia el texto del botón
          }
          break;

        case "nav-paso4":
          if (document.querySelector(".paso4").classList.contains("paso-incompleto")) {
            document.getElementById("encargarDiseno").setAttribute("disabled", "true");// Deshabilita el botón
            document.getElementById("encargarDiseno").textContent = "FALTAN CAMPOS POR COMPLETAR";  // Cambia el texto del botón
          }
          break;
      }
    }
  });
}

function limpiarPaso2Medidas() {
  document.getElementById('resumenAnchoProducto').innerText = "";
  document.getElementById('resumenAltoProducto').innerText = "";
  document.getElementById('resumenSuperficieProducto').innerHTML = "";
  document.getElementById('resumenPPU').innerText = "";
  document.getElementById('resumenPrecioProducto').innerText = "";
  verificarPaso2();
}

function limpiarBaseTelaMedidas() {
  document.getElementById('resumenAnchoBase').innerText = "";
  document.getElementById('resumenAltoBase').innerText = "";
  document.getElementById('resumenSuperficieBase').innerHTML = "";
  document.getElementById('resumenPPUComplemento').innerText = "";
  document.getElementById('resumenPrecioComplemento').innerText = "";
  anchoBaseInput.value = "";
  altoBaseInput.value = "";
  verificarPaso3();
}

function calcularSuperficieProducto() {
  superficie = ((anchoInt / 10) * (altoInt / 10)).toFixed(2); // Lo divido entre 10 para pasarlo a centimetros

  // Busco la superficie y la cantidad en la tabla de precios y si es correcto, lo reflejo a la tabla de resumen-presupuesto
  $.ajax({
    method: "POST",
    url: "funciones/functions.php",
    data: {
      precio: "", id_producto: $('select[name="tecnica"] :selected').val(), cantidad: inputCantidad.value, superficie: superficie
    }
  }).done(function (response) {
    response = response.trim();

    //Relleno los campos
    if (response != "") {
      document.getElementById('resumenAnchoProducto').innerText = (anchoInt / 10).toString().replace(".", ",") + "cm";
      document.getElementById('resumenAltoProducto').innerText = (altoInt / 10).toString().replace(".", ",") + "cm";
      document.getElementById('resumenSuperficieProducto').innerHTML = superficie.toString().replace(".", ",") + "cm<sup>2</sup>";
      document.getElementById('resumenPPU').innerText = response.replace(".", ",");
      document.getElementById('resumenPrecioProducto').innerText = (parseFloat(response) * parseInt(inputCantidad.value)).toFixed(2).replace(".", ",") + " €";
    } else {
      limpiarPaso2Medidas();
    }

    //Por último verifico todo el paso 2
    verificarPaso2();
  });
}

function verificarCantidadTopes() {
  document.getElementById('resumenCantidadTopes').innerText = inputCantidadTopes.value;
  // Realiza una solicitud AJAX al servidor para enviar el ID del producto y obtener la cantidad minima del producto
  $.ajax({
    method: "POST",
    url: "funciones/functions.php",
    data: {
      precioTopes: ""
    }
  }).done(function (response) {
    //Verifico que la cantidad introducida sea mayor que el mínimo de la técncia
    response = response.trim();

    //Relleno los campos
    if (response != "") {
      document.getElementById('resumenPPUComplemento').innerText = response.replace(".", ",");
      document.getElementById('resumenPrecioComplemento').innerText = (parseFloat(response) * parseInt(inputCantidadTopes.value)).toFixed(2).replace(".", ",") + " €";
    }
    verificarPaso3();
    //Calculo el precio si elige una base
    sumaSubtotal();
  });
}