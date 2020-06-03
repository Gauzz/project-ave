<?php

require '../includes/functions.php';
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
		 $image = $user_info["image"]["url"];
		 $email = $user_info["emails"]["0"]["value"];
		 $lastname = $user_info["name"]["familyName"];
		 $firstname = $user_info["name"]["givenName"];
		 $fullname = $user_info["displayName"];
		 $socialId = $user_info["id"];
		 $rand = rand();
		 file_put_contents('../images/customer'.$rand.'.png',file_get_contents($image));

		$query = saveData("customers",["firstname" => $firstname,"lastname" => $lastname,"fullname" => $fullname,"email" => $email,"token" => token(12),"profile_image" => $rand.'.png',"social_id" => $socialId,"login_with" => 'google' ]);
		if ($query) {
			echo "Success";
		}

		// Now that the user is logged in you may want to start some session variables
		$_SESSION['logged_in'] = 1;

		// You may now want to redirect the user to the home page of your website
		// header('Location: home.php');
	}
	catch(Exception $e) {
		echo $e->getMessage();
		exit();
	}
}

?>