<?php
header("Content-type:application/json");
include '../conn.php';
/*https://pitchar.io/api/_view-global.php?email=moiz.makerites@gmail.com*/
if (isset($_REQUEST["submit"])) {
	$email=$_REQUEST["email"];
	$project= array();
	$project["project"] = array();
$query=mysqli_query($conn,"SELECT * FROM tbl_std_project WHERE email='$email' ORDER BY id DESC");
while($data=mysqli_fetch_assoc($query))
{
	$forImage=mysqli_query($conn,"SELECT * FROM tbl_project_image WHERE token='".$data["token"]."'");
	$allImage=mysqli_fetch_assoc($forImage);

	
if (!empty($allImage["image"])) {
	$image = 'https://arvrintedu.com/uploads/imgs/';
}
if (!empty($data['mtlfile'])) {
	$mtl = 'https://arvrintedu.com/uploads/mtl/';
}
if (!empty($data['objfile'])) {
	$obj = 'https://arvrintedu.com/uploads/obj/';
}
if (!empty($data['video'])) {
	$video = 'https://arvrintedu.com/uploads/video/';
}
if (!empty($data['docs'])) {
	$docs = 'https://arvrintedu.com/uploads/docs/';
}
array_push($project["project"],array('id'=>$data['id'],'name'=>$data['name'],'token'=>$data['token'],'project_name'=>$data['project_name'],'email'=>$data['email'],'subject'=>$data['subject'],'book'=>$data['book'],'education'=>$data['education'],'magaz'=>$data['magaz'],'grade'=>$data['grade'],'image'=>["images" => $image.$allImage["image"]],'objfile'=>$obj.$data['objfile'],'mtlfile'=>$mtl.$data['mtlfile'],'video'=>$video.$data['video'],'notes'=>$data['notes'],'docs'=>$docs.$data['docs'],'calender'=>$data['calender'],'country'=>$data['country'],'fav'=>$data['fav'],'start_date'=>$data['start_date'],'end_date'=>$data['end_date'],'submit_time'=>$data['submit_time'],));
}
	echo json_encode(($project),JSON_PRETTY_PRINT);

}
?>