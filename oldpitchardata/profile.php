<?php 
 include 'secure_session.php';

   $GetData=mysqli_query($conn,"SELECT * FROM tbl_users WHERE email='$getEmail'");
   $GetUserData=mysqli_fetch_array($GetData);
   $user_name=$GetUserData["fullname"];
   $getType=$GetUserData["user_type"];
 ?>

<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Admin Dashboard</title>
      <!-- Tell the browser to be responsive to screen width -->
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <!-- Bootstrap 3.3.7 -->
      <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
      <!-- Ionicons -->
      <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
        <link rel="stylesheet" href="dist/css/new.css">
        <?php include 'favicon.php'; ?>
      <!-- Theme style -->
      <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
      <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
      <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
      <style>
         .form-control{border-top: none;
         border-left: none;
         border-right: none;
         border-bottom: 2px solid #ccc;
         height:45px;
         }
         .btn-danger {
         background-color: black;
         border-color: black;
         }
      </style>
      <!-- Google Font -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
   </head>
   <body class="hold-transition skin-blue sidebar-mini">
      <div class="wrapper">
         <header class="main-header">
            <!-- Logo -->
            <a href="index.php" class="logo">
               <!-- mini logo for sidebar mini 50x50 pixels -->
               <span class="logo-mini"><b>Pit</b>char.IO</span>
               <!-- logo for regular state and mobile devices -->
               <span class="logo-lg"><b>PITCHAR.IO</b></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
           <?php include 'header.php'; ?>
         </header>
         <!-- Left side column. contains the logo and sidebar -->
         <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <?php include 'sidebar.php'; ?>
            <!-- /.sidebar -->
         </aside>
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <h1>
                  User Profile
               </h1>
               <ol class="breadcrumb">
                  <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li class="active">User profile</li>
               </ol>
            </section>
            <!-- Main content -->
            <?php
               // for no of projects
               $getProject=mysqli_query($conn,"SELECT * FROM tbl_std_project WHERE email='$getEmail'");
               $getNoOfProject=mysqli_num_rows($getProject);
               // for project share with you..
               $getShare=mysqli_query($conn,"SELECT * FROM share_projects WHERE std_email='$getEmail'");
               $getNoOfShare=mysqli_num_rows($getShare);
               // for project you share
               $getShare1=mysqli_query($conn,"SELECT * FROM share_projects WHERE tch_email='$getEmail'");
               $getNoOfShare1=mysqli_num_rows($getShare1);
               //  for Fav...
               $getFav=mysqli_query($conn,"SELECT * FROM tbl_std_project WHERE email='$getEmail' AND fav='1'");
               $getNoOfFav=mysqli_num_rows($getFav);


            ?>
            <section class="content">
               <div class="row">
                  <div class="col-md-3">
                     <!-- Profile Image -->
                     <div class="box box-primary">
                        <div class="box-body box-profile">
                           <img class="profile-user-img img-responsive img-circle" style="height: 100px"; src="<?php echo (empty($GetUserData["display_pic"])) ? "img/user.png" : "uploads/user_profile_pic/".$GetUserData["display_pic"] ;?>" alt="User profile picture">
                           <h3 class="profile-username text-center"><?= $GetUserData[4]; ?></h3>
                           <p class="text-muted text-center"><?= $GetUserData[6]; ?></p>
                           <a href="logout.php" class="btn btn-primary btn-block"><b>Sign out</b></a>
                           <ul class="list-group list-group-unbordered">
                              <li class="list-group-item">
                                 <b>Your Project</b> <a class="pull-right"><?= $getNoOfProject;?></a>
                              </li>
                              <li class="list-group-item">
                                 <b>Project Share With You</b> <a class="pull-right"><?=  $getNoOfShare;?></a>
                              </li>
                              <li class="list-group-item">
                                 <b>Projects You Share</b> <a class="pull-right"><?=  $getNoOfShare1;?></a>
                              </li>
                              <li class="list-group-item">
                                 <b>Favriotes</b> <a class="pull-right"><?= $getNoOfFav;?></a>
                              </li>
                           </ul>
                        </div>
                        <!-- /.box-body -->
                     </div>
                     <!-- /.box -->
                     <!-- About Me Box -->
                     <div class="box box-primary">
                        <div class="box-header with-border">
                           <h3 class="box-title">About Me</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                           <strong><i class="fa fa-book margin-r-5"></i>  Registration Date</strong>
                           <p class="text-muted">
                             <?php echo date_create($GetUserData["reg_time"])->format('d M, Y'); ?>
                           </p>
                           <hr>
                           <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
                           <p class="text-muted"><?= $GetUserData[9]?></p>
                           <hr>
                           <hr>
                        </div>
                        <!-- /.box-body -->
                     </div>
                     <!-- /.box -->
                  </div> 
 
                  <div class="col-md-9">
                     <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                           <li class=" active "><a href="#timeline" data-toggle="tab">Edit Profile</a></li>
                           <?php if ($getType=="manual") { ?>
                                 <li class=""><a href="#changepassword" data-toggle="tab">Change password</a></li>
                           <?php } ?>
                           
                        </ul>
                        <div class="tab-content">
                           <div class="tab-pane  active " id="timeline">
                              <!-- The timeline -->
                              <div class="box box-primary">
                                 <div class="box-body box-profile">
                                    <img class="profile-user-img img-responsive img-circle" src="<?php echo (empty($GetUserData["display_pic"])) ? "img/user.png" : "uploads/user_profile_pic/".$GetUserData["display_pic"] ;?>" alt="User profile picture" id="output" style="height: 100px; cursor: pointer;" onclick="openfileDialog();">

                                    <h3 class="profile-username text-center" style="cursor: pointer;" onclick="openfileDialog();" >Change Profile Picture</h3>

                                   

                                    <h3 class="profile-username text-center">PITCHAR.IO</h3>
                                    <p class="text-muted text-center">Edit or Update Your Profile here.</p>
                                    <form class="form-horizontal" method="POST" enctype="multipart/form-data">

                                        <input type="file" id="fileLoader" accept="image/*" style="display: none;" onchange="loadFile(event)" name="images" >
                                       <div class="form-group has-feedback ">
                                          <div class="col-sm-5">
                                             <input type="text" name="First" class="form-control" placeholder="First name" value="<?= $GetUserData[2] ?>">
                                          </div>
                                          <div class="col-sm-5">
                                             <input type="text" name="Last" class="form-control" placeholder="Last name" value="<?= $GetUserData[3] ?>">
                                          </div>
                                       </div>
                                       <div class="form-group has-feedback ">
                                          <div class="col-sm-10">
                                             <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                <option disabled selected><?= $GetUserData["occupation"]; ?></option>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="form-group has-feedback ">
                                          <div class="col-sm-10">
                                             <input type="email" disabled="" name="" class="form-control" placeholder="Email" value="<?= $GetUserData["email"] ?>">
                                          </div>
                                       </div>
                                       <div class="form-group has-feedback ">
                                          <div class="col-sm-10">
                                             <select name="country" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                <option><?= $currentCont=$GetUserData["country"] ?></option>
                                                <?php $countries=mysqli_query($conn,"SELECT * FROM countries WHERE NOT countries_name='$currentCont'");
                                                   while ($getCountries=mysqli_fetch_array($countries)) { ?>
                                                         <option value="<?= $getCountries[1]; ?>"><?= $getCountries[1]; ?></option>
                                                  <?php }
                                                 ?>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col-sm-offset-2 col-sm-10">
                                          <button type="submit" name="save" class="btn btn-primary">Save</button>
                                       </div>
                                    </form>
                                    <?php

                                    if (isset($_POST["save"])) {
                                       $fName=mysqli_real_escape_string($conn,$_POST["First"]);
                                       $lName=mysqli_real_escape_string($conn,$_POST["Last"]);
                                       $cont=mysqli_real_escape_string($conn,$_POST["country"]);

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
                                    if (empty($image_name)) {
                                       $updateProfile=mysqli_query($conn,"UPDATE tbl_users SET firstname='$fName',lastname='$lName',fullname='$fName $lName',country='$cont' WHERE email='$getEmail'");

                                        if ($updateProfile) {
                                         echo "<script>alert('Profile updated Successfully!')</script>";
                                         header("Refresh:0");
                                       }
                                       else
                                       {
                                         echo "<script>alert('Something Went Wrong!')</script>";
                                          header("Refresh:0");
                                       }
                                    }
                                    if(!empty($image_name))
                                    {
                                       $updateProfile=mysqli_query($conn,"UPDATE tbl_users SET firstname='$fName',lastname='$lName',fullname='$fName $lName',country='$cont',display_pic='$image_name' WHERE email='$getEmail'");
                                       if ($updateProfile) {
                                         echo "<script>alert('Profile updated Successfully!')</script>";
                                         header("Refresh:0");
                                       }
                                       else
                                       {
                                          echo "Profile Not Update";
                                       }
                                    }
                                       
                                    }
                                    ?>
                                    <!-- /.box-body -->
                                 </div>
                              </div>
                           </div>
                           <!-- /.tab-pane -->
                           <!-- /.tab-pane -->
                           <div class="tab-pane " id="changepassword">
                              .
                              <form class="form-horizontal" method="post">
                                 <div class="form-group has-feedback ">
                                    <label for="inputName" class="col-sm-2 control-label">Old password</label>
                                    <div class="col-sm-10">
                                       <input type="password" name="opwd" class="form-control" placeholder="Old password" value="">
                                    </div>
                                 </div>
                                 <div class="form-group has-feedback ">
                                    <label for="inputEmail" class="col-sm-2 control-label">New password</label>
                                    <div class="col-sm-10">
                                       <input type="password" name="pwd" class="form-control" placeholder="New password" value="">
                                    </div>
                                 </div>
                                 <div class="form-group has-feedback ">
                                    <label for="inputName" class="col-sm-2 control-label">Retype password</label>
                                    <div class="col-sm-10">
                                       <input type="password" name="cpwd" class="form-control" placeholder="Retype password" value="">
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                       <button type="submit" name="update" class="btn btn-primary">Update</button>
                                    </div>
                                 </div>
                              </form>

                              <?php
                               $DBPass=$GetUserData["password"];
                               if (isset($_POST["update"])) {
                                 $opwd=mysqli_real_escape_string($conn,$_POST["opwd"]);
                                 $pwd=mysqli_real_escape_string($conn,$_POST["pwd"]);
                                 $password = password_hash($pwd, PASSWORD_BCRYPT);
                                 $cpwd=mysqli_real_escape_string($conn,$_POST["cpwd"]);
                                     if ($pwd==$cpwd) {
                                          if (password_verify($opwd,$DBPass)) {
                                              $update=mysqli_query($conn,"UPDATE tbl_users SET password='$password' WHERE email='$getEmail'");
                                              if ($update) {
                                                 echo "<script>alert('Password Update Successfully');</script>";
                                              }
                                          }

                                          else {
                                            echo "<script>alert('Old password Not matched');</script>";
                                          }
                                     }

                                     else{
                                       echo "<script>alert('New Password And Confirm Password Not Matched');</script>";
                                     }
                               }
                            

                              ?>
                           </div>
                           <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                     </div>
                     <!-- /.nav-tabs-custom -->
                  </div>
                  <!-- /.col -->
               </div>
               <!-- /.row -->
            </section>
            <!-- /.content -->
         </div>
         <!-- /.content-wrapper -->
         <?php include'footer.php'?>
         <!-- Control Sidebar -->
 
 
   
      </div>
      <!-- ./wrapper -->
      <!-- jQuery 3 -->
      <script src="bower_components/jquery/dist/jquery.min.js"></script>
      <!-- Bootstrap 3.3.7 -->
      <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
      <!-- FastClick -->
      <script src="bower_components/fastclick/lib/fastclick.js"></script>
      <!-- AdminLTE App -->
      <script src="dist/js/adminlte.min.js"></script>
      <!-- AdminLTE for demo purposes -->
      <script src="dist/js/demo.js"></script>
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