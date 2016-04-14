<?php
 $titulo = 'Publico';
 include('plantilla/head.php');
?>	


	<style type="text/css">
		.label {
		    font-size: 15px;
		}
	</style>
	<div class="container">
	  <div class="jumbotron text-center">
	    <h1>Lista de baneos</h1>
		</div>
	</div>
	</br>
	</br>
	<a href="http://gamerchileno.net/baneos-group/publico/"></a>
	<div class='table-responsive'><table  class='text-center table table-striped table-hover'><tr>
	<td><b>ID</b></font></td>
	<td><b>Nombre</b></font></td>
	<td><b>URL</b></font></td>
	<td><b>Razón</b></font></td>
	<td><b>Baneo desde (AAAA-MM-DD)</b></font></td>
	<td><b>Baneo hasta (AAAA-MM-DD)</b></font></td>
	<td><b>Baneado por</b></font></td>
	<td><b>Estado</b></font></td>
	<td><b>Prueba</b></font></td>
	</tr></div>
	<?php
	  $conexion=mysql_connect("localhost","gamelhzo_baneos","Ss262601") or die("Problemas en la conexion");
	  @mysql_select_db("gamelhzo_baneosfb", $conexion) or die ("Error al conectar a la base de datos.");
	  $query = "SELECT * from baneos where Estado='BAN'";
	  $result = mysql_query($query);
	  $numero = 1;
	  while($row = mysql_fetch_array($result))
	  {
	    echo "<tr><td><font face=\"verdana\">".$row["numero"]."</font></td>";
		echo "<td><font face=\"verdana\">".$row["nombre"]."</font></td>";
		echo "<td><font face=\"verdana\"><a href='".$row["url"]."' target='_blank'>Aquí</a></font></td>";
		echo "<td><font face=\"verdana\">".$row["razon"]."</font></td>";
		echo "<td><font face=\"verdana\">".$row["fechaban"]."</font></td>";
	    echo "<td><font face=\"verdana\">";
		if (($row['razon'] == 'Decision administrativa') || ($row['razon'] == 'Xenofobia') || ($row['razon'] == 'Bullying') || ($row['razon'] == 'Gore') || ($row['razon'] == 'Pornografia') || ($row['razon'] == 'Denunciar grupos al azar') || ($row['razon'] == 'Spam + cuenta FAKE-BOT') || ($row['razon'] == utf8_decode('Insultos a la Administracion')) || ($row['razon'] == 'Venta no autorizada + cuenta FAKE-BOT') || ($row['razon'] == 'Cuenta FAKE-BOT') || ($row['razon'] == 'Spam virus de facebook') || ($row['razon'] == 'Decision administrativa'))
		{
		echo "<b>PERMANENTE</b>";
		}
		elseif ($row['razon'] == 'Bloquear admin')
		{
			echo "<font face=\"verdana\">6 meses (".date("Y/m/d",strtotime("$row[fechaban]+6month")).")";
		}
		elseif ($row['razon'] == 'Venta no autorizada')
		{
		echo "1 mes (".date("Y/m/d",strtotime("$row[fechaban]+1month")).")";
		}
		elseif (($row['razon'] == 'Referidos') || ($row['razon'] == 'Usar grupo como inicio') || ($row['razon'] == 'Spoiler') || ($row['razon'] == 'Cadenas facebook') || ($row['razon'] == 'Insultos usuarios'))
		{
		echo "1 semana (".date("Y/m/d",strtotime("$row[fechaban]+1week")).")";
		}
		elseif (($row['razon'] == 'Spam') || ($row['razon'] == 'Concursos sin autorización'))
		{
		echo "2 semanas (".date("Y/m/d",strtotime("$row[fechaban]+2week")).")";
		}
		elseif ($row['razon'] == 'Insultos a la administracion')
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
	    echo "<td><font face=\"verdana\">".$row['admin']."</font></td>";
		echo "<td align='center'";
		if ($row['Estado'] == 'BAN')
		{
		echo " ><span class='label label-danger'>BAN</span></td>";
		}
		elseif ($row['Estado'] == "DBAN")
		{
		echo " ><span class='label label-success'>DBAN</span></td>";
		}
		elseif ($row['Estado'] == "UNK")
		{
		echo " ><span class='label label-warning'>UNK</span></td>";
		}
		elseif ($row['Estado'] == "LOV")
		{
		echo " ><span class='label label-default'>LOV</span></td>";
		}
		else
		{
		echo " bgcolor='#FFBF00'><font face=\'verdana\'><b>ERROR</b></font></td>";
		}
		if ($row["prueba"] == '')
		{
		echo "<td><font face=\"verdana\">No hay pruebas</font></td></tr>";
		}
		else
		{
		echo "<td><font face=\"verdana\"><a href='pruebas/".$row["prueba"]."' target='_blank'>Aquí</a></font></td></tr>";
		}
		}
	  mysql_free_result($result);
	  mysql_close($conexion);
	  ?>
	</table>
	</div>
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

 <?php include('plantilla/footer.php'); ?>
