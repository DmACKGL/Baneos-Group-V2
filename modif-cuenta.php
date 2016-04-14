<?php
 session_start();
 $titulo = 'Home';
 include('plantilla/head.php');
?>
<body>
<div class='wrapper'>
<?php
  if (isset($_SESSION['usuarioban']) && isset($_SESSION['passwordban']))
  {
    $conexion=mysql_connect("localhost","gamelhzo_baneos","Ss262601") or die("Problemas en la conexion");
    mysql_select_db("gamelhzo_baneosfb",$conexion) or die("Problemas en la selección de la base de datos");
    $registros=mysql_query("select * from sesionmodif
                       where Usuario='$_SESSION[usuarioban]' AND Password='$_SESSION[passwordban]' AND activo='$_SESSION[activo]'",$conexion) or die("Problemas en el select:".mysql_error());
  if ($reg=mysql_fetch_array($registros))
  {
    echo '<nav class="navbar navbar-default navbar-fixed-top"><div class="container-fluid"><div class="navbar-header"><button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a class="navbar-brand" href="#">Gamer Chileno</a></div><div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"><ul class="nav navbar-nav">
       <li role="presentation"><a href="index.php"><b>Inicio</b></a></li>
       <li role="presentation"><a href="perfil.php"><b>Perfil -BETA-</b></a></li>';
      if (($_SESSION['tipo'] == 1) || ($_SESSION['tipo'] == 2))
    {
      echo '<li role="presentation"><a href="admin-perfiles.php"><b>Administrador de perfiles</b></a></li>';
      echo '<li role="presentation"><a href="agregar-cuenta.php"><b>Agregar cuenta</b></a></li>';
    }
    echo '<li role="presentation"><a href="changelog.php" target="_blank"><b>Changelog</b></a></li>
<ul class="nav navbar-nav navbar-right">
        <li role="presentation"><a href="logout.php"><b>Cerrar sesión</b></a></li></div></div>
    </nav>';
    echo '<div style="text-align:center;" class="well">';
    echo "<img width='100px' height='100px' style='border-radius:50px;' align='center' src='img/avatar/nuevo-sistema/".$_SESSION['usuarioban']."/".$reg['extensionfoto']."'</img><p>Has iniciado sesión como: ".$_SESSION['usuarioban']."</br></br>";
    include("frases.php");
    echo "</p></div></br></br></br>
    <center>" ?>
<table borde="1"><tr>
<?php
  $numero = $_REQUEST['numero'];
  $conexion=mysql_connect("localhost","gamelhzo_baneos","Ss262601") or die("Problemas en la conexion");
    mysql_select_db("gamelhzo_baneosfb",$conexion) or die("Problemas en la selección de la base de datos");
    $registros=mysql_query("select * from sesionmodif
                       where Numero=$numero",$conexion) or die("Problemas en el select:".mysql_error());
  if ($reg=mysql_fetch_array($registros))
  $password = $reg['Password'];
  echo "<div class='panel panel-default'><div class='panel-body'><div class='form-group' style='margin-left:1%;align:center;'><label for='exampleInputEmail1'>Usuario: <b>".$reg['Usuario']."</b></label></div>";
  if ($reg['tipo'] == 1)
  {
    echo "<div class='form-group' style='margin-left:1%;align:center;'><label for='exampleInputEmail1'>Tipo:</label>
    Full admin</div>";
  }
  elseif ($reg['tipo'] == 2)
  {
    echo "<div class='form-group' style='margin-left:1%;align:center;'><label for='exampleInputEmail1'>Tipo:</label>
    admin</div>";
  }
  elseif ($reg['tipo'] == 3)
  {
    echo "<div class='form-group' style='margin-left:1%;align:center;'><label for='exampleInputEmail1'>Tipo:</label>
    moderador</div>";
  }
  if ($reg['activo'] == 1)
  {
    echo "<div class='form-group' style='margin-left:1%;align:center;'><label for='exampleInputEmail1'>Estado:</label>
    Activo</div>";
  }
  if ($reg['activo'] == 0)
  {
    echo "<div class='form-group' style='margin-left:1%;align:center;'><label for='exampleInputEmail1'>Estado:</label>
    Inactivo</div>";
  }
  echo "<form action='confirmar_modif_cuenta.php' method='post'>
  <input name='activo' type='hidden' value=".$reg['activo']."></input>
  <input name='tipo' type='hidden' value=".$reg['tipo']."></input>
  <input name='mail' type='hidden' value=".$reg['Email']."></input>
  <input name='usuario' type='hidden' value=".$reg['Usuario']."></input>
  <div class='form-group' style='margin-left:1%;align:center;'><label for='exampleInputEmail1'>Nueva contraseña: </label><input name='password' type='password'></input></div>
  <input name='numero' type='hidden' value=".$numero."></input>
  <input name='usuario' type='hidden' value=".$reg['Usuario']."></input>
  <input type='submit' value='agregar'></form></div></div>";
  ?>
<?php
}
else
{
?>
<div class="contentbar"><a href="index.php"><img align="left" src="img/logo.png" width="185" height="45"></img></a> Inicia sesión para poder ver, agregar o modificar baneos de GCL Group</div><br><br><br>
<form action="iniciar_sesion2.php" method="post">
Usuario: <input type="text" name="usuario"></input></br>
Contraseña: <input type="password" name="password"></input></br>
<input type="submit" value="Iniciar">
</form>
</br></br></br></br></br>
<?php
}
}
  include('plantilla/footer.php');
?>
