<?php session_start(); ?>
<?php session_destroy(); ?>
<?php 
echo "<script> alert (\"sesión terminada clickea ACEPTAR para ir a la pagina de baneos\"); </script>"; 
echo "<script language=Javascript> location.href=\"index.php\"; </script>"; 
?>
<html>
<meta http-equiv="Content-Type" content="text/html; ccharset=iso-8859-1">
<head>
<link rel="stylesheet" type="text/css" href="style.css" />
<title>Logout</title>
</head>
<body>