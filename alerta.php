<?php @session_start(); ?>
<?php
  $titulo = 'Modificar alerta';
  include('plantilla/head.php');
?>
<body>
<?php
if (isset($_SESSION['usuarioban']) && isset($_SESSION['passwordban']))
{
    $conexion=mysql_connect("localhost","gamelhzo_baneos","Ss262601") or die("Problemas en la conexion");
    mysql_select_db("gamelhzo_baneosfb",$conexion) or die("Problemas en la seleccion de la base de datos");
    $registros=mysql_query("select * from sesionmodif where Usuario='$_SESSION[usuarioban]' AND Password='$_SESSION[passwordban]' AND activo='$_SESSION[activo]'",$conexion) or die("Problemas en el select:".mysql_error());
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
    echo '<li role="presentation"><a href="changelog.php" target="_blank"><b>Changelog</b></a></li></ul></div></div></nav>
          <div style="text-align:center;" class="well">';
    echo "<img width='100px' height='100px' style='border-radius:50px;' align='center' src='img/avatar/nuevo-sistema/".$_SESSION['usuarioban']."/".$reg['extensionfoto']."'</img><p>Has iniciado sesión como: ".$_SESSION['usuarioban']."</br>Para salir de la sesión, haz click <a href='logout.php'>Aquí</a></br></br>";
    include("frases.php");
    echo "</p></div>";
    
    $conexion32=mysql_connect("localhost","gamelhzo_baneos","Ss262601") or die("Problemas en la conexion");
    mysql_select_db("gamelhzo_baneosfb",$conexion) or die("Problemas en la selección de la base de datos");
    $registros32=mysql_query("select * from Alertas",$conexion32) or die("Problemas en el select:".mysql_error());
    if ($reg32=mysql_fetch_array($registros32))
    $tipo = $reg32[Tipo];
    $alerta = $reg32[Texto];
    $admin = $reg32[Admin];
  {
    echo "<div class='panel panel-default'><div class='panel-body'>
<form action='confirmar_alerta.php' method='post'>
<div class='form-group' style='align:center;'>
<div class='form-group'><label for='exampleInputEmail1'>Alerta actual: </label><textarea style='width:50%;' class='form-control' placeholder='Elvio Lado' type='text' readonly>".$alerta."</textarea></div>
<div class='form-group'><label for='exampleInputEmail1'>Admin que emite alerta: </label><input style='width:50%;' class='form-control' placeholder='Elvio Lado' type='text' value='".$admin."' readonly></div>";
if ($tipo == 0)
{
echo "<label for='exampleInputEmail1'>Nombre facebook</label><input style='width:50%;' class='form-control' class='a' placeholder='Elvio Lado' type='text' name='nombre' value='Alerta desactivada' readonly></input></div>";
}
if ($tipo == 1)
{
echo "<label for='exampleInputEmail1'>Nombre facebook</label><input style='width:50%;' class='form-control' class='a' placeholder='Elvio Lado' type='text' name='nombre' value='Aviso' readonly></input></div>";
}
elseif ($tipo == 2)
{
echo "<label for='exampleInputEmail1'>Nombre facebook</label><input style='width:50%;' class='form-control' class='a' placeholder='Elvio Lado' type='text' name='nombre' value='Alerta' readonly></input></div>";
}
echo "<div class='form-group'><label for='exampleInputEmail1'>Modificar alerta: </label><select style='width:50%;' name='Tipo' class='form-control' required>
<option value=''>------</option>
<option value='0'>Desactivar alerta</option>
<option value='1'>Aviso</option>
<option value='2'>Alerta</option></select></div>
<div class='form-group'><label for='exampleInputEmail1'>Alerta: </label><textarea style='width:50%;' maxlength='999' class='form-control' name='alerta' cols='60' rows='6' placeholder='Alerta a mostrar en la pagina principal  (Maximo 999 caracteres)' style='resize:none 'required></textarea></div>
<button style='margin-left:1%;' type='submit' class='btn btn-default'>Agregar</button></form></div></div>";
}
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
