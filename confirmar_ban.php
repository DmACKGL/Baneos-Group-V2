<?php @session_start() ?>
<?php header('Location: index.php') ?>
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
	date_default_timezone_set('America/Santiago');
	$fecha = date("Y-m-d");
	$cantidaddebaneosnuevo = $_REQUEST['baneos']+1;
$conexion3=mysql_connect("localhost","gamelhzo_baneos","Ss262601") or die("Problemas en la conexion");
mysql_select_db("gamelhzo_baneosfb",$conexion3) or die("Problemas en la seleccion de la base de datos");
$registros=mysql_query("update sesionmodif
                       set Cantidadbaneos=Cantidadbaneos+1
                       where Usuario='$_SESSION[usuarioban]'",$conexion3) or
  die("Problemas en el select:".mysql_error());
  mysql_close($conexion3);
if ($_POST["action"] == "upload") {
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
	$nuevoarchivo = "$horafotorand'.'$extension[1]";
	$nombrefotonuevo = "$horafotorand.$extension[1]";
	if ($archivo != "") {
        // guardamos el archivo a la carpeta pruebas
        $destino =  "pruebas/".$archivo;
        if (copy($_FILES['foto']['tmp_name'],"$destino")) {
			rename ("pruebas/".$archivo,"pruebas/".$nombrefotonuevo);
			echo "</br>Nombre default: ".$archivo;
			echo "</br>Nombre nuevo: ".$nombrefotonuevo;
            $status = "Archivo subido: <b>".$archivo."</b>";
			echo "</br>".$status;
        } else {
            $status = "Error al subir el archivo";
			echo "</br>".$status;
			echo "</br>Nombre archivo: ".$_FILES['foto']['name'];
			echo "</br>Destino: ".$destino;
			echo "</br>Nombre nuevo de la foto: ".$nombrefotonuevo;
        }
$ar=fopen("archivos/baneos.txt","a") or
    die("</br>Problemas en la creacion");
	date_default_timezone_set('America/Santiago');
	$hora= date("h:i:s a");
  fputs($ar,"Nombre baneado: ".$_REQUEST['nombre']);
  fputs($ar,"\n");
  fputs($ar,"Fecha baneado: ".$_REQUEST['Fechaban']);
  fputs($ar,"\n");
  fputs($ar,"Razón: ".$_REQUEST['Tipoban']);
  fputs($ar,"\n");
  fputs($ar,"Hora baneo: ".$hora);
  fputs($ar,"\n");
  fputs($ar,"Duracion del ban: ");
  if (($_REQUEST['Tipoban'] == 'Spam virus de facebook') || ($_REQUEST['Tipoban'] == 'Xenofobia') || ($_REQUEST['Tipoban'] == 'Bullying') || ($_REQUEST['Tipoban'] == 'Gore') || ($_REQUEST['Tipoban'] == 'Denunciar grupos al azar') || ($_REQUEST['Tipoban'] == 'Spam + cuenta FAKE-BOT') || ($_REQUEST['Tipoban'] == 'Insultos a la Administración') || ($_REQUEST['Tipoban'] == 'Venta no autorizada + cuenta FAKE-BOT') || ($_REQUEST['Tipoban'] == 'Cuenta FAKE-BOT'))
	{
	fputs($ar,"PERMANENTE");
	}
	elseif ($_REQUEST['Tipoban'] == 'Venta no autorizada')
	{
	fputs($ar,"1 mes (".date("Y/m/d",strtotime("$row[fechaban]+1month")).")");
	$fechadban = date("Y/m/d",strtotime("$row[fechaban]+1month"));
	}
	elseif (($_REQUEST['Tipoban'] == 'Referidos') || ($_REQUEST['Tipoban'] == 'Usar grupo como inicio') || ($_REQUEST['Tipoban'] == 'Spoiler'))
	{
	fputs($ar,"1 semana (".date("Y/m/d",strtotime("$row[fechaban]+1week")).")");
	$fechadban = date("Y/m/d",strtotime("$row[fechaban]+1week"));
	}
	elseif (($_REQUEST['Tipoban'] == 'Spam') || ($_REQUEST['Tipoban'] == 'Concursos sin autorización'))
	{
	fputs($ar,"2 semanas (".date("Y/m/d",strtotime("$row[fechaban]+2week")).")");
	$fechadban = date("Y/m/d",strtotime("$row[fechaban]+2week"));
	}
	elseif ($_REQUEST['Tipoban'] == 'Insultos a la administración')
	{
	fputs($ar,"3 meses (".date("Y/m/d",strtotime("$row[fechaban]+3month")).")");
	$fechadban = date("Y/m/d",strtotime("$row[fechaban]+3month"));
	}
	elseif ($_REQUEST['Tipoban'] == 'Spam stickers')
	{
	fputs($ar,"2 semanas (".date("Y/m/d",strtotime("$row[fechaban]+2week")).")");
	$fechadban = date("Y/m/d",strtotime("$row[fechaban]+2week"));
	}
	elseif ($_REQUEST['Tipoban'] == 'Las fuerzas cosmicas')
	{
	fputs($ar,"Hasta el fin del mundo");
	}
	else
	{
	fputs($ar,"El tipo de ban no esta sancionado");
	}
	fputs($ar,"\n");
  fputs($ar,"Admin que banea: ".$_SESSION['usuarioban']);
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
  $conexion=mysql_connect("localhost","gamelhzo_baneos","Ss262601") or die("Problemas en la conexion");
mysql_select_db("gamelhzo_baneosfb",$conexion) or die("Problemas en la seleccion de la base de datos");
mysql_query("insert into baneos(nombre,razon,admin,fechaban,prueba,userid,fechaparadban) values 
   ('$_REQUEST[nombre]','$_REQUEST[Tipoban]','$_SESSION[usuarioban]','$fecha','$nombrefotonuevo','$_REQUEST[userid]','$fechadban')", 
   $conexion) or die("Problemas en el select".mysql_error());
mysql_close($conexion);
echo "El ban fue agregado :D";
} else {
        $status = "Error al subir archivo";
    }
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