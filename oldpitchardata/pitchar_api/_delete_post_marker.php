<?php
header('Content-Type: application/json');
include ('../conn.php');

if (!empty($_REQUEST["submit"]) AND !empty($_REQUEST["id"]) AND !empty($_REQUEST["authtoken"])) {
	$id = $_REQUEST["id"];
    $token = $_REQUEST["authtoken"];
   
// Delete Post Marker
       $queryMarker=mysqli_query($conn,"DELETE FROM post_marker WHERE id='$id' AND authtoken='$token'");

    if (!empty($queryMarker)) {
        
        $response["message"] = "Marker Deleted or Removed";
        $response["msg_code"] = 1;
    }
	else {
		
		    $response["message"] = "Invalid Request";
		    $response["msg_code"] = 0;
		}
}
else {
    $response["message"] = "Invalid Request";
    $response["msg_code"] = 0;
}

echo json_encode($response,JSON_PRETTY_PRINT);

?>