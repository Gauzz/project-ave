<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 
ob_start();
session_start();
if (!isset($_SESSION["admin"]) AND empty($_SESSION["admin"])) {
	header("Location:login.php");
	echo "<script>window.location.href='login.php'; </script>";
	exit();
}

if(isset($_SESSION["admin"])){
	$firstName=$_SESSION["admin"]["firstname"];
	$lastName=$_SESSION["admin"]["lastname"];
	$fullName=$firstName.' '.$lastName;
	$email=$_SESSION["admin"]["email"];
	$token=$_SESSION["admin"]["token"];
}
?>