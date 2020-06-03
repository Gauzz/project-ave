<?php 



include('../conn.php');


	
    $social= $_GET['social'];
	$firstname=$_GET['firstname'];

	$lastname=$_GET['lastname'];

$fname=$firstname." ".$lastname;

	$occupation=$_GET['occupation'];

	$email=$_GET['email'];

    
	$country=$_GET['country'];





        $query=mysqli_query($conn,"INSERT INTO tbl_users(verify,firstname,lastname,fullname,occupation,email,country,user_type)VALUES('0','$firstname','$lastname',' $fname','$occupation','$email','$country','$social')");

//$query=mysqli_query($conn,"INSERT INTO tbl_users(verify,firstname,lastname,fullname,occupation,email,country,user_type)VALUES('0','sri','ram',' sriram','busines','sram905@gmail.com','india','social')");

        if ($query) {

       echo "sucess";

        }




	else{

		 echo "Invalid Request.";

		

	}







/*-------------------------------------------Register End Here--------------------------------------------------------*/

 

 ?>