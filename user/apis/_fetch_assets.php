<?php
header("Content-type:application/json");
header('Access-Control-Allow-Origin: *');
include('../../includes/functions.php');

if (!empty($_REQUEST["submit"]) AND !empty($_REQUEST["authtoken"])) {
	$project= array();
	$project["assets"] = array();
	$token = $_REQUEST["authtoken"];
$queryAssets=mysqli_query($conn,"SELECT * FROM assets WHERE authtoken='$token' ORDER BY id DESC");
while($fetchAssets=mysqli_fetch_assoc($queryAssets))
{
	
array_push($project["assets"],array('id'=>$fetchAssets["id"],'authtoken'=>$fetchAssets["authtoken"],'Assetstype'=>$fetchAssets["type"],'objthumbnail'=>$fetchAssets["objthumbnail"],'obj'=>$fetchAssets["obj"],'mtl'=>$fetchAssets["mtl"],'gltf'=>$fetchAssets["gltf"],'fbx'=>$fetchAssets["fbx"],'Projectimage'=>$fetchAssets["image"],'Projectname'=>$fetchAssets["name"],'tags'=>$fetchAssets["tags"],));
}
	
}
else{
	$project["message"] = "Invalid Request";
    $project["msg_code"] = 0;
}
echo json_encode(($project),JSON_PRETTY_PRINT);

?>