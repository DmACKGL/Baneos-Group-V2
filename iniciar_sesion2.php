<?php session_start() ?>
<?php $titulo = 'Iniciar Sesion'; ?>
<?php header('Location: index.php');?>
<!--//-->
<?php include("plantilla/head.php");?>
<body>
<?php
	date_default_timezone_set('America/Santiago');
	$usuario1 = $_REQUEST['usuario'];
	$password1 = $_REQUEST['password'];
	$password2 = hash('SHA512',$password1);
	$_SESSION['error'] = '0';
	$conexion=mysql_connect("localhost","gamelhzo_baneos","Ss262601") or die("Problemas en la conexion");
	mysql_select_db("gamelhzo_baneosfb",$conexion) or die("Problemas en la selección de la base de datos");
	$registros=mysql_query("select * from sesionmodif where Usuario='$usuario1'",$conexion) or die("Problemas en el select:".mysql_error());
	if ($reg=mysql_fetch_array($registros))
	{
		if (($usuario1 != $reg['Usuario']) || ($password2 != $reg['Password']) && ($reg['activo'] == 1))
		{
			$_SESSION['error'] = '1';
			echo $_SESSION['error'];
			echo "<script> alert (\"Error al iniciar sesion, presiona ACEPTAR para volver al inicio\"); </script>"; 
			echo "<script language=Javascript> location.href=\"index.php\"; </script>";
		}
		elseif ($reg['activo'] == 0)
		{
			$_SESSION['error'] = '2';
			echo $_SESSION['error'];
			echo "<script> alert (\"Error al iniciar sesion, presiona ACEPTAR para volver al inicio\"); </script>"; 
			echo "<script language=Javascript> location.href=\"index.php\"; </script>";
		}
		elseif (($usuario1 == $reg['Usuario']) && ($password2 == $reg['Password']) && ($reg['activo'] == 1))
		{
		$registros=mysql_query("update sesionmodif set ultimaip='$_SERVER[REMOTE_ADDR]' WHERE Usuario='$usuario1'",$conexion) or die("Problemas en el select:".mysql_error());
		$fechainic = date('d/m/Y');
		$horainic = date('h:i:s a', strtotime('+1 hour'));
		$conexion2=mysqli_connect("localhost","gamelhzo_baneos","Ss262601","gamelhzo_baneosfb") or die("Problemas con la conexión");
		mysqli_query($conexion2,"insert into logsesion(usuario,ip,fecha,hora) values ('$usuario1','$_SERVER[REMOTE_ADDR]','$fechainic','$horainic')") or die("Problemas en el select".mysqli_error($conexion2));
		mysqli_close($conexion2);
		//$tipo = $reg[tipo];
		//print_r($reg);
		//echo $reg[activo];
		$_SESSION['usuarioban']= $reg['Usuario'];
		$_SESSION['passwordban']= $reg['Password'];
		$_SESSION['tipo']= $reg['tipo'];
		$_SESSION['activo']= $reg['activo'];
		$ar=fopen("archivos/sesiones/inicio-sesion".date("Y").".txt","a") or die("Problemas en la creacion");
		date_default_timezone_set('America/Santiago');
		$hora= date("h:i:s a");
		fputs($ar,"Nombre usuario: ".$_SESSION['usuarioban']);
		fputs($ar,"\n");
		fputs($ar,"Hora inicio sesion: ".$hora);
		fputs($ar,"\n");
		fputs($ar,"fecha inicio sesion : ".date("Y-m-d"));
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
		echo "</br>";
	/*print_r($reg);
	$tipo = $reg[tipo];
	echo $tipo;*/
	echo "<script> alert (\"sesión iniciada clickea ACEPTAR para ir a la pagina de baneos\"); </script>"; 
	echo "<script language=Javascript> location.href=\"index.php\"; </script>";
	die(); 
	$_SESSION['error']= '0';
	echo "Usuario: ".$reg['Usuario'];
	}
	}
?>
<br><br><br>
<?php include("plantilla/footer.php");?>
