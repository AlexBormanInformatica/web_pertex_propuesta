<div class="col-lg-3 col-md-3 ">
    <div class="card m-b-50 mx-auto">
        <ul class="list-group list-group-flush">
            <?php
            $sql_escliente = "SELECT COUNT(*) AS count FROM fichaempresametas WHERE idfichaempresa=? AND tieneDNI = 1 AND tieneFormulario = 1";
            $query_escliente = $conn_formularios->prepare($sql_escliente);
            $query_escliente->bindParam(1, $_SESSION['idfichaempresa'], PDO::PARAM_INT);
            $query_escliente->execute();
            $escliente = $query_escliente->fetchColumn();
            if ($escliente == 0) {
            ?>
                <li class="color-danger"><i style="color:red" class="fas fa-exclamation"></i> Completa tus datos para poder comprar</li>

            <?php
            }
            ?>
            <li class="list-group-item p-l-30"> <img alt="<?= buscarTexto("WEB", "mi-cuenta", "alt-mi-cuenta", "", $_SESSION['idioma']); ?>" src="iconos/Mi_cuenta_2.png"><span class="m-l-10"><a class="text-black" href="<?= buscarTexto("WEB", "paginas", "cuenta", "", $_SESSION['idioma']); ?>"><?= buscarTexto("WEB", "mi-cuenta", "cuenta_li-1", "", $_SESSION['idioma']); ?></a></span></li>
            <li class="list-group-item p-l-30"> <img alt="" src="iconos/mi-carrito.png"><span class="m-l-10"><a class="text-black" href="carrito">Carrito <span>(<?= $count_disenos ?>)</span></a></span></li>
            <li class="list-group-item p-l-30"> <img alt="" src="iconos/mis-disenos.png"><span class="m-l-10"><a class="text-black" href="historial-disenos">Mis diseños</a></span></li>
            <li class="list-group-item p-l-30"><img alt="<?= buscarTexto("WEB", "mi-cuenta", "alt-historial", "", $_SESSION['idioma']); ?>" src="iconos/Historial_pedidos_2.png"><span class="m-l-10"><a class="text-black" href="<?= buscarTexto("WEB", "paginas", "historial-pedidos", "", $_SESSION['idioma']); ?>"><?= buscarTexto("WEB", "mi-cuenta", "cuenta_li-3", "", $_SESSION['idioma']); ?></a></span></li>
            <li class="list-group-item p-l-30"><img alt="<?= buscarTexto("WEB", "mi-cuenta", "alt-cerrar-sesion", "", $_SESSION['idioma']); ?>" src="iconos/Cerrar_sesion_2.png"><span class="m-l-10"><a class="text-black" href="logout.php"><?= buscarTexto("WEB", "mi-cuenta", "cuenta_li-5", "", $_SESSION['idioma']); ?></a></span></li>
        </ul>
    </div>
</div>