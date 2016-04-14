<?php @session_start();
header('Location: /baneos-group/modif-estado.php'); ?>
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
?>
<div class="informacionsuperior">Has iniciado sesión como: <?php echo $_SESSION['usuarioban']; ?></br>Para salir de la sesión, haz click <a href="logout.php">Aquí</a></div></br></br>
<div class="contentbar">modificar un ban automaticamente se coloca el nick del administrador que lo ha modificado</div><br><br><br>
<?php
$nota=$_REQUEST['nota'];
$usuario=$_SESSION['usuarioban'];
$nombre=$_REQUEST['Nombre'];
$fecha=date('Y-m-d');
$proxy=$_SERVER['REMOTE_ADDR'];
$IP=$_SERVER['HTTP_X_FORWARDED_FOR'];
$estado=$_REQUEST['Estadonuevo'];
  $conexion=mysql_connect("localhost","gamelhzo_baneos","Ss262601") or die("Problemas en la conexion");
mysql_select_db("gamelhzo_baneosfb",$conexion) or die("Problemas en la selección de la base de datos");
$ar=fopen("archivos/modificacion-baneos.txt","a") or
    die("Problemas en la creacion");
	date_default_timezone_set('America/Santiago');
	$hora= date("h:i:s a");
  fputs($ar,"Nombre baneado: ".$_REQUEST['Nombre']);
  fputs($ar,"\n");
  fputs($ar,"Estado nuevo: ".$_REQUEST['Estadonuevo']);
  fputs($ar,"\n");
  fputs($ar,"Nota: ".$_REQUEST['nota']);
  fputs($ar,"\n");
  fputs($ar,"Hora modificacion: ".$hora);
  fputs($ar,"\n");
  fputs($ar,"fecha de modificacion : ".date("Y-m-d"));
  fputs($ar,"\n");
  fputs($ar,"Admin que modifica: ".$_SESSION['usuarioban']);
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
$registros=mysql_query("update baneos
                       set Estado='$_REQUEST[Estadonuevo]'
                       where nombre='$_REQUEST[Nombre]'",$conexion) or
  die("Problemas en el elect:".mysql_error());
$registros=mysql_query("update baneos
                       set nota='$_REQUEST[nota]'
					   where nombre='$_REQUEST[Nombre]'",$conexion) or
  die("Problemas en el elect:".mysql_error());
  $registros=mysql_query("update baneos
                       set dbanfecha='$_REQUEST[fechadban]'
					   where nombre='$_REQUEST[Nombre]' && dbanfecha!=$_REQUEST[fechadban]",$conexion) or
  die("Problemas en el select:".mysql_error());
  $registros=mysql_query("update baneos
                       set dbanpor='$_SESSION[usuarioban]'
					   where nombre='$_REQUEST[Nombre]'",$conexion) or
  die("Problemas en el select:".mysql_error());
  $conexion2=mysql_connect("localhost","gamelhzo_baneos","Ss262601") or die("Problemas en la conexion");
mysql_select_db("gamelhzo_baneosfb",$conexion2) or die("Problemas en la seleccion de la base de datos");
mysql_query("insert into modificacion(nombre,estado_nuevo,hora,fecha,admin,ip,proxy,nota) values 
   ('$nombre','$estado','$hora','$fecha','$usuario','$IP','$proxy','$nota')", 
   $conexion2) or die("Problemas en el select".mysql_error());
mysql_close($conexion);
echo "Baneo modificado";
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