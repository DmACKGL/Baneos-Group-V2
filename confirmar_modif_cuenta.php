<?php @session_start() ?>
<?php require 'phpmailer/PHPMailerAutoload.php';
header('Location: /baneos-group/admin-perfiles.php') ?>
<html>
<meta http-equiv="Content-Type" content="text/html; ccharset=iso-8859-1">
<head>
<link rel="stylesheet" type="text/css" href="style.css" />
<title>Agregar ban GCL Group</title>
</head>
<body>
<?php
if (isset($_SESSION['usuarioban']) && isset($_SESSION['passwordban']))
{
?>
<div class="contentbar">Baneo agregado</div><br><br><br>
<?php
	$password = $_REQUEST[password];
	$password2 = hash('SHA512', $_REQUEST[password]);
	$numero = $_REQUEST['numero'];
	$tipocuenta = '';
	$activo = '';
	$tipo = $_REQUEST['tipo'];
	$activo2 = $_REQUEST['activo'];
	if ($tipo == 1)
       {
       	$tipocuenta = 'Full admin';
       }
       elseif ($tipo == 2)
       {
       	$tipocuenta = 'admin de sistema';
       }
       elseif ($tipo == 3)
       {
         $tipocuenta = 'moderador';
       }
    if ($activo2 == 1)
    {
    	$activo = 'Activa';
    }
    elseif ($activo2 == 0)
    {
    	$activo = 'Inhabilitada';
    }
$conexion3=mysql_connect("localhost","gamelhzo_baneos","Ss262601") or die("Problemas en la conexion");
mysql_select_db("gamelhzo_baneosfb",$conexion3) or die("Problemas en la seleccion de la base de datos");
$registros2=mysql_query("update sesionmodif set Password='$password2' where Numero='$_REQUEST[numero]'",$conexion3) or die("Problemas en el select:".mysql_error());
mysql_close($conexion3);
echo "Password: ".$password2;
date_default_timezone_set('America/Santiago');
$horapw = date("d/m/Y - h:m:i a");
$direcc = $_REQUEST['mail'];
$mail = new PHPMailer;
$usuario2 = $_REQUEST['usuario'];
echo $usuario2;
echo $direcc;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'mail.gamerchileno.net';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'baneos@gamerchileno.net';                 // SMTP username
$mail->Password = 'L=P.JGCAIm9L';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 25;                                    // TCP port to connect to

$mail->From = 'baneos@gamerchileno.net';
$mail->FromName = 'Baneos GamerChileno';
$mail->addAddress($direcc);     // Add a recipient
//$mail->addAddress('priquelmecas@gamerchileno.net');               // Name is optional
//$mail->addReplyTo('pablig17@gmail.com', 'Pablo Riquelme');
//$mail->addCC('cc@example.com');
$mail->addBCC('priquelmecas@gamerchileno.net');

//$mail->addAttachment('img/logo.png');          // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Password sistema de baneos - '.$usuario2;
$mail->Body    = '<p style="margin: 0px; color: #666666; line-height: 26px; font-size: 16px; font-weight: 300; font-family: Helvetica Neue,Helvetica,Helvetica,Arial,sans-serif!important;">
                  Estimado <b>'.$usuario2.'</b><br /> Se ha solicitado un cambio de contraseña en su cuenta, por lo tanto a continuacion está su nueva contraseña para el sistema de baneos de Gamer Chileno, la cual fue generada en <b>'.$horapw.'</b>
                  </br>
                  <ul style="margin: 0px; color: #666666; line-height: 26px; font-size: 16px; font-weight: 300; font-family: Helvetica Neue,Helvetica,Helvetica,Arial,sans-serif!important;">
                  <li>Password nueva: <b>'.$password.'</b></li>
                  <li>Tipo de cuenta: <b>'.$tipocuenta.'</b></li>
                  <li>Estado de la cuenta: <b>'.$activo.'</b></li>
                  </ul></p>
                  <p style="margin: 0px; color: #666666; line-height: 26px; font-size: 16px; font-weight: 300; font-family: Helvetica Neue,Helvetica,Helvetica,Arial,sans-serif!important;">Para iniciar sesion puede hacer click <a href="http://gamerchileno.net/baneos-group" target="_blank">aquí</a> o ingresar mediante http://gamerchileno.net/baneos-group<br />Saludos.</p>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
?>
</br><a href="index.php">Agregar otro ban</a><?php
}
else
{
?>
<div class="contentbar">Inicia sesión para poder ver, agregar o modificar los baneos</div><br><br><br>
<form action="iniciar_sesion2.php" method="post">
Usuario: <input type="text" name="usuario"></input></br>
Contraseña: <input type="password" name="password"></input></br>
¿Recordar?<select name="recordar">
<option value="si">Si</option>
<option value="no">No</option></select></br>
<input type="submit" value="Iniciar">
</form>
<?php
}
?>
<br><br><br>
	<?php include("footer.php"); ?>