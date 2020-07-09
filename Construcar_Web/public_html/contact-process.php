<?php


if (isset($_POST['name']) && !empty($_POST['name']) &&
    isset($_POST['phone']) && !empty($_POST['phone']) &&
    isset($_POST['email']) && !empty($_POST['email']) &&
    isset($_POST['subject']) && !empty($_POST['subject']) &&
    isset($_POST['message']) && !empty($_POST['name'])) {

    $to = "pruebas@construcar.cl";
    $subject = 'Contacto desde la Web - '.date("d-m-Y H:i:s");
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From:"."construcar";

    $message = "
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset='utf-8' />
            <title></title>
            <meta name='viewport' content='width=device-width, initial-scale=1.0' />
        </head>
        <body>
            <div align='center'>
                <table width='714' border='0' cellpadding='0' cellspacing='0' style='border-collapse:collapse; background-color:#F5F5F5; font-family:'>
                    <tbody>
                        <tr height='30' style='background-color:#FF1300'>
                            <td width='80'></td>
                            <td colspan='3'><img></td>
                            <td width='80'></td>
                        </tr>
                        <tr style=''>
                            <td></td>
                            <td width='20' style='background-color:#ffffff'></td>
                            <td style='background-color:#ffffff; color:#444444; font-size:16px; padding-bottom:40px; padding-top:10px'>
                                <table width='100%' style='border:1px solid #E0E0E0'>
                                    <tbody>
                                        <tr style='font-size:14px; color:#444444'>
                                            <td valign='bottom' style='padding:5px'>
                                                <span style='margin-top: 10px; margin-bottom: 17px; font-weight: normal; font-family: Tahoma, &quot;Open Sans&quot;, sans-serif, serif, EmojiFont;'>
                                                    Estimada(o) Construcar:<br>Te enviamos el detalle de la solicitud realizada.<br>Con fecha ".date('d-m-Y H:i:s').":
                                                </span>
                                            </td>
                                            <td align='right' valign='bottom' nowrap='' style='padding:5px'></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table width='100%' style='border-bottom:1px solid #CCCCCC'>
                                    <tbody>
                                        <tr style=''>
                                            <td width='228' style='padding-top:20px; padding-bottom:20px'>
                                                <p align='right' style='margin: 0px; font-size: 14px; font-family: Tahoma, &quot;Open Sans&quot;, sans-serif, serif, EmojiFont;'>
                                                    <strong>Resumen de los datos enviados: </strong>
                                                </p>
                                            </td>
                                            <td width='250' style='padding-top:20px; padding-left:10px; padding-bottom:20px'>
                                                <p style='margin: 0px; font-size: 32px; font-family: Tahoma, &quot;Open Sans&quot;, sans-serif, serif, EmojiFont;'></p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table width='100%'>
                                    <tbody>
                                        <tr>
                                            <td style='border-bottom:1px solid #CCCCCC; padding-top:15px; padding-bottom:15px'>
                                                <p style='margin: 0px; color: rgb(68, 68, 68); font-size: 14px; font-weight: 500; font-family: Tahoma, &quot;Open Sans&quot;, sans-serif, serif, EmojiFont;'>
                                                    <strong>Nombre Solicitante:</strong><br>
                                                </p>
                                                <p style='margin: 0px; color: rgb(160, 160, 160); font-size: 13px; font-family: Tahoma, &quot;Open Sans&quot;, sans-serif, serif, EmojiFont;'>
                                                    ".$_POST['name']."
                                                </p>
                                            </td>
                                            <td></td>
                                            <td style='border-bottom:1px solid #CCCCCC; padding-top:15px; padding-bottom:15px'>
                                                <p style='margin: 0px; color: rgb(68, 68, 68); font-size: 14px; font-weight: 500; font-family: Tahoma, &quot;Open Sans&quot;, sans-serif, serif, EmojiFont;'>
                                                    <strong>Teléfono:</strong></p>
                                                <p style='margin: 0px; color: rgb(160, 160, 160); font-size: 13px; font-family: Tahoma, &quot;Open Sans&quot;, sans-serif, serif, EmojiFont;'>
                                                    ".$_POST['phone']."
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style='border-bottom:1px solid #CCCCCC; padding-top:15px; padding-bottom:15px'>
                                                <p style='margin: 0px; color: rgb(68, 68, 68); font-size: 14px; font-weight: 500; font-family: Tahoma, &quot;Open Sans&quot;, sans-serif, serif, EmojiFont;'>
                                                    <strong>Correo:</strong></p>
                                                <p style='margin: 0px; color: rgb(160, 160, 160); font-size: 13px; font-family: Tahoma, &quot;Open Sans&quot;, sans-serif, serif, EmojiFont;'>
                                                    ".$_POST['email']."
                                                </p>
                                            </td>
                                            <td></td>
                                            <td style='border-bottom:1px solid #CCCCCC; padding-top:15px; padding-bottom:15px'>
                                                <p style='margin: 0px; color: rgb(68, 68, 68); font-size: 14px; font-weight: 500; font-family: Tahoma, &quot;Open Sans&quot;, sans-serif, serif, EmojiFont;'>
                                                    <strong>Asunto:</strong></p>
                                                <p style='margin: 0px; color: rgb(160, 160, 160); font-size: 13px; font-family: Tahoma, &quot;Open Sans&quot;, sans-serif, serif, EmojiFont;'>
                                                    ".$_POST['subject']."
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style='border-bottom:1px solid #CCCCCC; padding-top:15px; padding-bottom:15px'>
                                                <p style='margin: 0px; color: rgb(68, 68, 68); font-size: 14px; font-weight: 500; font-family: Tahoma, &quot;Open Sans&quot;, sans-serif, serif, EmojiFont;'>
                                                    <strong>Comentario:</strong></p>
                                                <p style='margin: 0px; color: rgb(160, 160, 160); font-size: 13px; font-family: Tahoma, &quot;Open Sans&quot;, sans-serif, serif, EmojiFont;'>
                                                ".$_POST['message']."
                                                </p>
                                            </td>
                                            <td></td>
                                            <td style='padding-top:15px; padding-bottom:15px'>
                                                <p style='margin: 0px; color: rgb(68, 68, 68); font-size: 14px; font-weight: 500; font-family: Tahoma, &quot;Open Sans&quot;, sans-serif, serif, EmojiFont;'>
                                                    <strong></strong>
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan='3' style='padding-top:15px; padding-bottom:15px'>
                                                <table width='100%' style='border:1px solid #E0E0E0'>
                                                    <thead>
                                                        <tr style='font-size:12px; color:#444444'>
                                                            <td align='center' style='font-size:12px; padding:5px; background-color:#F5F5F5; font-family:Tahoma,Open Sans,sans-serif'>
                                                                <p style='font-family:'>Nota: Este e-mail es generado de manera automatica, por favor no respondas a este mensaje. Asimismo, se han omitido acentos para evitar problemas de compatibilidad.</p>
                                                            </td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td width='20' style='background-color:#ffffff'></td>
                            <td></td>
                        </tr>
                        <tr height='30' style='background-color:#FF1300'>
                            <td width='80'></td>
                            <td colspan='3'><img></td>
                            <td width='80'></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </body>
    </html>
    ";
    mail($to, $subject, $message, $headers);

    echo "Success";
}

?>
