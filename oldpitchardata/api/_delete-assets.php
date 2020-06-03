<?php
header('Content-Type: application/json');
include('../conn.php');
	if (isset($_REQUEST["authtoken"]) AND !empty($_REQUEST["authtoken"]) AND isset($_REQUEST["product_id"]) AND !empty($_REQUEST["product_id"])) {
		$token=$_REQUEST["authtoken"];
		$product_id=$_REQUEST["product_id"];
		$query = mysqli_query($conn,"DELETE FROM assets WHERE id='$product_id'");
		
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