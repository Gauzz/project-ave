<?php 

header('Content-Type: application/json');

include('../conn.php');



if (isset($_POST["submit"])) {

	$fName=mysqli_real_escape_string($conn,$_POST["first"]);

	$lName=mysqli_real_escape_string($conn,$_POST["last"]);

	$cont=mysqli_real_escape_string($conn,$_POST["country"]);

	//for API 

	$getEmail=$_POST["email"];



	$valid_formats = array("jpg", "png", "gif", "bmp","jpeg");  

		$name = $_FILES['images']['name'];

        $size = $_FILES['images']['size'];

           	if(strlen($name)) {

                list($txt, $ext) = explode(".", $name);

                if(in_array($ext,$valid_formats)) {

                if($size<(1024*1024)) {

                $image_name = time().".".$ext;

                $tmp = $_FILES['images']['tmp_name'];

                move_uploaded_file($tmp, "../uploads/user_profile_pic/".$image_name);

            	}}

            }  



        if (empty($image_name)) {

        	$updateProfile=mysqli_query($conn,"UPDATE tbl_users SET firstname='$fName',lastname='$lName',fullname='$fName $lName',country='$cont' WHERE email='$getEmail'");

        	if ($updateProfile) {

        		$response['message']="Profile Updated";

				$response['msg_code']=1; 

        	}

        	 else{

        		$response['message']="Error While Updating Profile";

				$response['msg_code']=0; 

        	} 

        }

          

        if (!empty($image_name)) {

        	$updateProfile=mysqli_query($conn,"UPDATE tbl_users SET firstname='$fName',lastname='$lName',fullname='$fName $lName',country='$cont',display_pic='$image_name' WHERE email='$getEmail'");

        	if ($updateProfile) {

        		$response['message']="Profile Updated";

				$response['msg_code']=1; 

        	}

        	else{

        		$response['message']="Error While Updating Profile";

				$response['msg_code']=0; 

        	}

        }

        echo json_encode(array(update =>[ $response]));

}





?>