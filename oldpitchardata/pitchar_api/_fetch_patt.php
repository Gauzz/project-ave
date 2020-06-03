<?php
header("Content-type:application/json");
include '../conn.php';

if (!empty($_REQUEST["submit"] AND !empty($_REQUEST["marker_id"]) AND !empty($_REQUEST["authtoken"]))) {
	$marker= array();
	$marker["Data"] = array();
	$id=$_REQUEST["marker_id"];
	$token=$_REQUEST["authtoken"];
	$queryMarkerPatt=mysqli_query($conn,"SELECT * FROM post_marker WHERE id='$id' AND authtoken='$token' ORDER BY id DESC");
	while($fetchMarkerPatt=mysqli_fetch_assoc($queryMarkerPatt))
	{
		
	array_push($marker["Data"],array('id'=>$fetchMarkerPatt["id"],'linkpatt'=>$fetchMarkerPatt["linkpatt"],'name'=>$fetchMarkerPatt["name"],'tags'=>$fetchMarkerPatt["tags"],'description'=>$fetchMarkerPatt["description"],'experienceid'=>$fetchMarkerPatt["experienceid"],'message'=>"Fetch Marker Pattern Successfully",'msg_code'=> '1',)); /*'authtoken'=>$fetchMarkerPatt["authtoken"],*/
	}
}
else{
    $marker["message"] = "Invalid Request";
    $marker["msg_code"] = 0;
}

echo json_encode($marker,JSON_PRETTY_PRINT);

?>