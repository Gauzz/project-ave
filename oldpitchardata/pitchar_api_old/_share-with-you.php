<?php
header("Content-type:application/json");
include '../conn.php';
if (isset($_POST["email"])) 
{
	$getEmail = $_POST["email"];
	$share= array();	
 	$share["share"] = array();
	$query=mysqli_query($conn,"SELECT * FROM share_projects WHERE std_email='$getEmail' ORDER BY date_time DESC");
	while($data= mysqli_fetch_assoc($query)){
	$project=mysqli_query($conn,"SELECT * FROM tbl_std_project WHERE token='".$data['token']."'");
	$getProject=mysqli_fetch_assoc($project);

	/*For Image*/
	$queryGetImage=mysqli_query($conn,"SELECT * FROM tbl_project_image WHERE token='".$getProject["token"]."'");
	$div = array();
	while($images=mysqli_fetch_assoc($queryGetImage)){
		$div='https://arvrintedu.com/uploads/imgs/'.$images["image"] ;
	} 

	/* For Images*/
	if (empty($div)) {
	$imagePath=NULL;

	}
	else{
		$imagePath=$div;	
	}
	/* For OBJ File*/
	if (!empty($getProject["objfile"])) {
		$objPath='https://arvrintedu.com/uploads/obj/'.$getProject["objfile"];
	}
	else{
		$objPath=null;
	}
	/* For MTL file*/
	if (!empty($getProject["mtlfile"])) {
		$mtlPath='https://arvrintedu.com/uploads/mtl/'.$getProject["mtlfile"];
	}
	else{
		$mtlPath=null;
	}
	/*for Video*/
	if (!empty($getProject["video"])) {
		$videoPath='https://arvrintedu.com/uploads/video/'.$getProject["video"];
	}
	else{
		$videoPath=null;
	}
	/* For Docs*/
	if (!empty($getProject["docs"])) {
		$docPath='https://arvrintedu.com/uploads/docs/'.$getProject["docs"];
	}
	else{
		$docPath=null;
	}
	/* For Zip File*/
	if (!empty($getProject["zipfile"])) {
		$zipPath='https://arvrintedu.com/uploads/zip/'.$getProject["zipfile"];
	}
	else{
		$zipPath=null;
	}

	$arrayToPush=[
		"id" => $getProject["id"],
		"name" => $getProject["name"],
		"token" => $getProject["token"],
		"project_name"	=> $getProject["project_name"],
		"email"	=> $getProject["email"],
		"subject"	=> $getProject["subject"],
		"language"	=> $getProject["language"],
		"year"	=> $getProject["year"],
		"book"	=> $getProject["book"],
		"image" => $imagePath,
		"objfile"	=> $objPath,
		"mtlfile"	=> $mtlPath,
		"video"	=> $videoPath,
		"notes"	=> $getProject["notes"],
		"docs"	=> $docPath,
		"zipfile"	=> $zipPath,
		"country"	=> $getProject["country"],
		"fav"	=> $getProject["fav"],
		"submit_time"	=> $getProject["submit_time"],
		"calender"	=> $getProject["calender"],
		"start_date"	=> $getProject["start_date"],
		"end_date"	=> $getProject["end_date"],
		"education"	=> $getProject["education"],
		"magaz"	=> $getProject["magaz"],
		"grade"	=> $getProject["grade"]
	];

		array_push($share["share"],$arrayToPush);


	}
	





		echo json_encode(($share),JSON_PRETTY_PRINT);

}

 




?>