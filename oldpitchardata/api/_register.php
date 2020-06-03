<?php 

header('Content-Type: application/json');

include('../conn.php');



	if (isset($_POST["submit"])) {

	$firstname=$_POST['firstname'];

	$lastname=$_POST['lastname'];

	$fname=$firstname." ".$lastname;

	$occupation=$_POST['occupation'];

	$email=$_POST['email'];

    $userpassword=$_POST['password'];

    $password = password_hash($userpassword, PASSWORD_BCRYPT);

	$country=$_POST['country'];


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
    $token = generateRandomString(15);


	$validatate=mysqli_query($conn,"SELECT * FROM tbl_users WHERE email='$email'");

	$getValidateCount=mysqli_num_rows($validatate);

	if ($getValidateCount>=1) {

		$response['message']="Email Already Register";

		$response['msg_code']=2;

	}



	if ($getValidateCount==0){

        $query=mysqli_query($conn,"INSERT INTO tbl_users(verify,firstname,lastname,fullname,occupation,email,password,country,authtoken,user_type)VALUES('0','$firstname','$lastname',' $fname','$occupation','$email','$password','$country','$token','manual')");



        if ($query) {

        	//$response['message']="User register Successfully";

			//$response['msg_code']=11; 

   

            $decodemail=base64_encode($email);



             //$html_Temp="<h2>Thanks For Joining Us!</h2><br><br><a href='https://arvrintedu.com/login.php?em=$decodemail&obj=true'>Click Here To Verify</a>";

            //email temp

             include '../assets/_php/verifyPassword.php';



            require_once ('../SendGrid-Starter-Kit-master/SendGrid-API/vendor/autoload.php'); 

              

            $email_receipients = $email;

              /*Post Data*/

              /*Content*/

              $from = new SendGrid\Email("arvrintedu", "Team@arvrintedu.com");

              $subject = "Welcome to AR VR Platform";

                   /*Send the mail*/

              $content = new SendGrid\Content("text/html",$verifyEmailTemp);

              $to = new SendGrid\Email("arvrintedu",$email);

              $mail = new SendGrid\Mail($from, $subject, $to, $content);

              $apiKey = ('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');

              $sg = new \SendGrid($apiKey);

            

              /*Response*/

              $responseEmail = $sg->client->mail()->send()->post($mail);



              if($responseEmail){          

              		$response['message']="Email Sent Success Please verify to Logged in";

					$response['msg_code']=1; 

                }

            

 

             

        }

      }

	}

	else{

		$response['message']="Invalid Request.";

		$response['msg_code']=0; 



	}



	echo json_encode(array('register' => [$response]));

/*-------------------------------------------Register End Here--------------------------------------------------------*/

 

 ?>