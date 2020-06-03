<?php
header("Content-type:application/json");
include '../conn.php';

if (!empty($_REQUEST["submit"] AND !empty($_REQUEST["authtoken"]))) {
	$marker= array();
	$marker["Data"] = array();
	$token=$_REQUEST["authtoken"];
	$queryMarker=mysqli_query($conn,"SELECT * FROM post_marker WHERE authtoken='$token' ORDER BY id DESC");
	while($fetchMarker=mysqli_fetch_assoc($queryMarker))
	{
		
	array_push($marker["Data"],array('id'=>$fetchMarker["id"],'authtoken'=>$fetchMarker["authtoken"],'linkmarker'=>$fetchMarker["marker"],'name'=>$fetchMarker["name"],'tags'=>$fetchMarker["tags"],'description'=>$fetchMarker["description"],'experienceid'=>$fetchMarker["experienceid"],'message'=>"Fetch Markers Successfully",'msg_code'=> '1',));
	}
}
else{
    $marker["message"] = "Invalid Request";
    $marker["msg_code"] = 0;
}

echo json_encode($marker,JSON_PRETTY_PRINT);

?>