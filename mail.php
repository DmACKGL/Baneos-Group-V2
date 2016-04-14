<?php
require 'phpmailer/PHPMailerAutoload.php';
$usuario = 'PENE PENE';
date_default_timezone_set('America/Santiago');
$horapw = date("d/m/Y - h:m:i a");
$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'phx03.reliabledns.org';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'baneos@gamerchileno.net';                 // SMTP username
$mail->Password = 'sanpop123';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 25;                                    // TCP port to connect to

$mail->From = 'baneos@gamerchileno.net';
$mail->FromName = 'Baneos GamerChileno';
//$mail->addAddress('francosanllehi@gmail.com');     // Add a recipient
$mail->addAddress('pablig17@gmail.com');               // Name is optional
//$mail->addReplyTo('pablig17@gmail.com', 'Pablo Riquelme');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('img/logo.png');          // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Password sistema de baneos - '.$usuario;
$mail->Body    = '<p style="margin: 0px; color: #666666; line-height: 26px; font-size: 16px; font-weight: 300; font-family: Helvetica Neue,Helvetica,Helvetica,Arial,sans-serif!important;">
                  Estimado <b>'.$usuario.'</b> enviamos a continuacion su nueva contraseña para el sistema de baneos de Gamer Chileno, la cual fue generada en <b>'.$horapw.'</b>
                  </br>
                  <ul style="margin: 0px; color: #666666; line-height: 26px; font-size: 16px; font-weight: 300; font-family: Helvetica Neue,Helvetica,Helvetica,Arial,sans-serif!important;">
                  <li>Password nueva: '.$password.'</li>
                  </ul></p>
                  <p style="margin: 0px; color: #666666; line-height: 26px; font-size: 16px; font-weight: 300; font-family: Helvetica Neue,Helvetica,Helvetica,Arial,sans-serif!important;">Para iniciar sesion puede hacer click <a href="http://gamerchileno.net/baneos-group" target="_blank">aquí</a> o ingresar mediante http://gamerchileno.net/baneos-group<br />Saludos.</p>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
