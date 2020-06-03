<?php
header("Content-type:application/json");
include '../conn.php';

if (!empty($_REQUEST["submit"])) {
	$img= array();
	$img["Admin"] = array();
	$queryimg=mysqli_query($conn,"SELECT * FROM post_images ORDER BY id DESC");
	
	while($fetchImg=mysqli_fetch_assoc($queryimg))
	{
		
	array_push($img["Admin"],array('id'=>$fetchImg["id"],'type'=>$fetchImg["type"],'content'=>$fetchImg["content"],'thumbnail'=>$fetchImg["thumbnail"],'project_name'=>$fetchImg["project_name"],'tags'=>$fetchImg["tags"],'description'=>$fetchImg["description"],'message'=>"Fetch Images Successfully",'msg_code'=> '1',)); /*'authtoken'=>$fetchImg["authtoken"],*/
	
	}
}
else{
    $img["message"] = "Error encountered";
    $img["msg_code"] = 0;
}
	
echo json_encode($img,JSON_PRETTY_PRINT);

?>