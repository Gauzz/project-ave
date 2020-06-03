<?php
require('http.php');
require('oauth_client.php');
require('config.php');
//include '../conn.php';

if ($_GET["oauth_problem"] <> "") {
  // in case if user cancel the login. redirect back to home page.
  $_SESSION["e_msg"] = $_GET["oauth_problem"];
  header("location:../login.php");
  exit;
}

$client = new oauth_client_class;


$client->debug = false;
$client->debug_http = true;
$client->redirect_uri = REDIRECT_URL;

$client->client_id = API_KEY;
$application_line = __LINE__;
$client->client_secret = SECRET_KEY;

if (strlen($client->client_id) == 0 || strlen($client->client_secret) == 0)
  die('Please go to LinkedIn Apps page https://www.linkedin.com/secure/developer?newapp= , '.
			'create an application, and in the line '.$application_line.
			' set the client_id to Consumer key and client_secret with Consumer secret. '.
			'The Callback URL must be '.$client->redirect_uri).' Make sure you enable the '.
			'necessary permissions to execute the API calls your application needs.';

/* API permissions
 */
$client->scope = SCOPE;
if (($success = $client->Initialize())) {
  if (($success = $client->Process())) {
    if (strlen($client->authorization_error)) {
      $client->error = $client->authorization_error;
      $success = false;
    } elseif (strlen($client->access_token)) {//'https://api.linkedin.com/v2/me?projection=(id,firstName,lastName,profilePicture(displayImage~:playableStreams))'
      $success = $client->CallAPI('http://api.linkedin.com/v1/people/~:(id,email-address,first-name,last-name,picture-url,public-profile-url,formatted-name)'
					, 
					'GET', array(
						'format'=>'json'
					), array('FailOnAccessError'=>true), $user);
    }
  }
  $success = $client->Finalize($success);
}
if ($client->exit) exit;
if ($success) {
  // Now check if user exist with same email ID
  $sql = "SELECT COUNT(*) AS count from linkedin where email = :email_id AND procced='1'";
  try {
    $stmt = $DB->prepare($sql);
    $stmt->bindValue(":email_id", $user->emailAddress);
    $stmt->execute();
    $result = $stmt->fetchAll();

    if ($result[0]["count"] > 0) {
      // User Exist 

      $_SESSION["name"] = $user->formattedName;
      $_SESSION["email"] = $user->emailAddress;
      $_SESSION["new_user"] = "no";
      $_SESSION["login"]="1";
      $_SESSION['EMail']=$user->emailAddress;
       header("Location:../dashboard.php");
    } else {
       $getKey=uniqid('in_');
      // New user, Insert in database
      $sql = "INSERT INTO `linkedin` (`name`, `email`,`procced`,`uniq_key`) VALUES " . "( :name, :email,'0','$getKey')";
      
      $stmt = $DB->prepare($sql);
      $stmt->bindValue(":name", $user->formattedName);
      $stmt->bindValue(":email", $user->emailAddress);
      $stmt->execute();
      $result = $stmt->rowCount();
      if ($result > 0) {
        //$_SESSION["name"] = $user->formattedName;
        $_SESSION["email"] = $user->emailAddress;
        $_SESSION["new_user"] = "yes";   
        $fnameLname=explode(" ",$user->formattedName);
        $_SESSION["fname"]=$fnameLname[0];
        $_SESSION["lname"]=$fnameLname[1];
        $_SESSION["Linkedin"]="1";
        $_SESSION["uniqKey"]=$getKey;
        header("Location:../create-profile.php");
       
      }
    }
  } catch (Exception $ex) {
    $_SESSION["e_msg"] = $ex->getMessage();
  }

  $_SESSION["user_id"] = $user->id;
} else {
  $_SESSION["e_msg"] = $client->error;
}
    
    
 

exit;
?>