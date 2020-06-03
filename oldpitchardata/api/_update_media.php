<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
header('Content-Type: application/json');
include ('../conn.php');

if (isset($_REQUEST["update-media"])) {
    if (isset($_REQUEST["project_id"]) AND !empty($_REQUEST["project_id"])) {

    $token = $_REQUEST["authtoken"];
    $project_id = $_REQUEST["project_id"];

    $selectMedia = mysqli_query($conn, "SELECT * FROM media WHERE id='$project_id' ");
    $getMediaRow = mysqli_num_rows($selectMedia);
    if($getMediaRow > 0){

    $getMediaData = mysqli_fetch_assoc($selectMedia);
    $assetsId = $getMediaData["id"];
    $authtoken = $getMediaData["authtoken"];
    $projectName = (isset($_REQUEST["name"])) ? $_REQUEST["name"]:$getMediaData["name"];
    $type = (isset($_REQUEST["type"])) ? $_REQUEST["type"]:$getMediaData["type"];
    $tags = (isset($_REQUEST["tags"])) ? $_REQUEST["tags"]:$getAssetsData["tags"];

    if ($authtoken==$token) {
// video
    if (isset($_FILES["video"]["name"]) AND $_FILES["video"]["size"] > 0) {
        $arrayVideo=explode('.',$_FILES["video"]["name"]);
        $videoReverseArray=array_reverse($arrayVideo);
        $videoGetExt=$videoReverseArray[0];
        $videoName=rand().".mp4";
        move_uploaded_file($_FILES["video"]["tmp_name"],"../uploads/video/".$videoName);
        $videoUrlPath = 'https://pitchar.io/uploads/video/'.$videoName;
    }
    else{
        $videoUrlPath=$getMediaData["video"];
    }
   

    //audioFile
    $valid_formats = array("mp3","wav","ogg");  
      $audio = $_FILES['audio']['name'];
      $audioSize = $_FILES['audio']['size'];
      if(strlen($audio)) {
        list($txt, $ext) = explode(".", $audio);
        if(in_array($ext,$valid_formats)) {
          if($audioSize<(10240*10240)) {
              $audioName = time().".".$ext;
              $audioExtension = substr($audioName, -3);
            $tmp = $_FILES['audio']['tmp_name'];
            move_uploaded_file($tmp, "../uploads/audio/".$audioName);
            $getAudioName = 'https://pitchar.io/uploads/audio/'.$audioName;
    }
    }
    }else{
        $getAudioName=$getMediaData["audio"];
        $audioExtension=$getMediaData["extension"];
    } 


    //videoThumbnail
    $valid_formats = array("png","jpeg","jpg");  
      $videoThumb = $_FILES['thumbnail']['name'];
      $videoSize = $_FILES['thumbnail']['size'];
      if(strlen($videoThumb)) {
        list($txt, $ext) = explode(".", $videoThumb);
        if(in_array($ext,$valid_formats)) {
          if($videoSize<(10240*10240)) {
              $videoThumbName = time().".".$ext;
            $tmp = $_FILES['thumbnail']['tmp_name'];
            move_uploaded_file($tmp, "../uploads/videoThumbnail/".$videoThumbName);
            $getVideoThumbnail = 'https://pitchar.io/uploads/videoThumbnail/'.$videoThumbName;
    }
    }
    }else{
        $getVideoThumbnail=$getMediaData["thumbnail"];
    }

           


// Add New Assets
          $queryAssets=mysqli_query($conn,"UPDATE  media SET type='$type',tags='$tags',video='$videoUrlPath',thumbnail='$getVideoThumbnail',audio='$getAudioName',extension='$audioExtension',name='$projectName' WHERE id='$assetsId' ");

    if ($queryAssets) {

        $getAssets = mysqli_query($conn, "SELECT * FROM media WHERE id='$assetsId' ORDER BY id DESC");
        $AssetsData = mysqli_fetch_assoc($getAssets);
        $response['message'] = "Media Update";
        $response['msg_code'] = 1;
        $response['data'] = $AssetsData;
    }else {
    $response['message'] = "Invalid Request";
    $response['msg_code'] = 00;
}

}else {
    $response['message'] = "Token are not Found Please Correct the token!";
    $response['msg_code'] = 00;
}


}
else {
    $response['message'] = "Media are not Available in our Database!";
    $response['msg_code'] = 00;
}

}else{
    $response['message'] = "Media are not Available in our Database!";
    $response['msg_code'] = 00;
}

echo json_encode($response);
}
?>
