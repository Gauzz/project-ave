<html>
    <head>
      <meta charset="UTF-8">
      <title>Forgot Password</title>
 
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
          #bgbtn{background-color: #43425D !important;
    color: white;
    height: 40px;
    width: 30% !important;
    border: none !important;
    margin-bottom: 10px;}
      </style>
   </head>
    <body>
        <div class="container-fullWidth">
         <div class="row">
            <div class="col-md-12">
		
               <div class="col-md-6 log hidden-sm hidden-xs"></div>
               <div class="col-md-6">
                  <div class="box box-primary" style="margin-top:30%;">
                     <div class="box-body box-profile">
                      
                        <a href="login.php">
                            <img class="profile-user-img img-responsive img-circle" src="img/Tap24hARInt.EDU.jpg" alt="User profile picture">
                        <h3 class="profile-username text-center">PITCHAR.IO</h3>
                        </a>
                        <p class="text-muted text-center">Enter Your Email To Reset Password</p>
                        <ul class="list-group list-group-unbordered">
                           <form method="POST">
                            <input type="email" required class="form-control" name="email" placeholder="Your Email Address"><br>
                            <div class="row">
                                <div class="col-md-12">
                            <input type="submit" class="btn btn-primary" value="Reset Password" name="submit" id="bgbtn" style=" margin: auto; display: block; text-align: center;">
                            </div>
                            </div>
                            </form>
                          
                        </ul>
                       
                           </div>
                        </div>
                     
                     </div>
                      
                  </div>
               </div>
        </div>        
    <?php
    
    include 'conn.php';
    require_once 'function.php';
    if(isset($_POST["submit"])){
        $email=$_POST["email"];   
    $main=mysqli_query($conn,"SELECT * FROM tbl_users WHERE email='$email'");
    $getuserdetails=mysqli_fetch_array($main);
    $getfname=$getuserdetails["fullname"];
    $rows=mysqli_num_rows($main);
    
    if($rows > 0){
      
        $token = generateNewString();
        mysqli_query($conn,"UPDATE tbl_users SET token='$token', 
                      tokenExpire=DATE_ADD(NOW(), INTERVAL 5 MINUTE)
                      WHERE email='$email'");    

        include 'assets/_php/resetPassword.php';
	       require_once ('SendGrid-Starter-Kit-master/SendGrid-API/vendor/autoload.php'); 

            	$from = new SendGrid\Email("PITCHAR.IO", "Team@PITCHAR.IO");
            	$subject = "PITCHAR.IO Change Password";
            	$content = new SendGrid\Content("text/html",$verifyEmailTemp);
            	$to = new SendGrid\Email($getfname,$email);
            	$mail = new SendGrid\Mail($from, $subject, $to, $content);
            	$apiKey = ('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');
            	$sg = new \SendGrid($apiKey);
            	/*Response*/
            	$response = $sg->client->mail()->send()->post($mail); ?>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-md-offset-3" style="position: absolute;top: 0;left: 0%;" align="center">
                        <div class="alert alert-dismissible alert-info">
                            A Reset Link has Been Sent to You <strong>Please Check Your Inbox!</strong>
                        </div>
                    </div>
                </div>
            </div>
<?php    }
    else{ ?>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-md-offset-3" style="position: absolute;top: 0;left: 0%;" align="center">
                        <div class=" alert alert-dismissible alert-danger">
                            <strong>There is no Account Associated With This Email</strong>
                        </div>
                    </div>
                </div>
            </div>
<?php 
}
    }
    ?>    
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <script src="js/jquery-min.js"></script>
      <script src="js/bootstrap.min.js"></script>	
    </body>
    
</html>