//Dinamismo del formulario encargar-diseño
//Global de la tecnica
const selectProducto = document.getElementById('tecnica');
const inputCantidad = document.getElementById('cantidad');
const elementosColorMetal = document.getElementsByName('colormetal');
const elementosColorPiel = document.getElementsByName('colorpiel');
const elementosColores = document.getElementsByName('colores');
const elementosBase = document.getElementsByName('base');
const anchoProductoInput = document.getElementById('anchoProductoInput');
const altoProducto = document.getElementById('altoProducto');
const anchoProductoSelect = document.getElementById('anchoProductoSelect');
var coloresSeleccionados = [];
var colorMetalSeleccionado = [];
var colorPielSeleccionado = [];
var maximoColores = 0;
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
          alert("No puedes seleccionar más de " + maximoColores + " colores.");
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
          alert("No puedes seleccionar más de " + 1 + " color.");
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
          alert("No puedes seleccionar más de " + 1 + " color.");
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
      if (altoInt != "" && anchoInt != "" && altoInt > 0 && altoInt > 0) {
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
      if (altoInt != "" && anchoInt != "" && altoInt > 0 && altoInt > 0) {
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
          break;
        case "ganchopelo":
          $('#tdTipoBase').show();
          $('#tdColorBase').show();
          document.getElementById('resumenTipoBase').innerText = "Cierre gancho + pelo";
          thElement.rowSpan = "2";
          break;

      }

      verificarPaso3();
      //Calculo el precio si elige una base
      // calcularPrecios();
      sumaSubtotal();
    });
  }
  // FIN PASO 3-----------------------------------------------------------------------------------------------//

  // Agrega un manejador de eventos para detectar cuando el botón se deshabilita
  const miBoton = document.getElementById('anadirCarrito');
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
  document.getElementById("paso1_rowspan").rowSpan = 3;
  coloresSeleccionados.length = 0;
  document.getElementById('resumenColores').innerText = coloresSeleccionados;
  colorMetalSeleccionado.length = 0;
  document.getElementById('resumenColorMetal').innerText = coloresSeleccionados;
  colorPielSeleccionado.length = 0;
  document.getElementById('resumenColorPiel').innerText = coloresSeleccionados;
  $('#divColores').hide(); //Div de colores limitados
  $('#divColoresMetal').hide(); // Div de colores metalicos
  $('#divColoresPiel').hide(); // Div de colores pieles
  $('#tdColores').hide(); // Div colores (resumen)
  $('#tdColorPiel').hide(); // Div color piel (resumen)
  $('#tdColorMetal').hide(); // Div color metal (resumen)

  //[2] cmyk
  //[3] colores_limitados
  //Si es colores a 1 saco los colores a elegir
  if ($('select[name="tecnica"] :selected').attr('class').split(' ')[3] == 1) {
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
        buscarColores: "", idproducto: $('select[name="tecnica"] :selected').val()
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
    document.getElementById("paso1_rowspan").rowSpan = document.getElementById("paso1_rowspan").rowSpan + 1;
    $('#tdColores').show();
    $('#divColores').show();
  }

  //Busco si tiene modulo de metal
  $.ajax({
    method: "POST",
    url: "funciones/functions.php",
    dataType: 'json',
    data: {
      buscarMetal: "", idproducto: $('select[name="tecnica"] :selected').val()
    }
  }).done(function (response) {
    //Si regresa algo, es que tiene
    if (response.length === 0) {
    } else {
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
      document.getElementById("paso1_rowspan").rowSpan = document.getElementById("paso1_rowspan").rowSpan + 1;
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
      buscarPiel: "", idproducto: $('select[name="tecnica"] :selected').val()
    }
  }).done(function (response) {
    //Si regresa algo, es que tiene
    if (response.length === 0) {
    } else {
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
      document.getElementById("paso1_rowspan").rowSpan = document.getElementById("paso1_rowspan").rowSpan + 1;
      $('#tdColorPiel').show();
      $('#divColoresPiel').show();
    }
  });

  // --------------------Para el PASO 2 diseño---------------------------
  //Oculto todos los campos primero
  $('#anchoPorAlto').hide(); //Div de medidas
  $('#divInputAncho').hide(); // Div de ancho (input)
  $('#divSelectAncho').hide(); // Div de ancho (select)
  $('#tdAnchoProducto').hide(); // Div de ancho (resumen)
  $('#tdAltoProducto').hide(); // Div de alto (resumen)
  $('#tdSuperficieProducto').hide(); // Div de superficie (resumen)

  var thElement = document.getElementById('paso2_rowspan');
  // ¿La técnica seleccionada tiene ancho y alto (mínimos y máximos)? Sí = habilitar div medidas, No = deshabilito div medidas
  // [9] alto máximo = "" = sin medidas
  if ($('select[name="tecnica"] :selected').attr('class').split(' ')[9] == "") {
    $('#anchoPorAlto').hide();
    $('#tdAnchoProducto').hide();
    $('#tdAltoProducto').hide();
    $('#tdSuperficieProducto').hide();
    thElement.rowSpan = "1";
  } else {
    thElement.rowSpan = "4";

    $('#anchoPorAlto').show();
    $('#tdAnchoProducto').show();
    $('#tdAltoProducto').show();
    $('#tdSuperficieProducto').show();

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
  // Recorre la lista de elementos y quita la clase "seleccionado"
  document.querySelectorAll(".seleccionado").forEach(function (elemento) {
    elemento.classList.remove("seleccionado");
  });
  document.getElementById("sinbase").checked = true;
  document.getElementById("divSinBase").classList.add("seleccionado");// Agrega la clase "seleccionado" al div
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
  $('#tdPrecioBase').hide(); // Div precio base (resumen)
  $('#tdCantidadTopes').hide(); // Div cantidad topes (resumen)
  $('#tdPrecioTopes').hide(); // Div precio topes (resumen)
  document.getElementById("paso3_rowspan").rowSpan = 1;

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
  var bool = true;

  // Encuentra el elemento por su clase
  const elemento = document.querySelector('.paso1');

  if (selectProducto.value != "" && document.getElementById('resumenCantidad').innerText != "") {
  } else {
    bool = false;
  }

  //Sin color a elegir
  if (document.getElementById("tdColores").style.display === "none") {
  } else {
    //Si debe elegir colores, que sea al menos uno
    if (document.getElementById('resumenColores').innerText != "") {
    } else {
      bool = false;
    }
  }

  //Sin color piel
  if (document.getElementById("tdColorPiel").style.display === "none") {
  } else {
    //Si debe elegir colores
    if (document.getElementById('resumenColorPiel').innerText != "") {
    } else {
      bool = false;
    }
  }

  //Sin color metal
  if (document.getElementById("tdColorMetal").style.display === "none") {
  } else {
    //Si debe elegir colores
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

  //Sin forma
  if (document.getElementById("tdFormaProducto").style.display === "none") {
  } else {
    //Si requiere forma, verifico que haya elegido una forma
    if (document.getElementById('resumenFormaProducto').innerText != "") {
    } else {
      bool = false;
    }
  }

  // [9] alto máximo = "" = sin medidas
  if ($('select[name="tecnica"] :selected').attr('class').split(' ')[9] == "") {
  } else {
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
  var moldeProducto = parseFloat(document.getElementById('resumenMoldeProducto').innerText.replace('€', '').replace(',', '.').trim());
  var precioProducto = parseFloat(document.getElementById('resumenPrecioProducto').innerText.replace('€', '').replace(',', '.').trim());
  var moldeBase = parseFloat(document.getElementById('resumenMoldeBase').innerText.replace('€', '').replace(',', '.').trim());
  var precioBase = parseFloat(document.getElementById('resumenPrecioBase').innerText.replace('€', '').replace(',', '.').trim());
  var precioTopes = parseFloat(document.getElementById('resumenPrecioTopes').innerText.replace('€', '').replace(',', '.').trim());

  var suma = 0;
  if (!isNaN(moldeProducto)) {
    suma += moldeProducto;
  }

  if (!isNaN(precioProducto)) {
    suma += precioProducto;
  }

  if (!isNaN(moldeBase)) {
    suma += moldeBase;
  }

  if (!isNaN(precioBase)) {
    suma += precioBase;
  }

  if (!isNaN(precioTopes)) {
    suma += precioTopes;
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

function limpiarPaso2Medidas() {
  document.getElementById('resumenAnchoProducto').innerText = "";
  document.getElementById('resumenAltoProducto').innerText = "";
  document.getElementById('resumenSuperficieProducto').innerHTML = "";
  document.getElementById('resumenPPU').innerText = "";
  document.getElementById('resumenPrecioProducto').innerText = "";
  verificarPaso2();
}

function calcularPrecios() {

}

function calcularSuperficieProducto() {
  var superficie = (anchoInt / 10) * (altoInt / 10); // Lo divido entre 10 para pasarlo a centimetros

  // Busco la superficie y la cantidad en la tabla de precios y si es correcto, lo reflejo a la tabla de resumen-presupuesto
  $.ajax({
    method: "POST",
    url: "funciones/functions.php",
    data: {
      precio: "", idproducto: $('select[name="tecnica"] :selected').val(), cantidad: inputCantidad.value, superficie: superficie
    }
  }).done(function (response) {
    response = response.trim();

    //Relleno los campos
    if (response != "") {
      document.getElementById('resumenAnchoProducto').innerText = anchoInt / 10 + "cm";
      document.getElementById('resumenAltoProducto').innerText = altoInt / 10 + "cm";
      document.getElementById('resumenSuperficieProducto').innerHTML = superficie + "cm<sup>2</sup>";
      document.getElementById('resumenPPU').innerText = response.replace(".", ",");
      document.getElementById('resumenPrecioProducto').innerText = (parseFloat(response) * parseInt(inputCantidad.value)).toFixed(2).replace(".", ",") + " €";
    } else {
      limpiarPaso2Medidas();
    }

    //Por último verifico todo el paso 2
    verificarPaso2();
  });


}