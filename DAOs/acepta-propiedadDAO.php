<?php
require_once('../includes/config.php');

$propiedad = $_POST['propiedad_intelectual'];
$id_diseno = $_POST['id_diseno'];

//Se cambia el estado del diseño a Boceto aceptado
$sql = "UPDATE disenos SET estado='Boceto aceptado' WHERE id_diseno=?";
$sentencia = $conn->prepare($sql);
$sentencia->bindParam(1, $id_diseno, PDO::PARAM_INT);
$sentencia->execute();

//Se guarda en el historial del diseño
$fechaAhora = date("Y-m-d H:i:s", time());
$sql = "INSERT INTO historial_pertex (usuario, descripcion, anotaciones, fecha, id_diseno) VALUES (?, 'BOCETO ACEPTADO', '', ?, ?)";
$sentencia = $conn->prepare($sql);
$sentencia->bindParam(1, $_SESSION['ID'], PDO::PARAM_STR);
$sentencia->bindParam(2, $fechaAhora, PDO::PARAM_STR);
$sentencia->bindParam(3, $id_diseno, PDO::PARAM_INT);
$sentencia->execute();

//Se envía un correo al cliente como que ha aceptado el boceto 
//y lo tiene disponible en su carrito para pagar
use PHPMailer\PHPMailer\PHPMailer;

require_once '../vendor/autoload.php';
$mail = new PHPMailer();

$mail->CharSet = "UTF-8";
$mail->SetFrom('alexandra.serrano.chacon@gmail.com', "Alexandra");
$mail->IsHTML(true);
$mail->SMTPDebug = 2;

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'alexandra.serrano.chacon@gmail.com';
$mail->Password = 'wnye mdqz eaid ztme';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$mail->addAddress("alexandra.serrano.chacon@gmail.com", '');
$mail->Subject = "Boceto aceptado 🎉";
$mail->Body = "<!DOCTYPE html>
            <html lang='en' xmlns='http://www.w3.org/1999/xhtml' xmlns:o='urn:schemas-microsoft-com:office:office'>
            
            <head>
                <meta charset='utf-8'>
                <meta name='viewport' content='width=device-width,initial-scale=1'>
                <meta name='x-apple-disable-message-reformatting'>
                <title></title>
                <!--[if mso]>
                        <noscript>
                            <xml>
                                <o:OfficeDocumentSettings>
                                    <o:PixelsPerInch>96</o:PixelsPerInch>
                                </o:OfficeDocumentSettings>
                            </xml>
                        </noscript>
                        <![endif]-->
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
            
            <body style='margin:0;padding:0;text-align: justify;'>
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
                                                    <h1 style='font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;'>Has acpetado el boceto de tu diseño Nº" . $id_diseno . "</h1>
                                                    <p style='margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;'>El siguiente paso es pagar el diseño. Puedes hacerlo junto con otros diseños en tu carrito. Una vez que se realice y confirme el pago, comenzaremos a fabricar tu pedido.</p>
                                                    <p style='margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;'>Si tienes alguna pregunta, no dudes en contactarnos.</p>
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
                                                    <h2 style='font-size:18px;margin:0 0 20px 0;font-family:Arial,sans-serif;color:#ffffff;'>¿Cómo es el proceso de un diseño?</h2>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style='padding:0;' align='center'>
                                                    <p style='margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;'><a href='https://personalizacionestextiles.com/infografia' style='background-color:#00953E;padding:10px 30px 10px 30px;border-radius:20px;color:#fff;text-decoration: none;'>Ver</a></p>
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
                                                        &reg; Personalizaciones textiles 2022<br /><a href='https://personalizacionestextiles.com/aviso-legal' style='color:#000;text-decoration:underline;'>Aviso legal</a> | <a href='https://personalizacionestextiles.com/politica-privacidad' style='color:#000;text-decoration:underline;'>Política de privacidad</a>
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
            
            </html>";

if ($mail->send()) {
} else {
}
header("location: ../carrito");