<?php
header("Content-type:application/json");
include '../conn.php';
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

if (isset($_REQUEST["submit"])) {
	$project= array();
	$project["assets"] = array();
	$token = $_REQUEST["authtoken"];
	$tags = $_REQUEST["tags"];
$queryAssets=mysqli_query($conn,"SELECT * FROM assets WHERE authtoken='$token' AND tags LIKE '%$tags%' OR type LIKE '%$tags%' OR name LIKE '%$tags%' ORDER BY id DESC");
$rowCount = mysqli_num_rows($queryAssets);
if($rowCount > 0){

		while($fetchAssets=mysqli_fetch_assoc($queryAssets))
	{
		
	array_push($project["assets"],array('id'=>$fetchAssets["id"],'authtoken'=>$fetchAssets["authtoken"],'Assetstype'=>$fetchAssets["type"],'objthumbnail'=>$fetchAssets["objthumbnail"],'obj'=>$fetchAssets["obj"],'mtl'=>$fetchAssets["mtl"],'fbx'=>$fetchAssets["fbx"],'Projectimage'=>$fetchAssets["image"],'Projectname'=>$fetchAssets["name"],'tags'=>$fetchAssets["tags"],));
	}
	echo json_encode(($project),JSON_PRETTY_PRINT);

}else{
	echo json_encode(("No Assets Available!"),JSON_PRETTY_PRINT);
}

	

}
?>