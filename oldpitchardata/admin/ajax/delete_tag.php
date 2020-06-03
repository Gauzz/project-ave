<?php 

include '../conn.php';
if (isset($_POST["id"])) {
	$id=$_POST["id"];
	$query=mysqli_query($conn,"DELETE FROM product_tag WHERE id='$id'");
	if ($query) {
		echo "1";
	}
	else{
		echo "0";
	}
}


?>