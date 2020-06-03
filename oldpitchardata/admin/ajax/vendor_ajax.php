<?php
include('../conn.php');

if (isset($_POST["vendorEmail"])) {
	$vendorName=$_POST["vendorName"];
	$vendorDOB=$_POST["vendorDOB"];
	$vendorStatus=$_POST["vendorStatus"];
	$vendorGander=$_POST["vendorGander"];
	$vendorEmail=$_POST["vendorEmail"];
	$mobileNumber=$_POST["mobileNumber"];
	$vendorAddress=$_POST["vendorAddress"];
	$vendorBrief=$_POST["vendorBrief"];
	$token="VEN".tokenInt(6);
	$photo=$_FILES['fileup']['name'];
	$tmp_name=$_FILES['fileup']['tmp_name'];
	$photo_token=$token.$photo;
	move_uploaded_file($tmp_name,"../venderImage/".$photo_token);
	 $query=mysqli_query($conn,"SELECT * FROM add_vendor WHERE email='$vendorEmail'");
	 $data=mysqli_num_rows($query);
	 if ($data > 0) {
	 	 echo "0";
	 }
	 else
	 {
	 	$vendorquery=mysqli_query($conn,"INSERT INTO add_vendor(token,name,gander,date_of_birth,email,phone,address,brief,status,images,date)VALUES('$token','$vendorName','$vendorGander','$vendorDOB','$vendorEmail','$mobileNumber','$vendorAddress','$vendorBrief','$vendorStatus','$photo_token',NOW())");
	 	 if ($vendorquery) {
      			echo "1";
     	}
	 }

}


?>