<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once($_SERVER['DOCUMENT_ROOT'].'/ext/PHPMailer/src/Exception.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/ext/PHPMailer/src/PHPMailer.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/ext/PHPMailer/src/SMTP.php');

if(isset($_POST["EMAIL_DEST"])) {

    $STRING_ENCODE  = base64_encode($_POST["EMAIL_DEST"]);
    #$URL = 'https://www.e-saudebr.com/app/login/recuperar_senha.php?uid='.$STRING_ENCODE;
    $URL = 'https://localhost/e/app/login/forgot_password/index.php?uid='.$STRING_ENCODE;
        
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
                                <p style="font-family: Georgia, serif; font-size: 30px; color: #3559B7; font-style: italic;text-align: center;"> Esqueceu sua senha? </p>
                                <p style="font-family: Georgia, serif; font-size: 26px; color: #3559B7; font-style: italic;text-align: center;"> Você esqueceu sua senha, vamos ajuda-lo a se reconectar. <br> Click no botão abaixo para redefinir sua senha</p>
                                <div style="text-align: center;">
                                    <a class="btn" href='.$URL.' style="	box-shadow:inset 0px 1px 0px 0px #f9eca0;
                                                                            background:linear-gradient(to bottom, #f0c911 5%, #f2ab1e 100%);
                                                                            background-color:#f0c911;
                                                                            border-radius:8px;
                                                                            border:1px solid #e65f44;
                                                                            display:inline-block;
                                                                            cursor:pointer;
                                                                            color:#c92200;
                                                                            font-family:Arial;
                                                                            font-size:24px;
                                                                            font-weight:bold;
                                                                            padding:6px 24px;
                                                                            text-decoration:none;
                                                                            text-shadow:0px 0px 0px #ded17c;">
                                        Esqueci minha Senha
                                    </a>
                                </div>
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
    
    $smtpUsername = secrets.EMAIL_USER;
    $smtpPassword = secrets.EMAIL_PASS;
    
    $emailFrom    = $smtpUsername;
    $emailFromName = 'Noreply';

    $emailTo = $_POST["EMAIL_DEST"];
    $emailToName = 'Usuário';

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
    $mail->Subject = 'Recuperar minha senha E-saudebr;';    
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
