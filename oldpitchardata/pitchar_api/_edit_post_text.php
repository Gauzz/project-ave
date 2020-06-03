<?php
header('Content-Type: application/json');
include ('../conn.php');

if (!empty($_REQUEST["submit"]) AND !empty($_REQUEST["id"]) AND !empty($_REQUEST["authtoken"])) {
    $id = $_REQUEST["id"];
    $token = $_REQUEST["authtoken"];
    $type = (isset($_REQUEST["type"])) ? $_REQUEST["type"]:'';

    if (!empty($_FILES["content"])) {
    $valid_format = array("pdf","doc","docx");
    $content = $_FILES['content']['name'];
    if(strlen($content)) {
    list($txt, $ext) = explode(".", $content);
    if(in_array($ext,$valid_format)) {
    $contentName = time().".".$ext;
    $tmp = $_FILES['content']['tmp_name'];
    move_uploaded_file($tmp, "../uploads/text/".$contentName);
    $getContent = 'https://pitchar.io/uploads/text/'.$contentName;
                                      }
                        }
    }

    $text = (isset($_REQUEST["text"])) ? $_REQUEST["text"]:'';
    $projectName = (isset($_REQUEST["name"])) ? $_REQUEST["name"]:'';
    $tags = (isset($_REQUEST["tags"])) ? $_REQUEST["tags"]:'';
   
// Edit Post Text

    if (empty($contentName)) {
        
       $querytext=mysqli_query($conn,"UPDATE post_text SET type='$type',textany='$text',project_name='$projectName',tags='$tags' WHERE id='$id'");

        $getText = mysqli_query($conn, "SELECT * FROM post_text WHERE id='$id' ORDER BY id DESC");
        $textData = mysqli_fetch_assoc($getText);
        if(!empty($querytext)){
        $response["message"] = "Text Updated/Uploaded";
        $response["msg_code"] = 1;
        $response["Data"] = $textData;
        }
        else {
            $response["message"] = "Invalid Request";
            $response["msg_code"] = 0;
        }
    }
    if (!empty($contentName)) {
        
       $querytext=mysqli_query($conn,"UPDATE post_text SET type='$type',textany='$text',content='$getContent',project_name='$projectName',tags='$tags' WHERE id='$id'");
        
        $getText = mysqli_query($conn, "SELECT * FROM post_text WHERE id='$id' ORDER BY id DESC");
        $textData = mysqli_fetch_assoc($getText);
        if(!empty($querytext)){
        $response["message"] = "Text Updated/Uploaded";
        $response["msg_code"] = 1;
        $response["Data"] = $textData;
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