<html>
<meta charset="iso-8859-1">
<head>
<link rel="stylesheet" type="text/css" href="/baneos-group/style.css" />
<title>baneos GCL Group</title>
</head>
<body>
<div class="contentbar"><img align="left" src="img/logo.png" width="185" height="45"></img>Lista de baneos públicas de Gamer Chileno</div><br><br><br>
</br>
<h1>Último perdonazo hecho el 04 de Diciembre de 2014</h1></br>
<div id="news">Lista de baneos<br></div>
<table align="center" width="93%" border="1px solid #000" cellspacing=0 cellpadding=2 style="font-size: 8pt"><tr>
<td><font face="verdana"><b>Numero</b></font></td>
<td><font face="verdana"><b>Nombre</b></font></td>
<td><font face="verdana"><b>URL</b></font></td>
<td><font face="verdana"><b>Razón</b></font></td>
<td><font face="verdana"><b>Baneo desde (AAAA-mm-dd)</b></font></td>
<td><font face="verdana"><b>Baneo hasta (AAAA-mm-dd)</b></font></td>
<td><font face="verdana"><b>Baneado por</b></font></td>
<td><font face="verdana"><b>Estado</b></font></td>
<td><font face="verdana"><b>prueba</b></font></td>
</tr>
<?php
  $conexion=mysql_connect("localhost","gamelhzo_baneos","Ss262601") or die("Problemas en la conexion");
  @mysql_select_db("gamelhzo_baneosfb", $conexion) or die ("Error al conectar a la base de datos.");
  $query = "SELECT * from baneos where Estado='BAN'";
  $result = mysql_query($query);
  $numero = 1;
  while($row = mysql_fetch_array($result))
  {
    echo "<tr><td width=\"6%\"><font face=\"verdana\">".$row["numero"]."</font></td>";
	echo "<td width=\"15%\"><font face=\"verdana\">".$row["nombre"]."</font></td>";
	echo "<td width=\"5%\"><font face=\"verdana\"><a href='".$row["url"]."' target='_blank'>Aquí</a></font></td>";
	echo "<td width=\"15%\"><font face=\"verdana\">".$row["razon"]."</font></td>";
	echo "<td width=\"15%\"><font face=\"verdana\">".$row["fechaban"]."</font></td>";
    echo "<td width=\"20%\"><font face=\"verdana\">";
	if (($row['razon'] == 'Xenofobia') || ($row['razon'] == 'Bullying') || ($row['razon'] == 'Gore') || ($row['razon'] == 'Pornografia') || ($row['razon'] == 'Denunciar grupos al azar') || ($row['razon'] == 'Spam + cuenta FAKE-BOT') || ($row['razon'] == 'Insultos a la Administración') || ($row['razon'] == 'Venta no autorizada + cuenta FAKE-BOT') || ($row['razon'] == 'Cuenta FAKE-BOT') || ($row['razon'] == 'Spam virus de facebook'))
	{
	echo "<b>PERMANENTE</b>";
	}
	elseif ($row['razon'] == 'Venta no autorizada')
	{
	echo "1 mes (".date("Y/m/d",strtotime("$row[fechaban]+1month")).")";
	}
	elseif (($row['razon'] == 'Referidos') || ($row['razon'] == 'Usar grupo como inicio') || ($row['razon'] == 'Spoiler') || ($row['razon'] == 'Cadenas facebook'))
	{
	echo "1 semana (".date("Y/m/d",strtotime("$row[fechaban]+1week")).")";
	}
	elseif (($row['razon'] == 'Spam') || ($row['razon'] == 'Concursos sin autorización'))
	{
	echo "2 semanas (".date("Y/m/d",strtotime("$row[fechaban]+2week")).")";
	}
	elseif ($row['razon'] == 'Insultos a la administración')
	{
	echo "3 meses (".date("Y/m/d",strtotime("$row[fechaban]+3month")).")";
	}
	elseif ($row['razon'] == 'Spam stickers')
	{
	echo "2 semanas (".date("Y/m/d",strtotime("$row[fechaban]+2week")).")";
	}
	elseif ($row['razon'] == 'Las fuerzas cosmicas')
	{
	echo "<b>Hasta el fin del mundo</b>";
	}
	else
	{
	echo "El tipo de ban no esta sancionado";
	}"</font></td>";
    echo "<td width=\"12%\"><font face=\"verdana\">".$row['admin']."</font></td>";
	echo "<td width=\'15%\'";
	if ($row['Estado'] == 'BAN')
	{
	echo " bgcolor='#FE2E2E'><font face=\'verdana\'><b>BAN</b></font></td>";
	}
	elseif ($row['Estado'] == "DBAN")
	{
	echo " bgcolor='#2EFE2E'><font face=\'verdana\'><b>DBAN</b></font></td>";
	}
	elseif ($row['Estado'] == "UNK")
	{
	echo " bgcolor='#FF4000'><font face=\'verdana\'><b>UNK</b></font></td>";
	}
	elseif ($row['Estado'] == "LOV")
	{
	echo " bgcolor='#CC2EFA'><font face=\'verdana\'><b>LOV</b></font></td>";
	}
	else
	{
	echo " bgcolor='#FFBF00'><font face=\'verdana\'><b>ERROR</b></font></td>";
	}
	if ($row["prueba"] == '')
	{
	echo "<td width=\"15%\"><font face=\"verdana\">No hay pruebas</font></td></tr>";
	}
	else
	{
	echo "<td width=\"15%\"><font face=\"verdana\"><a href='pruebas/".$row["prueba"]."' target='_blank'>Aquí</a></font></td></tr>";
	}
	}
  mysql_free_result($result);
  mysql_close($conexion);
  ?>
</table>
</br></br></br></br>
<?php
date_default_timezone_set('America/Santiago');
$fecha=date('Y-m-d');
$proxy=$_SERVER['REMOTE_ADDR'];
$IP=$_SERVER['HTTP_X_FORWARDED_FOR'];
$hora= date("h:i:s a");
  $conexion2=mysql_connect("localhost","gamelhzo_baneos","Ss262601") or die("Problemas en la conexion");
mysql_select_db("gamelhzo_baneosfb",$conexion2) or die("Problemas en la seleccion de la base de datos");
mysql_query("insert into publico(ip,proxy,fecha,hora) values 
   ('$IP','$proxy','$fecha','$hora')", 
   $conexion2) or die("Problemas en el select".mysql_error());
mysql_close($conexion2);
?></br></br><div align="center">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Baneos -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-7066797474773268"
     data-ad-slot="6268760430"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script></div>