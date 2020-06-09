<?php
header("Content-type:application/json");
header('Access-Control-Allow-Origin: *');
include('../../includes/functions.php');
if (!empty($_REQUEST["submit"]) AND !empty($_REQUEST["authtoken"])) {
    
    $token = $_REQUEST["authtoken"];
    if(!empty($_FILES["marker"])){
        $valid_formats = array("png","jpeg","jpg");
        $marker = $_FILES['marker']['name'];
        $photoSize = $_FILES['marker']['size'];
        if(strlen($marker)) {
            list($txt, $ext) = explode(".", $marker);
            if(in_array($ext,$valid_formats)) {
                if($photoSize<(10240*10240)) {
                    $markerName = time().".".$ext;
                    $tmp = $_FILES['marker']['tmp_name'];
                    move_uploaded_file($tmp, "../uploads/marker/".$markerName);
                    $getMarker = 'http://localhost/user/uploads/marker/'.$markerName;
                }
            }
        }
    }
    
    $projectName = (isset($_REQUEST["name"])) ? $_REQUEST["name"]:'';
    $tags = (isset($_REQUEST["tags"])) ? $_REQUEST["tags"]:'';    
    $description = (isset($_REQUEST["description"])) ? $_REQUEST["description"]:'';
    $experienceid= (isset($_REQUEST["experienceid"])) ? $_REQUEST["experienceid"]:'';
   
    // Create Post Marker
    $querymarker=mysqli_query($conn,"INSERT INTO post_marker(authtoken,marker,name,tags,description,experienceid)VALUES('$token','$getMarker','$projectName','$tags','$description','$experienceid')");
    if (!empty($querymarker)) {
        $getMark =  mysqli_query($conn,"SELECT * FROM post_marker WHERE authtoken='$token' ORDER BY id DESC");
        $markerData = mysqli_fetch_assoc($getMark);
        $response["message"] = "Marker Uploaded";
        $response["msg_code"] = 1;
        $response["Data"] = $markerData;
    }
    else {
        $response["message"] = "Invalid Request";
        $response["msg_code"] = 0;
    }   
}
else{
    $response["message"] = "Invalid Request";
    $response["msg_code"] = 0;
}

echo json_encode($response,JSON_PRETTY_PRINT);

?>