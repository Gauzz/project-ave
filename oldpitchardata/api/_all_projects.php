<?php
header("Content-type:application/json");
include '../conn.php';

if (isset($_REQUEST["submit"])) {
	$project= array();
	$project["project"] = array();
$query=mysqli_query($conn,"SELECT * FROM tbl_std_project ORDER BY id DESC");
while($data=mysqli_fetch_assoc($query))
{
	/*For Image*/
	$queryGetImage=mysqli_query($conn,"SELECT * FROM tbl_project_image WHERE token='".$data["token"]."'");
	$div = array();
	while($images=mysqli_fetch_assoc($queryGetImage)){
		$div[] = array('name' => 'https://arvrintedu.com/uploads/imgs/'.$images["image"] );
	}
if (!empty($allImage["image"])) {
	$image = 'https://arvrintedu.com/uploads/imgs/'.$allImage["image"];
}else{
$image =NULL;
}
if (!empty($data['mtlfile'])) {
	$mtl = 'https://arvrintedu.com/uploads/mtl/'.$data['mtlfile'];
}else{
$mtl=NULL;
}
if (!empty($data['objfile'])) {
	$obj = 'https://arvrintedu.com/uploads/obj/'.$data['objfile'];
}
else{
$obj=NULL;
}
if (!empty($data['video'])) {
	$video = 'https://arvrintedu.com/uploads/video/'.$data['video'];
}
else{
$video = NULL;
}
if (!empty($data['docs'])) {
	$docs = 'https://arvrintedu.com/uploads/docs/'.$data['docs'];
}
else{
$docs = NULL;
}
if (!empty($data['zipfile'])) {
	$zip = 'https://arvrintedu.com/uploads/zip/'.$data['zipfile'];
}
else{
$zip = NULL;
}
array_push($project["project"],array('id'=>$data['id'],'name'=>$data['name'],'token'=>$data['token'],'project_name'=>$data['project_name'],'email'=>$data['email'],'subject'=>$data['subject'],'book'=>$data['book'],'education'=>$data['education'],'magaz'=>$data['magaz'],'grade'=>$data['grade'],'image'=> $div,'objfile'=>$obj,'mtlfile'=>$mtl,'video'=>$video,'zipfile'=>$zip,'notes'=>$data['notes'],'docs'=>$docs,'calender'=>$data['calender'],'country'=>$data['country'],'fav'=>$data['fav'],'start_date'=>$data['start_date'],'end_date'=>$data['end_date'],'submit_time'=>$data['submit_time'],'language'=>$data['language'],));
}
	echo json_encode(($project),JSON_PRETTY_PRINT);

}
?>