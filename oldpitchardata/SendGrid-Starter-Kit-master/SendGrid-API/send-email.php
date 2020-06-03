<?php
	ob_start();
	session_start();
	/*SendGrid Library*/
	require_once ('vendor/autoload.php');
    echo $arr=$_SESSION["edata"];
    
    $count=count($arr);
    
	switch ($count) {
    case "1":
          $no="0";
        break;
    case "2":
          $no="1";
        break;
    case "3":
          $no="2";
        break;
    case "4":
          $no="3";
        break;
    case "5":
          $no="4";

    case "6":
          $no="5";
        break;
    case "7":
          $no="6";
        break;
    case "8":
          $no="7";
        break;
    case "9":
          $no="8";
        break;
    case "10":
          $no="9";
        break;
}

//echo $no;

 if($no=="0"){
 	$emails=$arr[0];
 }

  if($no=="1"){
 	$emails=$arr[0].",".$arr[1];
 }

 if($no=="2"){
 	  $emails= $arr[0].",".$arr[1].",".$arr[2];
 }

 if($no=="3"){
 	  $emails= $arr[0].",".$arr[1].",".$arr[2].",".$arr[3];
 }

 if($no=="4"){
 	  $emails= $arr[0].",".$arr[1].",".$arr[2].",".$arr[3].",".$arr[4];
 }

 if($no=="5"){
 	  $emails= $arr[0].",".$arr[1].",".$arr[2].",".$arr[3].",".$arr[4].",".$arr[5];
 }

 if($no=="6"){
 	  $emails= $arr[0].",".$arr[1].",".$arr[2].",".$arr[3].",".$arr[4].",".$arr[5].",".$arr[6];
 }

 if($no=="7"){
 	  $emails= $arr[0].",".$arr[1].",".$arr[2].",".$arr[3].",".$arr[4].",".$arr[5].",".$arr[6].",".$arr[7];
 }

 if($no=="8"){
 	  $emails= $arr[0].",".$arr[1].",".$arr[2].",".$arr[3].",".$arr[4].",".$arr[5].",".$arr[6].",".$arr[7].",".$arr[8];
 }

 if($no=="9"){
 	  $emails= $arr[0].",".$arr[1].",".$arr[2].",".$arr[3].",".$arr[4].",".$arr[5].",".$arr[6].",".$arr[7].",".$arr[8].",".$arr[9];
 }

 if($no=="10"){
 	  $emails= $arr[0].",".$arr[1].",".$arr[2].",".$arr[3].",".$arr[4].",".$arr[5].",".$arr[6].",".$arr[7].",".$arr[8].",".$arr[9].",".$arr[10];
 }
 
 //echo $emails;
//$email_receipients = "yashgupta.rock9@gmail.com,moiztandawala52@gmail.com";
$email_receipients =$emails;
$arr_value =  explode(',', $email_receipients);
	/*Post Data*/
	/*Content*/
	$from = new SendGrid\Email("arvrintedu", "info@arvrintedu.com");
	$subject = "New Mail";


$response="";
	foreach($arr_value as $email)
	{
			 /*Send the mail*/
			 	$content = new SendGrid\Content("text/html", "<h2>Hello World</h2>");
	$to = new SendGrid\Email("arvrintedu",$email);
	$mail = new SendGrid\Mail($from, $subject, $to, $content);
	$apiKey = ('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');
	$sg = new \SendGrid($apiKey);

	/*Response*/
	$response = $sg->client->mail()->send()->post($mail);

	}
	if($response){
	unset($_SESSION['edata']);
	$_SESSION["mailsent"]="1";
	header("Location:../../Student_Admin/index.php");
	}
	?>

	<!--Print the response-->
	<pre>
		<?php
		//var_dump($response);
		?>
	</pre>
