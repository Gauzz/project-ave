<?php
header("Content-type:application/json");
header('Access-Control-Allow-Origin: *');
include('../../includes/functions.php');
if (!empty($_REQUEST["submit"]) AND !empty($_REQUEST["marker_id"]) AND !empty($_REQUEST["authtoken"])) {
    $response["Data"]=array();
    $id = $_REQUEST["marker_id"];
    $token = $_REQUEST["authtoken"];

    if (!empty($_FILES["patt"])) {
        $valid_format = array("patt");
        $patt = $_FILES['patt']['name'];
        if(strlen($patt)) {
            list($txt, $ext) = explode(".", $patt);
            if(in_array($ext,$valid_format)) {
                $pattName = time().".".$ext;
                $tmp = $_FILES['patt']['tmp_name'];
                move_uploaded_file($tmp, "../uploads/pattern/".$pattName);
                $getPatt = 'http://localhost/user/uploads/pattern/'.$pattName;
            }
        }
    }
    $projectName = (isset($_REQUEST["name"])) ? $_REQUEST["name"]:'';
    $tags = (isset($_REQUEST["tags"])) ? $_REQUEST["tags"]:'';    
    $description = (isset($_REQUEST["description"])) ? $_REQUEST["description"]:'';
    $experienceid = (isset($_REQUEST["experienceid"])) ? $_REQUEST["experienceid"]:'';
   
    // Create Post Pattern
    if (!empty($getPatt)) {
        $querypatt=mysqli_query($conn,"UPDATE post_marker SET linkpatt='$getPatt',name='$projectName',tags='$tags',description='$description',experienceid='$experienceid' WHERE id='$id' AND authtoken='$token'");    
        $getPattern = mysqli_query($conn,"SELECT * FROM post_marker WHERE id='$id' AND authtoken='$token' ORDER BY id DESC");
        if($querypatt){
            while($fetchPatt=mysqli_fetch_assoc($getPattern)){        
                array_push($response["Data"],array('message'=>"Pattern Marker Uploaded",'id'=>$fetchPatt["id"],'authtoken'=>$fetchPatt["authtoken"],'linkpatt'=>$fetchPatt["linkpatt"],'linkmarker'=>$fetchPatt["marker"],'project_name'=>$fetchPatt["name"],'tags'=>$fetchPatt["tags"],'description'=>$fetchPatt["description"],'experienceid'=>$fetchMarkerPatt["experienceid"],'msg_code'=> '1',));     
            }
        }
        else {
        $response["message"] = "Invalid Request";
        $response["msg_code"] = 0;
        }
    }
}
else {
    $response["message"] = "Invalid Request";
    $response["msg_code"] = 0;
}

echo json_encode($response,JSON_PRETTY_PRINT);

?>