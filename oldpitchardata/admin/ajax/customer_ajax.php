<?php
include('../conn.php');

if (isset($_POST["customerEmail"])) {
	$customerName=$_POST["customerName"];
	$customerLast=$_POST["customerLast"];
	$customerPassword=$_POST["customerPassword"];
	$customerDOB=$_POST["customerDOB"];
	$customerStatus=$_POST["customerStatus"];
	$customerGander=$_POST["customerGander"];
	$customerEmail=$_POST["customerEmail"];
	$mobileNumber=$_POST["mobileNumber"];
	$customerAddress=$_POST["customerAddress"];
	$token=rand(11111,99999);
	$photo=$_FILES['fileup']['name'];
	$tmp_name=$_FILES['fileup']['tmp_name'];
	$photo_token=$token.$photo;
	move_uploaded_file($tmp_name,"../uploads/".$photo_token);
	 $query=mysqli_query($conn,"SELECT * FROM customers WHERE email='$customerEmail'");
	 $data=mysqli_num_rows($query);
	 if ($data > 0) {
	 	 echo "0";
	 }
	 else
	 {
	 	$customerquery=mysqli_query($conn,"INSERT INTO customers(firstname,lastname,password,dateofbirth,gender,email,mobile,address,status,token,photo,created_at)VALUES('$customerName','$customerLast','$customerPassword','$customerDOB','$customerGander','$customerEmail','$mobileNumber','$customerAddress','$customerStatus','$token','$photo_token',NOW())");
	 	 if ($customerquery) {
      			echo "1";
     	}
	 }

}


?>