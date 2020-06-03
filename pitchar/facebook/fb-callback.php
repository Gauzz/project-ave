<?php
session_start();
    require_once "config.php";

	$conn=mysqli_connect("localhost","pitchar_project","111444777aaa@@@","pitchar_project");


	try {
		$accessToken = $helper->getAccessToken();
	} catch (\Facebook\Exceptions\FacebookResponseException $e) {
		echo "Response Exception: " . $e->getMessage();
		exit();
	} catch (\Facebook\Exceptions\FacebookSDKException $e) {
		echo "SDK Exception: " . $e->getMessage();
		exit();
	}

	if (!$accessToken) {
		header('Location: ../login.php');
		exit();
	}

	$oAuth2Client = $FB->getOAuth2Client();
	if (!$accessToken->isLongLived())
		$accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);

	$response = $FB->get("/me?fields=id, first_name, last_name, email, picture.type(large)", $accessToken);
	$userDatafb = $response->getGraphNode()->asArray();
	$_SESSION['userDatafb'] = $userDatafb;
	$_SESSION['access_token'] = (string) $accessToken;
	$fname=$_SESSION['userDatafb']['first_name'];
	$lname=$_SESSION['userDatafb']['last_name'];
	$email=$_SESSION['userDatafb']['email'];
	$getKey=uniqid('fb_');
	$vali=mysqli_query($conn,"SELECT * FROM facebook_users WHERE email='$email' AND procced='1'");
	$cnt=mysqli_num_rows($vali);
	if($cnt==0){
	    $query=mysqli_query($conn,"INSERT INTO facebook_users(firstname,lastname,fullname,email,registration_time,procced,uniq_key)VALUES('$fname','$lname','$fname $lname','$email',NOW(),'0','$getKey')");
    	if($query==1){
    	$_SESSION["uniqKey"]=$getKey;
        $_SESSION['access_token'] = (string) $accessToken;
    	    //$_SESSION["new_profile"]=$email;
    	    header('Location:../create-profile.php');
    	    
    	}
	}
	
	if($cnt==1){
	    $_SESSION['login'] = 1;
	   	$_SESSION['EMail']=$email;
	    header("Location:../dashboard.php");
	}
	    
	exit();
?>