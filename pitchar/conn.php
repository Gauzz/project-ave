<?php
// $conn = mysql_connect("localhost","root","");
// $sql = mysql_select_db("project",$conn);

header('Access-Control-Allow-Methods: GET, POST');

header("Access-Control-Allow-Headers: X-Requested-With");

$conn=mysqli_connect("localhost","pitchar_project","111444777aaa@@@","pitchar_project");
//  if($conn==1){
//  	echo "connected";
//  }
//  else{
//  echo "error";
// }
 
?>