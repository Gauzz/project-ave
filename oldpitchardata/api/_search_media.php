<?php
header("Content-type:application/json");
include '../conn.php';
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

if (isset($_REQUEST["submit"])) {
	$project= array();
	$project["media"] = array();
	$token = $_REQUEST["authtoken"];
	$tags = $_REQUEST["tags"];
$queryMedia=mysqli_query($conn,"SELECT * FROM media WHERE authtoken='$token' AND tags LIKE '%$tags%' OR type LIKE '%$tags%' OR name LIKE '%$tags%' ORDER BY id DESC");
$rowCount = mysqli_num_rows($queryMedia);
if($rowCount > 0){

		while($fetchMedia=mysqli_fetch_assoc($queryMedia))
	{
		
	array_push($project["media"],array('id'=>$fetchMedia["id"],'authtoken'=>$fetchMedia["authtoken"],'type'=>$fetchMedia["type"],'video'=>$fetchMedia["video"],'thumbnail'=>$fetchMedia["thumbnail"],'audio'=>$fetchMedia["audio"],'extension'=>$fetchMedia["extension"],'project_name'=>$fetchMedia["name"],'tags'=>$fetchMedia["tags"],));
	}
	echo json_encode(($project),JSON_PRETTY_PRINT);

}else{
	echo json_encode(("No Media Available!"),JSON_PRETTY_PRINT);
}

	

}
?>