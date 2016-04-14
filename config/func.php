<?php
    /* Funciones */

    /* Funcion Login */
    function login() {
    	if($_SERVER["REQUEST_METHOD"] == "POST") {
	      $usuariolog = mysqli_real_escape_string($db,$_POST['username']);
	      $clavelog = mysqli_real_escape_string($db,$_POST['password']);
      	      $sql = "SELECT id FROM admin WHERE username = '$usuariolog' and passcode = '$clavelog'";
	      $result = mysqli_query($db,$sql);
	      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	      $active = $row['active'];
              $count = mysqli_num_rows($result);
		
	      if($count == 1) {
	         session_register("myusername");
        	 $_SESSION['login_user'] = $myusername;
         
	         header("location: welcome.php");
	      }else {
	         $error = "Your Login Name or Password is invalid";
	      }
	   }
    }

    /* Funcion no-login */
    function no-login() {
	session_start();
  
           $user_check = $_SESSION['login_user'];
	   $ses_sql = mysqli_query($db,"select username from admin where username = '$user_check' ");
	   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
	   $login_session = $row['username'];
   
	   if(!isset($_SESSION['login_user'])){
	      header("location:login.php");
	   }
    }
?>
