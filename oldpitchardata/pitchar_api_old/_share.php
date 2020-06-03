<?php 

header("Content-type:application/json");

include '../conn.php';



if (isset($_POST["submit"])) {

	$emails_array=$_POST["emails"];

	$email=$_POST["tech_email"];

	$gettoken=$_POST["token"];

	$queryForDetails=mysqli_query($conn,"SELECT * FROM tbl_users WHERE email='$email'");

	$details=mysqli_fetch_array($queryForDetails);

 	$user_name=$details["fullname"];

 	require_once ('../SendGrid-Starter-Kit-master/SendGrid-API/vendor/autoload.php');

 	$rec=explode(',',$emails_array);



 	$fetchProjectQuery=mysqli_query($conn,"SELECT * FROM tbl_std_project WHERE token='$gettoken'");

 	$fetchProject=mysqli_fetch_array($fetchProjectQuery);

 	$projectName=$fetchProject["project_name"];

 	$getID=$fetchProject["id"];

 	foreach ($rec as $userEmail) {



 	$queryGetUser=mysqli_query($conn,"SELECT * FROM tbl_users WHERE email='$userEmail'");	

 	$fetchStudent=mysqli_fetch_array($queryGetUser);

 	$stdID=$fetchStudent["id"];

 	$fullname=$fetchStudent["fullname"];



 	mysqli_query($conn,"INSERT INTO share_projects(token,std_id,std_email,std_name,tch_email,tch_id,project_name,project_id,type,date_time)VALUES('$gettoken','$stdID','$userEmail','$fullname','$email','$user_name','$projectName','$getID','share',NOW())");



	$from = new SendGrid\Email("arvrintedu", "Info@arvrintedu.com");

	$subject = "Invitation";

	$response="";       

		// Sharing Link

		$htmllink="https://arvrintedu.com/view-project.php?project=$gettoken&type=invite";

		$link=htmlspecialchars($htmllink);

		  /*Send the mail*/

		include '../assets/_php/share_mail.php';

		$content = new SendGrid\Content("text/html", $email_temp);

		$to = new SendGrid\Email("user",$userEmail);

		$mail = new SendGrid\Mail($from, $subject, $to, $content);

		$apiKey = ('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');

		 $sg = new \SendGrid($apiKey);



                        /*Response*/

 		$response = $sg->client->mail()->send()->post($mail);



}

 		if ($response) {

 			//exit(json_encode(["response" => ["code" => "1" ,"Project Share with Mention recipient"]]));
 			echo "sucess";

 		}

 		else{

 		//	exit(json_encode(["response" => ["code" => "0" ,"Falied To  Share Project with Mention recipient"]]));
 		echo "Falied To  Share Project with Mention recipient";
 				 
 		}



}



//echo json_encode($say);



?>