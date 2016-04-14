<?php session_start() ?>
<?php header('Location: perfil.php');
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
if ($_POST["action"] == "upload") {
// obtenemos los datos del archivo
    $tamano = $_FILES["foto-perfil"]['size'];
    $tipo = $_FILES["foto-perfil"]['type'];
    $archivo = $_FILES["foto-perfil"]["name"];
    $prefijo = substr(md5(uniqid(rand())),0,6);
	date_default_timezone_set('America/Santiago');
	$horafoto = date("h:m:i a Y-m-d");
	$horafotorand = hash('SHA256',$horafoto);
	$fotorand = rand(1, 60);
	$extension = explode(".",$archivo);
	$avatar = "_avatar";
	$usuario = $_SESSION['usuarioban'];
	$nombrefotonuevo = "$usuario$avatar$horafotorand.$extension[1]";
	$conexion3=mysql_connect("localhost","gamelhzo_baneos","Ss262601") or die("Problemas en la conexion");
mysql_select_db("gamelhzo_baneosfb",$conexion3) or die("Problemas en la selección de la base de datos");
$registros=mysql_query("update sesionmodif
                       set extensionfoto='$nombrefotonuevo'
                       where Usuario='$_SESSION[usuarioban]'",$conexion3) or
  die("Problemas en el select:".mysql_error());
$registros=mysql_query("update sesionmodif
                       set cantidadfotos=cantidadfotos+1
                       where Usuario='$_SESSION[usuarioban]'",$conexion3) or
  die("Problemas en el select:".mysql_error());
  mysql_close($conexion3);
	if ($archivo != "") {
        // guardamos el archivo a la carpeta pruebas
        $llega2 = $usuario.'/'.$archivo;
		$destino =  "img/avatar/nuevo-sistema/".$llega2;
		$nombrefoto2 = $usuario.'/'.$nombrefotonuevo;
        if (copy($_FILES['foto-perfil']['tmp_name'],"$destino")) {
			rename ("img/avatar/nuevo-sistema/".$llega2,"img/avatar/nuevo-sistema/".$nombrefoto2);
			echo "</br>Nombre default: ".$archivo;
			echo "</br>Nombre nuevo: ".$nombrefotonuevo;
			echo "</br>Ruta: ".$destino;
            $status = "Archivo subido: <b>".$archivo."</b>";
			echo "</br>".$status;
			echo "<script type=\"text/javascript\">"."window.alert('Foto cambiada :D');"."</script>"; 
        } else {
            $status = "Error al subir el archivo";
			echo "</br>".$status;
			echo "</br>Nombre archivo: ".$_FILES['foto-perfil']['name'];
			echo "</br>Destino: ".$destino;
			echo "</br>Nombre nuevo de la foto: ".$nombrefotonuevo;
			echo "<script type=\"text/javascript\">"."window.alert('Error en la foto D:');"."</script>"; 
        }
		}
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
}ñ
?>
</body><br><br><br>