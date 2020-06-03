<?php
header('Content-Type: application/json');
include ('../conn.php');

if (!empty($_REQUEST["submit"]) AND !empty($_REQUEST["id"]) AND !empty($_REQUEST["authtoken"])) {
    $response=array();
    $id = $_REQUEST["id"];
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
    $getpatt = 'https://pitchar.io/uploads/pattern/'.$pattName;
                                      }
                        }
    }

    $projectName = (isset($_REQUEST["name"])) ? $_REQUEST["name"]:'';
    $tags = (isset($_REQUEST["tags"])) ? $_REQUEST["tags"]:'';    
    $description = (isset($_REQUEST["description"])) ? $_REQUEST["description"]:'';
    $experienceid = (isset($_REQUEST["experienceid"])) ? $_REQUEST["experienceid"]:'';
   
    $squery=mysqli_query($conn,"SELECT * FROM post_marker WHERE experienceid='$experienceid' AND created_date > DATE_SUB(NOW(), INTERVAL 4 HOUR)");
    while($fetchMarker=mysqli_fetch_assoc($squery))
    {
        
    $getMarker=array('linkmarker'=>$fetchMarker["marker"],);
    /*$getMarker=array_push($response,array('linkmarker'=>$fetchMarker["marker"],));*/
    }

    if(mysqli_num_rows($squery) > 0){

// Create Post Pattern
    $querypatt=mysqli_query($conn,"INSERT INTO post_patt(authtoken,patt,name,tags,description,experienceid)VALUES('$token','$getpatt','$projectName','$tags','$description','$experienceid')");

    if ($querypatt) {
        
    $getPatt = mysqli_query($conn, "SELECT * FROM post_patt WHERE authtoken='$token' ORDER BY id DESC");
    while($fetchPatt=mysqli_fetch_assoc($getPatt))
    {
        
    array_push($response["Data"],array('message'=>"Pattern Uploaded",'id'=>$fetchPatt["id"],$getMarker,'linkpatt'=>$fetchPatt["patt"],'msg_code'=> '1',)); /*,'project_name'=>$fetchPatt["name"],'tags'=>$fetchPatt["tags"],'description'=>$fetchPatt["description"],'authtoken'=>$fetchPatt["authtoken"],*/
    
    }
        /*$response["message"] = "Pattern Created/Uploaded";
        $response["msg_code"] = 1;
        $response["Data"] = $expData;*/
    }
    else {

        $response["message"] = "Invalid Request";
        $response["msg_code"] = 0;
    }
    
    }
else{

        $response["message"] = "Your time interval 4hours has been processed for Uploading Marker";
        $response["msg_code"] = 0;
    } 
}
else {
    $response["message"] = "Invalid Request";
    $response["msg_code"] = 0;
}

echo json_encode($response,JSON_PRETTY_PRINT);

/*
    if (empty($pattName)) {
    $querypatt=mysqli_query($conn,"INSERT INTO post_patt(authtoken,name,tags,description,experienceid)VALUES('$token','$projectName','$tags','$description','$experienceid')");
        
    $getPatt = mysqli_query($conn, "SELECT * FROM post_patt WHERE authtoken='$token' ORDER BY id DESC");
    if($querypatt){
    while($fetchPatt=mysqli_fetch_assoc($getPatt))
    {
        
    array_push($response["Data"],array('message'=>"Pattern Uploaded",'id'=>$fetchPatt["id"],$getMarker,'linkpatt'=>$fetchPatt["patt"],'msg_code'=> '1',)); /*,'project_name'=>$fetchPatt["name"],'tags'=>$fetchPatt["tags"],'description'=>$fetchPatt["description"],'authtoken'=>$fetchPatt["authtoken"],*/
    /*
    }
        $response["message"] = "Pattern Created/Uploaded";
        $response["msg_code"] = 1;
        $response["Data"] = $expData;
    }
    }
    if (!empty($pattName)) {
    $querypatt=mysqli_query($conn,"INSERT INTO post_patt(authtoken,patt,name,tags,description,experienceid)VALUES('$token','$getpatt','$projectName','$tags','$description','$experienceid')");
        
    $getPatt = mysqli_query($conn, "SELECT * FROM post_patt WHERE authtoken='$token' ORDER BY id DESC");
    if($querypatt){
    while($fetchPatt=mysqli_fetch_assoc($getPatt))
    {
        
    array_push($response["Data"],array('message'=>"Pattern Uploaded",'id'=>$fetchPatt["id"],$getMarker,'linkpatt'=>$fetchPatt["patt"],'msg_code'=> '1',)); /*,'project_name'=>$fetchPatt["name"],'tags'=>$fetchPatt["tags"],'description'=>$fetchPatt["description"],'authtoken'=>$fetchPatt["authtoken"],
    
    }
        $response["message"] = "Pattern Created/Uploaded";
        $response["msg_code"] = 1;
        $response["Data"] = $expData;
    }
    }*/

?>