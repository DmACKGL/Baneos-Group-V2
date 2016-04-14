<?php session_start();
header('Location: /baneos-group/index.php'); ?>
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
$registros=mysql_query("select * from Alertas",$conexion) or
  die("Problemas en el select:".mysql_error());
if ($reg=mysql_fetch_array($registros))
?>
<div class="informacionsuperior">Has iniciado sesión como: <?php echo $_SESSION['usuarioban']; ?></br>Para salir de la sesión, haz click <a href="logout.php">Aquí</a></div></br></br>
<div class="contentbar">modificar un ban automaticamente se coloca el nick del administrador que lo ha modificado</div><br><br><br>
<?php
$tipo=$_REQUEST['Tipo'];
$usuario=$_SESSION['usuarioban'];
$alerta=$_REQUEST['alerta'];
date_default_timezone_set('America/Santiago');
$fecha=date('Y-m-d');
  $conexion=mysql_connect("localhost","gamelhzo_baneos","Ss262601") or die("Problemas en la conexion");
mysql_select_db("gamelhzo_baneosfb",$conexion) or die("Problemas en la selección de la base de datos");
$registros=mysql_query("update Alertas
                       set Texto='$alerta'",$conexion) or
  die("Problemas en el elect:".mysql_error());
$registros=mysql_query("update Alertas
                       set Tipo='$tipo'",$conexion) or
  die("Problemas en el select:".mysql_error());
$registros=mysql_query("update Alertas
                       set Admin='$usuario'",$conexion) or
  die("Problemas en el select:".mysql_error());
echo $tipo;
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