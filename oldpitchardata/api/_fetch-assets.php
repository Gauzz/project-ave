<?php
header("Content-type:application/json");
include '../conn.php';

if (isset($_REQUEST["submit"])) {
	$project= array();
	$project["assets"] = array();
	$token = $_REQUEST["authtoken"];
$queryAssets=mysqli_query($conn,"SELECT * FROM assets WHERE authtoken='$token' ORDER BY id DESC");
while($fetchAssets=mysqli_fetch_assoc($queryAssets))
{
	
array_push($project["assets"],array('id'=>$fetchAssets["id"],'authtoken'=>$fetchAssets["authtoken"],'Assetstype'=>$fetchAssets["type"],'objthumbnail'=>$fetchAssets["objthumbnail"],'obj'=>$fetchAssets["obj"],'mtl'=>$fetchAssets["mtl"],'gltf'=>$fetchAssets["gltf"],'fbx'=>$fetchAssets["fbx"],'Projectimage'=>$fetchAssets["image"],'Projectname'=>$fetchAssets["name"],'tags'=>$fetchAssets["tags"],));
}
	echo json_encode(($project),JSON_PRETTY_PRINT);

}
?>