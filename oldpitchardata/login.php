<?php
ob_start();
// connection to database
include('conn.php');

  // getting email of verified user i.e in "em";
    if(isset($_GET["em"])){
         $encode_email=$_GET["em"];
        //Decoding email
         $getVerifiedEmail=base64_decode($encode_email);
        // Checking Mail in user table 
       $checkForEmail=mysqli_query($conn,"SELECT * FROM tbl_users WHERE email='$getVerifiedEmail'");
                 $countForEmail= mysqli_num_rows($checkForEmail);
                if($countForEmail==1){
                    $update_Query=mysqli_query($conn,"UPDATE tbl_users SET verify='1' WHERE email='$getVerifiedEmail'");
                    if($update_Query) { ?>
                        <div style="position: absolute;z-index: 99;text-align: center;width: 100%;" class="alert alert-info alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Success!</strong> Your Account is Verified Now..Please Login! 
                        </div> 
               
                <?php  }
                    }
            }

session_start();
echo($_SESSION["invite"]);
require_once('loginGoogle/settings.php');
require_once 'facebook/config.php';

 
	$redirectURL="https://pitchar.io/facebook/fb-callback.php";
  $permissions =['email'];
  $logiURL=$helper->getLoginUrl($redirectURL,$permissions);

 

 
   if(isset($_POST["submit"])){
      $mail=$_POST["email"];
      $pass=$_POST["password"];
      //$occ= $_POST["occupation"];
      $verify=mysqli_query($conn,"SELECT * FROM tbl_users WHERE email='$mail'");
      $getTotalNo=mysqli_num_rows($verify);
      $verifypass=mysqli_fetch_array($verify);
      $dpass=$verifypass["password"];
      $acc_status=$verifypass["verify"];

      if ($acc_status=="1") {

        if (password_verify($pass, $dpass)) {
              if (isset($_SESSION["invite"])) {

                $oldRedirectUri= $_SESSION["invite"];
                $RemovingLastSix = substr($oldRedirectUri, 0, -6);
                $AddingNewGetReq=$RemovingLastSix."inv_success";
             
                 $_SESSION["EMail"]=$mail;
                 $_SESSION["getEmail"]=$mail;
                 $_SESSION["login"]="1";
                 header("Location:$AddingNewGetReq");
              }
           
             //$query=mysqli_query($conn,"SELECT * FROM  tbl_$occ WHERE email='$mail' AND verify='1'");
              
              //$count=mysqli_num_rows($query);
             else{
                $_SESSION["EMail"]=$mail;
                 $_SESSION["getEmail"]=$mail;
                 $_SESSION["login"]=1;
                 header("Location:dashboard.php");    
             }   
        } 
        else { ?>
             <div style="position: absolute;z-index: 99;text-align: center;width: 100%;" class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Error!</strong> Credentials Not Matches Our Records!
        </div>
    <?php    }
          
      }

      if ($getTotalNo=="0") { ?>
        <div style="position: absolute;z-index: 99;text-align: center;width: 100%;" class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Error!</strong>These Credentials Not Macthes Our <?= $occ ?> Records..
        </div>
      <?php }

      if($acc_status=="0"){ ?>

         <div style="position: absolute;z-index: 99;text-align: center;width: 100%;" class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Oops!</strong>Please Verify Your Account First!
        </div>

    <?php  }
     
   }
?>
<!DOCTYPE HTML>
<html lang="en-US">
   <head>
      <meta charset="UTF-8">
      <title>Login</title>
 <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
      <?php include 'favicon.php'; ?>
      <style>
         .form-control{border-top: none;
         border-left: none;
         border-right: none;
         border-bottom: 2px solid #ccc;
         height:45px;
        box-shadow: none;
         }
          #signbut { background-color: white;
    color: black;
    height: 40px;
    width: 50% !important;}
    
    #logbtn{background-color: #43425D;
    color: white;
    height: 40px;
    width: 50% !important;
         border: none !important;
             margin-bottom: 10px;
    }
      </style>
   </head>
   <body>
       
       
     
   <form method="POST">
      <div class="container-fullWidth">
 
         <div class="row">
            <div class="col-md-12">
       
               <div class="col-md-6 log hidden-sm hidden-xs"></div>
               <div class="col-md-6">
                  <div class="box box-primary" style="    margin-top: 10%;">
                     <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="img/Tap24hARInt.EDU.jpg" alt="User profile picture">
                        <h3 class="profile-username text-center">PITCHAR.IO</h3>
                        <p class="text-muted text-center">Welcome back! Please login to your account</p>
                        <ul class="list-group list-group-unbordered">
                           <li class="list-group-item">
                              <input   type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email ID">
                           </li>
                           <li class="list-group-item">
                              <input  type="password" name="password" class="form-control" id="exampleInputEmail1" placeholder="Password(Min 6 Characters)">
                           </li>

                        </ul>
                       <!--  <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <select class="form-control select2 select2-hidden-accessible" name="occupation" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                    <option value="student">Student</option>
                                    <option value="teacher">Teacher</option>
                                   
                                 </select>
                              </div>
                              
                           </div>
                        </div> -->
                        <div class="row">
                           <div class="col-md-6">
                              <div class="checkbox">
                                 <label><input type="checkbox" value="">Remember me</label>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="checkbox">
                                 <label><a href="forgot.php">Forgot Password</a></label>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6"style="    text-align: center;">
                             <input type="submit" class="btn btn-primary" name="submit" value="Login" id="logbtn">
                           </div>
                           <div class="col-md-6"style="    text-align: center;">
                              <a href="register.php" class="btn btn-primary" id="signbut">Sign Up</a>
                           </div>
                        </div>
                        <p align="center" class="login-error"><?php //echo $error ?></p>
                        <div class="row share">
                           <p class="text-center" style="font-weight:bold;    font-size: 18px;">Sign in via</p>
                           <div class="col-md-12">
                              <ul class="social-icons" style="text-align: center;">
                                 <li>
                                    <a href="<?php echo $logiURL ?>"><i class="fa fa-facebook" id="fb"></i></a>
                                 </li>
                                 <li>
                                    <a href="<?= 'https://accounts.google.com/o/oauth2/auth?scope=' . urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email') . '&redirect_uri=' . urlencode(CLIENT_REDIRECT_URL) . '&response_type=code&client_id=' . CLIENT_ID . '&access_type=online' ?>"><i class="fa fa-google" id="google"></i></a>
                                 </li>
                                 <li>
                                    <a href="https://pitchar.io/linkedin/linkedin_login.php"><i class="fa fa-linkedin" id="linkdin"></i></a>
                                 </li>
                              </ul>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-12">
                              <a href="register.php" style="text-align: center;
    margin: auto;
    display: block;"><u>Sign up via Email ID</u></a>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12">
                              <a href="policy.php" style="text-align: center;
    margin: auto;
    display: block;">Terms Of Use Privacy Policy</a>
                           </div>
                        </div>
                     </div>
                      
                  </div>
               </div>
            </div>
         </div>
      </div>
      </div>
    </form>
      <script src="js/jquery-min.js"></script>
      <script src="js/bootstrap.min.js"></script> 
   </body>
</html>