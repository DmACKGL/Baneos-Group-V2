<?php
 session_start();
 $titulo = 'Home';
 include('plantilla/head.php');
?>
  <!--JS-->
        <!--JS Locales-->
          <script src='js/index.js'></script>
          <script src="js/usuario.js" type="text/javascript" charset="utf-8" async defer></script>

        <!--JS Externos-->
          <script src='js/npm.js'></script>
          <script src='js/bootstrap.min.js'></script>
	
	<style type="text/css">
		.label {
		    font-size: 15px;
		}
		.label-default {
			background-color: #E400FF;
		}
		 .top-nav-collapse {
            background-color: #3F729B !important;
        }
        
        <!--Remember to set navbar color for mobile devices-->
        @media only screen and (max-width: 768px) {
            .navbar {
                background-color: #3F729B !important;
            }
        }
	</style>

<?php
	if (isset($_SESSION['usuarioban']) && isset($_SESSION['passwordban']))
	{
		$conexion=mysql_connect("localhost","gamelhzo_baneos","Ss262601") or die("Problemas en la conexion");
		mysql_select_db("gamelhzo_baneosfb",$conexion) or die("Problemas en la selección de la base de datos");
		$registros=mysql_query("select * from sesionmodif
                       where Usuario='$_SESSION[usuarioban]' AND Password='$_SESSION[passwordban]' AND activo='$_SESSION[activo]'",$conexion) or die("Problemas en el select:".mysql_error());
	if ($reg=mysql_fetch_array($registros))
	{
		echo '<nav style="background-color:#3949AB" class="navbar navbar-fixed-top z-depth-1" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand waves-effect waves-light" href="#">GamerChileno</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#" class="waves-effect waves-light">Inicio</a></li>
                    <li><a href="perfil.php" class="waves-effect waves-light">Perfil (Beta)</a></li>';
                    if (($_SESSION['tipo'] == 1) || ($_SESSION['tipo'] == 2))
				{
					echo '<li><a href="admin-perfiles.php">Administrador de perfiles</a></li>';
					echo '<li><a href="agregar-cuenta.php">Agregar cuenta</a></li>';
				}
				if ($_SESSION['tipo'] == 1)
				{
					echo '<li><a href="alerta.php"><b>Cambiar alerta</b></a></li>';
				}
				echo '<li><a href="logout.php" class="waves-effect waves-light">Cerrar sesion</a></li></ul>
            </div>
        </div>
    </nav>';
		$conexion32=mysql_connect("localhost","gamelhzo_baneos","Ss262601") or die("Problemas en la conexion");
		mysql_select_db("gamelhzo_baneosfb",$conexion) or die("Problemas en la selección de la base de datos");
		$registros32=mysql_query("select * from Alertas",$conexion32) or die("Problemas en el select:".mysql_error());
	if ($reg32=mysql_fetch_array($registros32))
		$tipo = $reg32[Tipo];
		$alerta = $reg32[Texto];
		$admin = $reg32[Admin];
	{
		if ($tipo == 1)
		{
		echo '<div style="position:relative" class="alert alert-warning alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  		<strong><div style=";position: absolute; z-index:1"><i class="fa fa-eye fa-5x"></i></div><p align="center"> Aviso!</span></strong>
	  		</br><p align="center">'.$alerta.'</p></br>
	  		<p align="right">Saludos.</br><b>'.$admin.'</b></p></div>';
		}
		if ($tipo == 2)
		{
		echo '<div style="position: relative;" class="alert alert-danger alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  		<strong><div style="position: absolute; top:35px; z-index:1"><i class="fa fa-exclamation-triangle fa-5x"></i></div><p align="center"> ALERTA!</span></strong>
	  		</br><p align="center">'.$alerta.'</p></br>
	  		<p align="right">Saludos.</br><b>'.$admin.'</b></p></div>';
		}
	}
		echo "<div style='text-align:center;' class='jumbotron'><img width='100px' height='100px' style='border-radius:50px;' align='center' src='img/avatar/nuevo-sistema/".$_SESSION['usuarioban']."/".$reg['extensionfoto']."'</img><p>Has iniciado sesión como: ".$_SESSION['usuarioban']."</br></br>";
		include("frases.php");
		echo "</p></div>"; ?>
    <div class="container-fluid">
    	<div class="row">
    		<div class='col-sm-4 text-center'>
		</div>
   			<div class='col-sm-4 text-center'>
  				<h4>Sistema de baneos</h4>
  				<h4><span class='label label-danger'>Version 3.1</span></h4>
			</div>
			<div class='col-sm-4 text-center'>
		<h4>API Facebook:</h4>
		<?php
		include('tools/status_url3/ping.php');
		$statusw3 = statweb3("graph.facebook.com");
		$checkw3 = @fsockopen($statusw3, 80);
		if(!$checkw3)
			{
				echo "<h4>Estado: <span class='label label-danger'>Offline</span> </h4>";
			}
		else
			{
				echo "<h4>Estado: <span class='label label-success'>Online</span> </h4>";
			}
			?>
		</div>
		</div>
		</div>
    <?php echo"</br>";
		echo "<div class='panel panel-default'><div class='panel-body'><div class='row'><form action='confirmar_ban.php' method='post' enctype='multipart/form-data' class='col-md-12'>";
		$conexion3=mysql_connect("localhost","gamelhzo_baneos","Ss262601") or die("Problemas en la conexion");
		mysql_set_charset("UTF8",$conexion3);
		mysql_select_db("gamelhzo_baneosfb",$conexion3) or die("Problemas en la selección de la base de datos");
		$registros=mysql_query("select * from sesionmodif where Usuario='$_SESSION[usuarioban]'",$conexion3) or die("Problemas en el select:".mysql_error());
	if ($reg=mysql_fetch_array($registros))
	{
		echo "<div class='row'>
        <div class='input-field col-md-6'>
          <input name='nombre' id='nombrefb' type='text' class='validate' required>
          <label for='nombrefb'>Nombre Facebook</label>
        </div>
        <div class='input-field col-md-6'>
          <input name='userid' id='ifb' type='text' class='validate' required>
          <label for='idfb'>ID Facebook</label>
        </div>
      </div>
      <div class='row'>
        <div class='input-field col-md-12'>
          <input disabled value=".$reg['Cantidadbaneos']." id='numbaneo' type='text' class='validate'>
          <label for='numbaneo'>Baneo numero</label>
        </div>
      </div>
      <div class='input-field col-md-12'>
          <h4 class='h4-responsive'>Tipo de ban: </h4><select id='tipoban' name='Tipoban' id='tipoban' type='text' required>
        ";
	if ($_SESSION['tipo'] == 1)
	{
		echo '<option value="">------</option>
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
		  <option value="Bloquear admin">Bloquear administrador</option>
		  <option value="Decision administrativa">Decision administrativa</option>
		  <option value="Bullying">Bullying</option></select></div>';
	}
	elseif (($_SESSION['tipo'] == 2) || ($_SESSION['tipo'] == 3))
	{
		echo '<option value="">------</option>
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
		  <option value="Bloquear admin">Bloquear administrador</option>
		  <option value="Bullying">Bullying</option></select></div>';
	}

echo "	</div>
      	</div>
  		<div class='col-md-12'><label for='exampleInputEmail1'>Prueba ban:</label><input style='width:50%' class='exampleInputFile' type='file' name='foto' accept='image/*' required></div><input name='action' type='hidden' value='upload'/>
		<div>
		<button type='submit' class='btn btn-default'>Agregar</button></form></div></div></div>";
echo "</br><center><div id='text-center'><h1>Lista de baneos</h1><br></center></div>
	  <div class='table-responsive'><table style='font-size:12px' class='table table-striped table-hover text-center'><tr>
	  <td><font face='verdana'><b>Nº</b></font></td>
	  <td><font face='verdana'><b>Nombre</b></font></td>
	  <td><font face='verdana'><b>URL</b></font></td>
	  <td><font face='verdana'><b>Razon</b></font></td>
	  <td><font face='verdana'><b>Baneo desde (AAAA-mm-dd)</b></font></td>
	  <td><font face='verdana'><b>Baneo hasta (AAAA-mm-dd)</b></font></td>
	  <td><font face='verdana'><b>Baneado por</b></font></td>
	  <td><font face='verdana'><b>Estado</b></font></td>
	  <td><font face='verdana'><b>Desbaneado por</b></font></td>
	  <td><font face='verdana'><b>Desbaneado el (AAAA-mm-dd)</b></font></td>
	  <td><font face='verdana'><b>Nota</b></font></td>
	  <td><font face='verdana'><b>prueba</b></font></td>
	  <td><font face='verdana'><b>Desbanear</b></font></td></tr>";
  $link=mysql_connect("localhost","gamelhzo_baneos","Ss262601") or die("Problemas en la conexion");
  @mysql_select_db("gamelhzo_baneosfb", $link) or die ("Error al conectar a la base de datos.");
  $query = "SELECT * from baneos";
  $result = mysql_query($query);
  $numero = 1;
  while($row = mysql_fetch_array($result))
  {
  	$nombre8 = $row['nombre'];
  	$nombresp = utf8_decode($nombre8);
    echo "<tr><td><font face=\"verdana\">".$row["numero"]."</font></td>";
	echo "<td><font face=\"verdana\">".$nombresp."</font></td>";
	echo "<td><font face=\"verdana\"><a href='https://facebook.com/".$row["userid"]."' target='_blank'>Aquí</a></font></td>";
			echo "<td width='15%'><font face=\"verdana\">";
			echo utf8_decode($row["razon"]);
			echo "</font></td>";
			echo "<td><font face=\"verdana\">".$row["fechaban"]."</font></td>";
			echo "<td ";
		if (($row['razon'] == 'Xenofobia') || ($row['razon'] == 'Bullying') || ($row['razon'] == 'Gore') || ($row['razon'] == 'Pornografia') || ($row['razon'] == 'Denunciar grupos al azar') || ($row['razon'] == 'Spam + cuenta FAKE-BOT') || ($row['razon'] == utf8_decode('Insultos a la Administracion')) || ($row['razon'] == 'Venta no autorizada + cuenta FAKE-BOT') || ($row['razon'] == 'Cuenta FAKE-BOT') || ($row['razon'] == 'Spam virus de facebook') || ($row['razon'] == 'Decision administrativa'))
		{
			echo "><a style='color:#fff' class='btn btn-danger'>PERMANENTE</a>";
		}
		elseif ($row['razon'] == 'Venta no autorizada')
		{
			echo "<font face=\"verdana\">1 mes (".date("Y/m/d",strtotime("$row[fechaban]+1month")).")";
		}
		elseif ($row['razon'] == 'Bloquear admin')
		{
			echo "<font face=\"verdana\">6 meses (".date("Y/m/d",strtotime("$row[fechaban]+6month")).")";
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
		}
		echo "</font></td>";
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
			echo " bgcolor='#FFBF00'><font face='verdana'><b>ERROR</b></font></td>";
		}
			echo "<td><font face=\"verdana\">".$row["dbanpor"]."</font></td>";
			echo "<td><font face=\"verdana\">".$row["dbanfecha"]."</font></td>";
			echo "<td><font face=\"verdana\">".$row["nota"]."</font></td>";
		if ($row["prueba"] == '')
		{
			echo "<td><font face=\"verdana\">No hay pruebas</font></td>";
		}
		else
		{
			echo "<td><font face=\"verdana\"><a href='pruebas/".$row["prueba"]."' target='_blank'>Aquí</a></font></td>";
		}
		if ($row['Estado'] == "DBAN")
		{
			echo "<td>Desbaneado</td></tr>";
		}
		elseif (($row['Estado'] == "BAN") && ($_SESSION['tipo'] == 1))
		{
			echo "<td><form action='dban_auto.php' method='post'><input type='hidden' name='Nombre' value='".$row['nombre']."'></input>
			<input type='hidden' name='numero' value='".$row['numero']."'></input><input type='hidden' name='estado' value='".$row['Estado']."'></input><input type='submit' class='btn btn-raised btn-success' value='Desbanear'></input></form></td></tr>";
		}
		elseif ((($row['razon'] == 'Decision administrativa') || ($row['razon'] == 'Xenofobia') || ($row['razon'] == 'Bullying') || ($row['razon'] == 'Gore') || ($row['razon'] == 'Pornografia') || ($row['razon'] == 'Denunciar grupos al azar') || ($row['razon'] == 'Spam + cuenta FAKE-BOT') || ($row['razon'] == 'Insultos a la Administracion') || ($row['razon'] == 'Venta no autorizada + cuenta FAKE-BOT') || ($row['razon'] == 'Cuenta FAKE-BOT') || ($row['razon'] == 'Spam virus de facebook')) && ($_SESSION['tipo'] != 1))
		{
			echo "<td><font face='verdana'>Baneado permanente</td></tr>";
		}
		elseif ($row['Estado'] == "LOV")
		{
			echo "<td><font face='verdana'>Machimaro la protege</td></tr>";
		}
		else
		{
			echo "<td><font face='verdana'><form action='dban_auto.php' method='post'><input type='hidden' name='Nombre' value='".$row['nombre']."'></input>
			<input type='hidden' name='numero' value='".$row['numero']."'></input><input type='hidden' name='estado' value='".$row['Estado']."'></input><input type='submit' value='Desbanear'></input></form></td></tr>";
	}
		}
  mysql_free_result($result);
  mysql_close($link);
echo "</table></div></div>";
}
	}
	}
else
{
	 include('login.php');
if ($_SESSION['error'] == 1)
	{
		echo "Usuario y/o contraseñas inválidas";
	}
	elseif ($_SESSION['error'] == 2)
	{
		echo "Cuenta desactivada";
	}
echo $_SESSION['error'];
}
?>
 <?php /*include('plantilla/footer.php');*/ ?>
