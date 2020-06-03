<?php

header("Content-type:application/json");

include '../conn.php';



if (isset($_POST["set"])) {

	$token=$_POST["token"];

	$queryGetToken=mysqli_query($conn,"SELECT * FROM tbl_std_project WHERE token='$token'");

	$fetchName=mysqli_fetch_array($queryGetToken);

	$nameOfProject=$fetchName["project_name"];

	$email=$_POST["email"];
	$queryGetFav=mysqli_query($conn,"SELECT * FROM favourite WHERE email='$email' AND token='$token'");
	if (mysqli_num_rows($queryGetFav) > 0) {
		$response['message']="Project Already Set to favourite";
        $response['msg_code']=0; 
	}
	else{
	$querySetFav=mysqli_query($conn,"INSERT INTO favourite(email,uid,token,fav)VALUES('$email','$nameOfProject','$token','1')");

	if ($querySetFav=="1") {

			$response['message']="favourite set Success";
            $response['msg_code']=1; 
	}

	else{

		$response['message']="error in setting favourite";
        $response['msg_code']=0; 

		}
		
	}
	echo(json_encode($response,JSON_PRETTY_PRINT));
}



if (isset($_POST["unset"])) {

	$token=$_POST["token"];

	$email=$_POST["email"];

	$queryUnSetFav=mysqli_query($conn,"DELETE FROM favourite WHERE email='$email' AND token='$token'");

	if ($queryUnSetFav=="1") {

		$response['message']="Project Removed From favourites";
        $response['msg_code']=1; 
			 

	}

	else{

		$response['message']="Something Went Wrong While Removing Project To favourites!";
        $response['msg_code']=0;
	}
	echo(json_encode($response,JSON_PRETTY_PRINT));


}


?>