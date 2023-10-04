<?php
session_start();

include("../functions.php");
?>
<!DOCTYPE html>
<html lang='en' xmlns='http://www.w3.org/1999/xhtml' xmlns:o='urn:schemas-microsoft-com:office:office'>

<head>
	<meta charset='utf-8'>
	<meta name='viewport' content='width=device-width,initial-scale=1'>
	<meta name='x-apple-disable-message-reformatting'>
	<title></title>

	<style>
		table,
		td,
		div,
		h1,
		p {
			font-family: Arial, sans-serif;
		}
	</style>
</head>

<body style='margin:0;padding:0;'>
	<table role='presentation' style='width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;'>
		<tr>
			<td align='center' style='padding:0;'>
				<img src='https://personalizacionestextiles.com/assets/img/logo/logo.png' alt='' width='150' style='height:auto;display:block;padding:30px;' />
				<table role='presentation' style='width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;'>
					<tr>
						<td align='center' style='padding:40px 0 30px 0;background:#00953e'>
							<h1 style='font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;color:#FFF;'>Personalizaciones textiles</h1>
						</td>
					</tr>
					<tr>
						<td style='padding:36px 30px 42px 30px;'>
							<table role='presentation' style='width:100%;border-collapse:collapse;border:0;border-spacing:0;'>
								<tr>
									<td style='padding:0 0 36px 0;color:#191D34;'>
										<h1 style='font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;'><?= buscarTextoConReturn("WEB", "correos", "rep_tit1", "", $_SESSION['idioma']) ?></h1>
										<p style='margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;'><?= buscarTextoConReturn("WEB", "correos", "rep_p1", "", $_SESSION['idioma']) ?></p>
										<p style='margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;'><a href='https://personalizacionestextiles.com/<?= buscarTextoConReturn("WEB", "paginas", "historial-pedidos", "", $_SESSION[' idioma']) ?>' style='color:#ee4c50;text-decoration:underline;'><?= buscarTextoConReturn("WEB", "mi-cuenta", "cuenta_li-3", "", $_SESSION['idioma']) ?></a></p>
									</td>
								</tr>
								<tr>
									<td style='padding:0 0 36px 0;color:#191D34;'>
										<p style='margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;'><strong><?= buscarTextoConReturn("WEB", "correos", "rep_p2", "", $_SESSION['idioma']) ?><img width="30px" src='../iconos/mi-cuenta/ver-boceto.png' alt='<?= buscarTextoConReturn("WEB", "historial-pedidos", "alt-ver-boceto", "", $_SESSION['idioma']) ?>'></p>
										<p style='margin:20px 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;'><?= buscarTextoConReturn("WEB", "correos", "conf_p3", "", $_SESSION['idioma']) ?><br><?= buscarTextoConReturn("WEB", "correos", "conf_p4", "", $_SESSION['idioma']) ?></p>
										<a href='https://personalizacionestextiles.com/' style='color:#00953e;'>personalizacionestextiles.com</a>
									</td>
								</tr>

							</table>
						</td>
					</tr>
					<tr>
						<td style='padding:30px;background:#191D34;'>
							<table role='presentation' style='width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;'>
								<tr>
									<td style='padding:0;' align='center'>
									<h2 style='font-size:18px;margin:0 0 20px 0;font-family:Arial,sans-serif;color:#ffffff;'><?= buscarTextoConReturn("WEB", "correos", "recu_tit2", "", $_SESSION['idioma']) ?></h2>
									</td>
								</tr>
								<tr>
									<td style='padding:0;' align='center'>
										<p style='margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;'><a href='https://personalizacionestextiles.com/<?= buscarTextoConReturn("WEB", "paginas" , "infografia" , "" , $_SESSION['idioma']) ?>' style='background-color:#00953E;padding:10px 30px 10px 30px;border-radius:20px;color:#fff; text-decoration: none;'><?= buscarTextoConReturn("WEB", "correos", "recu_btn-ver", "", $_SESSION['idioma']) ?></a></p>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td style='padding:30px;background:#eeee;'>
							<table role='presentation' style='width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;'>
								<tr>
								<td style='padding:0;width:50%;' align='center'>
										<p style='margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#000;'>
										&reg; Personalizaciones textiles 2022<br/><a href='https://personalizacionestextiles.com/<?= buscarTextoConReturn("WEB", "paginas" , "aviso-legal" , "" , $_SESSION['idioma']) ?>' style='color:#000;text-decoration:underline;'><?= buscarTextoConReturn("WEB", "footer-fin" , "foot_fin-aviso" , "" , $_SESSION['idioma']) ?></a> | <a href='https://personalizacionestextiles.com/<?= buscarTextoConReturn("WEB", "paginas" , "privacidad" , "" , $_SESSION['idioma']) ?>' style='color:#000;text-decoration:underline;'><?= buscarTextoConReturn("WEB", "footer-fin" , "foot_fin-privacidad" , "" , $_SESSION['idioma']) ?></a>
										</p>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>

</html>