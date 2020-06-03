<?php
ob_start();
session_start();
include('conn.php');
 //when user hit the register button 
if(isset($_POST["submit"])){
	$firstname=$_POST['firstname'];
	$lastname=$_POST['lastname'];
	$fname=$firstname." ".$lastname;
	$occupation=$_POST['occupation'];
	$email=$_POST['email'];
  $userpassword=$_POST['password'];
  $password = password_hash($userpassword, PASSWORD_BCRYPT);
	$country=$_POST['country'];

      function generateRandomString($length = 12)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString.= $characters[rand(0, $charactersLength - 1) ];
        }

        return $randomString;
    }
    $token = generateRandomString(15);
    // Validating new user Email if already register or not..
    $validatate=mysqli_query($conn,"SELECT * FROM tbl_users WHERE email='$email'");

    $getValidateCount=mysqli_num_rows($validatate);
    
      if ($getValidateCount==0){
        $query=mysqli_query($conn,"INSERT INTO tbl_users(verify,firstname,lastname,fullname,occupation,email,password,country,authtoken,user_type)VALUES('0','$firstname','$lastname',' $fname','$occupation','$email','$password','$country','$token','manual')");

        if ($query) {
   
            $decodemail=base64_encode($email);

             //$html_Temp="<h2>Thanks For Joining Us!</h2><br><br><a href='https://pitchar.io/login.php?em=$decodemail&obj=true'>Click Here To Verify</a>";
             include 'assets/_php/verifyPassword.php';


            require_once ('SendGrid-Starter-Kit-master/SendGrid-API/vendor/autoload.php'); 
              
            $email_receipients = $email;
              /*Post Data*/
              /*Content*/
              $from = new SendGrid\Email("Pitchar", "Team@pitchar.com");
              $subject = "Welcome to Pitchar Platform";
                   /*Send the mail*/
              $content = new SendGrid\Content("text/html",$verifyEmailTemp);
              $to = new SendGrid\Email("Pitchar",$email);
              $mail = new SendGrid\Mail($from, $subject, $to, $content);
              $apiKey = ('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');
              $sg = new \SendGrid($apiKey);
            
              /*Response*/
              $response = $sg->client->mail()->send()->post($mail);

              if($response){ ?>
                <div style="position: absolute;z-index: 999;text-align: center;width: 100%;" class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Success!</strong> A Verification Link Has Been Sent to Your Email.. 
                </div> 

<?php              }
            
            

        }
      }

      if ($getValidateCount>=1) { ?>
     <div style="position: absolute;z-index: 999;text-align: center;width: 100%;" class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Oh Snap!</strong> Email is Already Register.. 
                    </div> 
            <?php
          
                }
    



 

      


	 
    
}
?>
<!DOCTYPE html>
<html lang="en-US">
   <head>
      <meta charset="UTF-8">
      <title></title>
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="https://www.jqueryscript.net/demo/jQuery-International-Telephone-Input-With-Flags-Dial-Codes/build/css/intlTelInput.css">
      <link rel="stylesheet" type="text/css" href="https://www.jqueryscript.net/css/jquerysctipttop.css">
       <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <?php include 'favicon.php'; ?>
      <style>
         .form-control{border-top: none;
         border-left: none;
         border-right: none;
         border-bottom: 2px solid #ccc;
         height:45px;
         box-shadow: none;
         }
         #sig{background-color: #43425D;
    color: white;
    height: 40px;
    width: 20% !important;
    border: none !important;
    margin-bottom: 10px;}
      </style>
   </head>
   <body>

    <?php
        //determinig If user is comming from email invitaion link..
        if(isset($_SESSION["invite"])){ ?>
          <div style="position: absolute;z-index: 99;text-align: center;width: 100%;" class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Important!</strong> Please Register to View The Project.
          </div>
<?php
      }
    ?>
   <form method="POST">
      <div class="container-fullWidth">
         <div class="row">
            <div class="col-md-12">
               <div class="col-md-6 log hidden-sm hidden-xs"></div>
               <div class="col-md-6">
                  <div class="box box-primary" style="margin-top:10%;">
                     <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="img/Tap24hARInt.EDU.jpg" alt="User profile picture">
                        <h3 class="profile-username text-center">PITCHAR.IO</h3>
                        <p class="text-muted text-center">Welcome back! Please login to your account</p>
                        <div class="row">
                           <div class="col-md-6">
                              <ul class="list-group list-group-unbordered">
                                 <li class="list-group-item">
                                    <input required="" type="text" name="firstname" class="form-control" id="First" placeholder="First name">
                                 </li>
                              
                           </div>
                           <div class="col-md-6">
                            <li class="list-group-item">
                              <input required="" type="Last" name="lastname" class="form-control" id="Last" placeholder="Last name">
                            </li>
                           </div>
                           </ul>
                        </div>
                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <select required="" class="form-control select2 select2-hidden-accessible" name="occupation" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                    <option value="" selected="selected">Occupation</option>
                                    <option value="student">Student</option>
                                    <option value="teacher">Teacher</option>
                                   
                                 </select>
                              </div>
                              <!-- /.form-group -->
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12">
                              <ul class="list-group list-group-unbordered">
                                 <li class="list-group-item">
                                    <input required="" type="email" class="form-control" name="email" id="email" placeholder="Email">
                                 </li>
                                 <li class="list-group-item">
                                    <input required="" type="password" class="form-control" name="password" id="pass" placeholder="Password(Min 6 Characters)">
                                 </li>

                              </ul>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                              <!-- <select class="form-control select2 select2-hidden-accessible" name="country" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                    <option selected="selected">Country</option>
                                     <?php
                                          
                                          $sql=mysqli_query($conn,"SELECT * FROM countries");
                                           while($r=mysqli_fetch_array($sql))
                                          { ?>
                                           <option value="<?php echo $r["countries_name"]; ?>"><?php echo $r["countries_name"]; ?></option>
                                           <?php } ?>
                                     
                                 
                                 </select> -->
                                 <input required="" type="tel" name="country" id="mobile-number" value=" " class="form-control" required="">
                              </div>
                              <!-- /.form-group -->
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12">
                              <div class="checkbox">
                                 <label><input type="checkbox" value="" required>I agree with terms and conditions</label>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12" style="text-align:center;">
                              <input type="submit" class="btn btn-primary" id="sig" name="submit" value="Sign Up">
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12">
                              <a href="login.php" style="    margin: auto;
    display: block;
    text-align: center;"><u>Already have an account? sign in</u></a>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12">
                              <a href="policy.php" style="    margin: auto;
    display: block;
    text-align: center;">Terms Of Use Privacy Policy</a>
                           </div>
                        </div>
                     </div>
                     <!-- /.box-body -->
                  </div>
               </div>
            </div>
         </div>
      </div>
      </div>
	  </form>
      <script src="js/jquery-min.js"></script>
      <script src="js/bootstrap.min.js"></script>	
      <script type="text/javascript" src="js/intlTelInput.js"></script>
      <script>
      $("#mobile-number").intlTelInput();
</script>
   </body>
</html>