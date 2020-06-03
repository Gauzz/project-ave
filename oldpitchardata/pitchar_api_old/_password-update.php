<?php

header('Content-Type: application/json');

include('../conn.php');

if (isset($_POST["submit"])) 

{

  $getEmail=$_POST["email"];



  $GetData=mysqli_query($conn,"SELECT * FROM tbl_users WHERE email='$getEmail'");

  $GetUserData=mysqli_fetch_array($GetData);

  $count = mysqli_num_rows($GetData);

  if ($count=='1') 

  {

    

  

  $DBPass=$GetUserData["password"];



  $opwd=mysqli_real_escape_string($conn,$_POST["opwd"]);

  $pwd=mysqli_real_escape_string($conn,$_POST["pwd"]);

  $password = password_hash($pwd, PASSWORD_BCRYPT);

  $cpwd=mysqli_real_escape_string($conn,$_POST["cpwd"]);





  if ($pwd==$cpwd) {

  if (password_verify($opwd,$DBPass)) {

  $update=mysqli_query($conn,"UPDATE tbl_users SET password='$password' WHERE email='$getEmail'");

  if ($update) {

  $response["msg"]="updated success";

  $response["code"]=1;

  }

  }

  else {

  $response["msg"]="old password not matched";

  $response["code"]=0;

  }

  }

  else{

  $response["msg"]="new password and confirm password not matched";

  $response["code"]=2;

  }

      

}

else

{

  $response["msg"]="Email Address are not matched";

  $response["code"]=3;

}

echo json_encode(array("passwordupdate" =>[$response]));



}

?>