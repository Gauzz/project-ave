<?php
header('Content-Type: application/json');
include ('../conn.php');

if (!empty($_REQUEST["submit"]) AND !empty($_REQUEST["authtoken"])) {
    //AND !empty($_REQUEST["id"]) $id = $_REQUEST["id"];
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
    $getMarker = 'https://pitchar.io/uploads/marker/'.$markerName;
                                 }
                                      }
                        }
    }
    $projectName = (isset($_REQUEST["name"])) ? $_REQUEST["name"]:'';
    $tags = (isset($_REQUEST["tags"])) ? $_REQUEST["tags"]:'';    
    $description = (isset($_REQUEST["description"])) ? $_REQUEST["description"]:'';
    $experienceid= (isset($_REQUEST["experienceid"])) ? $_REQUEST["experienceid"]:'';
   
// Edit Post Marker

    if (empty($markerName)) {
       $querymarker=mysqli_query($conn,"UPDATE post_marker SET name='$projectName',tags='$tags',description='$description',experienceid='$experienceid' WHERE authtoken='$token'");

        $getMark = mysqli_query($conn, "SELECT * FROM post_marker WHERE authtoken='$token' ORDER BY id DESC");
        $markerData = mysqli_fetch_assoc($getMark);
        if(!empty($querymarker)){
        $response["message"] = "Updated Marker Uploaded";
        $response["msg_code"] = 1;
        $response["Data"] = $markerData;
        }
        else {
            $response["message"] = "Invalid Request";
            $response["msg_code"] = 0;
        }
    }
    if (!empty($markerName)) {
       $querymarker=mysqli_query($conn,"UPDATE post_marker SET marker='$getMarker',name='$projectName',tags='$tags',description='$description',experienceid='$experienceid' WHERE authtoken='$token'");

        $getMark = mysqli_query($conn, "SELECT * FROM post_marker WHERE authtoken='$token' ORDER BY id DESC");
        $markerData = mysqli_fetch_assoc($getMark);
        if(!empty($querymarker)){
        $response["message"] = "Updated Marker Uploaded";
        $response["msg_code"] = 1;
        $response["Data"] = $markerData;
        }
        else {
            $response["message"] = "Invalid Request";
            $response["msg_code"] = 0;
        }
    }
    else {
    $response["message"] = "Your token is not correct";
    $response["msg_code"] = 0;
    }
}
else {
    $response["message"] = "Invalid Request";
    $response["msg_code"] = 0;
}

echo json_encode($response,JSON_PRETTY_PRINT);

?>