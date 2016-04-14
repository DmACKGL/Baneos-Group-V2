<?php @session_start(); ?>
<?php
$titulo = "Perfil de ".$_SESSION['usuarioban'];
  include('plantilla/head.php');  
?>
<body>
<?php
if (isset($_SESSION['usuarioban']) && isset($_SESSION['passwordban']))
{
$conexion=mysql_connect("localhost","gamelhzo_baneos","Ss262601") or die("Problemas en la conexion");
mysql_select_db("gamelhzo_baneosfb",$conexion) or die("Problemas en la selección de la base de datos");
$registros=mysql_query("select * from sesionmodif
                       where Usuario='$_SESSION[usuarioban]' AND Password='$_SESSION[passwordban]' AND activo='$_SESSION[activo]'",$conexion) or
  die("Problemas en el select:".mysql_error());
if ($reg=mysql_fetch_array($registros))
{
  echo '<nav class="navbar navbar-inverse navbar-fixed-top"><div class="container-fluid"><div class="navbar-header"><button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><img class="navbar-brand" src="logo.png"></img></div><div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"><ul class="nav navbar-nav">
       <li role="presentation"><a href="index.php"><b>Inicio</b></a></li>
       <li role="presentation" class="active"><a href="perfil.php"><b>Perfil -BETA-</b></a></li>';
      if (($_SESSION['tipo'] == 1) || ($_SESSION['tipo'] == 2))
    {
      echo '<li role="presentation"><a href="admin-perfiles.php"><b>Administrador de perfiles</b></a></li>';
      echo '<li role="presentation"><a href="agregar-cuenta.php"><b>Agregar cuenta</b></a></li>';
    }
    echo '<li role="presentation"><a href="changelog.php" target="_blank"><b>Changelog</b></a></li></ul></div></div></nav>';
 echo '<div style="text-align:center;" class="jumbotron">';
    echo "<img width='100px' height='100px' style='border-radius:50px;' align='center' src='img/avatar/nuevo-sistema/".$_SESSION['usuarioban']."/".$reg['extensionfoto']."'</img><p>Has iniciado sesión como: ".$_SESSION['usuarioban']."</br>Para salir de la sesión, haz click <a href='logout.php'>Aquí</a></br></br>";
    include("frases.php");
    echo '</div>';
?>
<div class="container">
<div class="jumbotron text-center">
<h1>Foto de perfil</h1></br>

<form action="cambiar_foto_perfil.php" method="post" enctype="multipart/form-data">
  <table borde="1">
  <tr>
    <td width="350px">Cambiar foto perfil: </td>
    <td>
      <input type="file" name="foto-perfil" accept="image/*" width="auto" required>
      <input name="action" type="hidden"   value="upload" />
    </td>
  </tr>
  <tr>
  <td></td><td><input type="submit" class="btn btn-raised btn-success " align="center" value="Cambiar!"></td></tr>
  </table>

</form> 
</div>
</div>
  <div class='panel panel-primary panel-inverse'><div class='panel-heading'><h1 class="panel-title">Estadisticas</h1></div>
  <div class="panel-body">
  <p>Aquí encontrarás todas las estadísticas sobre tu cuenta que te puedan interesar.</p>
  <table class="table table-bordered">
  <tbody>
        <tr>
          <td>Baneos realizados</td>
          <td>Desbaneos realizados</td>
          <td>Cambios de foto realizados</td>
          <td>Direccion IP</td>
          <td>Ultima IP guardada</td>
        </tr>
        <tr>
          <td class="info"><b><?php echo $reg['Cantidaddbaneos']?></b></td>
          <td class="info"><b><?php echo $reg['cantidadfotos']?></b></td>
          <td class="info"><b><?php echo $reg['cantidadfotos']?></b></td>
          <td class="info"><b><?php echo $_SERVER['REMOTE_ADDR']?></b></td>
          <td class="info"><b><?php echo $reg['ultimaip']?></b></td>
        </tr>
      </tbody>
      </table>
      </div>
      </div>
      </br>
      </br>
<div class='panel panel-primary'><div class='panel-heading'><h1 class="panel-title">Logs</h1></div>
  <div class="panel-body">
  <p>Aquí encontrarás los últimos 10 inicios de sesión en tu cuenta.</p>
  <table class="table table-bordered">
  <tbody>
        <tr>
          <td>IP</td>
          <td>Fecha</td>
          <td>Hora</td>
        </tr>
        <?php
          $link=mysql_connect("localhost","gamelhzo_baneos","Ss262601") or die("Problemas en la conexion");
          @mysql_select_db("gamelhzo_baneosfb", $link) or die ("Error al conectar a la base de datos.");
          $query = "SELECT * from logsesion WHERE usuario='$_SESSION[usuarioban]' order by numero DESC LIMIT 10";
          $result = mysql_query($query);
          $numero = 1;
          while($row = mysql_fetch_array($result))
            {
              echo "
              <tr>
                <td class=info>".$row['ip']."</td>
                <td class=info>".$row['fecha']."</td>
                <td class=info>".$row['hora']."</td>
              </tr>";
            }
            ?>
      </tbody>
      </table>
      </div>
      </div>
	<?php
}?>
</br>

<!--- </br><h1>Cambio contraseña</h1></br>
<form action="cambiar_pw.php" method="post">
<table borde="1"><tr>
<td width="350px">Contraseña antigua: </td><td><input type="password" name="pw-vieja" required></input></td>
</tr>
<tr>
<td width="350px">Contraseña nueva: </td><td><input type="password" name="pw-nueva" required></input></td>
</tr>
<tr>
<td width="350px">Confirmar nueva contraseña: </td><td><input type="password" name="pw-confirm" required></input></td>
</tr>
<tr>
<td></td><td><input type="submit" value="Cambiar!"></td></tr>
</table>
</form> -->
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
  include('plantilla/footer.php');
?>
