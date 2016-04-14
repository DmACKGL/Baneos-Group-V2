<?php @session_start() ?>
<?php// header('Location: /baneos-group/index.php');
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
//$userid = "https://www.facebook.com/profile.php?id=100004060807080";
$userid = "https://www.facebook.com/sebastian.malebranreyes.9";
$contador1 = strpos($userid , '?');
$contador2 = strpos($userid , '.com/');
echo $contador1."</br>";
	if (($contador1 == 36) || ($contador1 == 35))
	{
		$explode = explode('?id=', $userid);
		print_r($explode);
		echo "</br>";
		echo $explode[1];
		echo "</br>";
		$nombre = json_decode(file_get_contents('https://graph.facebook.com/v2.3/'.$explode[1].'?access_token=1505797149704326|7ed8ab3f7b60c7f73109d01f6a809ff3'))->name;
		echo "Nombre: ".$nombre;
	}
	elseif (($contador2 == 20) || ($contador2 == 19))
	{
		$explode = explode('.com/', $userid);
		print_r($explode);
		echo "</br>";
		echo $explode[1];
		echo "</br>";
		$nombre = json_decode(file_get_contents('https://graph.facebook.com/v2.3/'.$explode[1].'?access_token=1505797149704326|7ed8ab3f7b60c7f73109d01f6a809ff3'))->name;
		echo "Nombre: ".$nombre;
	}
?>
</br><a href="prueba-fbapi.php">Agregar otro ban</a><?php
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