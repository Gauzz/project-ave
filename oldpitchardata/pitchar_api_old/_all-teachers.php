<?php
header("Content-type:application/json");
include('../conn.php');


	$teachers=array(); 
	if(!$conn)
{
  die("could not connect:".mysqli_error());
}
	$teachers["Teachers"] = array();	
	$query=mysqli_query($conn,"SELECT * FROM tbl_users WHERE occupation='teacher' ORDER BY reg_time DESC");
$url="https://arvrintedu.com/uploads/user_display_pic/";

while($row=mysqli_fetch_assoc($query)) {
array_push($teachers["Teachers"],array('id'=>$row['id'],'verify'=>$row['verify'],'firstname'=>$row['firstname'],'lastname'=>$row['lastname'],'fullname'=>$row['fullname'],'display_pic'=>$url.$row['display_pic'],
'occupation'=>$row['occupation'],'email'=>$row['email'],'password'=>$row['password'],'country'=>$row['country'],
'token'=>$row['token'],'tokenExpire'=>$row['tokenExpire'],'reg_time'=>$row['reg_time'],'user_type'=>$row['user_type'],));
}
echo(json_encode($teachers,JSON_PRETTY_PRINT));

?>