<?php 
	session_start();

	unset($_SESSION['giftvoucher_password']);
	
	header("Location:verify_giftpromocode.php");

	

?>