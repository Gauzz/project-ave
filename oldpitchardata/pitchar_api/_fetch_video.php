<?php
header("Content-type:application/json");
include '../conn.php';

if (!empty($_REQUEST["submit"])) {
	$vid= array();
	$vid["Admin"] = array();
	$queryvid=mysqli_query($conn,"SELECT * FROM post_video ORDER BY id DESC");
	
	while($fetchVid=mysqli_fetch_assoc($queryvid))
	{
		
	array_push($vid["Admin"],array('id'=>$fetchVid["id"],'type'=>$fetchVid["type"],'content'=>$fetchVid["content"],'thumbnail'=>$fetchVid["thumbnail"],'project_name'=>$fetchVid["project_name"],'tags'=>$fetchVid["tags"],'description'=>$fetchVid["description"],'message'=>"Fetch Video Successfully",'msg_code'=> '1',)); /*'authtoken'=>$fetchVid["authtoken"],*/
	
	}
}
else{
    $vid["message"] = "Error encountered";
    $vid["msg_code"] = 0;
}
	
echo json_encode($vid,JSON_PRETTY_PRINT);

?>