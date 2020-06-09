<?php
header("Content-type:application/json");
header('Access-Control-Allow-Origin: *');
include('../../includes/functions.php');
if (!empty($_REQUEST["submit"]) AND !empty($_REQUEST["authtoken"])) {
    //$id = $_REQUEST["id"];
    $token = $_REQUEST["authtoken"];
       
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
    }

    $experience = mysqli_real_escape_string($conn,$_REQUEST["experience"]);
    $experiencetmp=stripslashes($experience);
    $currentTime = time();
    $putLink = 'https://pitchar.io/uploads/experience/'.$currentTime.'.html';
    file_put_contents('../uploads/experience/'.$currentTime.'.html', $experiencetmp);

    $projectName = (isset($_REQUEST["name"])) ? $_REQUEST["name"]:'';
    $tags = (isset($_REQUEST["tags"])) ? $_REQUEST["tags"]:'';    
    $description = (isset($_REQUEST["description"])) ? $_REQUEST["description"]:'';
    
// Create Post Experience
    $queryexp=mysqli_query($conn,"INSERT INTO post_experience(authtoken,experience,share_experience,thumbnail,name,tags,description)VALUES('$token','$experience','$putLink','$getthumbnail','$projectName','$tags','$description')");
       
    if (!empty($queryexp)) {        
        $getExp = mysqli_query($conn,"SELECT * FROM post_experience WHERE authtoken='$token' ORDER BY id DESC");
        $expData = mysqli_fetch_assoc($getExp);
        $response["message"] = "Experience Created/Uploaded";
        $response["msg_code"] = 1;
        $response["Data"] = $expData;
    }
    else {
        $response["message"] = 'Invalid Request';
        $response["msg_code"] = 0;
    }
}
else {
    $response["message"] = "Invalid Request";
    $response["msg_code"] = 0;
}

echo json_encode($response,JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);

?>