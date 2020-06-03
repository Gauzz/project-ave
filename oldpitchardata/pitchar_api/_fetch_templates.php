<?php
header("Content-type:application/json");
include '../conn.php';

if (!empty($_REQUEST["submit"])) {
	$tmp= array();
	$tmp["Admin"] = array();
	$querytmp=mysqli_query($conn,"SELECT * FROM post_templates ORDER BY id DESC");
	
	while($fetchTmp=mysqli_fetch_assoc($querytmp))
	{
		
	array_push($tmp["Admin"],array('id'=>$fetchTmp["id"],'type'=>$fetchTmp["type"],'content'=>$fetchTmp["content"],'thumbnail'=>$fetchTmp["thumbnail"],'project_name'=>$fetchTmp["project_name"],'tags'=>$fetchTmp["tags"],'description'=>$fetchTmp["description"],'message'=>"Fetch Templates Successfully",'msg_code'=> '1',)); /*'authtoken'=>$fetchTmp["authtoken"],*/
	
	}
}
else{
    $tmp["message"] = "Error encountered";
    $tmp["msg_code"] = 0;
}
	
echo json_encode($tmp,JSON_PRETTY_PRINT);

?>