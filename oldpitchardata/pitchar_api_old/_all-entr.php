<?php 
	header("Content-type:application/json");
	include '../conn.php';
 	$entr["Entr"] = array();
	if (isset($_POST)) {
		$query=mysqli_query($conn,"SELECT * FROM subject"); 	
		while($data=mysqli_fetch_assoc($query)){
			array_push($entr["Entr"],array('id' => $data["id"],'Entr' => $data["subject"]));
		}
		echo json_encode($entr,JSON_PRETTY_PRINT);
	}

?>