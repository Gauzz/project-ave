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
	$queryMedia=mysqli_query($conn,"SELECT * FROM media WHERE authtoken='".$data["token"]."'");
	$fetchMedia=mysqli_fetch_assoc($queryMedia);
	$queryAssets=mysqli_query($conn,"SELECT * FROM assets WHERE authtoken='".$data["token"]."'");
	$fetchAssets=mysqli_fetch_assoc($queryAssets);

	/*For Image*/
	$queryGetImage=mysqli_query($conn,"SELECT * FROM tbl_project_image WHERE token='".$getProject["token"]."'");
	$div = array();
	while($images=mysqli_fetch_assoc($queryGetImage)){
		$div='https://pitchar.io/uploads/imgs/'.$images["image"] ;
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
		$objPath='https://pitchar.io/uploads/obj/'.$getProject["objfile"];
	}
	else{
		$objPath=null;
	}
	/* For MTL file*/
	if (!empty($getProject["mtlfile"])) {
		$mtlPath='https://pitchar.io/uploads/mtl/'.$getProject["mtlfile"];
	}
	else{
		$mtlPath=null;
	}
	/*for Video*/
	if (!empty($getProject["video"])) {
		$videoPath='https://pitchar.io/uploads/video/'.$getProject["video"];
	}
	else{
		$videoPath=null;
	}
	/* For Docs*/
	if (!empty($getProject["docs"])) {
		$docPath='https://pitchar.io/uploads/docs/'.$getProject["docs"];
	}
	else{
		$docPath=null;
	}
	/* For Zip File*/
	if (!empty($getProject["zipfile"])) {
		$zipPath='https://pitchar.io/uploads/zip/'.$getProject["zipfile"];
	}
	else{
		$zipPath=null;
	}

	$arrayToPush=['id'=>$getProject['id'],'name'=>$getProject['name'],'token'=>$getProject['token'],'project_name'=>$getProject['project_name'],'email'=>$getProject['email'],'subject'=>$getProject['subject'],'book'=>$getProject['book'],'education'=>$getProject['education'],'magaz'=>$getProject['magaz'],'grade'=>$getProject['grade'],'image'=>["images" => $image.$allImage["image"]],'objfile'=>$obj.$getProject['objfile'],'mtlfile'=>$mtl.$getProject['mtlfile'],'video'=>$video.$getProject['video'],'notes'=>$getProject['notes'],'docs'=>$docs.$getProject['docs'],'calender'=>$getProject['calender'],'country'=>$getProject['country'],'fav'=>$getProject['fav'],'start_date'=>$getProject['start_date'],'end_date'=>$getProject['end_date'],'submit_time'=>$getProject['submit_time'],'type'=>$fetchMedia["type"],'video'=>$fetchMedia["video"],'thumbnail'=>$fetchMedia["thumbnail"],'audio'=>$fetchMedia["audio"],'extension'=>$fetchMedia["extension"],'Assetstype'=>$fetchAssets["type"],'objthumbnail'=>$fetchAssets["objthumbnail"],'obj'=>$fetchAssets["obj"],'mtl'=>$fetchAssets["mtl"],'fbx'=>$fetchAssets["fbx"],'Projectimage'=>$fetchAssets["image"]
	];

		array_push($share["share"],$arrayToPush);


	}
	
		echo json_encode(($share),JSON_PRETTY_PRINT);

}

 




?>