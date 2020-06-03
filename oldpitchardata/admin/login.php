<?php
require_once '../includes/functions.php';


if (isset($_POST["check"])) {

	$email=mysqli_real_escape_string($conn,$_POST["email"]);

	$password=mysqli_real_escape_string($conn,$_POST["pass"]);

 	$query=mysqli_query($conn,"SELECT * FROM admin WHERE email='$email'");

 	if (mysqli_num_rows($query)=='1') { 

 		$getData=mysqli_fetch_array($query);

 		$dbpass=$getData["password"];

 		if (password_verify($password,$dbpass)) {

 			$_SESSION["admin"]=$getData;

 			exit(json_encode(array('response' =>array("code" =>'1', "msg" => 'Login Success!'))));

 		}

 		else{

 			exit(json_encode(array('response' =>array("code" => '0', "msg" => 'Invalid Password!'))));

 		}

 	}

 	else{

 			exit(json_encode(array('response' =>array("code" => '00', "msg" => 'Invalid Email!'))));

 	}

exit();

}

if (isset($_SESSION["admin"])) {

	header("Location:index.php");

}

?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta content="width=device-width, initial-scale=1" name="viewport" />

    <meta name="description" content="Responsive Admin Template" />

    <meta name="author" content="SmartUniversity" />

    <title>Admin Login | PITCHAR.IO Admin panel</title>

    <!-- google font -->

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css" />

	<!-- icons -->

    <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

	<link rel="stylesheet" href="assets/plugins/iconic/css/material-design-iconic-font.min.css">

    <!-- bootstrap -->

	<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <!-- style -->

    <link rel="stylesheet" href="assets/css/pages/extra_pages.css">

	<!-- favicon -->

    <link rel="shortcut icon" href="assets/img/favicon.ico" /> 

</head>

<body>

    <div class="limiter">

		<div class="container-login100 page-background">

			<div class="wrap-login100">

				<form class="login100-form validate-form" id="formvalidate">

					<span class="login100-form-logo">

						<i class="zmdi zmdi-flower"></i>

					</span>

					<span class="login100-form-title p-b-34 p-t-27">

						Log in

					</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter Email">

						<input class="input100" autocomplete="off" type="email" name="email" placeholder="Email">

						<span class="focus-input100" data-placeholder="&#xf207;"></span>

					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">

						<input class="input100" type="password" name="pass" placeholder="Password">

						<span class="focus-input100" data-placeholder="&#xf191;"></span>

					</div><!-- 

					<div class="contact100-form-checkbox">

						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">

						<label class="label-checkbox100" for="ckb1">

							Remember me

						</label>

						

					</div> -->

					<input type="hidden" name="check" value="checked">

					<div class="container-login100-form-btn">

						<button class="login100-form-btn">

							Login

						</button>

					</div>

					<!-- <div class="text-center p-t-90">

						<a class="txt1" href="#">

							Forgot Password?

						</a>

					</div> -->

				</form>

			</div>

		</div>

	</div>

    <!-- start js include path -->

    <script src="assets/plugins/jquery/jquery.min.js" ></script>

    <!-- bootstrap -->

    <script src="assets/plugins/bootstrap/js/bootstrap.min.js" ></script>

    <script src="assets/js/pages/extra_pages/login.js" ></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- end js include path -->

    <script type="text/javascript">

    $(document).ready(function (e) {

	    $('#formvalidate').on('submit',(function(e) {

	        e.preventDefault();

	        var formData = new FormData(this);

	        $(".login100-form-btn").html("Validating..");

	        $.ajax({

	            type:'POST',

	            url: 'login.php',

	            data:formData,

	            cache:false,

	            dataType:'json',

	            contentType: false,

	            processData: false,

	            success:function(data){

	               if (data.response.code=='1') {

	               	$(".login100-form-btn").html("Redirecting..");

	               	setTimeout(function(){ window.location.href="index.php"; }, 3000);		

	               }

	               if (data.response.code=="00") {

	               		swal("Oh Snap","This Is an Invalid Email!","warning");

	               		$(".login100-form-btn").html("Login");

	               }

	               if (data.response.code=='0') {

	               		swal("Oh Snap","You Entered a Wrong Password","error");

	               	$(".login100-form-btn").html("Login");

	               }

	            },

	            error: function(data){

	                console.log("error");

	                console.log(data);

	            }

	        });

	    }));

});

    </script>

</body>
</html>