<?php 
header("Content-type:application/json");
include '../conn.php';

if (isset($_REQUEST["submit"])) {
	$emails_array=$_REQUEST["emails"];
	$email=$_REQUEST["tech_email"];
	$gettoken=$_REQUEST["token"];
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
 		# code...
 	mysqli_query($conn,"INSERT INTO share_projects(token,std_id,std_email,std_name,tch_email,tch_id,project_name,project_id,type,date_time)VALUES('$gettoken','Not available','$userEmail','Not available','$email','$user_name','$projectName','$getID','invite',NOW())");

	$from = new SendGrid\Email("pitchar", "Info@pitchar.io");
	$subject = "Invitation";
	$response="";       
		// Sharing Link
		$htmllink="https://pitchar.io/view-project.php?project=$gettoken&type=invite";
		$link=htmlspecialchars($htmllink);
		  /*Send the mail*/
		include '../assets/_php/invitation_email.php';
		$content = new SendGrid\Content("text/html", $email_temp);
		$to = new SendGrid\Email("user",$userEmail);
		$mail = new SendGrid\Mail($from, $subject, $to, $content);
		$apiKey = ('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');
		 $sg = new \SendGrid($apiKey);

                        /*Response*/
 		$response = $sg->client->mail()->send()->post($mail);

}
 		if ($response) {
 			$say['msg']='Invite Send Success';
 			$say["code"]=1;
 		}
 		else{
 			$say["msg"]="Error In Invites";
 			$say["code"]=0;
 		}

}

echo json_encode($say);

?>