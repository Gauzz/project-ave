<?php 

	header("Content-type:application/json");

	include '../conn.php';



	function generateNewString($len = 6) {

		$token = "1234567890";

		$token = str_shuffle($token);

		$token = substr($token, 0, $len);

		return $token;

	}



 



    if(isset($_POST["submit"])){

    $email=$_POST["email"];   

    $main=mysqli_query($conn,"SELECT * FROM tbl_users WHERE email='$email'");

    $getuserdetails=mysqli_fetch_array($main);

    $getfname=$getuserdetails["firstname"];

    $rows=mysqli_num_rows($main);

    

    if($rows > 0){

      

        $token = generateNewString();

        mysqli_query($conn,"UPDATE tbl_users SET token='$token', 

                      tokenExpire=DATE_ADD(NOW(), INTERVAL 5 MINUTE)

                      WHERE email='$email'");    



           include '../assets/_php/reset-password-androidMail.php';

	       require_once ('../SendGrid-Starter-Kit-master/SendGrid-API/vendor/autoload.php'); 



            	$from = new SendGrid\Email("arvrintedu", "Team@arvrintedu.com");

            	$subject = "Tap24ARVR Change Password";

            	$content = new SendGrid\Content("text/html",$verifyEmailTemp);

            	$to = new SendGrid\Email($getfname,$email);

            	$mail = new SendGrid\Mail($from, $subject, $to, $content);

            	$apiKey = ('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');

            	$sg = new \SendGrid($apiKey);

            	/*Response*/

            	$response = $sg->client->mail()->send()->post($mail);

            	if ($response) {

            	//	$say["msg"]="Email Sent Success";

            	//	$say["code"]=1;

                  //  $say["otp"]=$token;
                    
                    echo "sucess";

            	}

            	else{

            	//	$say["msg"]="Something Went Wrong Email Not Sent!";

            	//	$say["code"]=0;
            	
            	
            	echo "Something Went Wrong Email Not Sent!";

            	}



	}

	

	else{ 

		//$say["msg"]="There is no Account Associated With This Email!";

	//	$say["code"]=2;
	
	echo "There is no Account Associated With This Email!";

	}

    

        

}



//echo json_encode(array('response' => $say ));

?>

