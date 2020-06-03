<?php
header("Content-type:application/json");
include '../conn.php';

if (!empty($_REQUEST["submit"])) {
	$aud= array();
	$aud["Admin"] = array();
	$queryaud=mysqli_query($conn,"SELECT * FROM post_audio ORDER BY id DESC");
	
	while($fetchAud=mysqli_fetch_assoc($queryaud))
	{
		
	array_push($aud["Admin"],array('id'=>$fetchAud["id"],'type'=>$fetchAud["type"],'content'=>$fetchAud["content"],'thumbnail'=>$fetchAud["thumbnail"],'project_name'=>$fetchAud["project_name"],'tags'=>$fetchAud["tags"],'description'=>$fetchAud["description"],'message'=>"Fetch Audio Successfully",'msg_code'=> '1',)); /*'authtoken'=>$fetchAud["authtoken"],*/
	
	}
}
else{
    $aud["message"] = "Error encountered";
    $aud["msg_code"] = 0;
}
	
echo json_encode($aud,JSON_PRETTY_PRINT);

?>