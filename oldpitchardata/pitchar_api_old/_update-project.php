<?php 
header('Content-Type: application/json');
include('../conn.php');
if(isset($_POST["update"])){
	$projectName=$_POST["project_name"];
	$projectId=$_POST["id"];
	$user_name=$_POST["username"];
          	function generateRandomString($length = 12) {
              	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                  $charactersLength = strlen($characters);
                  $randomString = '';
                  for ($i = 0; $i < $length; $i++) {
                      $randomString .= $characters[rand(0, $charactersLength - 1)];
                  }
                  return $randomString;
                }
            	$token=generateRandomString();
            $email=$_POST["email"];
        	$getEntr=$_POST["subject"];
        	$getBook=$_POST["book"];
        	$getMag=$_POST["magaz"];
        	$getEdu=$_POST["education"];
        	$calender=$_POST["calender"];
        	$getWeekStart=$_POST["start_date"];
        	$getWeekEnd=$_POST["end_date"];
        	$grade=$_POST["grade"];
        	$country=$_POST["country"];
        	$notes=$_POST["notes"];

	     //docs
           $doc= $_FILES["pdf"];
           $docname= $_FILES["pdf"]["name"];
           $doctempname= $_FILES["pdf"]["tmp_name"];
           $nameOfDoc=time().$docname;
           move_uploaded_file($doctempname, "../uploads/docs/".$nameOfDoc);
        //video
           $video= $_FILES["video"];
           $videoname= $_FILES["video"]["name"];
           $videotempname= $_FILES["video"]["tmp_name"];
           $updatevideo=rand().$videoname;
           move_uploaded_file($videotempname, "../uploads/video/".$updatevideo);


        //Obj,fbx
              $valid_formats = array("obj","fbx");  
              $name = $_FILES['modelobj']['name'];
              $size = $_FILES['modelobj']['size'];
              if(strlen($name)) {
                list($txt, $ext) = explode(".", $name);
                if(in_array($ext,$valid_formats)) {
                  if($size<(10240*10240)) {
                      $obj_name = time().".".$ext;
                    $tmp = $_FILES['modelobj']['tmp_name'];
                    move_uploaded_file($tmp, "../uploads/obj/".$obj_name);
            }
            }
            }

        //Mtl
            $valid_formatsmtl = array("mtl");  
              $namemtl = $_FILES['modelmtl']['name'];
              $sizemtl = $_FILES['modelmtl']['size'];
              if(strlen($namemtl)) {
                list($txt, $ext) = explode(".", $namemtl);
                if(in_array($ext,$valid_formatsmtl)) {
                  if($sizemtl<(10240*10240)) {
                      $mtl_name = time().".".$ext;
                    $tmp = $_FILES['modelmtl']['tmp_name'];
                    move_uploaded_file($tmp, "../uploads/mtl/".$mtl_name);
            }
            }
            }


            $errors = array();
            $uploadedFiles = array();
            $extension = array("jpeg","jpg","png");
            $bytes = 1024;
            $KB = 1024;
            $totalBytes = $bytes * $KB;
            $UploadFolder = "../uploads/imgs/";
             
            $counter = 0;
             
            foreach($_FILES["images"]["tmp_name"] as $key=>$tmp_name){
                $temp = $_FILES["images"]["tmp_name"][$key];
                $name = $_FILES["images"]["name"][$key];
                 
                if(empty($temp))
                {
                    break;
                }
                 
                $counter++;
                $UploadOk = true;
                 
                if($_FILES["images"]["size"][$key] > $totalBytes)
                {
                    $UploadOk = false;
                    array_push($errors, $name." file size is larger than the 1 MB.");
                }
                 
                $ext = pathinfo($name, PATHINFO_EXTENSION);
                if(in_array($ext, $extension) == false){
                    $UploadOk = false;
                    array_push($errors, $name." is invalid file type.");
                }
                 
                if(file_exists($UploadFolder."/".$name) == true){
                    $UploadOk = false;
                    array_push($errors, $name." file is already exist.");
                } 
                 $getname=rand(10,100000000).$name;
                if($UploadOk == true){
                    move_uploaded_file($temp,$UploadFolder."/".$getname);
                    array_push($uploadedFiles, $getname);
                }
            }
             
            if($counter>0){
                if(count($uploadedFiles)>0){
                  $i=0;
                    foreach($uploadedFiles as $fileName)
                    {
                         
                     $i++;
                    $queryImageupdate=mysqli_query($conn,"UPDATE tbl_project_image SET image='$fileName',token='$token',cnt='$i'") ;


                    }
                            
                   
                }                               
            }



            $queryUpdate=mysqli_query($conn,"UPDATE tbl_std_project SET project_name='$projectName',subject='$getEntr',book='$getBook',objfile='$obj_name',mtlfile='$mtl_name',video='$insertVideo',notes='$notes',docs='$docname',education='$getEdu',magaz='$getMag',grade='$grade' WHERE id='$projectId'");

            if ($queryUpdate) {
            // Update New education
              $UpdateEdu=mysqli_query($conn,"SELECT * FROM education WHERE name='$getEdu'");
              $countEdu=mysqli_num_rows($UpdateEdu);
              if ($countEdu==0 AND !empty($getEdu)) {
                mysqli_query($conn,"UPDATE education SET name='$getEdu',user_by='$user_name'");
              }
            // Update New book
              $UpdateBook=mysqli_query($conn,"SELECT * FROM books WHERE book='$getBook'");
              $countBook=mysqli_num_rows($UpdateBook);
              if($countBook==0 AND !empty($getBook)){
                mysqli_query($conn,"UPDATE books SET Book='$getBook'");
              }
              // Update New ENTR
              $UpdateEntr=mysqli_query($conn,"SELECT * FROM subject WHERE subject='$getEntr'");
              $countEntr=mysqli_num_rows($UpdateEntr);
              if ($countEntr==0 AND !empty($getEntr)) {
                mysqli_query($conn,"UPDATE subject SET subject='$getEntr'");
              }
              // Update New Magz
              $UpdateMag=mysqli_query($conn,"SELECT * FROM magazine WHERE name='$getMag'");
              $countMag=mysqli_num_rows($UpdateMag);
              if ($countMag==0 AND !empty($getMag)) {
                  mysqli_query($conn,"UPDATE magazine name='$getMag',update_by='$user_name'");
              }

              $getProject=mysqli_query($conn,"SELECT * FROM tbl_std_project WHERE token='$token'");
              $projectData=mysqli_fetch_assoc($getProject);
              $response['message']="Project Updated";
              $response['msg_code']=1;
              $response['data']=$projectData;

           } }
           else{
              $response['message']="Invalid Request";
              $response['msg_code']=00; 
}
              echo json_encode($response);
 ?>
