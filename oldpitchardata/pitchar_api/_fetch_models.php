<?php
header("Content-type:application/json");
include '../conn.php';

if (!empty($_REQUEST["submit"])) {
	$mod= array();
	$mod["Admin"] = array();
	$querymod=mysqli_query($conn,"SELECT * FROM post_models ORDER BY id DESC");
	
	while($fetchMod=mysqli_fetch_assoc($querymod))
	{
		
	array_push($mod["Admin"],array('id'=>$fetchMod["id"],'type'=>$fetchMod["type"],'content'=>$fetchMod["content"],'thumbnail'=>$fetchMod["thumbnail"],'project_name'=>$fetchMod["project_name"],'tags'=>$fetchMod["tags"],'description'=>$fetchMod["description"],'message'=>"Fetch Models Successfully",'msg_code'=> '1',)); /*'authtoken'=>$fetchMod["authtoken"],*/
	
	}
}
else{
    $mod["message"] = "Error encountered";
    $mod["msg_code"] = 0;
}
	
echo json_encode($mod,JSON_PRETTY_PRINT);

?>