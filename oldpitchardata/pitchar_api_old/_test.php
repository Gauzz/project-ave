<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
function generateRandomString($length = 12){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString.= $characters[rand(0, $charactersLength - 1) ];
        }

        return $randomString;
}
if (isset($_POST["create"])) {
 	$projectName = $_POST["project_name"];
 	$user_name = $_POST["username"];
 	$token = generateRandomString();
    $email = $_POST["email"];
    $getEntr = (isset($_POST["subject"])) ? $_POST["subject"] : '' ;
    $getBook = (isset($_POST["book"])) ? $_POST["book"] : '' ;
    $getMag = (isset($_POST["magaz"])) ? $_POST["magaz"] : '' ;
    $getEdu = (isset($_POST["education"])) ? $_POST["education"] : '' ;
    $calender = (isset($_POST["calender"])) ? $_POST["calender"] : '' ;
    $getWeekStart = (isset($_POST["start_date"])) ? $_POST["start_date"] : '' ;
    $getWeekEnd = (isset($_POST["end_date"])) ? $_POST["end_date"] : '' ;
    $grade = (isset($_POST["grade"])) ? $_POST["grade"] : '' ;
    $notes = (isset($_POST["notes"])) ? $_POST["notes"] : '' ;

    /*files */

    /*  Doc */
    if (isset($_FILES["doc"]["name"]) AND $_FILES["doc"]["size"] > 0) {
        $array=explode('.',$_FILES["doc"]["name"]);
        $reverseArray=array_reverse($array);
        $getext=$reverseArray[0];
        move_uploaded_file($_FILES["doc"]["tmp_name"],"upload/".rand().".".$getext);
    }

    if (isset($_FILES["images"])) {
        foreach ($_FILES["images"]["name"] as $key => $value) {
            $imageName=rand().'.jpg';
           if (move_uploaded_file($_FILES["images"]["tmp_name"][$key],'upload/'.$imageName)) {
                
            }
        }
    }
 

 
  exit(json_encode(["response" => [
        "project_name"  =>  $projectName,
        "user_name"     =>  $user_name,
        "token"         =>  $token,
        "email"         =>  $email,
        "Entr"          =>  $getEntr,
        "Book"          =>  $getBook,
        "mags"          =>  $getMag,
        "edu"           =>  $getEdu,
        "calender"      =>  $calender,
        "getWeekstart"  =>  $getWeekStart,
        "getWeekEnd"    =>  $getWeekEnd,
        "grader"        =>  $grade,
        "notes"         =>  $notes
    ]]));



}
 


?>
