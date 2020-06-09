<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include('../../includes/functions.php');

	if (isset($_REQUEST["authtoken"]) AND !empty($_REQUEST["authtoken"]) AND isset($_REQUEST["id"]) AND !empty($_REQUEST["id"])) {
		$token=$_REQUEST["authtoken"];
		$id=$_REQUEST["id"];
		$query = mysqli_query($conn,"DELETE FROM assets WHERE id='$id'");
		
		if ($query) {	
			$response['message']="Assets Deleted Success";
            $response['msg_code']=1; 
		}
		else{
			$response['message']="Something went Wrong! Error";
            $response['msg_code']=0; 
		}
	}
	echo json_encode(array('response' => $response ));
?>