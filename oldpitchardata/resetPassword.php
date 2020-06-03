 <?php
    ob_start();

	function generateNewString($len = 10) {
		$token = "poiuztrewqasdfghjklmnbvcxy1234567890";
		$token = str_shuffle($token);
		$token = substr($token, 0, $len);

		return $token;
	}

	function redirectToLoginPage() {
		header('Location:login.php');
		exit();
	}

	if (isset($_GET['email']) && isset($_GET['token'])) {
		include 'conn.php';
		$email = mysqli_real_escape_string($conn,$_GET['email']);
		$token = mysqli_real_escape_string($conn,$_GET['token']);

 		$sql = $conn->query("SELECT id FROM tbl_users WHERE
			email='$email' AND token='$token' AND token<>'' AND tokenExpire > NOW()
		");

		if ($sql->num_rows > 0) { ?>
							<!DOCTYPE html>
		<html>
		<head>
			<title>Set New Password</title>
			      <!-- Tell the browser to be responsive to screen width -->
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
		</head>
		<body>
				<div class="container mt-5">
		<div class="col-md-6 offset-md-3">
			<div class="card">
				<div class="card-header">Create a New Password</div>
				<div class="card-body">
				   <form method="post">
			        	<input type="password" class="form-control mb-3" name="newpassword" placeholder="New Password">
			        	<input type="password" class="form-control" name="confirm" placeholder="Confirm Password">
				    	<center><button type="submit" name="password" class="btn btn-primary mt-3">Set Password</button></center>
				    </form>
				</div>
			</div>
 		</div>

		</div>
		</body>
		</html>
			
<?php  		
			if (isset($_POST["password"])) {
				$getpassword=$_POST["newpassword"];
				$getconfirm=$_POST["confirm"];

				if ($getpassword==$getconfirm) {
					
				
				$newPasswordEncrypted = password_hash($getpassword, PASSWORD_BCRYPT);
				 $conn->query("UPDATE tbl_users SET token='', password = '$newPasswordEncrypted',user_type= 'mannual'
					WHERE email='$email'
					");  ?>
				 <div class="col-md-4 offset-4  mt-3 alert alert-dismissible alert-success">
  					<strong>Success! </strong> Passwrod Reset Successfully <a href="login.php" class="alert-link">Cick here to Login</a>.
				 </div>
<?
		} else{ ?>
				 <div class="col-md-4 offset-4 mt-3 alert alert-dismissible alert-danger">
  					<strong>Oops! </strong> Password Not Matched Please try Again.
				 </div>


	<?php	}


			}

			
		

			
		} else
			redirectToLoginPage();
	} else {
		redirectToLoginPage();
	}
?>


