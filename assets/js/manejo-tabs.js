(function ($) {

    var i = 0;
    window.addEventListener("load", function () {
        let tabs = document.querySelectorAll(".divpills a");
        let tabsMovil = document.querySelectorAll(".divpills2 a");
        let nextTab = document.getElementById("v-pills-next-tab");
        let nextTabMovil = document.getElementById("v-pills-next-tabmv");
        nextTab.addEventListener("click", function () {
            //Primero veo en que NAV/TAB estoy, y verifico si el paso de dicho tab esta COMPLETO, para habilitar el botón de SIGUIENTE PASO
            var idDelElementoActivo = document.querySelector(".paso1").getAttribute("id");
            switch (idDelElementoActivo) {
                case "nav-paso1":
                    if (document.querySelector(".paso1").classList.contains("paso-completo")) {
                        nextTab.removeAttribute("disabled"); // Habilita el botón
                        nextTab.textContent = "SIGUIENTE PASO"; // Cambia el texto del botón
                    }
                    break;

                case "nav-paso2":
                    if (document.querySelector(".paso2").classList.contains("paso-completo")) {
                        nextTab.removeAttribute("disabled"); // Habilita el botón
                        nextTab.textContent = "SIGUIENTE PASO"; // Cambia el texto del botón
                    }
                    break;

                case "nav-paso3":
                    if (document.querySelector(".paso3").classList.contains("paso-completo")) {
                        nextTab.removeAttribute("disabled"); // Habilita el botón
                        nextTab.textContent = "SIGUIENTE PASO"; // Cambia el texto del botón
                    }
                    break;
                default:
                    nextTab.setAttribute("disabled", "true"); // Deshabilita el botón
                    nextTab.textContent = "FALTAN CAMPOS POR COMPLETAR"; // Cambia el texto del botón
                    break;
            }

            i = (i == (tabs.length - 1)) ? 0 : i + 1;
            tabs[i].click();


            switch ($('.nav-link[aria-selected="true"]').eq(1).attr("href")) {
                case "#tecnicas":
                    i = 0;
                    break;
                case "#diseno":
                    i = 1;
                    break;
                case "#complementos":
                    i = 2;
                    break;
                case "#imagen":
                    i = 3;
                    verificar4Completos();
                    break;
            }
            subir();
        }, false);

        nextTabMovil.addEventListener("click", function () {
            i = (i == (tabsMovil.length - 1)) ? 0 : i + 1;
            tabsMovil[i].click();
            subir();
        }, false);

        ////////////////////iconos tabs//////////////////////
        $('.primerBoton').on('click', function () {
            i = 0;
            $('#imgtecnica')[0].setAttribute("src", "iconos/Tecnica3.png");
            $('#imgdiseno')[0].setAttribute("src", "iconos/Diseno6.png");
            $('#imgcomplementos')[0].setAttribute("src", "iconos/Diseno6.png");
            $('#imgsubirfoto')[0].setAttribute("src", "iconos/Subir-foto6.png");

            $('#v-pills-next-tab').show();
            $('#encargarDiseno').hide();
            subir();

            if (document.querySelector(".paso1").classList.contains("paso-completo")) {
                nextTab.removeAttribute("disabled"); // Habilita el botón
                nextTab.textContent = "SIGUIENTE PASO"; // Cambia el texto del botón
            } else {
                nextTab.setAttribute("disabled", "true"); // Deshabilita el botón
                nextTab.textContent = "FALTAN CAMPOS POR COMPLETAR"; // Cambia el texto del botón
            }
        });
        $('.segundoBoton').on('click', function () {
            i = 1;
            $('#imgtecnica')[0].setAttribute("src", "iconos/Tecnica6.png");
            $('#imgdiseno')[0].setAttribute("src", "iconos/Diseno3.png");
            $('#imgcomplementos')[0].setAttribute("src", "iconos/Diseno6.png");
            $('#imgsubirfoto')[0].setAttribute("src", "iconos/Subir-foto6.png");

            $('#v-pills-next-tab').show();
            $('#encargarDiseno').hide();
            subir();

            if (document.querySelector(".paso2").classList.contains("paso-completo")) {
                nextTab.removeAttribute("disabled"); // Habilita el botón
                nextTab.textContent = "SIGUIENTE PASO"; // Cambia el texto del botón
            } else {
                nextTab.setAttribute("disabled", "true"); // Deshabilita el botón
                nextTab.textContent = "FALTAN CAMPOS POR COMPLETAR"; // Cambia el texto del botón
            }
        });
        $('.tercerBoton').on('click', function () {
            i = 2;
            $('#imgtecnica')[0].setAttribute("src", "iconos/Tecnica6.png");
            $('#imgdiseno')[0].setAttribute("src", "iconos/Diseno6.png");
            $('#imgcomplementos')[0].setAttribute("src", "iconos/Diseno3.png");
            $('#imgsubirfoto')[0].setAttribute("src", "iconos/Subir-foto6.png");

            $('#v-pills-next-tab').show();
            $('#encargarDiseno').hide();
            subir();

            if (document.querySelector(".paso3").classList.contains("paso-completo")) {
                nextTab.removeAttribute("disabled"); // Habilita el botón
                nextTab.textContent = "SIGUIENTE PASO"; // Cambia el texto del botón
            } else {
                nextTab.setAttribute("disabled", "true"); // Deshabilita el botón
                nextTab.textContent = "FALTAN CAMPOS POR COMPLETAR"; // Cambia el texto del botón
            }
        });
        $('.cuartoBoton').on('click', function () {
            i = 3;
            $('#imgtecnica')[0].setAttribute("src", "iconos/Tecnica6.png");
            $('#imgdiseno')[0].setAttribute("src", "iconos/Diseno6.png");
            $('#imgcomplementos')[0].setAttribute("src", "iconos/Diseno6.png");
            $('#imgsubirfoto')[0].setAttribute("src", "iconos/Subir-foto3.png");

            $('#v-pills-next-tab').hide();
            $('#encargarDiseno').show();
            subir();

            verificar4Completos();
        });

        // //movil
        // // $('.primerBotonM').on('click', function() {
        // //   i = 0;
        // //   $('#imgtecnicam')[0].setAttribute("src", "iconos/Tecnica3.png");
        // //   $('#imgdisenom')[0].setAttribute("src", "iconos/Diseno6.png");
        // //   $('#imgcoloresm')[0].setAttribute("src", "iconos/Colores6.png");
        // //   $('#imgsubirfotom')[0].setAttribute("src", "iconos/Subir-foto6.png");

        // //   $('#v-pills-next-tabmv').show();
        // //   $('#encargarDisenoMV').hide();
        // // });
        // // $('.segundoBotonM').on('click', function() {
        // //   i = 1;
        // //   $('#imgtecnicam')[0].setAttribute("src", "iconos/Tecnica6.png");
        // //   $('#imgdisenom')[0].setAttribute("src", "iconos/Diseno3.png");
        // //   $('#imgcoloresm')[0].setAttribute("src", "iconos/Colores6.png");
        // //   $('#imgsubirfotom')[0].setAttribute("src", "iconos/Subir-foto6.png");

        // //   $('#v-pills-next-tabmv').show();
        // //   $('#encargarDisenoMV').hide();
        // // });
        // // $('.tercerBotonM').on('click', function() {
        // //   i = 2;
        // //   $('#imgtecnicam')[0].setAttribute("src", "iconos/Tecnica6.png");
        // //   $('#imgdisenom')[0].setAttribute("src", "iconos/Diseno6.png");
        // //   $('#imgcoloresm')[0].setAttribute("src", "iconos/Colores3.png");
        // //   $('#imgsubirfotom')[0].setAttribute("src", "iconos/Subir-foto6.png");

        // //   $('#v-pills-next-tabmv').show();
        // //   $('#encargarDisenoMV').hide();
        // // });
        // // $('.cuartoBotonM').on('click', function() {
        // //   i = 3;
        // //   $('#imgtecnicam')[0].setAttribute("src", "iconos/Tecnica6.png");
        // //   $('#imgdisenom')[0].setAttribute("src", "iconos/Diseno6.png");
        // //   $('#imgcoloresm')[0].setAttribute("src", "iconos/Colores6.png");
        // //   $('#imgsubirfotom')[0].setAttribute("src", "iconos/Subir-foto3.png");

        // //   $('#v-pills-next-tabmv').hide();
        // //   $('#encargarDisenoMV').show();
        // // });

        // $(document).on('click', '#btnPedidoNuevo', function() {
        //   $('#btnPedidoNuevo').addClass("button--loading");
        //   $('#btnPedidoNuevo').prop("disabled", true);
        // });
    }, false);
})(jQuery);