<?php
header('Content-Type: application/json');
include ('../conn.php');

if (isset($_REQUEST["submit"])) {
	$id = (!empty($_REQUEST["id"]));
    $token = (!empty($_REQUEST["authtoken"]));
   
// Delete Post Text
       $querytext=mysqli_query($conn,"DELETE FROM post_text WHERE id='$id' AND authtoken='$token'");

    if (!empty($querytext)) {
        
        $response["message"] = "Text Deleted or Removed";
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