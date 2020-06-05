<?php
include '../includes/functions.php';
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
?>
<!doctype html>
<html class="no-js" lang="">
<!-- Mirrored from affixtheme.com/html/xmee/demo/login-7.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 09 Apr 2020 18:28:03 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Pitchar</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="shortcut icon" href="../img1/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="css/fontawesome-all.min.css">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="font/flaticon.css">
    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->     
    <section class="fxt-template-animation fxt-template-layout7 has-animation" data-bg-image="img/figure/bg7-l.png">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-xl-6 col-lg-7 col-sm-12 col-12 fxt-bg-color">
                    <div class="fxt-content">
                        <div class="fxt-header">
                            <a href="login.php" class="fxt-logo">Pitchar</a>                        
                            <p>Login into your pages account</p>
                        </div>
                        <form method="POST" id="login">                            
                        <div class="fxt-form"> 
                            
                                <div class="form-group"> 
                                    <div class="fxt-transformY-50 fxt-transition-delay-1">                                              
                                        <input type="email" id="email" class="form-control" name="email" placeholder="Email" required="required">
                                    </div>
                                </div>
                                <div class="form-group">  
                                    <div class="fxt-transformY-50 fxt-transition-delay-2">                                              
                                        <input id="password" type="password" class="form-control" name="password" placeholder="Password" required="required">
                                        <i toggle="#password" class="fa fa-fw fa-eye toggle-password field-icon"></i>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="fxt-transformY-50 fxt-transition-delay-3">  
                                        <div class="fxt-checkbox-area">
                                            <!--<div class="checkbox">-->
                                            <!--    <input id="checkbox1" type="checkbox">-->
                                            <!--    <label for="checkbox1">Keep me logged in</label>-->
                                            <!--</div>-->
                                            <a href="forgot-password.php" class="switcher-text">Forgot Password</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="fxt-transformY-50 fxt-transition-delay-4"> 
                                         <input type="hidden" name="login_user" value="true">
                                        <button type="submit" class="fxt-btn-fill btnSubmit">Log in</button>
                                    </div>
                                </div>
                                            
                        </div>
                        </form> 
                        <div class="fxt-style-line"> 
                            <div class="fxt-transformY-50 fxt-transition-delay-5">                                
                                <h3>Or Login With</h3> 
                            </div>
                        </div>
                        <ul class="fxt-socials">
                            <li class="fxt-google">
                                <div class="fxt-transformY-50 fxt-transition-delay-6">  
                                <a href="#" title="google"><i class="fab fa-google-plus-g"></i><span>Google +</span></a>
                                </div>
                            </li>                                    
                            <li class="fxt-twitter"><div class="fxt-transformY-50 fxt-transition-delay-7">  
                                <a href="#" title="twitter"><i class="fab fa-twitter"></i><span>Twitter</span></a>
                                </div>
                            </li>
                            <li class="fxt-facebook"><div class="fxt-transformY-50 fxt-transition-delay-8">  
                                <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i><span>Facebook</span></a>
                                </div>
                            </li>                                    
                        </ul>
                        <div class="fxt-footer">
                            <div class="fxt-transformY-50 fxt-transition-delay-9">  
                                <p>Don't have an account?<a href="register.php" class="switcher-text2">Register</a></p>
                            </div> 
                        </div> 
                    </div>
                </div>                    
            </div>
        </div>
    </section>    
    <!-- jquery-->
    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- Popper js -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Imagesloaded js -->
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <!-- Validator js -->
    <script src="js/validator.min.js"></script>
    <!-- Custom Js -->
    <script src="js/main.js"></script>
</body>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script> 
      <script type="text/javascript">       
$("#login").on('submit',function(event) {
event.preventDefault(); 
var data=new FormData(this);
$(".btnSubmit").html("Redirecting..");
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
  $(".btnSubmit").html("Redirecting..");
window.location='../pitchar/dashboard.php';
}
if (data.response.code=='0') {
swal("Oh Snap",data.response.msg,"error");
$(".btnSubmit").html("login");
}
})
.complete(function(data) {
console.log(data);
});
});  

      </script>
<!-- Mirrored from affixtheme.com/html/xmee/demo/login-7.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 09 Apr 2020 18:28:11 GMT -->
</html>