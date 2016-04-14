<?php session_start(); ?>
<html>
<meta charset="iso-8859-1">
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
                       where Usuario='$usuario1' AND Password='$password1'",$conexion) or
  die("Problemas en el select:".mysql_error());
if ($reg=mysql_fetch_array($registros))
{
$pw_nueva=$_REQUEST['pw-nueva'];
$pw_confirm=$_REQUEST['pw-confirm'];
$pw_vieja=$_REQUEST['pw-vieja'];
$pw_vieja_db=$reg['Password'];
$new_password=hash(SHA512,$pw-nueva);
$old_password=hash(SHA512,$pw-vieja);
if (($pw_nueva==$pw_confirm) && ($pw_vieja!=$pw_vieja_db))
{
$conexion3=mysql_connect("localhost","gamelhzo_baneos","Ss262601") or die("Problemas en la conexion");
mysql_select_db("gamelhzo_baneosfb",$conexion3) or die("Problemas en la selección de la base de datos");
$registros=mysql_query("update sesionmodif
                       set Password='$new_password'
                       where Usuario='$_SESSION[usuarioban]' AND Password<>'$old_password' AND '$pw_nueva'='$pw_confirm'",$conexion3) or
  die("Problemas en el select:".mysql_error());
    mysql_close($conexion3);
	echo "</br>Contraseña nueva: ".$pw_nueva;
	}
	if (($pw_nueva!=$pw_confirm) || ($pw_vieja==$pw_vieja_db))
	{
	echo "</br>Las contraseñas no coinciden o la nueva contraseña coincide con la actual";
	}
	}
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