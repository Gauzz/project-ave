<?php
header("Content-type:application/json");
header('Access-Control-Allow-Origin: *');
include('../../includes/functions.php');

echo json_encode($_REQUEST);
if (!empty($_REQUEST["submit"]) AND !empty($_REQUEST["authtoken"])) {
	$project= array();
	$project["media"] = array();
	$token=$_REQUEST["authtoken"];
	$queryMedia=mysqli_query($conn,"SELECT * FROM media WHERE authtoken='$token' ORDER BY id DESC");
	while($fetchMedia=mysqli_fetch_assoc($queryMedia))
	{
		
	array_push($project["media"],array('id'=>$fetchMedia["id"],'authtoken'=>$fetchMedia["authtoken"],'type'=>$fetchMedia["type"],'video'=>$fetchMedia["video"],'thumbnail'=>$fetchMedia["thumbnail"],'audio'=>$fetchMedia["audio"],'extension'=>$fetchMedia["extension"],'project_name'=>$fetchMedia["name"],'tags'=>$fetchMedia["tags"],));
	}
}
else{
	$project["message"] = "Invalid Request";
    $project["msg_code"] = 0;
}

echo json_encode(($project),JSON_PRETTY_PRINT);
?>