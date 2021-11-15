<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once('../../ext/PHPMailer/src/Exception.php');
require_once('../../ext/PHPMailer/src/PHPMailer.php');
require_once('../../ext/PHPMailer/src/SMTP.php');

if(     isset($_POST["EMAIL_DEST"]) 
    &&  isset($_POST["NOME_DEST"])) {
        
    $BODY = '<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Email</title>
        </head>
    
        <body>
            <main class="container">
    
                <div class="body">
                    <p style="font-family: Georgia, serif; font-size: 30px; color: #3559B7; font-style: italic;text-align: center;"> 
                        Boas vindas a plataforma E-SaúdeBr! 
                    </p>
                    <p style="font-family: Georgia, serif; font-size: 26px; color: #3559B7; font-style: italic;text-align: center;"> 
                        Você se cadastrou com sucesso a plataforma.
                    </p>                    
                </div>
            </main>
            <section class="">
                <!-- Footer -->
                <footer style="text-align: center;background-color:#04549c;font-family: Georgia, serif; font-size: 24px; color: whitesmoke; font-style: italic;">
                <!-- Grid container -->
                    <div class="container p-4 pb-0">
                        <!-- Section: CTA -->
                        <section class="">
                            <p style="text-align: center;">
                                Contato: contato@e-saudebr.com
                            </p>
                        </section>
                    </div>
    
                    <!-- Copyright -->
                    <div style="text-align:center;background-color: rgba(0, 0, 0, 0.2);">
                        © 2021 Copyright:
                        <a class="text-white" href="https://e-saudebr.com">www.e-saudebr.com</a>
                    </div>
                    
                </footer>
            </section>
        </body>
    </html>';
    
    $smtpUsername = 'noreply@e-saudebr.com';
    $smtpPassword = 'Noreply2021';
    
    $emailFrom    = $smtpUsername;
    $emailFromName = 'Noreply';

    $emailTo = $_POST["EMAIL_DEST"];
    $emailToName = $_POST["NOME_DEST"];

    $mail = new PHPMailer;
    $mail->isSMTP(); 
    $mail->CharSet = 'UTF-8';
    $mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
    $mail->Host = "smtp.hostinger.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
    $mail->Port = 587; // TLS only
    $mail->SMTPSecure = 'tls'; // ssl is depracated
    $mail->SMTPAuth = true;
    $mail->Username = $smtpUsername;
    $mail->Password = $smtpPassword;
    $mail->setFrom($emailFrom, $emailFromName);
    $mail->addAddress($emailTo, $emailToName);
    $mail->Subject = 'Boas vindas ao E-SaudeBr ';    
    $mail->AddEmbeddedImage('../../ext/images/ebr/esaudeBR-horizontal.png', 'e_saudebr','esaudeBR-horizontal.png');
    $mail->msgHTML($BODY); //Read an HTML message body from an external file, convert referenced images to embedded,
    $mail->AltBody = 'HTML messaging not supported';
    
    if(!$mail->send()){
        echo "Mailer Error: " . $mail->ErrorInfo;
    }else{
        echo "Message sent!";
    }
}
?>