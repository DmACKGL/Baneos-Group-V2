<?php session_start(); ?>
<?php $titulo = 'Administrador de perfiles';
 include('plantilla/head.php');
?>
</head>
<body>
<?php
if (isset($_SESSION['usuarioban']) && isset($_SESSION['passwordban']))
{
$conexion=mysql_connect("localhost","gamelhzo_baneos","Ss262601") or die("Problemas en la conexion");
mysql_select_db("gamelhzo_baneosfb",$conexion) or die("Problemas en la selección de la base de datos");
$registros=mysql_query("select * from sesionmodif
                       where Usuario='$_SESSION[usuarioban]' AND Password='$_SESSION[passwordban]'",$conexion) or
  die("Problemas en el select:".mysql_error());
if ($reg=mysql_fetch_array($registros))
{
		echo '<nav class="navbar navbar-inverse navbar-fixed-top"><div class="container-fluid"><div class="navbar-header"><button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><img class="navbar-brand" src="logo.png"></img></div><div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"><ul class="nav navbar-nav">
			 <li role="presentation"><a href="index.php"><b>Inicio</b></a></li>
			 <li role="presentation"><a href="perfil.php"><b>Perfil -BETA-</b></a></li>';
    	if (($_SESSION['tipo'] == 1) || ($_SESSION['tipo'] == 2))
		{
			echo '<li role="presentation" class="active"><a href="admin-perfiles.php"><b>Administrador de perfiles</b></a></li>';
			echo '<li role="presentation"><a href="agregar-cuenta.php"><b>Agregar cuenta</b></a></li>';
		}
		echo '<li role="presentation"><a href="changelog.php" target="_blank"><b>Changelog</b></a></li></ul></div></div></nav>';
 	echo '<div style="text-align:center;" class="jumbotron">';
		echo "<img width='100px' height='100px' style='border-radius:50px;' align='center' src='img/avatar/nuevo-sistema/".$_SESSION['usuarioban']."/".$reg['extensionfoto']."'</img><p>Has iniciado sesión como: ".$_SESSION['usuarioban']."</br>Para salir de la sesión, haz click <a href='logout.php'>Aquí</a></br></br>";
		include("frases.php");
		echo "</p></div></br></br></br>";
	echo "</br><center><div class='container><div class='jumbotron'><h1>Lista de usuarios<br><br></h1>
		 <div class='table-responsive'>
		 <table class='table table-striped table-hover text-center'><tr>
		 <td><font face='verdana'><b>Nº</b></font></td>
		 <td><font face='verdana'><b>Usuario</b></font></td>
		 <td><font face='verdana'><b>Cantidad de baneos</b></font></td>
		 <td><font face='verdana'><b>Cantidad de desbaneos</b></font></td>
		 <td><font face='verdana'><b>Foto</b></font></td>
		 <td><font face='verdana'><b>Tipo</b></font></td>
		 <td><font face='verdana'><b>Estado de la cuenta</b></font></td>";
	if (($_SESSION['tipo'] == 1) || ($_SESSION['tipo'] == 2))
	{
		echo "<td><font face='verdana'><b>Acción</b></font></td>";
		echo "<td><font face='verdana'><b>Modificar</b></font></td></tr></center>";
	}
	else
	{
	}
$link=mysql_connect("localhost","gamelhzo_baneos","Ss262601") or die("Problemas en la conexion");
  @mysql_select_db("gamelhzo_baneosfb", $conexion) or die ("Error al conectar a la base de datos.");
  $query = "SELECT * from sesionmodif";
  $result = mysql_query($query);
  $numero = 1;
  while($row = mysql_fetch_array($result))
    {
	  echo "<tr><td align='center'><font face=\"verdana\">".$row["Numero"]."</font></td>";
	  echo "<td><font face=\"verdana\">".$row['Usuario']."</font></td>";
	  echo "<td><font face=\"verdana\">".$row['Cantidadbaneos']."</font></td>";
	  echo "<td><font face=\"verdana\">".$row['Cantidaddbaneos']."</font></td>";
	  echo "<td><img width='25px' height='25px' src='img/avatar/nuevo-sistema/".$row['Usuario']."/".$row['extensionfoto']."'</img></td>";
	  if ($row['tipo'] == 1)
	  {
		  echo "<td><font face=\"verdana\">Full admin</font></td>";
	  }
	  elseif ($row['tipo'] == 2)
	  {
		  echo "<td><font face=\"verdana\">admin</font></td>";
	  }
	  elseif ($row['tipo'] == 3)
	  {
		  echo "<td><font face=\"verdana\">moderador</font></td>";
	  }
	  else
	  {
		  echo "<td><font face=\"verdana\">ERROR</font></td>";
	  }
	  if ($row['activo'] == 1)
	  {
		  echo "<td><font face=\"verdana\">Activo</font></td>";
	  }
	  else
	  {
		  echo "<td><font face=\"verdana\">Inactivo</font></td>";
	  }
	  if (($_SESSION['tipo'] == 1) && (($row['activo'] == 1) && ($row['tipo'] != 1)))
	  {
		  echo "<td><font face='verdana'><form action='cambiar-estado-cuenta.php' method='post'><input type='hidden' name='mail' value='".$row['Email']."'></input><input type='hidden' name='tiponuevo' value='0'></input><input type='hidden' name='Usuario' value='".$row['Usuario']."'></input>
			<input type='hidden' name='numero' value='".$row['Numero']."'></input><input type='hidden' name='tipo' value='".$row['tipo']."'></input><input type='submit' class='btn btn-raised btn-danger' value='Desactivar'></input></form></td>";
	  }
	  elseif (($_SESSION['tipo'] == 1) && ($row['activo'] == 0))
	  {
		  echo "<td><font face='verdana'><form action='cambiar-estado-cuenta.php' method='post'><input type='hidden' name='mail' value='".$row['Email']."'></input><input type='hidden' name='tiponuevo' value='1'></input><input type='hidden' name='Usuario' value='".$row['Usuario']."'></input>
			<input type='hidden' name='numero' value='".$row['Numero']."'></input><input type='hidden' name='tipo' value='".$row['tipo']."'></input><input type='submit' class='btn btn-raised btn-success' value='Activar'></input></form></td>";
	  }
	  elseif (($_SESSION['tipo'] == 2) && (($row['activo'] == 1) && ($row['tipo'] == 3)))
	  {
		  echo "<td><font face='verdana'><form action='cambiar-estado-cuenta.php' method='post'><input type='hidden' name='mail' value='".$row['Email']."'></input><input type='hidden' name='tiponuevo' value='0'></input><input type='hidden' name='Usuario' value='".$row['Usuario']."'></input>
			<input type='hidden' name='numero' value='".$row['Numero']."'></input><input type='hidden' name='tipo' value='".$row['tipo']."'></input><input type='submit' value='Desactivar'></input></form></td>";
	  }
	  elseif (($_SESSION['tipo'] == 2) && (($row['activo'] == 0) && ($row['tipo'] == 3)))
	  {
		  echo "<td><font face='verdana'><form action='cambiar-estado-cuenta.php' method='post'><input type='hidden' name='mail' value='".$row['Email']."'></input><input type='hidden' name='tiponuevo' value='1'></input><input type='hidden' name='Usuario' value='".$row['Usuario']."'></input>
			<input type='hidden' name='numero' value='".$row['Numero']."'></input><input type='hidden' name='tipo' value='".$row['tipo']."'></input><input type='submit' value='Activar'></input></form></td>";
	  }
	  else
	  {
		  echo "<td><font face=\"verdana\">No tienes poder aquí</font></td>";
	  }
	  if (($_SESSION['tipo'] == 1) && ($row['tipo'] != 1))
	  {
	  	echo "<td><font face='verdana'><form action='modif-cuenta.php' method='post'><input type='hidden' name='tiponuevo' value='1'></input><input type='hidden' name='Usuario' value='".$row['Usuario']."'></input>
			<input type='hidden' name='numero' value='".$row['Numero']."'></input><input type='submit' class='btn btn-raised btn-default' value='Modificar'></input></form></td></tr>";
	  }
	  elseif (($_SESSION['tipo'] == 2) && ($row['tipo'] != 1) && ($row['tipo'] != 2))
	  {
	  	echo "<td><font face='verdana'><form action='modif-cuenta.php' method='post'><input type='hidden' name='tiponuevo' value='1'></input><input type='hidden' name='Usuario' value='".$row['Usuario']."'></input>
			<input type='hidden' name='numero' value='".$row['Numero']."'></input><input type='submit' class='btn btn-raised btn-default' value='Modificar'></input></form></td></tr>";
	  }
	  else
	  {
		  echo "<td class='btn btn-raised btn-info'><font face=\"verdana\">No tienes poder aquí</font></td>";
	  }
	}
	echo "</table></div>";
}
else
{
}
}
else
{
echo "<div class='contentbar'><a href='index.php'><img align='left' src='img/logo.png' width='185' height='45'></img></a> Inicia sesión para poder ver, agregar o modificar baneos de GCL Group</div><br><br><br><form action='iniciar_sesion2.php' method='post'>
	Usuario: <input type='text' name='usuario'></input></br>
	Contraseña: <input type='password' name='password'></input></br>
	<input type='submit' value='Iniciar'></form></br></br></br></br></br>";
// include("footer.php");
}
?>
