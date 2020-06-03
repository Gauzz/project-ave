<?php
header("Content-type:application/json");
include '../conn.php';

if (!empty($_REQUEST["submit"]) AND !empty($_REQUEST["authtoken"])) {
	$text= array();
	$text["Data"] = array();
	$token=$_REQUEST["authtoken"];
	$queryText=mysqli_query($conn,"SELECT * FROM post_text WHERE authtoken='$token' ORDER BY id DESC");
	while($fetchText=mysqli_fetch_assoc($queryText))
	{
		
	array_push($text["Data"],array('id'=>$fetchText["id"],'authtoken'=>$fetchText["authtoken"],'type'=>$fetchText["type"],'text'=>$fetchText["textany"],'project_name'=>$fetchText["project_name"],'tags'=>$fetchText["tags"],'message'=>"Fetch Text Successfully",'msg_code'=> '1',));
	
	}
}
else{
    $text["message"] = "Invalid Request";
    $text["msg_code"] = 0;
}
	
echo json_encode($text,JSON_PRETTY_PRINT);

?>