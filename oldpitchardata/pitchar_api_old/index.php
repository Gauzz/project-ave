<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header("Content-type:application/json");
$user = array();
include '../conn.php';
	if (isset($_GET["user"])) {
		$id=$_GET["user"];

 	$user["user"] = array();
	$query=mysqli_query($conn,"SELECT * FROM tbl_users ");
	while($data=mysqli_fetch_assoc($query))
	{
			array_push($user["user"],array('id'=>$data['id'],'fullname'=>$data['fullname'],'email'=>$data['email'],'display_pic'=>'https://pitchar.io/'.$data['display_pic'],'reg_time'=>$data['reg_time'],
'password'=>$data['password'],));

	}


	echo json_encode($user,JSON_PRETTY_PRINT);
	}


?>