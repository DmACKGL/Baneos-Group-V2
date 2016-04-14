  <?php @session_start();
  require 'phpmailer/PHPMailerAutoload.php';
  ?>
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
    if ($_POST["action"] == "upload")
  {
    // obtenemos los datos del archivo
      $tamano = $_FILES["foto"]['size'];
      $tipo = $_FILES["foto"]['type'];
       $archivo = $_FILES["foto"]["name"];
       $prefijo = substr(md5(uniqid(rand())),0,6);
      date_default_timezone_set('America/Santiago');
      $horafoto = date("h:m:i a Y-m-d");
      $horafotorand = hash('SHA256',$horafoto);
      $fotorand = rand(1, 60);
      $extension = explode(".",$archivo);
      $avatar = "_avatar";
      $usuario = $_REQUEST['username'];
      $nombrefotonuevo = "$usuario$avatar$horafotorand.$extension[1]";
    if ($archivo != "")
    {
      $llega2 = $usuario.'/'.$archivo;
      $destino =  "img/avatar/nuevo-sistema/".$llega2;
      $destino3= "img/avatar/nuevo-sistema/".$usuario;
      mkdir($destino3, 0755);
      $nombrefoto2 = $usuario.'/'.$nombrefotonuevo;
        if (copy($_FILES['foto']['tmp_name'],"$destino")) 
        {
          rename ("img/avatar/nuevo-sistema/".$llega2,"img/avatar/nuevo-sistema/".$nombrefoto2);
        }
        else
        {
            $status = "Error al subir el archivo";
        }
    }
    else
    {
      echo "Error, no hay archivo";
    }
          $password1 = $_REQUEST['password'];
          $password2 = hash('SHA512',$password1);
          $conexion=mysql_connect("localhost","gamelhzo_baneos","Ss262601") or die("Problemas en la conexion");
          mysql_select_db("gamelhzo_baneosfb",$conexion) or die("Problemas en la seleccion de la base de datos");
          mysql_query("insert into sesionmodif(Usuario,Password,extensionfoto,tipo,activo,Email) values 
          ('$_REQUEST[username]','$password2','$nombrefotonuevo','$_REQUEST[Tipocuenta]',1,'$_REQUEST[mail]')", 
          $conexion) or die("Problemas en el select".mysql_error());
          mysql_close($conexion);
          $ar=fopen("archivos/crear-cuentas.txt","a") or
          die("</br>Problemas en la creacion");
          date_default_timezone_set('America/Santiago');
          $hora= date("h:i:s a");
          fputs($ar,"Nombre cuenta: ".$_REQUEST['username']);
          fputs($ar,"\n");
          fputs($ar,"Fecha creacion: ".$_REQUEST['Fechacrear']);
          fputs($ar,"\n");
      if ($_REQUEST['Tipocuenta'] == 1) 
      {
        fputs($ar,"Tipo de cuenta: Full admin");
      }
      elseif ($_REQUEST['Tipocuenta'] == 2)
      {
        fputs($ar,"Tipo de cuenta: Administrador sistema");
      }
      elseif ($_REQUEST['Tipocuenta'] == 3)
      {
        fputs($ar,"Tipo de cuenta: moderador");
      }
        fputs($ar,"\n");
        fputs($ar,"Admin que crea: ".$_SESSION['usuarioban']);
        fputs($ar,"\n");
      if($_SERVER["HTTP_X_FORWARDED_FOR"])
      {
        fputs($ar,"Proxy Admin: ".$_SERVER['REMOTE_ADDR']);
        fputs($ar,"\n");
        fputs($ar,"IP Admin: ".$_SERVER['HTTP_X_FORWARDED_FOR']);
      }
      else
      {
        fputs($ar,"IP Admin: ".$_SERVER['REMOTE_ADDR']);
      }
      fputs($ar,"\n");
      fputs($ar,"--------------------------------------------------------");
      fputs($ar,"\n");
      fclose($ar);
      echo "Los datos se cargaron correctamente.";
      $tipo4 = $_REQUEST['Tipocuenta'];
      $tipocuenta = '';
      $activo = '';
      if ($tipo4 == 1)
       {
        $tipocuenta = 'Full admin';
       }
       elseif ($tipo4 == 2)
       {
        $tipocuenta = 'admin de sistema';
       }
       elseif ($tipo4 == 3)
       {
         $tipocuenta = 'moderador';
       }
date_default_timezone_set('America/Santiago');
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
//$mail->addAddress('priquelmecas@gamerchileno.net');               // Name is optional
//$mail->addReplyTo('pablig17@gmail.com', 'Pablo Riquelme');
//$mail->addCC('cc@example.com');
$mail->addBCC('priquelmecas@gamerchileno.net');

//$mail->addAttachment('img/logo.png');          // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Nueva cuenta Baneos GamerChileno - '.$usuario;
$mail->Body    = '<div class="panel panel-success" role="alert"><div class="panel-heading" align="center">Bienvenido al sistema de baneos!</div><div class="panel-body" align="center">A continuacion enviamos todos los datos de tu cuenta, para que puedan acceder con ella a nuestro sistema, esta cuenta fue generada en: <b>'.$horapw.'</b></div></div>
<div class="well"><ul style="margin: 0px; color: #666666; line-height: 26px; font-size: 16px; font-weight: 300; font-family: Helvetica Neue,Helvetica,Helvetica,Arial,sans-serif!important;">
<li>Usuario: <b>'.$usuario.'</b></li>
<li>Password nueva: <b>'.$password1.'</b></li>
<li>Tipo de cuenta: <b>'.$tipocuenta.'</b></li>
<li>Estado de la cuenta: <span class="label label-success"><b>Activa</b></span></li>
</ul></p>
</div>
<p style="margin: 0px; color: #666666; line-height: 26px; font-size: 16px; font-weight: 300; font-family: Helvetica Neue,Helvetica,Helvetica,Arial,sans-serif!important;">Para iniciar sesion puede hacer click <b><a href="http://gamerchileno.net/baneos-group" target="_blank">aquí</a></b> o ingresar mediante http://gamerchileno.net/baneos-group</p></br>
<div align="center" class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Si tienes problemas para acceder a tu cuenta, puedes contactarte con el administrador que la ha creado para solucionar el problema</div>
<small>Este mail fue automaticamente generado por el sistema de baneos de GamerChileno, no responda este mail</small>';
$mail->AltBody = 'Este mail no puede ser mostrado, debido a que es necesario un cliente que soporte HTML';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
      echo "<script> alert (\"Cuenta agregada, click en ACEPTAR para volver al inicio\"); </script>"; 
      echo "<script language=Javascript> location.href=\"agregar-cuenta.php\"; </script>";
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
}
  ?>
  <br><br><br>
  	<?php include("footer.php"); ?>