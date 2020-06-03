<?php 
	header("Content-type:application/json");
	include '../conn.php';
 	$education["education"] = array();
	if (isset($_POST)) {
		$query=mysqli_query($conn,"SELECT * FROM education"); 	
		while($data=mysqli_fetch_assoc($query)){
			array_push($education["education"],array('id' => $data["id"],'Name' => $data["name"]));
		}
		echo json_encode($education,JSON_PRETTY_PRINT);
	}

?>