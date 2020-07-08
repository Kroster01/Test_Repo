<?php


if (isset($_POST['name']) && !empty($_POST['name']) &&
    isset($_POST['phone']) && !empty($_POST['phone']) &&
    isset($_POST['email']) && !empty($_POST['email']) &&
    isset($_POST['subject']) && !empty($_POST['subject']) &&
    isset($_POST['message']) && !empty($_POST['name'])) {

    $to = "pruebas@construcar.cl";
    $subject = $_POST['subject'];
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From:"."construcar";
    
    $message = "
    <html>
    <head>
    <title>HTML</title>
    </head>
    <body>
    <h1>Plantilla del correo electrónico</h1>
    <p>Nombre: ".$_POST['name']."</p>
    <p>phone: ".$_POST['phone']."</p>
    <p>email: ".$_POST['email']."</p>
    <p>subject: ".$_POST['subject']."</p>
    <p>message: ".$_POST['message']."</p>
    </body>
    </html>";
    
    mail($to, $subject, $message, $headers);
    
    echo "Success";
}

?>
