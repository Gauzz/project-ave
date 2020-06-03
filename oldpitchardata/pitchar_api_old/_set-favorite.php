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
		exit( "Project Already Set To favourites");
	}
	else{
	$querySetFav=mysqli_query($conn,"INSERT INTO favourite(email,uid,token,fav)VALUES('$email','$nameOfProject','$token','1')");

	if ($querySetFav=="1") {

		//	exit(json_encode(["response" => ["code" => 1 ,"msg" => "Project Set To favourites"]]));
			echo "success";
	}

	else{

	//	exit(json_encode(["response" => ["code" => 0 ,"msg" => "Something Went Wrong While Setting Project To favourites!"]]));
		 echo "fail";

		}
	}

}



if (isset($_POST["unset"])) {

	$token=$_POST["token"];

	$email=$_POST["email"];

	$queryUnSetFav=mysqli_query($conn,"DELETE FROM favourite WHERE email='$email' AND token='$token'");

	if ($queryUnSetFav=="1") {

		//	exit(json_encode(["response" => ["code" => 1 ,"msg" => "Project Removed From favourites"]]));
		echo "sucess";
			 

	}

	else{
        echo "fail";
		//	exit(json_encode(["response" => ["code" => 0 ,"msg" => "Something Went Wrong While Removing Project To favourites!"]]));
	}

}

//	echo json_encode($response);



?>