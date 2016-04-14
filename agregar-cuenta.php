<?php
 session_start();
 $titulo = 'Agregar cuenta';
 include('plantilla/head.php');
 ?>
<body>
<?php
	if (isset($_SESSION['usuarioban']) && isset($_SESSION['passwordban']))
	{
		$conexion=mysql_connect("localhost","gamelhzo_baneos","Ss262601") or die("Problemas en la conexion");
		mysql_select_db("gamelhzo_baneosfb",$conexion) or die("Problemas en la selección de la base de datos");
		$registros=mysql_query("select * from sesionmodif
                       where Usuario='$_SESSION[usuarioban]' AND Password='$_SESSION[passwordban]' AND activo='$_SESSION[activo]'",$conexion) or die("Problemas en el select:".mysql_error());
	if ($reg=mysql_fetch_array($registros))
	{
				echo '<nav class="navbar navbar-inverse navbar-fixed-top"><div class="container-fluid"><div class="navbar-header"><button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><img class="navbar-brand" src="logo.png"></img></div><div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"><ul class="nav navbar-nav">
			 <li role="presentation"><a href="index.php"><b>Inicio</b></a></li>
			 <li role="presentation"><a href="perfil.php"><b>Perfil -BETA-</b></a></li>';
    	if (($_SESSION['tipo'] == 1) || ($_SESSION['tipo'] == 2))
		{
			echo '<li role="presentation"><a href="admin-perfiles.php"><b>Administrador de perfiles</b></a></li>';
			echo '<li role="presentation" class="active"><a href="agregar-cuenta.php"><b>Agregar cuenta</b></a></li>';
		}
		echo '<li role="presentation"><a href="changelog.php" target="_blank"><b>Changelog</b></a></li></ul></div></div></nav>';
		echo '<div style="text-align:center;" class="jumbotron">';
		echo "<img width='100px' height='100px' style='border-radius:50px;' align='center' src='img/avatar/nuevo-sistema/".$_SESSION['usuarioban']."/".$reg['extensionfoto']."'</img><p>Has iniciado sesión como: ".$_SESSION['usuarioban']."</br>Para salir de la sesión, haz click <a href='logout.php'>Aquí</a></br></br>";
		include("frases.php");
		echo "</p></div></br></br></br>";
			}
	echo "<div class='panel panel-inverse'><div class='panel-body'><div class='form-group' style='margin-left:1%;'><form action='confirmar-cuenta.php' method='post' enctype='multipart/form-data'><div class='form-group' style='margin-left:1%;align:center;'>";
	echo "<div class='form-group' style='margin-left:1%;'><label for='exampleInputEmail1'>Nombre cuenta:</label><input style='width:50%;' class='form-control' placeholder='player one' type='text' name='username' required></input></div>
		<div class='form-group' style='margin-left:1%;'><label for='exampleInputEmail1'>Contraseña:</label><input style='width:50%;' class='form-control' type='password' name='password' placeholder='password' required></input></div>
		<div class='form-group' style='margin-left:1%;'><label for='exampleInputEmail1'>mail:</label><input style='width:50%;' class='form-control' type='mail' name='mail' placeholder='correo@pene.com' required></input></div>
		<div class='form-group' style='margin-left:1%;'><label for='exampleInputEmail1'>Foto de perfil:</label><input type='file' name='foto' accept='image/*' required><input name='action' type='hidden' value='upload'/><input name='Fechacrear' type='hidden' value=".date('Y-m-d')."></input></div>";
		if ($_SESSION['tipo'] == 1)
		{
			echo "<div class='form-group' style='margin-left:1%;'><label for='exampleInputEmail1'>Tipo de cuenta:</label>
			<select name='Tipocuenta' style='width:50%;' name='Tipoban' class='form-control' required>
		  	<option value=''>------</option>
		  	<option value='1'>Full admin</option>
		  	<option value='2'>Admin sistema</option>
		  	<option value='3'>moderador</option></select></div>
		  	<button style='margin-left:1%;' type='submit' class='btn btn-raised btn-success'>Agregar</button></form></div></div>";
		}
		elseif ($_SESSION['tipo'] == 2)
			echo "<div class='form-group' style='margin-left:1%;'><label for='exampleInputEmail1'>Tipo de cuenta:</label>
			<select name='Tipocuenta' class='a' required>
		  	<option value=''>------</option>
		  	<option value='3'>moderador</option></select></div>
		  	<button style='margin-left:1%;' type='submit' class='btn btn-raised btn-success'>Agregar</button></form></div></div>";
		}
	else
	{
echo utf8_decode('<div class="contentbar"><a href="index.php"><img align="left" src="img/logo.png" width="185" height="45"></img></a> Inicia sesion para poder ver, agregar o modificar baneos de GCL Group</div><br><br><br>');
echo utf8_decode('<form action="iniciar_sesion2.php" method="post">Usuario: <input type="text" name="usuario"></input></br>Password: <input type="password" name="password"></input></br><input type="submit" value="Iniciar"></form></br></br></br></br></br>');
echo $_SESSION['error'];
	}
?>