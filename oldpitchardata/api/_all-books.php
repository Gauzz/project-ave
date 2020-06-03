<?php 
	header("Content-type:application/json");
$conn=mysqli_connect("localhost","pitchar_project","111444777aaa@@@","pitchar_project");

	if (isset($_POST)) {
	
	$books= array();	
 	$books["books"] = array();

		$query=mysqli_query($conn,"SELECT * FROM books"); 	
		while($data=mysqli_fetch_assoc($query))
		{
		array_push($books["books"],array('id'=>$data['id'],'book'=>$data['book'],'dates_time'=>$data['dates_time'],));
	 	}
		echo json_encode(($books),JSON_PRETTY_PRINT);
	
	}

?>