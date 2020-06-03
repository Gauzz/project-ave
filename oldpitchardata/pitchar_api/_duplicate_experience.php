<?php
header("Content-type:application/json");
include '../conn.php';

if (!empty($_REQUEST["submit"]) AND !empty($_REQUEST["id"]) AND !empty($_REQUEST["authtoken"]) AND !empty($_REQUEST["linkmarker"])) {
    $dupexp= array();
    $dupexp["Data"] = array();
    $id = $_REQUEST["id"];
    $token = $_REQUEST["authtoken"];

    if (!empty($_FILES["experience"])) {
    $valid_format = array("png","jpeg","jpg");
    $experience = $_FILES['experience']['name'];
    if(strlen($experience)) {
    list($txt, $ext) = explode(".", $experience);
    if(in_array($ext,$valid_format)) {
    $experienceName = time().".".$ext;
    $tmp = $_FILES['experience']['tmp_name'];
    move_uploaded_file($tmp, "../uploads/marker/".$experienceName);
    $getexperience = 'https://pitchar.io/uploads/marker/'.$experienceName;
                                     }
                            }
    }
    $thumbnail = (isset($_REQUEST["thumbnail"])) ? $_REQUEST["thumbnail"]:'';
    $projectName = (isset($_REQUEST["name"])) ? $_REQUEST["name"]:'';
    $tags = (isset($_REQUEST["tags"])) ? $_REQUEST["tags"]:'';    
    $description = (isset($_REQUEST["description"])) ? $_REQUEST["description"]:'';
    $linkmarker = (isset($_REQUEST["linkmarker"])) ? $_REQUEST["linkmarker"]:''; 
   
// Create Duplicate Experience
    $selectDupexp=mysqli_query($conn,"SELECT * FROM duplicate_experience WHERE id='$id'");
    
    if(mysqli_num_rows($selectDupexp) > 0){
        
       if(empty($experienceName)){
       $queryexp=mysqli_query($conn,"UPDATE duplicate_experience SET authtoken='$token',thumbnail='$thumbnail',name='$projectName',tags='$tags',description='$description',linkmarker='$linkmarker' WHERE id='$id'");

        $getExp=mysqli_query($conn,"SELECT * FROM duplicate_experience WHERE id='$id' ORDER BY id DESC");

        while($expData=mysqli_fetch_assoc($getExp)){

        array_push($dupexp["Data"],array(
        'message'=>"Experience Created/Uploaded",
        'experienceid'=>$expData["id"],
        'linkmarker'=>$expData["experience"],
        'msg_code'=> '1',)
        ); 

        }

        if (!empty($getExp)) {
            
            $response["Data"] = $dupexp;

        }
        else {

            $dupexp["message"] = "Invalid Request";
            $dupexp["msg_code"] = 0;

        }
       
       }
       if(!empty($experienceName)){
       $queryexp=mysqli_query($conn,"UPDATE duplicate_experience SET authtoken='$token',experience='$getexperience',thumbnail='$thumbnail',name='$projectName',tags='$tags',description='$description',linkmarker='$linkmarker' WHERE id='$id'");

        $getExp=mysqli_query($conn,"SELECT * FROM duplicate_experience WHERE id='$id' ORDER BY id DESC");

        while($expData=mysqli_fetch_assoc($getExp)){

        array_push($dupexp["Data"],array(
        'message'=>"Experience Created/Uploaded",
        'experienceid'=>$expData["id"],
        'linkmarker'=>$expData["experience"],
        'msg_code'=> '1',)
        ); 

        }

        if ($getExp) {
            
            $response["Data"] = $dupexp;

        }
        else {

            $dupexp["message"] = "Invalid Request";
            $dupexp["msg_code"] = 0;

        }
       
       }
       }
       else{
       $queryexp=mysqli_query($conn,"INSERT INTO duplicate_experience(authtoken,experience,thumbnail,name,tags,description,linkmarker)VALUES('$token','$getexperience','$thumbnail','$projectName','$tags','$description','$linkmarker')");

        $getExp=mysqli_query($conn,"SELECT * FROM duplicate_experience WHERE authtoken='$token' ORDER BY id DESC");

        while($expData=mysqli_fetch_assoc($getExp)){

        array_push($dupexp["Data"],array(
        'message'=>"Experience Created/Uploaded",
        'experienceid'=>$expData["id"],
        'linkmarker'=>$expData["experience"],
        'msg_code'=> '1',)
        ); 

        }

    if ($getExp) {
        
        $response["Data"] = $dupexp;

    }
    else {

        $dupexp["message"] = "Invalid Request";
        $dupexp["msg_code"] = 0;

    }
  }
}
else {

      $dupexp["message"] = "Invalid Request";
      $dupexp["msg_code"] = 0;

     }

echo json_encode($dupexp,JSON_PRETTY_PRINT);

?>