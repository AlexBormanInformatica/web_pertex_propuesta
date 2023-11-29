<?php
require_once('includes/config.php');
include("funciones/functions.php");
include('classes/AES.php');
include("assets/_partials/codigo-idiomas.php");
?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title><?= buscarTexto("WEB", "aviso-legal", "avisol_title_seo", "", $_SESSION['idioma']); ?></title>
	<meta name="description" content="<?= buscarTexto("WEB", "aviso-legal", "avisol_description_seo", "", $_SESSION['idioma']); ?>">
	<link rel="canonical" href="https://personalizacionestextiles.com/aviso-legal">
	<meta property="og:locale" content="es_ES">
	<meta property="og:site_name" content="personalizacionestextiles" />
	<meta property="og:url" content="https://personalizacionestextiles.com/aviso-legal" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="<?= buscarTexto("WEB", "aviso-legal", "avisol_og:title_seo", "", $_SESSION['idioma']); ?>" />
	<meta property="og:description" content="<?= buscarTexto("WEB", "aviso-legal", "avisol_og:description_seo", "", $_SESSION['idioma']); ?>" />
	<meta property="og:image" content="https://personalizacionestextiles.com/images/logo.png" />

	<?php
	include("assets/_partials/header.php");
	?>

	<div class="single-slider slider-height2 d-flex align-items-center">
		<div class="container">
			<div class="row">
				<div class="col-xl-12">
					<div class="hero-cap text-center">
						<h1 class="title-product"><?= buscarTexto("WEB", "aviso-legal", "avisol_tit-principal", "", $_SESSION['idioma']); ?></h1>
					</div>
				</div>
			</div>
		</div>
	</div>

	<section class="privacy section pt-0">
		<div class="container">
			<div class="block p-lr-30">
				<div id="informacion" class="policy-item">
					<div class="title">
						<h3 class="mb-20"><?= buscarTexto("WEB", "aviso-legal", "avisol_tit-1-info", "", $_SESSION['idioma']); ?></h3>
					</div>

					<div class="policy-details txt-alineado">
						<p><?= buscarTexto("WEB", "aviso-legal", "avisol_tit-1-info-p1", "", $_SESSION['idioma']); ?></p>
						<p><?= buscarTexto("WEB", "aviso-legal", "avisol_tit-1-info-p2", "", $_SESSION['idioma']); ?></p>
						<p><?= buscarTexto("WEB", "aviso-legal", "avisol_tit-1-info-p3", "", $_SESSION['idioma']); ?></p>
						<p><?= buscarTexto("WEB", "aviso-legal", "avisol_tit-1-info-p4", "", $_SESSION['idioma']); ?></p>
						<p><?= buscarTexto("WEB", "aviso-legal", "avisol_tit-1-info-p5", "", $_SESSION['idioma']); ?></p>
						<p><?= buscarTexto("WEB", "aviso-legal", "avisol_tit-1-info-p6", "", $_SESSION['idioma']); ?></p>
						<p><?= buscarTexto("WEB", "aviso-legal", "avisol_tit-1-info-p7", "", $_SESSION['idioma']); ?></p>
						<p><?= buscarTexto("WEB", "aviso-legal", "avisol_tit-1-info-p8", "", $_SESSION['idioma']); ?></p>
					</div>
				</div>

				<div id="terminos" class="policy-item">
					<div class="title">
						<h3 class="mb-20"><?= buscarTexto("WEB", "aviso-legal", "avisol_tit-2-term", "", $_SESSION['idioma']); ?></h3>
						<div class="policy-details txt-alineado">
							<p><?= buscarTexto("WEB", "aviso-legal", "avisol_tit-2-term-p1", "", $_SESSION['idioma']); ?></p>
						</div>
					</div>
				</div>

				<div id="introduccion" class="policy-item">
					<div class="title">
						<h3 class="mb-20"><?= buscarTexto("WEB", "aviso-legal", "avisol_tit-2.1-intro", "", $_SESSION['idioma']); ?></h3>
					</div>

					<div class="policy-details txt-alineado">
						<p><?= buscarTexto("WEB", "aviso-legal", "avisol_tit-2.1-intro-p1", "", $_SESSION['idioma']); ?></p>
						<p><?= buscarTexto("WEB", "aviso-legal", "avisol_tit-2.1-intro-p2", "", $_SESSION['idioma']); ?></p>
					</div>
				</div>

				<div id="condiciones" class="policy-item">
					<div class="title">
						<h3 class="mb-20"><?= buscarTexto("WEB", "aviso-legal", "avisol_tit-2.2-regulacion", "", $_SESSION['idioma']); ?></h3>
					</div>

					<div class="policy-details txt-alineado">
						<p><?= buscarTexto("WEB", "aviso-legal", "avisol_tit-2.2-regul-p1", "", $_SESSION['idioma']); ?></p>
						<p><?= buscarTexto("WEB", "aviso-legal", "avisol_tit-2.2-regul-p2", "", $_SESSION['idioma']); ?></p>
					</div>
				</div>

				<div id="contenido" class="policy-item">
					<div class="title">
						<h3 class="mb-20"><?= buscarTexto("WEB", "aviso-legal", "avisol_tit-3-cont", "", $_SESSION['idioma']); ?></h3>
						<div class="policy-details txt-alineado">
							<p><?= buscarTexto("WEB", "aviso-legal", "avisol_tit-3-cont-p1", "", $_SESSION['idioma']); ?></p>
						</div>
					</div>
				</div>

				<div id="servicios" class="policy-item">
					<div class="title">
						<h3 class="mb-20"><?= buscarTexto("WEB", "aviso-legal", "avisol_tit-3.1-infyserv", "", $_SESSION['idioma']); ?></h3>
					</div>

					<div class="policy-details txt-alineado">
						<p><?= buscarTexto("WEB", "aviso-legal", "avisol_tit-3.1-infyserv-p1", "", $_SESSION['idioma']); ?></p>
					</div>
				</div>

				<div id="disponibilidad" class="policy-item">
					<div class="title">
						<h3 class="mb-20"><?= buscarTexto("WEB", "aviso-legal", "avisol_tit-3.2-dispo", "", $_SESSION['idioma']); ?></h3>
					</div>

					<div class="policy-details txt-alineado">
						<p><?= buscarTexto("WEB", "aviso-legal", "avisol_tit-3.2-dispo-p1", "", $_SESSION['idioma']); ?></p>
						<p><?= buscarTexto("WEB", "aviso-legal", "avisol_tit-3.2-dispo-p2", "", $_SESSION['idioma']); ?></p>
					</div>
				</div>

				<div id="responsabilidades" class="policy-item">
					<div class="title">
						<h3 class="mb-20"><?= buscarTexto("WEB", "aviso-legal", "avisol_tit-4-res", "", $_SESSION['idioma']); ?></h3>
						<div class="policy-details txt-alineado">
							<p><?= buscarTexto("WEB", "aviso-legal", "avisol_tit-4-res-p1", "", $_SESSION['idioma']); ?></p>
						</div>
					</div>
				</div>

				<div id="web" class="policy-item">
					<div class="title">
						<h3 class="mb-20"><?= buscarTexto("WEB", "aviso-legal", "avisol_tit-4.1-ressw", "", $_SESSION['idioma']); ?></h3>
					</div>

					<div class="policy-details txt-alineado">
						<p><?= buscarTexto("WEB", "aviso-legal", "avisol_tit-4.1-ressw-p1", "", $_SESSION['idioma']); ?></p>
						<p><?= buscarTexto("WEB", "aviso-legal", "avisol_tit-4.1-ressw-p2", "", $_SESSION['idioma']); ?></p>
					</div>
				</div>

				<div id="obligaciones" class="policy-item">
					<div class="title">
						<h3 class="mb-20"><?= buscarTexto("WEB", "aviso-legal", "avisol_tit-4.2-obli", "", $_SESSION['idioma']); ?></h3>
					</div>

					<div class="policy-details txt-alineado">
						<p><?= buscarTexto("WEB", "aviso-legal", "avisol_tit-4.2-obli-p1", "", $_SESSION['idioma']); ?></p>
						<p><?= buscarTexto("WEB", "aviso-legal", "avisol_tit-4.2-obli-p2", "", $_SESSION['idioma']); ?></p>
						<p><?= buscarTexto("WEB", "aviso-legal", "avisol_tit-4.2-obli-p3", "", $_SESSION['idioma']); ?></p>
						<p><?= buscarTexto("WEB", "aviso-legal", "avisol_tit-4.2-obli-p4", "", $_SESSION['idioma']); ?></p>
						<p><?= buscarTexto("WEB", "aviso-legal", "avisol_tit-4.2-obli-p5", "", $_SESSION['idioma']); ?></p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php
	include("assets/_partials/footer.php");
	?>