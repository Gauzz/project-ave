<?php
header("Content-type:application/json");
include '../conn.php';

if (!empty($_REQUEST["submit"] AND !empty($_REQUEST["id"]) AND !empty($_REQUEST["authtoken"]))) {
	$marker= array();
	$marker["Data"] = array();
	$id=$_REQUEST["id"];
	$token=$_REQUEST["authtoken"];
	$queryMarker=mysqli_query($conn,"SELECT * FROM post_marker WHERE id='$id' AND authtoken='$token' ORDER BY id DESC");
	while($fetchMarker=mysqli_fetch_assoc($queryMarker))
	{
		
	array_push($marker["Data"],array('id'=>$fetchMarker["id"],'linkmarker'=>$fetchMarker["marker"],'linkpatt'=>$fetchMarker["linkpatt"],'name'=>$fetchMarker["name"],'tags'=>$fetchMarker["tags"],'description'=>$fetchMarker["description"],'experienceid'=>$fetchMarker["experienceid"],'message'=>"Fetch Marker Successfully",'msg_code'=> '1',)); /*'authtoken'=>$fetchMarker["authtoken"],*/
	}
}
else{
    $marker["message"] = "Invalid Request";
    $marker["msg_code"] = 0;
}

echo json_encode($marker,JSON_PRETTY_PRINT);

?>