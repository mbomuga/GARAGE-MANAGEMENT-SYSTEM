<?php
   
	session_start();
	
	session_destroy();
	
	if(isset($_SESSION['name']) && isset($_SESSION['email']) && isset($_SESSION['conduct']))
	{
		unset($_SESSION['name']);
		unset($_SESSION['email']);
		unset($_SESSION['conduct']);

      	header("Location: home.php");
      	exit();
   	}
   	else
   	{
   		header("Location: login.php");
   		exit();
   	}
?>