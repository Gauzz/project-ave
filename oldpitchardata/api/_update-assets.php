<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
header('Content-Type: application/json');
include ('../conn.php');

if (isset($_REQUEST["update-assets"])) {
    if (isset($_REQUEST["project_id"]) AND !empty($_REQUEST["project_id"])) {

    $token = $_REQUEST["authtoken"];
    $project_id = $_REQUEST["project_id"];

    $selectAssets = mysqli_query($conn, "SELECT * FROM assets WHERE id='$project_id' ");
    $getAssetsRow = mysqli_num_rows($selectAssets);
    if($getAssetsRow > 0){

    $getAssetsData = mysqli_fetch_assoc($selectAssets);
    $assetsId = $getAssetsData["id"];
    $authtoken = $getAssetsData["authtoken"];
    $projectName = (isset($_REQUEST["name"])) ? $_REQUEST["name"]:$getAssetsData["name"];
    $type = (isset($_REQUEST["type"])) ? $_REQUEST["type"]:$getAssetsData["type"];
    $tags = (isset($_REQUEST["tags"])) ? $_REQUEST["tags"]:$getAssetsData["tags"];

    if ($authtoken==$token) {

    // Obj,fbx
    if (isset($_FILES["obj"]["name"]) AND $_FILES["obj"]["size"] > 0) {
        $arrayModel=explode('.',$_FILES["obj"]["name"]);
        $modelReverseArray=array_reverse($arrayModel);
        $modelGetExt=$modelReverseArray[0];
        $modelName=rand().".".$modelGetExt;
        move_uploaded_file($_FILES["obj"]["tmp_name"],"../uploads/obj/".$modelName);
        $shortObFbx = substr($_FILES["obj"]["name"], -4);
        $objurlpath = ($shortObFbx==".obj") ? 'https://pitchar.io/uploads/obj/'.$modelName : '' ;
        $fbxurlpath = ($shortObFbx==".fbx") ? 'https://pitchar.io/uploads/obj/'.$modelName : '' ;
    }
    else{
        $modelName='';
        $objurlpath=$getAssetsData["obj"];
        $fbxurlpath=$getAssetsData["fbx"];
    }
    // Mtl
    if (isset($_FILES["mtl"]["name"]) AND $_FILES["mtl"]["size"] > 0) {
        $arrayMtl=explode('.',$_FILES["mtl"]["name"]);
        $mtlReverseArray=array_reverse($arrayMtl);
        $mtlGetExt=$mtlReverseArray[0];
        $mtlName=rand().".".$mtlGetExt;
        move_uploaded_file($_FILES["mtl"]["tmp_name"],"../uploads/mtl/".$mtlName);
        $mtlUrlPath = 'https://pitchar.io/uploads/mtl/'.$mtlName;
    }
    else{
        $mtlName='';
        $mtlUrlPath=$getAssetsData["mtl"];
    }
    
    // Gltf
    if (isset($_FILES["gltf"]["name"]) AND $_FILES["gltf"]["size"] > 0) {
        $arrayGltf=explode('.',$_FILES["gltf"]["name"]);
        $gltfReverseArray=array_reverse($arrayGltf);
        $gltfGetExt=$gltfReverseArray[0];
        $gltfName=rand().".".$gltfGetExt;
        move_uploaded_file($_FILES["gltf"]["tmp_name"],"../uploads/obj/".$gltfName);
        $gltfUrlPath = 'https://pitchar.io/uploads/obj/'.$gltfName;
    }
    else{
        $gltfName='';
        $gltfUrlPath=$getAssetsData["gltf"];
    }

    /* image */
    
        $valid_formats = array("png","jpeg","jpg");  
          $image = $_FILES['image']['name'];
          $sizeimage = $_FILES['image']['size'];
          if(strlen($image)) {
            list($txt, $ext) = explode(".", $image);
            if(in_array($ext,$valid_formats)) {
              if($sizeimage<(10240*10240)) {
                  $imageName = time().".".$ext;
                $tmp = $_FILES['image']['tmp_name'];
                move_uploaded_file($tmp, "../uploads/imgs/".$imageName);
                $imageUrlPath = 'https://pitchar.io/uploads/imgs/'.$imageName;
        }
        }
        }else{
            $imageUrlPath=$getAssetsData["image"];
        }  

    //objThumb
        $valid_formats = array("png","jpeg","jpg");  
          $objThumb = $_FILES['thumbnail']['name'];
          $sizeobj = $_FILES['thumbnail']['size'];
          if(strlen($objThumb)) {
            list($txt, $ext) = explode(".", $objThumb);
            if(in_array($ext,$valid_formats)) {
              if($sizeobj<(10240*10240)) {
                  $objThumbnailName = time().".".$ext;
                $tmp = $_FILES['thumbnail']['tmp_name'];
                move_uploaded_file($tmp, "../uploads/objThumbnail/".$objThumbnailName);
                $getObjThumbnail = 'https://pitchar.io/uploads/objThumbnail/'.$objThumbnailName;
        }
        }
        }else{
            $getObjThumbnail=$getAssetsData["objthumbnail"];
        }  


           


// Add New Assets
          $queryAssets=mysqli_query($conn,"UPDATE  assets SET type='$type',tags='$tags',objthumbnail='$getObjThumbnail',obj='$objurlpath',mtl='$mtlUrlPath',gltf='$gltfUrlPath',fbx='$fbxurlpath',image='$imageUrlPath',name='$projectName' WHERE id='$assetsId' ");

    if ($queryAssets) {

        $getAssets = mysqli_query($conn, "SELECT * FROM assets WHERE id='$assetsId' ORDER BY id DESC");
        $AssetsData = mysqli_fetch_assoc($getAssets);
        $response['message'] = "Assets Update";
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
    $response['message'] = "Assets are not Available in our Database!";
    $response['msg_code'] = 00;
}

}else{
    $response['message'] = "Assets are not Available in our Database!";
    $response['msg_code'] = 00;
}

echo json_encode($response);
}
?>
