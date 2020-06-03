<?php
header('Content-Type: application/json');
include('../conn.php');
	if (isset($_POST["token"])) {
		$token=$_POST["token"];
		$email=$_POST["email"];
		$query=mysqli_query($conn,"DELETE FROM tbl_std_project WHERE token='$token' AND email='$email'");
		if ($query) {	
			$deleteFormFav=mysqli_query($conn,"DELETE FROM favourite WHERE token='$token' AND email='$email'");
			$deleteFormshared=mysqli_query($conn,"DELETE FROM share_projects WHERE token='$token'");
			if ($deleteFormFav) {
				$response['message']="Project Deleted Success";
            $response['msg_code']=1; 
			}
					else{
			$response['message']="Something went Wrong! Error";
            $response['msg_code']=0; 
		}
			
		}
		else{
			$response['message']="Something went Wrong! Error";
            $response['msg_code']=0; 
		}
	}
	echo json_encode(array('response' => $response ));
?>