<?php 

include '../conn.php';
if (isset($_POST["id"])) {
	$id=$_POST["id"];
	$deleteVariant=mysqli_query($conn," SELECT * FROM productInfo WHERE productToken='$token' ");
	while($row=mysqli_fetch_array())
	$query=mysqli_query($conn,"DELETE FROM products WHERE token='$id'");
	
}


?>