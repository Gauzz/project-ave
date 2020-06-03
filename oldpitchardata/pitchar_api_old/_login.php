<?php 

header('Content-Type: application/json');

include('../conn.php');



if (isset($_POST["submit"])) {

	$mail=$_POST["email"];

    $pass=$_POST["password"];

    $verify=mysqli_query($conn,"SELECT * FROM tbl_users WHERE email='$mail'");

    $getTotalNo=mysqli_num_rows($verify);

    if ($getTotalNo>0) {

    	$verifypass=mysqli_fetch_assoc($verify);

    	$dpass=$verifypass["password"];

    	$acc_status=$verifypass["verify"];

    	if ($acc_status=='1') {

    		 if (password_verify($pass, $dpass)) {
    		 	$response['message']="Login Success";
				$response['msg_code']=1; 
			//	$response['data']=$verifypass;
                if (!empty($verifypass['display_pic'])) {
                    $imageUrl='https://arvrintedu.com/uploads/user_profile_pic/'.$verifypass['display_pic'];
                  
                }
                else{
                    $imageUrl=null;
                }
                
				$response['data']="".$verifypass['id'].' ,'.$verifypass['firstname'].' ,'. $verifypass['lastname'].' , '.$verifypass['country'].','. $verifypass['email'] .', '. $verifypass['occupation'].','.$imageUrl;
    		 }

    		 else{

    		 	$response['message']="Password Not Matched";

				$response['msg_code']=0;

    		 }

    	}

    	else{

    		$response['message']="Account Not Verified";

			$response['msg_code']=2; 

    	}

    }

    else{

    	$response['message']="Credentials Not Matched";

		$response['msg_code']=3; 

    }

echo json_encode(array('login' => [$response]));

}



?>