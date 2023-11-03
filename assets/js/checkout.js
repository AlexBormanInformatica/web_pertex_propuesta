$.validator.setDefaults({
    submitHandler: function () {
        $('#boton_formulario_checkout').addClass("button--loading");
        $('#boton_formulario_checkout').prop("disabled", true);
        var amount = $('#total').val();
        var order = $('input[name=nPedido]').val();
        var paymethod = $('input[name=metodoPago]:checked').val();
        var factura = $('#sifac').is(':checked') ? 1 : 0;

        submitDelForm(amount, order, paymethod, factura);
    }
});


function submitDelForm(paymethod, order, paymethod, factura) {

    if (paymethod == "transferenciaBancaria") {
        $('#formulariopago').attr('action', "transferencia");
        $('#formulariopago').submit();
    } else {
        $('#formulariopago').attr('action', "https://sis-t.redsys.es:25443/sis/realizarPagoo");

        if ($('input[name=Ds_MerchantParameters]').val() != "" && $('input[name=Ds_Signature]').val() != "") {
            $('#formulariopago').submit();
        } else {
            console.log("Ha ocurrido un error");
        }
    }
}

/////////////////////////////////////////////////ENVIO//////////////////////////////////////////////////////////////////////////////
$(document).ready(function () {
    calcularPrecio();
})
var suma = 0;

function calcularPrecio() {
    var pais = $('#pais').val();
    var provincia = $('#provincia').val();

    //Booleanos para saber que sumar
    var nacional = false;
    var peninsula = false;
    var baleares = false;
    var ceutaYmelilla = false;
    var canarias = false;

    var corcega = false;
    var siciliaYcerdana = false;
    var azoresYmadeira = false;

    nacional = pais == "ESPAÑA" ? true : false;
    baleares = provincia == "Balears (Illes)" ? true : false;
    ceutaYmelilla = provincia == "Ceuta" ? true : provincia == "Melilla" ? true : false;
    canarias = provincia == "Palmas (Las)" ? true : provincia == "Santa Cruz de Tenerife" ? true : false;

    corcega = provincia == "Córcega" ? true : false;
    siciliaYcerdana = provincia == "Sicilia" ? true : provincia == "Cerdeña" ? true : false;
    azoresYmadeira = provincia == "Azores" ? true : provincia == "Madeira" ? true : false;

    var suplementoDua = 20.50;
    var vat = $('#intracomunitario').val() == 'Sí' ? true : false; //Si es 1 esta excento de iva (es intracomunitario), si es 0 se cobra el iva con normalidad
    var precio = ($('#subtotal').text().split(' ')[0]).replace(",", ".");
    var recargo = $('#inputRecargo').val() == 'Sí' ? (precio * 5.2) / 100 : 0;
    var iva = canarias ? 0 : ceutaYmelilla ? 0 : vat ? 0 : (precio * 21) / 100;
    var envio = 0;

    var precioMasIva = parseFloat(precio) + parseFloat(iva);

    if (nacional && (!baleares && !ceutaYmelilla && !canarias)) {
        peninsula = true;
    }

    if (nacional) {
        if (peninsula) {
            if (precioMasIva < 25) {
                envio = 5;
            } else if (precioMasIva < 99) {
                envio = 8;
            } else if (precioMasIva < 199) {
                envio = 11;
            } else if (precioMasIva < 399) {
                envio = 14;
            } else if (precioMasIva < 1000) {
                envio = 0;
            } else if (precioMasIva > 1000) {
                envio = 0;
            }
        } else if (baleares) {
            if (precioMasIva < 25) {
                envio = 10;
            } else if (precioMasIva < 99) {
                envio = 16;
            } else if (precioMasIva < 199) {
                envio = 23;
            } else if (precioMasIva < 399) {
                envio = 30;
            } else if (precioMasIva < 1000) {
                envio = 50;
            } else if (precioMasIva > 1000) {
                envio = 75;
            }
        } else if (ceutaYmelilla) {
            if (precioMasIva < 25) {
                envio = 30;
            } else if (precioMasIva < 99) {
                envio = 39;
            } else if (precioMasIva < 199) {
                envio = 48;
            } else if (precioMasIva < 399) {
                envio = 55;
            } else if (precioMasIva < 1000) {
                envio = 75;
            } else if (precioMasIva > 1000) {
                envio = 110;
            }
        } else if (canarias) {
            if (precioMasIva < 25) {
                envio = 40;
            } else if (precioMasIva < 99) {
                envio = 50;
            } else if (precioMasIva < 199) {
                envio = 63;
            } else if (precioMasIva < 399) {
                envio = 75;
            } else if (precioMasIva < 1000) {
                envio = 110;
            } else if (precioMasIva > 1000) {
                envio = 180;
            }
        }
    } else {
        if (pais == "FRANCIA") {
            if (corcega) {
                if (precioMasIva < 50) {
                    envio = 40;
                } else if (precioMasIva < 149) {
                    envio = 60;
                } else if (precioMasIva < 299) {
                    envio = 80;
                } else if (precioMasIva < 499) {
                    envio = 120;
                } else if (precioMasIva < 1000) {
                    envio = 180;
                } else if (precioMasIva > 1000) {
                    envio = 260;
                }
            } else {
                if (precioMasIva < 50) {
                    envio = 12;
                } else if (precioMasIva < 149) {
                    envio = 19;
                } else if (precioMasIva < 299) {
                    envio = 25;
                } else if (precioMasIva < 499) {
                    envio = 30;
                } else if (precioMasIva < 1000) {
                    envio = 50;
                } else if (precioMasIva > 1000) {
                    envio = 90;
                }
            }
        } else if (pais == "ITALIA") {
            if (siciliaYcerdana) {
                if (precioMasIva < 50) {
                    envio = 40;
                } else if (precioMasIva < 149) {
                    envio = 60;
                } else if (precioMasIva < 299) {
                    envio = 80;
                } else if (precioMasIva < 499) {
                    envio = 120;
                } else if (precioMasIva < 1000) {
                    envio = 180;
                } else if (precioMasIva > 1000) {
                    envio = 260;
                }
            } else {
                if (precioMasIva < 50) {
                    envio = 15;
                } else if (precioMasIva < 149) {
                    envio = 22;
                } else if (precioMasIva < 299) {
                    envio = 32;
                } else if (precioMasIva < 499) {
                    envio = 40;
                } else if (precioMasIva < 1000) {
                    envio = 65;
                } else if (precioMasIva > 1000) {
                    envio = 110;
                }
            }
        } else if (pais == "PORTUGAL") {
            if (azoresYmadeira) {
                if (precioMasIva < 50) {
                    envio = 70;
                } else if (precioMasIva < 149) {
                    envio = 90;
                } else if (precioMasIva < 299) {
                    envio = 130;
                } else if (precioMasIva < 499) {
                    envio = 190;
                } else if (precioMasIva < 1000) {
                    envio = 260;
                } else if (precioMasIva > 1000) {
                    envio = 320;
                }
            } else {
                if (precioMasIva < 50) {
                    envio = 10;
                } else if (precioMasIva < 149) {
                    envio = 13;
                } else if (precioMasIva < 299) {
                    envio = 16;
                } else if (precioMasIva < 499) {
                    envio = 20;
                } else if (precioMasIva < 1000) {
                    envio = 30;
                } else if (precioMasIva > 1000) {
                    envio = 0;
                }
            }
        }

    }

    suma = (parseFloat(precio) + parseFloat(recargo) + parseFloat(iva) + parseFloat(envio));

    if (canarias) {
        suma += (suma => 3000 ? parseFloat(suplementoDua) : 0);
        $('#liGestionDua').show();
    } else if (ceutaYmelilla) {
        suma += parseFloat(suplementoDua);
        $('#liGestionDua').show();
    } else {
        suplementoDua = 0;
        $('#liGestionDua').hide();
    }

    var strSuma = suma.toFixed(2).replace(".", ",");

    $("#gestionDua").text(suplementoDua.toFixed(2).replace(".", ","));
    $("#envio").text(envio.toFixed(2).replace(".", ","));
    $("#recargo").text(recargo.toFixed(2).replace(".", ","));
    $("#iva").text(iva.toFixed(2).replace(".", ","));
    $('#total').val(suma.toFixed(2).replace(".", ""));
    $('#totalAmount').text(strSuma);
    $('#strTotal').val(strSuma);
}