<?php
header('Content-Type: application/json');
include ('../conn.php');

if (!empty($_REQUEST["submit"]) AND !empty($_REQUEST["id"]) AND !empty($_REQUEST["authtoken"])) {
    $id = $_REQUEST["id"];
    $token = $_REQUEST["authtoken"];
    $projectName = (isset($_REQUEST["name"])) ? $_REQUEST["name"]:'';
    $tags = (isset($_REQUEST["tags"])) ? $_REQUEST["tags"]:'';    
    /*$description = (isset(mysqli_real_escape_string($conn,$_REQUEST["description"]))) ? mysqli_real_escape_string($conn,$_REQUEST["description"]):'';*/
    $description = mysqli_real_escape_string($conn,$_REQUEST["description"]);
    
    if(!empty($_FILES["thumbnail"])){
    $valid_formats = array("png","jpeg","jpg");
    $thumbnail = $_FILES['thumbnail']['name'];
    $photoSize = $_FILES['thumbnail']['size'];
    if(strlen($thumbnail)) {
    list($txt, $ext) = explode(".", $thumbnail);
    if(in_array($ext,$valid_formats)) {
    if($photoSize<(10240*10240)) {
    $thumbnailName = time().".".$ext;
    $tmp = $_FILES['thumbnail']['tmp_name'];
    move_uploaded_file($tmp, "../uploads/expThumbnail/".$thumbnailName);
    $getthumbnail = 'https://pitchar.io/uploads/expThumbnail/'.$thumbnailName;
                                 }
                                      }
                            }
    }else{
    $queryexp=mysqli_query($conn,"SELECT * FROM post_experience WHERE id='$id'");
    $fetchExp=mysqli_fetch_assoc($queryexp);
    if(!empty($fetchExp["thumbnail"])){$getThumb=$fetchExp["thumbnail"];}else{$getThumb=$getthumbnail;}
    $getthumbnail =$fetchExp["thumbnail"] ;
    }

    $experience = mysqli_real_escape_string($conn,$_REQUEST["experience"]);
    $experiencetmp=stripslashes($experience);
   
    $checkExp=mysqli_query($conn,"SELECT * FROM post_experience WHERE authtoken='$token' AND id='$id'");
    if(mysqli_num_rows($checkExp)>0){
    
    // Edit Post Experience
    if (!empty($experience)) { 
    $queryexp=mysqli_query($conn,"SELECT * FROM post_experience WHERE id='$id'");
    $fetchExp=mysqli_fetch_assoc($queryexp);
    /*if(!empty($fetchExp["thumbnail"])){$getThumb=$fetchExp["thumbnail"];}else{$getThumb=$getthumbnail;}*/
    $currentTime = $fetchExp["share_experience"];   
    $file_pointer = explode("https://pitchar.io/uploads/experience/",$currentTime); 
    $getFileExp = $file_pointer[1];  

    // Open the file to put new content in it
    // $open = file_put_contents("https://pitchar.io/uploads/experience/".$getFileExp); 
    
    // Open the file to get existing content 
    /*$open = file_get_contents("https://pitchar.io/uploads/experience/".$getFileExp); */
      
    // Append a new person to the file 
    /*$open .= $experiencetmp;*/ 
      
    // Write the contents back to the file @file_put_contents($file_pointer, $open); 
    $putLinkEdit = 'https://pitchar.io/uploads/experience/'.$getFileExp;
    file_put_contents('../uploads/experience/'.$getFileExp,$experiencetmp);
        
       $queryexp=mysqli_query($conn,"UPDATE post_experience SET experience='$experience' WHERE id='$id'");
       $queryexp.=mysqli_query($conn,"UPDATE post_experience SET thumbnail='$getthumbnail' WHERE id='$id'");
       $queryexp.=mysqli_query($conn,"UPDATE post_experience SET name='$projectName' WHERE id='$id'");
       $queryexp.=mysqli_query($conn,"UPDATE post_experience SET tags='$tags' WHERE id='$id'");
       $queryexp.=mysqli_query($conn,"UPDATE post_experience SET description='$description' WHERE id='$id'");
        
        $getExp = mysqli_query($conn, "SELECT * FROM post_experience WHERE id='$id' ORDER BY id DESC");
        $expData = mysqli_fetch_assoc($getExp);
        if(!empty($queryexp)){
        $response["message"] = "Experience Updated/Uploaded";
        $response["msg_code"] = 1;
        $response["Data"] = $expData;
        }
        else {
            $response["message"] = "Invalid Request";
            $response["msg_code"] = 0;
        }
    }
    elseif (!empty($thumbnailName)) {   
       $queryexp=mysqli_query($conn,"UPDATE post_experience SET thumbnail='$getthumbnail' WHERE id='$id'");
        
        $getExp = mysqli_query($conn, "SELECT * FROM post_experience WHERE id='$id' ORDER BY id DESC");
        $expData = mysqli_fetch_assoc($getExp);
        if(!empty($queryexp)){
        $response["message"] = "Experience Updated/Uploaded";
        $response["msg_code"] = 1;
        $response["Data"] = $expData;
        }
        else {
            $response["message"] = "Invalid Request";
            $response["msg_code"] = 0;
        }
        
    }
    else{ 
    $queryexp=mysqli_query($conn,"SELECT * FROM post_experience WHERE id='$id'");
    $fetchExp=mysqli_fetch_assoc($queryexp);
    $currentTime = $fetchExp["share_experience"];   
    $file_pointer = explode("https://pitchar.io/uploads/experience/",$currentTime); 
    $getFileExp = $file_pointer[1];  

    // Open the file to put new content in it
    // $open = file_put_contents("https://pitchar.io/uploads/experience/".$getFileExp); 
    
    // Open the file to get existing content 
    /*$open = file_get_contents("https://pitchar.io/uploads/experience/".$getFileExp); */
      
    // Append a new person to the file 
    /*$open .= $experiencetmp;*/ 
      
    // Write the contents back to the file @file_put_contents($file_pointer, $open); 
    $putLinkEdit = 'https://pitchar.io/uploads/experience/'.$getFileExp;
    file_put_contents('../uploads/experience/'.$getFileExp,$experiencetmp);
    
       $queryexp=mysqli_query($conn,"UPDATE post_experience SET experience='$experience' WHERE id='$id'");
       $queryexp.=mysqli_query($conn,"UPDATE post_experience SET thumbnail='$getthumbnail' WHERE id='$id'");
       $queryexp.=mysqli_query($conn,"UPDATE post_experience SET name='$projectName' WHERE id='$id'");
       $queryexp.=mysqli_query($conn,"UPDATE post_experience SET tags='$tags' WHERE id='$id'");
       $queryexp.=mysqli_query($conn,"UPDATE post_experience SET description='$description' WHERE id='$id'");
        
        $getExp = mysqli_query($conn, "SELECT * FROM post_experience WHERE id='$id' ORDER BY id DESC");
        $expData = mysqli_fetch_assoc($getExp);
        if(!empty($queryexp)){
        $response["message"] = "Experience Updated/Uploaded";
        $response["msg_code"] = 1;
        $response["Data"] = $expData;
        }
        else {
            $response["message"] = "Invalid Request";
            $response["msg_code"] = 0;
        }
    }
    }
    else {
        $response["message"] = 'Invalid Request AuthToken or Id OR Both Incorrect';
        $response["msg_code"] = 0;
    }  
}
else {
    $response["message"] = "Invalid Request";
    $response["msg_code"] = 0;
}

echo json_encode($response,JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);

?>