<?php

    /* Carga de todas las configs */

	include ("./config/app.php") or die("Error comnfig APP");
echo("1");
	include ("./config/db.php") or die("Error config DB");
echo("2");
	include ("./config/func.php") or die("Error config Login");
echo("3");

?>
