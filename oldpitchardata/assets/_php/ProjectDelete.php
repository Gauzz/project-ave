<?php 
include '../../conn.php';

if (isset($_POST["done"])) {
	$pid=$_POST["pid"];
	$email=$_POST["email"];
	$token=$_POST["token"];
	$id=substr($pid,3);
	mysqli_query($conn,"DELETE FROM tbl_std_project WHERE id='$id'");

	mysqli_query($conn,"DELETE FROM favourite WHERE email='$email' AND token='$token'");
	$deleteFormshared=mysqli_query($conn,"DELETE FROM share_projects WHERE token='$token'");
	mysqli_query($conn,"DELETE FROM assets WHERE authtoken='$token'");
	mysqli_query($conn,"DELETE FROM media WHERE authtoken='$token'");
}
 ?>