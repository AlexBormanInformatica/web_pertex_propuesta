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
	<title><?= buscarTexto("WEB", "politica-cookies", "cookies_title_seo", "", $_SESSION['idioma']); ?></title>
	<meta name="description" content="<?= buscarTexto("WEB", "politica-cookies", "cookies_description_seo", "", $_SESSION['idioma']); ?>">
	<link rel="canonical" href="https://personalizacionestextiles.com/politica-cookies">
	<meta property="og:locale" content="es_ES">
	<meta property="og:site_name" content="personalizacionestextiles" />
	<meta property="og:url" content="https://personalizacionestextiles.com/politica-cookies" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="<?= buscarTexto("WEB", "politica-cookies", "cookies_og:title_seo", "", $_SESSION['idioma']); ?>" />
	<meta property="og:description" content="<?= buscarTexto("WEB", "politica-cookies", "cookies_og:description_seo", "", $_SESSION['idioma']); ?>" />
	<meta property="og:image" content="https://personalizacionestextiles.com/images/logo.png" />
	<?php
	include("assets/_partials/header.php");
	?>
	<div class="single-slider slider-height2 d-flex align-items-center">
		<div class="container">
			<div class="row">
				<div class="col-xl-12">
					<div class="hero-cap text-center">
						<h1 class="title-product"><?= buscarTexto("WEB", "politica-cookies", "cookies_tit-principal", "", $_SESSION['idioma']); ?></h1>

					</div>
				</div>
			</div>
		</div>
	</div>

	<section class="privacy section pt-0">
		<div class="container">
			<div class="block p-lr-30">
				<div id="cookies" class="policy-item">
					<div class="title">
						<h3 class="mb-20"><?= buscarTexto("WEB", "politica-cookies", "cookies_preg1", "", $_SESSION['idioma']); ?></h3>
					</div>

					<div class="policy-details txt-alineado">
						<p><?= buscarTexto("WEB", "politica-cookies", "cookies_preg1-p1", "", $_SESSION['idioma']); ?></p>
					</div>
				</div>

				<div id="funcion" class="policy-item">
					<div class="title">
						<h3 class="mb-20"><?= buscarTexto("WEB", "politica-cookies", "cookies_preg2", "", $_SESSION['idioma']); ?></h3>
					</div>

					<div class="policy-details txt-alineado">
						<p><?= buscarTexto("WEB", "politica-cookies", "cookies_preg2-p1", "", $_SESSION['idioma']); ?></p>
					</div>
				</div>

				<div id="tipos" class="policy-item">
					<div class="title">
						<h3 class="mb-20"><?= buscarTexto("WEB", "politica-cookies", "cookies_preg3", "", $_SESSION['idioma']); ?></h3>
					</div>

					<div class="policy-details txt-alineado">
						<p><?= buscarTexto("WEB", "politica-cookies", "cookies_preg3-p1", "", $_SESSION['idioma']); ?></p>
						<p><?= buscarTexto("WEB", "politica-cookies", "cookies_preg3-p2", "", $_SESSION['idioma']); ?></p>
						<p><?= buscarTexto("WEB", "politica-cookies", "cookies_preg3-p3", "", $_SESSION['idioma']); ?></p>
						<p><?= buscarTexto("WEB", "politica-cookies", "cookies_preg3-p4", "", $_SESSION['idioma']); ?></p>
					</div>
				</div>

				<div id="aceptacion" class="policy-item">
					<div class="title">
						<h3 class="mb-20"><?= buscarTexto("WEB", "politica-cookies", "cookies_preg4", "", $_SESSION['idioma']); ?></h3>
					</div>

					<div class="policy-details txt-alineado">
						<p><?= buscarTexto("WEB", "politica-cookies", "cookies_preg4-p1", "", $_SESSION['idioma']); ?></p>
						<p><?= buscarTexto("WEB", "politica-cookies", "cookies_preg4-p2", "", $_SESSION['idioma']); ?></p>
						<p><?= buscarTexto("WEB", "politica-cookies", "cookies_preg4-p3", "", $_SESSION['idioma']); ?></p>
						<p><?= buscarTexto("WEB", "politica-cookies", "cookies_preg4-p4", "", $_SESSION['idioma']); ?></p>
					</div>
				</div>

				<div id="revocacion" class="policy-item">
					<div class="title">
						<h3 class="mb-20"><?= buscarTexto("WEB", "politica-cookies", "cookies_preg5", "", $_SESSION['idioma']); ?></h3>
					</div>

					<div class="policy-details txt-alineado">
						<p><?= buscarTexto("WEB", "politica-cookies", "cookies_preg5-p1", "", $_SESSION['idioma']); ?></p>
						<p><?= buscarTexto("WEB", "politica-cookies", "cookies_preg5-p2", "", $_SESSION['idioma']); ?><a class="links" href="https://support.mozilla.org/es/kb/habilitar-y-deshabilitar-cookies-sitios-web-rastrear-preferencias?redirectslug=habilitar-y-deshabilitar-cookies-que-los-sitios-we&redirectlocale=es" target="_blank"> <?= buscarTexto("WEB", "politica-cookies", "cookies_preg5-aqui", "", $_SESSION['idioma']); ?></a>.</p>
						<p><?= buscarTexto("WEB", "politica-cookies", "cookies_preg5-p3", "", $_SESSION['idioma']); ?><a class="links" href="https://support.google.com/accounts/answer/61416?hl=es" target="_blank"> <?= buscarTexto("WEB", "politica-cookies", "cookies_preg5-aqui", "", $_SESSION['idioma']); ?></a>.</p>
						<p><?= buscarTexto("WEB", "politica-cookies", "cookies_preg5-p4", "", $_SESSION['idioma']); ?><a class="links" href="https://support.microsoft.com/es-es/windows/eliminar-y-administrar-cookies-168dab11-0753-043d-7c16-ede5947fc64d#ie=ie-11" target="_blank"> <?= buscarTexto("WEB", "politica-cookies", "cookies_preg5-aqui", "", $_SESSION['idioma']); ?></a>.</p>
						<p><?= buscarTexto("WEB", "politica-cookies", "cookies_preg5-p5", "", $_SESSION['idioma']); ?> <a class="links" href="https://support.apple.com/es-es/HT201265" target="_blank"><?= buscarTexto("WEB", "politica-cookies", "cookies_preg5-aqui", "", $_SESSION['idioma']); ?></a>.</p>
					</div>
				</div>

				<div id="detalles" class="policy-item">
					<div class="title">
						<h3 class="mb-20"><?= buscarTexto("WEB", "politica-cookies", "cookies_preg6", "", $_SESSION['idioma']); ?></h3>
					</div>
					<div class="policy-details txt-alineado">
						<p><?= buscarTexto("WEB", "politica-cookies", "cookies_preg6-p1", "", $_SESSION['idioma']); ?></p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php
	include("assets/_partials/footer.php");
	?>