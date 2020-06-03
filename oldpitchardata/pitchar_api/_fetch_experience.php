<?php
header("Content-Type:application/json");
include '../conn.php';

if (!empty($_REQUEST["submit"]) AND !empty($_REQUEST["experienceid"]) AND !empty($_REQUEST["authtoken"])) {
	$exp= array();
	$exp["Data"] = array();
	$id=$_REQUEST["experienceid"];
/* AND !empty($_REQUEST["experience"])	$experience=$_REQUEST["experience"]; 'experience'=>$fetchExp["experience"],*/
	$token=$_REQUEST["authtoken"];
	$queryexp=mysqli_query($conn,"SELECT * FROM post_experience WHERE id='$id' AND authtoken='$token' ORDER BY id DESC");
	while($fetchExp=mysqli_fetch_assoc($queryexp))
	{
		
	array_push($exp["Data"],array('experienceid'=>$fetchExp["id"],'experience'=>$fetchExp["experience"],'share_experience'=>$fetchExp["share_experience"],'thumbnail'=>$fetchExp["thumbnail"],'project_name'=>$fetchExp["name"],'tags'=>$fetchExp["tags"],'description'=>$fetchExp["description"],'authtoken'=>$fetchExp["authtoken"],'message'=>"Fetch Experience Successfully",'msg_code'=> '1',)); /*'authtoken'=>$fetchExp["authtoken"],*/
	
	}
}
else{
    $exp["message"] = "Invalid Request";
    $exp["msg_code"] = 0;
}
	
echo json_encode($exp,JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);

?>