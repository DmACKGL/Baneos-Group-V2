<?php
 session_start();
 $titulo = 'Login';
 /*include('plantilla/head.php');*/
?>
	<link rel="stylesheet" type="text/css" href="./css/login.css">
	<script src="js/login.js"></script>
	<hgroup>
	  
	  <h1>Baneos Group</h1>
	</hgroup>
	<form action="iniciar_sesion2.php" autocomplete="off" method="POST">
	  <div class="group">
	    <input type="text" name='usuario' placeholder="Usuario" required><span class="highlight"></span><span class="bar"></span>	    
	  </div>
	  <div class="group">
	    <input type="password" name="password" placeholder="Clave" required><span class="highlight"></span><span class="bar"></span>
	  </div>
	  <button class="button buttonBlue" type="submit">Ingresar
	    <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
	  </button>
	</form>
	<footer>
	<a href="https://fsanllehi.me/" target="_blank"><img src="//cdn.gamerchileno.net/wp-content/uploads/2015/09/logowp.png"></a>
	  <p>SSL y Host por <a href="https://fsanllehi.me/" target="_blank">Franco Sanllehi</a></p>
	</footer>
 <?php include('plantilla/footer.php'); ?>