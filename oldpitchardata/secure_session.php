<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ob_start();
session_start();
// connection
include 'conn.php';

if(!isset($_SESSION["login"]) AND !isset( $_SESSION["getEid"])){
     header("Location:register.php");
}
// session email is required..
 if (empty($_SESSION["getEid"]) OR !isset($_SESSION["getEid"])) {
     header("Location:login.php");
 }
 if (!empty($_SESSION["getEid"])) {
    $eid=$_SESSION["getEid"];
 }

 //Getting Logged In user Info
 $fetchUserData=mysqli_query($conn,"SELECT * FROM tbl_users WHERE email='$eid'");
 $getUserData=mysqli_fetch_array($fetchUserData);
 //Basic details
  $getEmail=$getUserData["email"];
 $user_name=$getUserData["fullname"];
 $status=$getUserData["occupation"];
   $getDisplayPic=$getUserData["display_pic"];
   $first=$getUserData["firstname"];
   $last=$getUserData["lastname"];





 ?>