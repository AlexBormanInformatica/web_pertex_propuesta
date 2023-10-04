<?php
require_once "includes/config.php";
include("functions.php");
include("includes/idioma.php");
if (!isset($_SESSION['resultadoTraduccionPertex'])) {
	$_SESSION['resultadoTraduccionPertex'] = llamadoInicial($_SESSION['idioma']);
} ?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title><?= buscarTexto("WEB", "politica-privacidad", "privad_title_seo", "", $_SESSION['idioma']); ?></title>
	<meta name="description" content="<?= buscarTexto("WEB", "politica-privacidad", "privad_description_seo", "", $_SESSION['idioma']); ?>">
	<link rel="canonical" href="https://personalizacionestextiles.com/politica-privacidad">
	<meta property="og:locale" content="es_ES">
	<meta property="og:site_name" content="personalizacionestextiles" />
	<meta property="og:url" content="https://personalizacionestextiles.com/politica-privacidad" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="<?= buscarTexto("WEB", "politica-privacidad", "privad_og:title_seo", "", $_SESSION['idioma']); ?>" />
	<meta property="og:description" content="<?= buscarTexto("WEB", "politica-privacidad", "privad_og:description_seo", "", $_SESSION['idioma']); ?>" />
	<meta property="og:image" content="https://personalizacionestextiles.com/images/logo.png" />

	<?php
	include("assets/_partials/header.php");
	?>

	<div class="single-slider slider-height2 d-flex align-items-center">
		<div class="container">
			<div class="row">
				<div class="col-xl-12">
					<div class="hero-cap text-center">
						<h1 class="title-product"><?= buscarTexto("WEB", "politica-privacidad", "privad_title-principal", "", $_SESSION['idioma']); ?></h1>
					</div>
				</div>
			</div>
		</div>
	</div>

	<section class="privacy section pt-0">
		<div class="container">
			<div class="block p-lr-30">
				<div id="datos" class="policy-item">
					<div class="title">
						<h3 class="mb-20"><?= buscarTexto("WEB", "politica-privacidad", "privad_subtitle-1", "", $_SESSION['idioma']); ?></h3>
					</div>

					<div class="policy-details txt-alineado">
						<p><?= buscarTexto("WEB", "politica-privacidad", "privad_subtitle-1-p1", "", $_SESSION['idioma']); ?></p>
						<p><?= buscarTexto("WEB", "politica-privacidad", "privad_subtitle-1-p2", "", $_SESSION['idioma']); ?> <a class="links" href="https://www.personalizacionestextiles.com/">personalizacionestextiles</a> <?= buscarTexto("WEB", "politica-privacidad", "privad_subtitle-1-p2.2", "", $_SESSION['idioma']); ?></p>
					</div>
				</div>

				<div id="responsable" class="policy-item">
					<div class="title">
						<h3 class="mb-20"><?= buscarTexto("WEB", "politica-privacidad", "privad_subtitle-2", "", $_SESSION['idioma']); ?></h3>
					</div>

					<div class="policy-details txt-alineado">
						<p><?= buscarTexto("WEB", "politica-privacidad", "privad_subtitle-2-p1", "", $_SESSION['idioma']); ?></p>
						<p><?= buscarTexto("WEB", "politica-privacidad", "privad_subtitle-2-p2", "", $_SESSION['idioma']); ?> <a class="links" href="mailto:info@bormantextil.com">info@bormantextil.com</a></p>
					</div>
				</div>

				<div id="finalidad" class="policy-item">
					<div class="title">
						<h3 class="mb-20"><?= buscarTexto("WEB", "politica-privacidad", "privad_subtitle-3", "", $_SESSION['idioma']); ?></h3>
					</div>

					<div class="policy-details txt-alineado">
						<p><?= buscarTexto("WEB", "politica-privacidad", "privad_subtitle-3-p1", "", $_SESSION['idioma']); ?></p>
						<p><?= buscarTexto("WEB", "politica-privacidad", "privad_subtitle-3-p2", "", $_SESSION['idioma']); ?></p>
						<p><?= buscarTexto("WEB", "politica-privacidad", "privad_subtitle-3-p3", "", $_SESSION['idioma']); ?></p>
						<p><?= buscarTexto("WEB", "politica-privacidad", "privad_subtitle-3-p4", "", $_SESSION['idioma']); ?> <a class="links" href="mailto:info@bormantextil.com">info@bormantextil.com</a>. <?= buscarTexto("WEB", "politica-privacidad", "privad_subtitle-3-p4.2", "", $_SESSION['idioma']); ?></p>
					</div>
				</div>

				<div id="tiempo" class="policy-item">
					<div class="title">
						<h3 class="mb-20"><?= buscarTexto("WEB", "politica-privacidad", "privad_subtitle-4", "", $_SESSION['idioma']); ?></h3>
					</div>

					<div class="policy-details txt-alineado">
						<p><?= buscarTexto("WEB", "politica-privacidad", "privad_subtitle-4-p1", "", $_SESSION['idioma']); ?></p>
					</div>
				</div>

				<div id="derechos" class="policy-item">
					<div class="title">
						<h3 class="mb-20"><?= buscarTexto("WEB", "politica-privacidad", "privad_subtitle-5", "", $_SESSION['idioma']); ?></h3>
					</div>

					<div class="policy-details txt-alineado">
						<p><?= buscarTexto("WEB", "politica-privacidad", "privad_subtitle-5-p1", "", $_SESSION['idioma']); ?></p>
						<ul>
							<li><?= buscarTexto("WEB", "politica-privacidad", "privad_subtitle-5-li1", "", $_SESSION['idioma']); ?></li>
							<li><?= buscarTexto("WEB", "politica-privacidad", "privad_subtitle-5-li2", "", $_SESSION['idioma']); ?></li>
							<li><?= buscarTexto("WEB", "politica-privacidad", "privad_subtitle-5-li3", "", $_SESSION['idioma']); ?></li>
							<li><?= buscarTexto("WEB", "politica-privacidad", "privad_subtitle-5-li4", "", $_SESSION['idioma']); ?></li>
							<li><?= buscarTexto("WEB", "politica-privacidad", "privad_subtitle-5-li5", "", $_SESSION['idioma']); ?></li>
							<li><?= buscarTexto("WEB", "politica-privacidad", "privad_subtitle-5-li6", "", $_SESSION['idioma']); ?></li>
							<li><?= buscarTexto("WEB", "politica-privacidad", "privad_subtitle-5-li7", "", $_SESSION['idioma']); ?></li>
							<li><?= buscarTexto("WEB", "politica-privacidad", "privad_subtitle-5-li8a", "", $_SESSION['idioma']); ?> <a href="mailto:ventas@personalizacionestextiles.com">ventas@personalizacionestextiles.com</a> <?= buscarTexto("WEB", "politica-privacidad", "privad_subtitle-5-li8b", "", $_SESSION['idioma']); ?></li>
							<li><?= buscarTexto("WEB", "politica-privacidad", "privad_subtitle-5-li9", "", $_SESSION['idioma']); ?></li>
							<li><?= buscarTexto("WEB", "politica-privacidad", "privad_subtitle-5-li10", "", $_SESSION['idioma']); ?></li>
						</ul>
					</div>
				</div>

				<div id="seguridad" class="policy-item">
					<div class="title">
						<h3 class="mb-20"><?= buscarTexto("WEB", "politica-privacidad", "privad_subtitle-6", "", $_SESSION['idioma']); ?></h3>
					</div>

					<div class="policy-details txt-alineado">
						<p><?= buscarTexto("WEB", "politica-privacidad", "privad_subtitle-6-p1", "", $_SESSION['idioma']); ?></p>
					</div>
				</div>

				<div id="personales" class="policy-item">
					<div class="title">
						<h3 class="mb-20"><?= buscarTexto("WEB", "politica-privacidad", "privad_subtitle-7", "", $_SESSION['idioma']); ?></h3>
					</div>

					<div class="policy-details txt-alineado">
						<p><?= buscarTexto("WEB", "politica-privacidad", "privad_subtitle-7-p1", "", $_SESSION['idioma']); ?></p>
						<p><?= buscarTexto("WEB", "politica-privacidad", "privad_subtitle7-p2", "", $_SESSION['idioma']); ?></p>
						<a href="assets/formularios/<?= strtolower($_SESSION['idioma']) ?>/borman-<?= buscarTexto("WEB", "politica-privacidad", "form1", "", $_SESSION['idioma']); ?>.docx" download class="btn btn-main-md ml-auto text-md-left my-2"><?= buscarTexto("WEB", "politica-privacidad", "privad_subtitle-7-btn1", "", $_SESSION['idioma']); ?></a>
						<a href="assets/formularios/<?= strtolower($_SESSION['idioma']) ?>/borman-<?= buscarTexto("WEB", "politica-privacidad", "form2", "", $_SESSION['idioma']); ?>.docx" download class="btn btn-main-md ml-auto my-2"><?= buscarTexto("WEB", "politica-privacidad", "privad_subtitle-7-btn2", "", $_SESSION['idioma']); ?></a>
						<a href="assets/formularios/<?= strtolower($_SESSION['idioma']) ?>/borman-<?= buscarTexto("WEB", "politica-privacidad", "form3", "", $_SESSION['idioma']); ?>.docx" download class="btn btn-main-md ml-auto my-2"><?= buscarTexto("WEB", "politica-privacidad", "privad_subtitle-7-btn3", "", $_SESSION['idioma']); ?></a>
						<a href="assets/formularios/<?= strtolower($_SESSION['idioma']) ?>/borman-<?= buscarTexto("WEB", "politica-privacidad", "form4", "", $_SESSION['idioma']); ?>.docx" download class="btn btn-main-md ml-auto my-2 "><?= buscarTexto("WEB", "politica-privacidad", "privad_subtitle-7-btn4", "", $_SESSION['idioma']); ?></a>
						<a href="assets/formularios/<?= strtolower($_SESSION['idioma']) ?>/borman-<?= buscarTexto("WEB", "politica-privacidad", "form5", "", $_SESSION['idioma']); ?>.docx" download class="btn btn-main-md ml-auto my-2"><?= buscarTexto("WEB", "politica-privacidad", "privad_subtitle-7-btn5", "", $_SESSION['idioma']); ?></a>
						<a href="assets/formularios/<?= strtolower($_SESSION['idioma']) ?>/borman-<?= buscarTexto("WEB", "politica-privacidad", "form6", "", $_SESSION['idioma']); ?>.docx" download class="btn btn-main-md ml-auto my-2 "><?= buscarTexto("WEB", "politica-privacidad", "privad_subtitle-7-btn6", "", $_SESSION['idioma']); ?></a>
						<p><?= buscarTexto("WEB", "politica-privacidad", "privad_subtitle-7-p3", "", $_SESSION['idioma']); ?></p>
					</div>
				</div>

				<div id="intelectual" class="policy-item">
					<div class="title">
						<h3 class="mb-20"><?= buscarTexto("WEB", "politica-privacidad", "privad_subtitle-8", "", $_SESSION['idioma']); ?></h3>
					</div>

					<div class="policy-details txt-alineado">
						<p><?= buscarTexto("WEB", "politica-privacidad", "privad_subtitle-8-p1", "", $_SESSION['idioma']); ?></p>
						<p><?= buscarTexto("WEB", "politica-privacidad", "privad_subtitle-8-p2", "", $_SESSION['idioma']); ?></p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php
	include("assets/_partials/footer.php");
	?>