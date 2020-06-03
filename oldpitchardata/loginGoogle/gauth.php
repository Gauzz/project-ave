<?php
ob_start();
session_start();
$conn=mysqli_connect("localhost","pitchar_project","111444777aaa@@@","pitchar_project");
require_once('settings.php');
require_once('google-login-api.php');

// Google passes a parameter 'code' in the Redirect Url
if(isset($_GET['code'])) {
	try {
		$gapi = new GoogleLoginApi();
		
		// Get the access token 
		$data = $gapi->GetAccessToken(CLIENT_ID, CLIENT_REDIRECT_URL, CLIENT_SECRET, $_GET['code']);
		
		// Get user information
		$user_info = $gapi->GetUserProfileInfo($data['access_token']);

		echo '<pre>';print_r($user_info); echo '</pre>';

		// Now that the user is logged in you may want to start some session variables
		$_SESSION['logged_in'] = 1;
		$_SESSION["userData"]=$user_info;
        $email=$user_info['emails']['0']['value'];
        $googledatafname=$_SESSION['userData']['name']['givenName'];
   		$googledatalname=$_SESSION['userData']['name']['familyName'];
        $getKey=uniqid('gl_');
             
		// You may now want to redirect the user to the home page of your website
		$validate=mysqli_query($conn,"SELECT * FROM google WHERE email='$email' AND procced='1'");
		$count=mysqli_num_rows($validate);
		if($count==0){
			$query=mysqli_query($conn,"INSERT INTO google(firstname,lastname,fullname,occupation,email,country,procced,uniq_key)VALUES('$googledatafname','$googledatalname','$googledatafname $googledatalname',' ','$email',' ','0','$getKey')");
			if($query){
  
	                 $_SESSION['login'] = "1";
	                 $_SESSION['uniqKey']=$getKey;
	                header("Location:../create-profile.php");
				}
			else{
				header("Location:../login.php");
			}	
			
		}
		if($count>0){
			$_SESSION["EMail"]=$email;
			$_SESSION['login'] = "1";
			header("Location:../dashboard.php");
		}
                


	}
	catch(Exception $e) {
		echo $e->getMessage();
		exit();
	}
}
	 
?>

 