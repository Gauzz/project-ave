<?php 

	include '../../conn.php';
	if (isset($_POST["done"])) {
 		$token=$_POST["pid"];
 		$uid=$_POST["uid"];
 		$name=$_POST["name"];
 		$favCounts=mysqli_query($conn,"SELECT * FROM favourite WHERE email='$uid' AND token='$token'");
 		$getFavCount=mysqli_num_rows($favCounts);
 		if ($getFavCount=='0') {
 			mysqli_query($conn,"INSERT INTO favourite(email,token,fav,uid)VALUES('$uid','$token','1','$name') ");		 
 		}
 		if ($getFavCount=='1') {
 			mysqli_query($conn,"DELETE FROM favourite WHERE email='$uid' AND token='$token'");	 			
 		}
	}

	
	
 ?>