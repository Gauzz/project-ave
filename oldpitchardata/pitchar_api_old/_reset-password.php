<?php 

	header("Content-type:application/json");

	include '../conn.php';



	if (isset($_POST['submit'])) {

		$email = mysqli_real_escape_string($conn,$_POST['email']);

		$token = mysqli_real_escape_string($conn,$_POST['token']);

		$pass = mysqli_real_escape_string($conn,$_POST['password']);

		$cpass = mysqli_real_escape_string($conn,$_POST['cpassword']);



		$query=mysqli_query($conn,"SELECT id FROM tbl_users WHERE

			email='$email' AND token='$token' AND token<>'' AND tokenExpire > NOW()");



		if (mysqli_num_rows($query) > 0) {

			if ($pass==$cpass) {

				$newPasswordEncrypted = password_hash($pass, PASSWORD_BCRYPT);

				$queryForUpdate=mysqli_query($conn,"UPDATE tbl_users SET token='', password = '$newPasswordEncrypted',user_type= 'manual' WHERE email='$email'");

				if ($queryForUpdate) {

				//	$response["msg"]="Password Update Success";

				//	$response["code"]=1;
				
				echo "success";

				}

				else{

				//	$response["msg"]="Password Not Updated QueryERROR";

				//	$response["code"]=5;
				echo "Password Not Updated QueryERROR";

				}

			}

			else{

				//$response["msg"]="Password & Confirm Password Not Matched";

			//	$response["code"]=2;
			echo "Password & Confirm Password Not Matched";

			}	 

		}

		else{

		//	$response["msg"]="Invalid OTP OR token Expire";

		//	$response['code']=0;
		echo "Invalid OTP OR token Expire";

		}





}

//	echo json_encode(array('response' => $response ));

?>