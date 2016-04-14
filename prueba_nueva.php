<?php
  $link=mysql_connect("localhost","gamelhzo_baneos","Ss262601") or die("Problemas en la conexion");
  @mysql_select_db("gamelhzo_baneosfb", $link) or die ("Error al conectar a la base de datos.");
  $query = "SELECT last_insert_id() AS num FROM baneos";
  $result = mysql_query($query);
  if ($row = mysql_fetch_row($query))
  {
  $id = trim($row[0]);
  echo $id;
}
    mysql_free_result($result);
  mysql_close($link);
?>