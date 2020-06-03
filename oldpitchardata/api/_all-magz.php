<?php 
	header("Content-type:application/json");
	include '../conn.php';
	if (isset($_POST)) {
	$magaz= array();	
 	$magaz["magaz"] = array();

		$query=mysqli_query($conn,"SELECT * FROM magazine"); 	
		while($data=mysqli_fetch_assoc($query))
		{
		array_push($magaz["magaz"],array('id'=>$data['id'],'name'=>$data['name'],'date_time'=>$data['date_time'],'insert_by'=>$data['insert_by'],));
	 	}
		echo json_encode(($magaz),JSON_PRETTY_PRINT);
	 
	}

?>