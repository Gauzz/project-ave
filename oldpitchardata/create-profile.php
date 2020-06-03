<?php
ob_start();
include('conn.php');
session_start();
if (!isset($_SESSION['logged_in']) AND !isset($_SESSION['access_token']) AND !isset($_SESSION['new_user'])) {
      header('Location: register.php');
      exit();
   }

   if (isset($_SESSION['logged_in'])) {
       $googledatafname=$_SESSION['userData']['name']['givenName'];
        $googledatalname=$_SESSION['userData']['name']['familyName'];
         $gmail=$_SESSION['userData']['emails']['0']['value'];
   }
   if (isset($_SESSION['access_token'])) {
      $fbdatafname=$_SESSION['userDatafb']['first_name'];
       $fbdatalname=$_SESSION['userDatafb']['last_name'];
        $fbmail=$_SESSION['userDatafb']['email'];
        //useless
         $getFbPic=$_SESSION['userDatafb']['picture']['url'];
   }
   if ($_SESSION['new_user']) {
        $linkedin= $_SESSION["email"];
        $linkedinFname= $_SESSION["fname"];
       $linkedinLname= $_SESSION["lname"];
   }

  
  
 ?>

 <!--     -->
<!DOCTYPE 
HTML>
<html lang="en-US">
   <head>
      <meta charset="UTF-8">
      <title></title>
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/style.css">
      <?php include 'favicon.php'; ?>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
       <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
      <style>
         .form-control{border-top: none;
         border-left: none;
         border-right: none;
         border-bottom: 2px solid #ccc;
         height:45px;
         box-shadow: none;
         }
         
         .peraError{
                font-size: 16px;
    text-transform: capitalize;
    color: darkred;
         }
      </style>
   </head>
   <body>
   <form  method="POST" enctype="multipart/form-data">
      <div class="container-fluid" >
         <div class="row">
            <div class="col-md-12" style="margin: 0 !important;padding: 0 !important;">
  
               <div class="col-md-6 log hidden-sm hidden-xs"></div>
               <div class="col-md-6">
                  <div class="box box-primary">
                     <div class="box-body box-profile">
                        <img onclick="openfileDialog();"  style="height: 100px;cursor: pointer;" class="profile-user-img img-responsive img-circle" src="img/user.png" id="output" alt="User profile picture">
                        <h3 class="profile-username text-center" style="cursor: pointer;" onclick="openfileDialog();" >Set Profile Picture</h3>
                         
                        <input type="file" id="fileLoader" accept="image/*" style="display: none;" onchange="loadFile(event)" name="images" >
                        <p class="text-muted text-center">Welcome! Complete Your profile Here</p>
                        <div class="row">
                           <div class="col-md-6">
                              <ul class="list-group list-group-unbordered">
                                 <li class="list-group-item">
                                    <input type="text" name="firstname" value="<?php if(empty($googledatafname) AND empty($fbdatafname)){
                                            echo($linkedinFname);
                                          }

                                          if(empty($fbdatafname) AND empty($linkedinFname)){
                                            echo($googledatafname);
                                          } 

                                          if(empty($googledatafname) AND empty($linkedinFname)){
                                            echo ($fbdatafname);
                                          }
                                      ?>" class="form-control" id="First" placeholder="First name">
                                 </li>
                              </ul>
                           </div>
                           <div class="col-md-6">
                              <ul class="list-group list-group-unbordered">
                                 <li class="list-group-item">
                                   <input type="text" name="lastname" class="form-control" id="Last" placeholder="Last name" value="<?php
                                          if(empty($googledatalname) AND empty($fbdatalname)){
                                            echo($linkedinLname);
                                          }

                                          if(empty($fbdatalname) AND empty($linkedinLname)){
                                            echo($googledatalname);
                                          } 

                                          if(empty($googledatalname) AND empty($linkedinLname)){
                                            echo ($fbdatalname);
                                          }


                                   ?>">
                                 </li>
                              </ul>
                           </div>
                           
                        </div>
                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <select required="" class="form-control select2 select2-hidden-accessible" name="occupation" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                    
                                    <option value="student">Student</option>
                                    <option value="teacher">Teacher</option>
                                   
                                 </select>
                              </div>
                              <!-- /.form-group -->
                           </div>
                        </div>
                        <div class="row" style="margin-bottom:15px;">
                            <div class="col-md-12">
                                   <input type="text" disabled name="email" class="form-control" id="email" placeholder="Email:" value="<?php if(empty($gmail) AND empty($linkedin)){echo $fbmail;}if(empty($fbmail) AND empty($linkedin)){echo $gmail;}if (empty($gmail) AND empty($fbmail)) {echo $linkedin;}?>">
                                </div>
                           </div>
 
                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <select required="" class="form-control select2 select2-hidden-accessible" name="country" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                    <option  disabled="">Country</option>
                                     <?php
                                           
                                           $sql=mysqli_query($conn,"SELECT * FROM countries");
                                           while($r=mysqli_fetch_array($sql))
                                          { ?>
                                           <option value="<?php echo $r["countries_name"]; ?>"><?php echo $r["countries_name"]; ?></option>
                                    <?php      }
                                   ?>
                                 </select>
                              </div>
                              <!-- /.form-group -->
                           </div>
                        </div>
 
                        <div class="row">
                           <div class="col-md-6 col-md-offset-3">
                              <input type="submit" class="btn btn-primary btn-block" name="submit" value="Continue">
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
<?php 
 
    //   $gmail=$_SESSION['userData']['emails']['0']['value'];
    //   $fbmail=$_SESSION['userDatafb']['email'];
      $email = (empty($gmail)) ? $fbmail : $gmail ;
   if (isset($_POST["submit"])) {
      $firstname=$_POST["firstname"];
      $lastname=$_POST["lastname"];
      $fname=$firstname." ".$lastname;
      $country=$_POST["country"];
      $occupation=$_POST["occupation"];

      $getRandomPass=uniqid();

      $valid_formats = array("jpg", "png", "gif", "bmp","jpeg");  
              $name = $_FILES['images']['name'];
              $size = $_FILES['images']['size'];
              if(strlen($name)) {
                list($txt, $ext) = explode(".", $name);
                if(in_array($ext,$valid_formats)) {
                  if($size<(1024*1024)) {
                      $image_name = time().".".$ext;
                    $tmp = $_FILES['images']['tmp_name'];
                    move_uploaded_file($tmp, "uploads/user_profile_pic/".$image_name);
            }
            }
            }  

      //if user is googleuser then only google table update
      if(isset($_SESSION['logged_in'])){
         $getKey=$_SESSION['uniqKey'];
          $querys=mysqli_query($conn,"UPDATE google SET firstname='$firstname',lastname='$lastname',fullname='$fname',occupation='$occupation',country='$country',procced='1' WHERE email='$email' AND uniq_key='$getKey'");
        if ($querys) {
         $validate=mysqli_query($conn,"SELECT * FROM tbl_users WHERE email='$email'");     
         $getValid=mysqli_num_rows($validate);
         if($getValid=="1"){ ?>
            <p align="center" class="peraError">Email already Register Please Login!</p>
      <?php }
         else{
            $gooleuser=mysqli_query($conn,"INSERT INTO tbl_users(verify,firstname,lastname,fullname,display_pic,occupation,email,password,country,user_type)VALUES('1','$firstname','$lastname','$fname','$image_name','$occupation','$email','$getRandomPass','$country','google')");
                $_SESSION['login'] = "1";
                $_SESSION["EMail"] = $email;
                header("Location:dashboard.php");
         }
      }
          
      }
      if(isset($_SESSION['access_token'])){
        $getKey=$_SESSION["uniqKey"];
           $querys=mysqli_query($conn,"UPDATE facebook_users SET occupation='$occupation',country='$country',procced='1' WHERE email='$email' AND uniq_key='$getKey'");
              if ($querys) {
           $validate=mysqli_query($conn,"SELECT * FROM tbl_users WHERE email='$email'");     
          $getValid=mysqli_num_rows($validate);
         if($getValid=="1"){ ?>
            <p align="center" class="peraError">Email already Register Please Login!</p>
      <?php }
         else{
            $fbuser=mysqli_query($conn,"INSERT INTO tbl_users(verify,firstname,lastname,fullname,display_pic,occupation,email,password,country,user_type)VALUES('1','$firstname','$lastname','$fname','$image_name','$occupation','$email','$getRandomPass','$country','facebook')");
                $_SESSION['EMail']=$email;
                $_SESSION['login'] = "1";
                header("Location:dashboard.php");
         }
      }
      }
    //   linked in
      if(isset($_SESSION['Linkedin'])){
          $getKey=$_SESSION["uniqKey"];
           $querys=mysqli_query($conn,"UPDATE linkedin SET occupation='$occupation',country='$country',procced='1' WHERE email='$linkedin' AND uniq_key='$getKey'");
              if ($querys) {
         $validate=mysqli_query($conn,"SELECT * FROM tbl_users WHERE email='$linkedin'");
         $getValidate=mysqli_num_rows($validate);
         if($getValidate=="1"){ ?>
            <p align="center" class="peraError">Email already Register Please Login!</p>
      <?php }
         else{
            $linkedinUser=mysqli_query($conn,"INSERT INTO tbl_users(verify,firstname,lastname,fullname,occupation,email,password,country,user_type)VALUES('1','$firstname','$lastname','$fname','$occupation','$linkedin','pas123','$country','linkedin')");
                $_SESSION['login'] = "1";
                 $_SESSION['EMail']=$linkedin;
                header("Location:dashboard.php");
         }
      }
      }
      

   
       else{
               echo "error";
            }

   }

 ?>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
 <script type="text/javascript">
          var loadFile = function(event) {
                               var reader = new FileReader();
                               reader.onload = function(){
                               var output = document.getElementById('output');
                              output.src = reader.result;
                                  };
                             reader.readAsDataURL(event.target.files[0]);
                                 };

                                 function openfileDialog() {
                                    $("#fileLoader").click();
                                    }
     </script>
   
   </body>
</html>