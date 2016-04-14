<?php session_start()?>
<html>
<meta charset="UFT-8">
<head>
<link rel="stylesheet" type="text/css" href="/baneos-group/style.css" />
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
?>
<ul id="menu">
<li><a href="index.php"><b>Inicio</b></a></li>
<li><a href="perfil.php"><b>Perfil -BETA-</b></a></li> 
</ul>
<div class="infosesion"><?php
$conexion3=mysql_connect("localhost","gamelhzo_baneos","Ss262601") or
  die("Problemas en la conexion");
mysql_select_db("gamelhzo_baneosfb",$conexion3) or
  die("Problemas en la selección de la base de datos");
$registros=mysql_query("select * from sesionmodif
                       where Usuario='$_SESSION[usuarioban]'",$conexion3) or
  die("Problemas en el select:".mysql_error());
if ($reg=mysql_fetch_array($registros))
{
 echo "<img width='100px' height='100px' style='border-radius: 50px;' align='left' class='avatar' src='img/avatar/nuevo-sistema/".$_SESSION['usuarioban']."/".$reg['extensionfoto']."'</img>"; } echo "Has iniciado sesión como" ;?>: <?php echo $_SESSION['usuarioban']; ?></br><?php echo "Para salir de la sesión, haz click"; ?><a href="logout.php">Aquí</a>
</br></br><?php include("frases.php");?></div></br></br></br>
<div class="contentbar" align="center">Al agregar un ban se agrega con el nick del administrador que lo ha ingresado</div><br>
<form action="confirmar-fbapi-test.php" method="post" enctype="multipart/form-data">
<table borde="1"><tr>
<?php $conexion3=mysql_connect("localhost","gamelhzo_baneos","Ss262601") or
  die("Problemas en la conexion");
mysql_select_db("gamelhzo_baneosfb",$conexion3) or
  die("Problemas en la selección de la base de datos");
$registros=mysql_query("select * from sesionmodif
                       where Usuario='$_SESSION[usuarioban]'",$conexion3) or
  die("Problemas en el select:".mysql_error());
if ($reg=mysql_fetch_array($registros))
{
?>
	<td>Baneos realizados:</td><td><?php echo $reg['Cantidadbaneos'] ?><input class="a" placeholder="Elvio Lado" type="hidden" name="baneos" value="<?php echo $reg['Cantidadbaneos'] ?>"></input></td>
	<?php
}?>
	</tr>
    <td>Nombre Facebook:</td><td><input class="a" placeholder="Elvio Lado" type="text" name="nombre" required></input></td>
	</tr>
<tr>
<br><td>ID Facebook<br>(Despues de facebook.com/ Sin &ref u otros):</td><td><input class="a" type="text" name="userid" placeholder="USERID" required></input></td><br>
	</tr>
<tr>
<td>Tipo de ban:</td><td>
<select name="Tipoban" class="a" required>
<option value="">------</option>
<option value="Cadenas facebook">Cadenas facebook</option>
<option value="Spam">Spam</option>
<option value="Insultos usuarios">Insultos usuarios</option>
<option value="Usar grupo como inicio">Usar grupo como inicio</option>
<option value="Referidos">Referidos</option>
<option value="Pornografia">Pornografia</option>
<option value="Spam virus de facebook">Spam virus de facebook</option>
<option value="Spam stickers">Spam stickers</option>
<option value="Spam + cuenta FAKE-BOT">Spam + cuenta FAKE-BOT</option>
<option value="Venta no autorizada">Venta no autorizada</option>
<option value="Concursos sin autorizacion">Concursos sin autorizacion</option>
<option value="Insultos a la administracion">Insultos a la administracion (Ban 3 meses)</option>
<option value="Insultos a la Administracion">Insultos a la administracion (Ban permanente)</option>
<option value="Venta no autorizada + cuenta FAKE-BOT">Venta no autorizada + cuenta FAKE-BOT</option>
<option value="Cuenta FAKE-BOT">Cuenta FAKE-BOT</option>
<option value="Gore">Gore</option>
<option value="Denunciar grupos al azar">Denunciar grupos al azar</option>
<option value="Xenofobia">Xenofobia</option>
<option value="Decision administrativa">Decision administrativa</option>
<option value="Bullying">Bullying</option></select></td></br>
	</tr>
<tr>
<td>Fecha ban:</td><td> <?php date_default_timezone_set('America/Santiago'); echo date("Y-m-d");?><input name="Fechaban" type="hidden" value="<?php echo date("Y-m-d");?>"></input></td>
	</tr>
<tr>
<td>Prueba Ban:</td><td> <input type="file" name="foto" accept="image/*" required><input name="action" type="hidden" value="upload" /></td>
	</tr>
<tr>
</table>
<input type="submit" value="agregar">
</form>
</br>
<div id="news">Lista de baneos<br></div>
<table align="center" width="97%" border="1px solid #000" cellspacing=0 cellpadding=2 style="font-size: 8pt"><tr>
<td><font face="verdana"><b>Nº</b></font></td>
<td><font face="verdana"><b>Nombre</b></font></td>
<td><font face="verdana"><b>URL</b></font></td>
<td><font face="verdana"><b>Foto</b></font></td>
<td><font face="verdana"><b>Razon</b></font></td>
<td><font face="verdana"><b>Baneo desde (AAAA-mm-dd)</b></font></td>
<td><font face="verdana"><b>Baneo hasta (AAAA-mm-dd)</b></font></td>
<td><font face="verdana"><b>Baneado por</b></font></td>
<td><font face="verdana"><b>Estado</b></font></td>
<td><font face="verdana"><b>Desbaneado por</b></font></td>
<td><font face="verdana"><b>Desbaneado el (AAAA-mm-dd)</b></font></td>
<td><font face="verdana"><b>Nota</b></font></td>
<td><font face="verdana"><b>prueba</b></font></td>
<td><font face="verdana"><b>Desbanear</b></font></td>
</tr>
<?php
  $link=mysql_connect("localhost","gamelhzo_baneos","Ss262601") or die("Problemas en la conexion");
  @mysql_select_db("gamelhzo_baneosfb", $conexion) or die ("Error al conectar a la base de datos.");
  $query = "SELECT * from baneos";
  $result = mysql_query($query);
  $numero = 1;
  while($row = mysql_fetch_array($result))
  {
	//$nombre = json_decode(file_get_contents('https://graph.facebook.com/v2.3/'.$row['userid'].'?access_token=1505797149704326|7ed8ab3f7b60c7f73109d01f6a809ff3'))->name;
    echo "<tr><td width='auto' align='center'><font face=\"verdana\">".$row["numero"]."</font></td>";
	echo "<td width='15%'><font face=\"verdana\">".$row['nombre']."</font></td>";
	echo "<td width='3%'><font face=\"verdana\"><a href='https://facebook.com/".$row["userid"]."' target='_blank'>Aquí</a></font></td>";
	if ($row['nombre'] == 'Kat' && $row['url'] == 'http://kat.net')
	{
	echo "<td width='51px'><font face=\"verdana\"><img src='img/avatar/machimaro.png' width='50px' height='50px' img></font></td>";
	}
	elseif ($row['userid'] == '')
	{
	echo "<td width='51px'><font face=\"verdana\"><img src='img/avatar/".$_SESSION['usuarioban']."_avatar.jpg' width='50px' height='50px' img></font></td>";
	}
	else
	{
	echo "<td width='51px'><font face=\"verdana\"><img src='https://graph.facebook.com/".$row["userid"]."/picture' width='50px' height='50px' img></font></td>";
	}
	echo "<td width='15%'><font face=\"verdana\">";
	echo utf8_decode($row["razon"]);
	echo "</font></td>";
	echo "<td width='10%'><font face=\"verdana\">".$row["fechaban"]."</font></td>";
    echo "<td width='auto' align='center' ";
	if (($row['razon'] == 'Xenofobia') || ($row['razon'] == 'Bullying') || ($row['razon'] == 'Gore') || ($row['razon'] == 'Pornografia') || ($row['razon'] == 'Denunciar grupos al azar') || ($row['razon'] == 'Spam + cuenta FAKE-BOT') || ($row['razon'] == utf8_decode('Insultos a la Administracion')) || ($row['razon'] == 'Venta no autorizada + cuenta FAKE-BOT') || ($row['razon'] == 'Cuenta FAKE-BOT') || ($row['razon'] == 'Spam virus de facebook') || ($row['razon'] == 'Decision administrativa'))
	{
	echo "bgcolor='#FE2E2E'><font face=\"verdana\"><b>PERMANENTE</b>";
	}
	elseif ($row['razon'] == 'Venta no autorizada')
	{
	echo "<font face=\"verdana\">1 mes (".date("Y/m/d",strtotime("$row[fechaban]+1month")).")";
	}
	elseif (($row['razon'] == 'Referidos') || ($row['razon'] == 'Insultos usuarios') || ($row['razon'] == 'Usar grupo como inicio') || ($row['razon'] == 'Spoiler') || ($row['razon'] == 'Cadenas facebook'))
	{
	echo "<font face=\"verdana\">1 semana (".date("Y/m/d",strtotime("$row[fechaban]+1week")).")";
	}
	elseif (($row['razon'] == 'Spam') || ($row['razon'] == utf8_decode('Concursos sin autorizacion')))
	{
	echo "<font face=\"verdana\">2 semanas (".date("Y/m/d",strtotime("$row[fechaban]+2week")).")";
	}
	elseif ($row['razon'] == utf8_decode('Insultos a la administracion'))
	{
	echo "<font face=\"verdana\">3 meses (".date("Y/m/d",strtotime("$row[fechaban]+3month")).")";
	}
	elseif ($row['razon'] == 'Spam stickers')
	{
	echo "<font face=\"verdana\">2 semanas (".date("Y/m/d",strtotime("$row[fechaban]+2week")).")";
	}
	elseif ($row['razon'] == 'Las fuerzas cosmicas')
	{
	echo "<font face=\"verdana\"><b>Hasta el fin del mundo</b>";
	}
	else
	{
	echo "<font face=\"verdana\">El tipo de ban no esta sancionado";
	}"</font></td>";
    echo "<td width='10%'><font face=\"verdana\">".$row['admin']."</font></td>";
	echo "<td width='auto' align='center'";
	if ($row['Estado'] == 'BAN')
	{
	echo " bgcolor='#FE2E2E'><font face='verdana'><b>BAN</b></font></td>";
	}
	elseif ($row['Estado'] == "DBAN")
	{
	echo " bgcolor='#2EFE2E'><font face='verdana'><b>DBAN</b></font></td>";
	}
	elseif ($row['Estado'] == "UNK")
	{
	echo " bgcolor='#FF4000'><font face='verdana'><b>UNK</b></font></td>";
	}
	elseif ($row['Estado'] == "LOV")
	{
	echo " bgcolor='#CC2EFA'><font face='verdana'><b>LOV</b></font></td>";
	}
	else
	{
	echo " bgcolor='#FFBF00'><font face='verdana'><b>ERROR</b></font></td>";
	}
	echo "<td width='auto' align='center'><font face=\"verdana\">".$row["dbanpor"]."</font></td>";
	echo "<td width='auto' align='center'><font face=\"verdana\">".$row["dbanfecha"]."</font></td>";
	echo "<td width='15%'><font face=\"verdana\">".$row["nota"]."</font></td>";
	if ($row["prueba"] == '')
	{
	echo "<td width='15%'><font face=\"verdana\">No hay pruebas</font></td>";
	}
	else
	{
	echo "<td width='auto' align='center'><font face=\"verdana\"><a href='pruebas/".$row["prueba"]."' target='_blank'>Aquí</a></font></td>";
	}
	if ($row['Estado'] == "DBAN")
	{
	echo "<td width='auto'><font face='verdana'>Desbaneado</td></tr>";
	}
	elseif (($row['razon'] == 'Decision administrativa') || ($row['razon'] == 'Xenofobia') || ($row['razon'] == 'Bullying') || ($row['razon'] == 'Gore') || ($row['razon'] == 'Pornografia') || ($row['razon'] == 'Denunciar grupos al azar') || ($row['razon'] == 'Spam + cuenta FAKE-BOT') || ($row['razon'] == 'Insultos a la Administracion') || ($row['razon'] == 'Venta no autorizada + cuenta FAKE-BOT') || ($row['razon'] == 'Cuenta FAKE-BOT') || ($row['razon'] == 'Spam virus de facebook'))
	{
	echo "<td width='auto'><font face='verdana'>Baneado permanente</td></tr>";
	}
	elseif ($row['Estado'] == "LOV")
	{
	echo "<td width='auto'><font face='verdana'>Machimaro la protege</td></tr>";
	}
	else
	{
	echo "<td width='auto'><font face='verdana'><form action='dban_auto.php' method='post'><input type='hidden' name='Nombre' value='".$row['nombre']."'></input>
<input type='hidden' name='numero' value='".$row['numero']."'></input><input type='hidden' name='estado' value='".$row['Estado']."'></input><input type='submit' value='Desbanear'></input></form></td></tr>";
}
	}
  mysql_free_result($result);
  mysql_close($link);
?>
</table>
</br></br></br></br>
<?php 
}
else
{
echo utf8_decode('<div class="contentbar"><a href="index.php"><img align="left" src="img/logo.png" width="185" height="45"></img></a> Inicia sesion para poder ver, agregar o modificar baneos de GCL Group</div><br><br><br>');
echo utf8_decode('<form action="iniciar_sesion2.php" method="post">Usuario: <input type="text" name="usuario"></input></br>Password: <input type="password" name="password"></input></br><input type="submit" value="Iniciar"></form></br></br></br></br></br>');
}
// include("footer.php");
?>