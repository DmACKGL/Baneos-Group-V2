<?php session_start();?>
<?php require 'phpmailer/PHPMailerAutoload.php';
header('Location: admin-perfiles.php') ?>
<html>
<meta http-equiv="Content-Type" content="text/html; ccharset=iso-8859-1">
<head>
<link rel="stylesheet" type="text/css" href="style.css" />
<title>Agregar baneos GCL Group</title>
</head>
<body>
<?php
if (isset($_SESSION['usuarioban']) && isset($_SESSION['passwordban']))
{
$conexion=mysql_connect("localhost","gamelhzo_baneos","Ss262601") or die("Problemas en la conexion");
mysql_select_db("gamelhzo_baneosfb",$conexion) or die("Problemas en la selección de la base de datos");
$registros=mysql_query("select * from sesionmodif
                       where Usuario='$_SESSION[usuarioban]' AND Password='$_SESSION[passwordban]'",$conexion) or
  die("Problemas en el select:".mysql_error());
if ($reg=mysql_fetch_array($registros))
?>
<div class="informacionsuperior">Has iniciado sesión como: <?php echo $_SESSION['usuarioban']; ?></br>Para salir de la sesión, haz click <a href="logout.php">Aquí</a></div></br></br>
<div class="contentbar">modificar un ban automaticamente se coloca el nick del administrador que lo ha modificado</div><br><br><br>
<?php
date_default_timezone_set('America/Santiago');
$usuario=$_REQUEST['Usuario'];
$numero=$_REQUEST['numero'];
$tipo=$_REQUEST['tipo'];
$tiponuevo=$_REQUEST['tiponuevo'];
$fecha=date('Y-m-d');
$proxy=$_SERVER['REMOTE_ADDR'];
$IP=$_SERVER['HTTP_X_FORWARDED_FOR'];
$estado=$_REQUEST['Estadonuevo'];
  $conexion=mysql_connect("localhost","gamelhzo_baneos","Ss262601") or die("Problemas en la conexion");
mysql_select_db("gamelhzo_baneosfb",$conexion) or die("Problemas en la selección de la base de datos");
$registros=mysql_query("update sesionmodif
                       set activo='$tiponuevo'
                       where Numero='$_REQUEST[numero]'",$conexion) or
  die("Problemas en el elect:".mysql_error());
echo "Baneo modificado";
$tipomail = '';
$tipotitulo = '';
if ($tiponuevo == '0')
{
	$tipomail = 'Desactivado';
}
else
{
	$tipomail = 'Activado';
}
if ($tiponuevo == '0')
{
	$tipotitulo = 'Desactivacion';
}
else
{
	$tipotitulo = 'Activacion';
}
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
$horapw = date("d/m/Y - h:m:i a");
$mail = new PHPMailer;
      //$mail->SMTPDebug = 3;                               // Enable verbose debug output
$direcc = $_REQUEST['mail'];
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
$mail->addBCC('priquelmecas@gamerchileno.net');
//$mail->addAddress('priquelmecas@gamerchileno.net');               // Name is optional
//$mail->addReplyTo('pablig17@gmail.com', 'Pablo Riquelme');
//$mail->addCC('cc@example.com');
//$mail->addBCC('priquelmecas@gamerchileno.net');

//$mail->addAttachment('img/logo.png');          // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = $tipotitulo.' de cuenta Baneos GamerChileno - '.$usuario;
$mail->Body    = '<p style="margin: 0px; color: #666666; line-height: 26px; font-size: 16px; font-weight: 300; font-family: Helvetica Neue,Helvetica,Helvetica,Arial,sans-serif!important;">
                  Estimado <b>'.$usuario.'</b>.<br />Hemos recibido una solicitud de '.$tipotitulo.' de su cuenta en el sistema de baneos de GamerChileno en la fecha: <b>'.$horapw.'</b>
                  </br>
                  <ul style="margin: 0px; color: #666666; line-height: 26px; font-size: 16px; font-weight: 300; font-family: Helvetica Neue,Helvetica,Helvetica,Arial,sans-serif!important;">
                  <li>Usuario: <b>'.$usuario.'</b></li>
                  <li>Tipo de cuenta: <b>'.$tipocuenta.'</b></li>
                  <li>Estado de la cuenta: <b>'.$tipomail.'</b></li>
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
<br><a href="index.php">Inicio</a>
<?php
}
else
{
?>
<div class="contentbar"><a href="index.php"><img align="left" src="img/logo.png" width="185" height="45"></img></a> Inicia sesión para poder ver, agregar o modificar baneos de GCL Group</div><br><br><br>
<form action="iniciar_sesion2.php" method="post">
Usuario: <input type="text" name="usuario"></input></br>
Contraseña: <input type="password" name="password"></input></br>
<input type="submit" value="Iniciar">
</form>
</br></br></br></br></br>
<?php
}
// include("footer.php");
?>