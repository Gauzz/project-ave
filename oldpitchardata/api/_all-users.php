<?php
header("Content-type:application/json");
include('../conn.php');

$response = array();
//$demo=mysqli_connect("localhost","arvrinte_Yashgup","_pmx4vNuySob","arvrinte_project");

//$demo=mysqli_connect("host","makerite_motivat","password12345","makerite_motivation");
if(!$conn)
{
  die("could not connect:".mysqli_error());
}

$result=mysqli_query($conn,"SELECT * FROM tbl_users ORDER BY reg_time DESC");

//$result=mysqli_query($demo,"SELECT `bus_title`, `bus_description`, `bus_latitude`, `bus_longitude`, `bus_contact`, `bus_logo` FROM  business WHERE bus_status = 1")/user_profile_pic;

$response["Users"] = array();
$url="https://arvrintedu.com/uploads/user_display_pic/";
while ($row=mysqli_fetch_assoc($result)) {
   $output=$row;
   //var_dump($row);
 /*verify,firstname,lastname,fullname,occupation,email,password,country,user_type*/
array_push($response["Users"],array('id'=>$output['id'],'verify'=>$output['verify'],'firstname'=>$output['firstname'],'lastname'=>$output['lastname'],'fullname'=>$output['fullname'],'display_pic'=>$url.$output['display_pic'],
'occupation'=>$output['occupation'],'email'=>$output['email'],'password'=>$output['password'],'country'=>$output['country'],
'token'=>$output['token'],'tokenExpire'=>$output['tokenExpire'],'reg_time'=>$output['reg_time'],'user_type'=>$output['user_type'],));
}
echo(json_encode($response,JSON_PRETTY_PRINT));

?>


