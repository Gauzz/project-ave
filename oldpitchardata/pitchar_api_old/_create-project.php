<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');
include ('../conn.php');

if (isset($_POST["create"])) {
    $projectName = $_POST["project_name"];
    $user_name = $_POST["username"];
    function generateRandomString($length = 12)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString.= $characters[rand(0, $charactersLength - 1) ];
        }

        return $randomString;
    }

    $token = generateRandomString();
    $email = $_POST["email"];
    $getEntr = $_POST["subject"];
    $getBook = $_POST["book"];
    $getMag = $_POST["magaz"];
    $getEdu = $_POST["education"];
    $calender = $_POST["calender"];
    $getWeekStart = $_POST["start_date"];
    $getWeekEnd = $_POST["end_date"];
    $grade = $_POST["grade"];
    $country = $_POST["country"];
    $notes = $_POST["notes"];

    //DOC
    if (isset($_FILES["doc"]["name"]) AND $_FILES["doc"]["size"] > 0) {
        $array=explode('.',$_FILES["doc"]["name"]);
        $reverseArray=array_reverse($array);
        $getext=$reverseArray[0];
        $docname=rand().".".$getext;
        move_uploaded_file($_FILES["doc"]["tmp_name"],"../uploads/docs/".$docname);
    }
    else{
        $docname='';
    }
    // video
    if (isset($_FILES["video"]["name"]) AND $_FILES["video"]["size"] > 0) {
        $arrayVideo=explode('.',$_FILES["video"]["name"]);
        $videoReverseArray=array_reverse($arrayVideo);
        $videoGetExt=$videoReverseArray[0];
        $videoName=rand().".mp4";
        move_uploaded_file($_FILES["video"]["tmp_name"],"../uploads/video/".$videoName);
    }
    else{
        $videoName='';
    }
    // Obj,fbx
    if (isset($_FILES["modelobj"]["name"]) AND $_FILES["modelobj"]["size"] > 0) {
        $arrayModel=explode('.',$_FILES["modelobj"]["name"]);
        $modelReverseArray=array_reverse($arrayModel);
        $modelGetExt=$modelReverseArray[0];
        $modelName=rand().".".$modelGetExt;
        move_uploaded_file($_FILES["modelobj"]["tmp_name"],"../uploads/obj/".$modelName);
    }
    else{
        $modelName='';
    }
    // Mtl
    if (isset($_FILES["modelmtl"]["name"]) AND $_FILES["modelmtl"]["size"] > 0) {
        $arrayMtl=explode('.',$_FILES["modelmtl"]["name"]);
        $mtlReverseArray=array_reverse($arrayMtl);
        $mtlGetExt=$mtlReverseArray[0];
        $mtlName=rand().".".$mtlGetExt;
        move_uploaded_file($_FILES["modelmtl"]["tmp_name"],"../uploads/mtl/".$mtlName);
    }
    else{
        $mtlName='';
    }

    // zip
    if (isset($_FILES["zipfile"]["name"]) AND $_FILES["zipfile"]["size"] > 0) {
        $arrayZip=explode('.',$_FILES["zipfile"]["name"]);
        $zipReverseArray=array_reverse($arrayZip);
        $zipGetExt=$zipReverseArray[0];
        $zipName=rand().".".$zipGetExt;
        move_uploaded_file($_FILES["zipfile"]["tmp_name"],"../uploads/zip/".$zipName);
    }
    else{
        $zipName='';
    }
    /* Images */
    if (isset($_FILES["images"])) {
        $i = 0;
        foreach ($_FILES["images"]["name"] as $key => $value) {
            $imageName=rand().'.jpg';
            $i++;
           if (move_uploaded_file($_FILES["images"]["tmp_name"][$key],'../uploads/imgs/'.$imageName)) {
                $queryImageInsert = mysqli_query($conn, "INSERT INTO tbl_project_image(image,token,cnt)VALUES('$imageName','$token','$i')");
            }
        }
    }


    $queryInsert = mysqli_query($conn, "INSERT INTO tbl_std_project(name,token,project_name,email,subject,book,image,objfile,mtlfile,video,notes,docs,country,submit_time,calender,start_date,end_date,education,magaz,grade,zipfile)VALUES('$user_name','$token','$projectName','$email','$getEntr','$getBook','1','$modelName','$mtlName','$videoName','$notes','$docname','$country',NOW(),'$calender','$getWeekStart','$getWeekEnd','$getEdu','$getMag','$grade','$zipName')");
    if ($queryInsert) {

        // Add New education

        $addEdu = mysqli_query($conn, "SELECT * FROM education WHERE name='$getEdu'");
        $countEdu = mysqli_num_rows($addEdu);
        if ($countEdu == 0 AND !empty($getEdu)) {
            mysqli_query($conn, "INSERT INTO education(name,user_by)VALUES('$getEdu','$user_name')");
        }

        // Add New book

        $addBook = mysqli_query($conn, "SELECT * FROM books WHERE book='$getBook'");
        $countBook = mysqli_num_rows($addBook);
        if ($countBook == 0 AND !empty($getBook)) {
            mysqli_query($conn, "INSERT INTO books(Book)VALUES('$getBook')");
        }

        // Add New ENTR

        $addEntr = mysqli_query($conn, "SELECT * FROM subject WHERE subject='$getEntr'");
        $countEntr = mysqli_num_rows($addEntr);
        if ($countEntr == 0 AND !empty($getEntr)) {
            mysqli_query($conn, "INSERT INTO subject(subject)VALUES('$getEntr')");
        }

        // Add New Magz

        $addMag = mysqli_query($conn, "SELECT * FROM magazine WHERE name='$getMag'");
        $countMag = mysqli_num_rows($addMag);
        if ($countMag == 0 AND !empty($getMag)) {
            mysqli_query($conn, "INSERT INTO magazine(name,insert_by)VALUES('$getMag','$user_name')");
        }

        $getProject = mysqli_query($conn, "SELECT * FROM tbl_std_project WHERE token='$token'");
        $projectData = mysqli_fetch_assoc($getProject);
        $response['message'] = "Project Created";
        $response['msg_code'] = 1;
        $response['data'] = $projectData;
    }
}
else {
    $response['message'] = "Invalid Request";
    $response['msg_code'] = 00;
}

echo json_encode($response);
?>
