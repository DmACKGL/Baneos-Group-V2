<?php @session_start(); ?>
<html>
<meta http-equiv="Content-Type" content="text/html; ccharset=iso-8859-1">
<head>
<link rel="stylesheet" type="text/css" href="style.css" />
<title>Agregar baneos GCL Group</title>
</head>
<body>
<?php
if (isset($_SESSION['usuarioban']) && isset($_SESSION['passwordban']))
{
$conexion=mysql_connect("localhost","gamelhzo_baneos","Ss262601") or die("Problemas en la conexion");
mysql_select_db("gamelhzo_baneosfb",$conexion) or die("Problemas en la selección de la base de datos");
$registros=mysql_query("select * from sesionmodif
                       where Usuario='$_SESSION[usuarioban]' AND Password='$_SESSION[passwordban]' AND activo='$_SESSION[activo]'",$conexion) or die("Problemas en el select:".mysql_error());
if ($reg=mysql_fetch_array($registros))
?>
<ul id="menu">
<li><a href="index.php">Inicio</a></li>
<li><a href="modif-estado.php">Desbanear/Estado UNK</a></li> 
</ul>
<div class="infosesion"><?php echo "<img width='100px' height='100px' style='border-radius: 50px;' align='left' class='avatar' src='img/avatar/".$_SESSION['usuarioban']."_avatar.jpg'</img>";?>Has iniciado sesión como: <?php echo $_SESSION['usuarioban']; ?></br>Para salir de la sesión, haz click <a href="logout.php">Aqui</a></br></br><?php include("frases.php");?></div></br></br></br>
<div class="contentbar">modificar un ban automaticamente se coloca el nick del administrador que lo ha modificado</div><br><br><br>
<form action="confirmar_modif.php" method="post">
<table borde="1"><tr>
    <td>Nombre Facebook:</td><td><select name="Nombre" required>
<option value=''>------</option>
<?php
  $link=mysql_connect("localhost","gamelhzo_baneos","Ss262601") or die("Problemas en la conexion");
  @mysql_select_db("gamelhzo_baneosfb", $conexion) or die ("Error al conectar a la base de datos.");
  $query = "SELECT * from baneos";
  $result = mysql_query($query);
  $numero = 1;
  while($row = mysql_fetch_array($result))
  {
  if (($row['Estado'] == 'UNK') && ($row['razon'] != 'Xenofobia') && ($row['razon'] != 'Bullying') && ($row['razon'] != 'Denunciar grupos al azar') && ($row['razon'] != 'Spam + cuenta FAKE-BOT') && ($row['razon'] != 'Insultos a la Administración') && ($row['razon'] != 'Venta no autorizada + cuenta FAKE-BOT'))
  {
  echo "<option value='".$row['nombre']."'>".$row['nombre']." (UNK)</option>";
  }
  elseif (($row['Estado'] == 'BAN') && ($row['razon'] != 'Xenofobia') && ($row['razon'] != 'Bullying') && ($row['razon'] != 'Denunciar grupos al azar') && ($row['razon'] != 'Spam + cuenta FAKE-BOT') && ($row['razon'] != 'Insultos a la Administración') && ($row['razon'] != 'Venta no autorizada + cuenta FAKE-BOT'))
  {
  echo "<option value='".$row['nombre']."'>".$row['nombre']." (BAN)</option>";
  }
  }
 
  echo "</select></td>";
    mysql_free_result($result);
  mysql_close($link);
  ?>
</tr>
<tr>
<td></br>Nuevo estado:</td><td><select name="Estadonuevo" required>
<option value="">------</option>
<option value="UNK">Desconocido</option>
<option value="BAN">Baneado</option>
<option value="DBAN">Desbaneado</option></select></td></br>
</tr>
<tr>
<td style="vertical-align:middle;">Nota</td><td><textarea maxlength="999" class="b" name="nota" cols='60' rows='6' placeholder='Nota para que los administradores sepan la razon de la modificacion  (Maximo 999 caracteres)' style="resize:none" required></textarea></td></br>
</tr>
<tr>
<td>Fecha de modificacion: </td><td><b><?php echo date("Y-m-d");?></b> <input name="fechadban" value="<?php echo date("Y-m-d");?>" type="hidden"></input></td></br>
</tr></table>
<input type="submit" value="agregar">
</form>
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
// include("footer.php");
?>