<?php
header("Content-type:application/json");
include '../conn.php';

if (!empty($_REQUEST["submit"]) AND !empty($_REQUEST["authtoken"]) AND !empty($_REQUEST["experienceid"])) {
	$exp= array();
	$exp["Data"] = array();
	$id=$_REQUEST["experienceid"];
	$token=$_REQUEST["authtoken"];
	$queryexp=mysqli_query($conn,"SELECT * FROM post_experience WHERE authtoken='$token' AND id='$id' ORDER BY id DESC");
	while($fetchExp=mysqli_fetch_assoc($queryexp))
	{
		
		array_push($exp["Data"],array(
		'message'=>"Sharing Link Generated",
		'sharinglink'=>$fetchExp["share_experience"],
		'msg_code'=> '1',)
		); 
	
	}

    if (!empty($queryexp)) {
              
        $response["Data"] = $exp;
    }
    else {

        $exp["message"] = "Invalid Request";
        $exp["msg_code"] = 0;

    }
}
else{
	    $exp["message"] = "Invalid Request";
	    $exp["msg_code"] = 0;
	}
	
echo json_encode($exp,JSON_PRETTY_PRINT);

?>