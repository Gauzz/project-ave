<?php

header("Content-type:application/json");

include('../conn.php');





	$students=array(); 

	if(!$conn)

{

  die("could not connect:".mysqli_error());

}

	$students["Students"] = array();	

	$query=mysqli_query($conn,"SELECT * FROM tbl_users WHERE occupation='student' ORDER BY reg_time DESC");

//$url="https://arvrintedu.com/uploads/user_display_pic/";




while($row=mysqli_fetch_assoc($query)) {

	$output=$row;

	$output=$row;
	
	
	if (!empty($output["image"])) {

	$image = "https://arvrintedu.com/uploads/user_display_pic/".$output["image"];

}else{
    $image =NULL;
}

array_push($students["Students"],array('id'=>$output['id'],'verify'=>$output['verify'],'firstname'=>$output['firstname'],'lastname'=>$output['lastname'],'fullname'=>$output['fullname'],'display_pic'=> $image,

'occupation'=>$output['occupation'],'email'=>$output['email'],'password'=>$output['password'],'country'=>$output['country'],

'token'=>$output['token'],'tokenExpire'=>$output['tokenExpire'],'reg_time'=>$output['reg_time'],'user_type'=>$output['user_type'],));

}

echo(json_encode($students,JSON_PRETTY_PRINT));



?>