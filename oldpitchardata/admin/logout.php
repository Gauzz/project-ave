<?php 

	//require 'partials/_secure-session.php';

	session_start();

	unset($_SESSION['admin']);

	header("Location:login.php");

	

?>