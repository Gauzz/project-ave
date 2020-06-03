<?php
ob_start();
// connection to database
include('../includes/functions.php');

// login 

if(isset($_POST["login_user"])){
$email =$_POST['email'];
$password = $_POST['password'];
$queryValidate=select("tbl_users","email='$email'");
$queryValidateEmailS=fetch($queryValidate);
$verify = $queryValidateEmailS["verify"];
if (howMany($queryValidate) > 0) {
    
if ($verify == 1) {
if (password_verify($password,$queryValidateEmailS["password"])) {

$_SESSION["user"]=$queryValidateEmailS;
returnJson(1,"Customers login Successfully!");
}
else{
returnJson(0,"Please Check Password!");
}

}else{
   returnJson(0,"Email Not Found!"); 
}    
}
else{
returnJson(0,"Email Not Found!");
}
}


// Register

if (isset($_POST["register_big"])) {
    if (!empty($_POST["first_name"])) {
$first_name=$_POST["first_name"];
$email=$_POST["email"];
$password=$_POST["password"];
if (filter_var($email,FILTER_VALIDATE_EMAIL) AND !empty($_POST["email"])) {
$queryValidateEmail=select("tbl_users","email='$email'");
if (howMany($queryValidateEmail) == 0) {

if (strlen($password) >= 6) {

    if(strlen($first_name) <= 15)
    {
      $hash=password_hash($password,PASSWORD_BCRYPT);
$data=[
'fullname'  => $first_name,
'email' => $email,
'password'  => $hash,
'token' => token(12),
];
$query=saveData("tbl_users",$data);
if ($query) {
    $selectSession = select("tbl_users","email='$email'");
    $getSession = fetch($selectSession);
$_SESSION["user"]=$getSession;

returnJson(1,"Customer Signup Successfully!");
}
else{
returnJson(0,"Error: While Adding Customer!");
}
}
else {
  returnJson(0,"Name lenght only 15 Character!");

}

}
else{
returnJson(0,"Password Must be 6 Character Long!");
}


}
else{
returnJson(0,"This Email is Already Associated With Another account!");
}
}
else{
returnJson(0,"Please Enter A Valid Email!");
}
}
else{
returnJson(0,"Please Enter All Details!");
}


}

?>
<!DOCTYPE html>
<html lang="en">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Pitcher | Login/Sign up</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Quicksafirst_namend:300,400,500,600,700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/common.css">
    <script src="scripts/jquery-3.4.1.min.js" type="text/javascript"></script>
    <script src="scripts/bootstrap.min.js" type="text/javascript"></script>
  </head>
  <body style="margin:0">
<div class="container-fluid login-container">
            
            <div class="row h-100 login-screen">
                <div class="col-md-5 login-form-1 pt-5">
                    <div class="col-md-12 p-0 text-center">
                        <img height="50" src="https://pngimage.net/wp-content/uploads/2018/06/logo-design-png-transparent-7.png" alt="">
                        <h3 class="mt-3">Welcome Back!!</h3>
                        <p>Don’t have an account? <a href="javascript:void(0)" class="signup-btn">Sign Up Here</a></p>
                    </div>
                    <form method="post" id="login">
                        <div class="form-group">
                            <input type="text" class="form-control" name="email" placeholder="Your Email *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Your Password *" value="" />
                        </div>
                        <div class="form-group">
                              <input type="hidden" name="login_user" value="true">
                            <input type="submit" value="Login" class="login200-form-btn button btnSubmit" value="Login" />
                        </div>
                        <div class="form-group">
                          <a href="#" class="ForgetPwd text-muted float-right">Forget Password?</a>
                        </div>
                        <div class="col-md-12 float-left text-center mb-3 mt-4"> -- Or Login with -- </div>
                        <div class="media-options offset-sm-2 col-sm-8 ">
                          <div class="m-option text-white" style="background: #3578E5">
                            <i class="fa fa-facebook" aria-hidden="true"></i>
                          </div>
                          <div class="m-option text-white" style="background: #00a2f8">
                            <i class="fa fa-twitter"></i>
                          </div>
                          <div class="m-option text-white" style="background:#d93025">
                            <i class="fa fa-google" aria-hidden="true"></i>
                          </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-7 login-form-2" style="background-image:url(https://cdn.dribbble.com/users/48670/screenshots/6112246/floating_ui.jpg)">
                  <div class="float-left bg-translusant title-right-pane">
                    <h3>Start Creating on scapic </h3>
                    <p>Start creating your scape on scapic by creating an account righ away</p>
                  </div>
                </div>
            </div>
            
            
            
            
            <div class="row h-100 signup-screen hidden">
              <div class="col-md-5 login-form-1 pt-5" >
                  <div class="col-md-12 p-0 text-center">
                      <img height="50" src="https://pngimage.net/wp-content/uploads/2018/06/logo-design-png-transparent-7.png" alt="">
                      <h3 class="mt-3">Welcome Back!!</h3>
                      <p>Already have an account? <a href="javascript:void(0)" class="login-btn">Login Here</a></p>
                  </div>
                  <form method="post" id="signup">
                      <div class="form-group">
                          <input type="text" class="form-control" name="first_name" placeholder="Your Name *" value="" />
                      </div>
                      <div class="form-group">
                          <input type="text" class="form-control" name="email" placeholder="Your Email *" value="" />
                      </div>
                      <div class="form-group">
                          <input type="password" class="form-control" name="password" placeholder="Your Password *" value="" />
                      </div>
                      <div class="form-group">
                            <input type="hidden" name="register_big" value="true">
                          <input type="submit" value="Sign Up" class="login200-form-btn2 button btnSubmit" value="Sign up" />
                      </div>
                      <div class="col-md-12 float-left text-center mb-3 mt-4"> -- Or Login with -- </div>
                      <div class="media-options offset-sm-2 col-sm-8 ">
                        <div class="m-option text-white" style="background: #3578E5">
                          <i class="fa fa-facebook" aria-hidden="true"></i>
                        </div>
                        <div class="m-option text-white" style="background: #00a2f8">
                          <i class="fa fa-twitter"></i>
                        </div>
                        <div class="m-option text-white" style="background:#d93025">
                          <i class="fa fa-google" aria-hidden="true"></i>
                        </div>
                      </div>
                  </form>
              </div>
                <div class="col-md-7 login-form-2"style="background-image:url(https://cdn.dribbble.com/users/280617/screenshots/6377888/table3.jpg)">
                  <div class="float-left bg-translusant title-right-pane">
                    <h3>Start Creating on scapic </h3>
                    <p>Start creating your scape on scapic by creating an account righ away</p>
                  </div>
                </div>
            </div>
            <div class="row h-100 fogot-pswrd hidden">
              <div class="col-md-5 login-form-1 pt-5" >
                  <div class="col-md-12 p-0 text-center">
                      <img height="50" src="https://pngimage.net/wp-content/uploads/2018/06/logo-design-png-transparent-7.png" alt="">
                      <h3 class="mt-3">Password Reset!!</h3>
                      <p>Enter your Scapic email address that you <br> used to register.
                        <a href="javascript:void(0)" class="login-btn">Login Here</a></p>
                  </div>
                  <form class="form-frgt-pswrd">
                      <div class="form-group">
                          <input type="text" class="form-control" placeholder="Your Email *" value="" />
                      </div>
                      <div class="form-group">
                          <div class="btnSubmit reset-password">Reset Password</div>
                      </div>
                  </form>
                  <div class="text-center mail-sent mt-5"><img class="mr-3" height="42" src="https://www.tcsfuel.com/wp-content/themes/tcsfuel/images/icons/checkbox.png" alt="">Please check your inbox!</div>
              </div>
                <div class="col-md-7 login-form-2"style="background-image:url(https://miro.medium.com/max/5032/1*lNBlbzdiKukH_GBNdQrFog.png)">
                  <div class="float-left bg-translusant title-right-pane">
                    <h3>Start Creating on scapic </h3>
                    <p>Start creating your scape on scapic by creating an account righ away</p>
                  </div>
                </div>
            </div>
        </div>
      </body>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script> 
      <script>
   
      
      
        $(document).ready(function(){
          $('.signup-btn').click(function(){
            console.log('hey!!!!');
            $('.fogot-pswrd, .login-screen').addClass('hidden');
            $('.signup-screen').removeClass('hidden');
          });
          $('.login-btn').click(function(){
            $('.signup-screen, .forgot-pswrd').addClass('hidden');
            $('.mail-sent').hide()
            $('.login-screen,.form-frgt-pswrd').removeClass('hidden');
          });
          $('.ForgetPwd').click(function(){
            $('.signup-screen,.login-screen').addClass('hidden');
            $('.fogot-pswrd').removeClass('hidden');
          });
          $('.reset-password').click(function(){
            $('.form-frgt-pswrd').addClass('hidden');
            $('.mail-sent').show();
          });
        });
        
        
$("#login").on('submit',function(event) {
event.preventDefault(); 
var data=new FormData(this);
$(".login200-form-btn").html("Redirecting..");
$.ajax({
type:'POST',
url: 'login.php',
data:data,
dataType:'json',
contentType: false,
processData: false,
cache:false
})
.done(function(data) {
if (data.response.code=='1') {
  $(".login200-form-btn").html("Redirecting..");
window.location='dashboard.php';
}
if (data.response.code=='0') {
swal("Oh Snap",data.response.msg,"error");
}
})
.complete(function(data) {
console.log(data);
});
});   


$("#signup").on('submit',function(event) {
event.preventDefault(); 
var data=new FormData(this);

$(".login100-form-btn2").html("Validating..");

$.ajax({
type:'POST',
url: 'login.php',
data:data,
dataType:'json',
contentType: false,
processData: false,
cache:false
})
.done(function(data) {
if (data.response.code=='1') {
$(".login100-form-btn2").html("Validating..");
swal("Sign Up!",data.response.msg,"success");
setTimeout(function(){
window.location='login.php'; 
},3000);
}
if (data.response.code=='0') {
swal("Oh Snap",data.response.msg,"error");
}
})
.fail(function(data) {
console.log(data);
})
.complete(function(data) {
console.log(data);
});
});

      </script>
      </html>
