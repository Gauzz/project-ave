<?php
require '../includes/functions.php';
secureAdmin();
$admin_name=mysqli_query($conn,"SELECT * FROM admin");
$name= mysqli_fetch_array($admin_name);
$date=$name["created_date"];
date('Y:m:d', strtotime($date));
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta name="description" content="Responsive Admin Template" />
        <meta name="author" content="SmartUniversity" />
        <title>User Profile</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <?php include 'partials/_style.php'; ?>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        
    </head>
    <!-- END HEAD -->
    <body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
        <div class="page-wrapper">
            <!-- start header -->
            <?php include 'partials/_header.php'; ?>
            <div class="page-container">
                <?php include 'partials/_sidebar.php'; ?>
                <!-- end header -->
                <!-- start page container -->
                
                <!-- start sidebar menu -->
                
                
                <!-- end sidebar menu -->
                <!-- start page content -->
                <div class="page-content-wrapper">
                    <div class="page-content">
                        <div class="page-bar">
                            <div class="page-title-breadcrumb">
                                <div class=" pull-left">
                                    <div class="page-title">User Profile</div>
                                </div>
                                <ol class="breadcrumb page-breadcrumb pull-right">
                                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="#">Extra</a>&nbsp;<i class="fa fa-angle-right"></i>
                            </li>
                            <li class="active">User Profile</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN PROFILE SIDEBAR -->
                        <div class="profile-sidebar">
                            <div class="card card-topline-aqua">
                                <div class="card-body no-padding height-9">
                                    <div class="row">
                                        <div class="profile-userpic">
                                        <img src="assets/img/dp.jpg" class="img-responsive" alt=""> </div>
                                    </div>
                                    <div class="profile-usertitle">
                                        <div class="profile-usertitle-name"><?php echo $name["firstname"].''.$name["lastname"] ?></div>
                                        <div class="profile-usertitle-job"><?php echo date('Y:m:d', strtotime($date)); ?></div>
                                    </div>
                                    
                                    <!-- END SIDEBAR USER TITLE -->
                                    <!-- SIDEBAR BUTTONS -->
                                    <!--  <div class="profile-userbuttons">
                                        <a herf="logout.php" type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-circle btn-primary">Sing Out</a>
                                        
                                    </div> -->
                                    <!-- END SIDEBAR BUTTONS -->
                                </div>
                            </div>
                            
                        </div>
                        <!-- END BEGIN PROFILE SIDEBAR -->
                        <!-- BEGIN PROFILE CONTENT -->
                        <div class="profile-content">
                            <div class="row">
                                <div class="profile-tab-box">
                                    <div class="p-l-20">
                                        <ul class="nav ">
                                            <li class="nav-item tab-all"><a
                                            class="nav-link active show" href="#tab1" data-toggle="tab">Settings</a></li>
                                            
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="white-box">
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane active fontawesome-demo" id="tab1">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="card-head">
                                                    <header>Password Change</header>
                                                </div>
                                                <?php
                                                if (isset($_POST["submit"])) {
                                                $oldpassword=$_POST["oldpassword"];
                                                $newpassword=$_POST["newpassword"];
                                                $cpassword=$_POST["cpassword"];
                                                $selectQuery=mysqli_query($conn,"SELECT * FROM admin");
                                                $fetchQuery=mysqli_fetch_array($selectQuery);
                                                $hashPassword = $fetchQuery["password"];
                                                if (password_verify($oldpassword,$hashPassword)) {
                                                if ($fetchQuery) {
                                                if($newpassword==$cpassword)
                                                {
                                                $hash=password_hash($newpassword,PASSWORD_BCRYPT);
                                                $sql=mysqli_query($conn,"UPDATE admin SET password='$hash'");
                                                
                                                if ($sql) { ?>
                                                <script>swal("Success!", "Password Change Successfully!", "success");</script>
                                                <?php }
                                                }
                                                else{  ?>
                                                <script>swal("Oops!", "Password Are Not Same!", "error");</script>
                                                <?php }
                                                }
                                                }
                                                else{ ?>
                                                <script>swal("Oops!", "Old Password Are Not Matched!", "error");</script>
                                                <?php }
                                                }
                                                ?>
                                                <div class="card-body " id="bar-parent1">
                                                    <form method="POST" id="update_password">
                                                        <div class="form-group">
                                                            <label for="simpleFormPassword">Old Password</label>
                                                            <input type="password" class="form-control" name="oldpassword" id="oldpassword" placeholder="Old Password">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="simpleFormPassword">New Password</label>
                                                            <input type="password" class="form-control" name="newpassword" id="newpassword" placeholder="New Password">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="simpleFormPassword">Confiem New Password</label>
                                                            <input type="password" name="cpassword" class="form-control" id="cpassword" placeholder="Current Password">
                                                        </div>
                                                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END PROFILE CONTENT -->
                </div>
            </div>
        </div>
        <!-- end page content -->
        <!-- start chat sidebar -->
        <!-- end chat sidebar -->
    </div>
</div>
<!-- end page container -->
<!-- start footer -->

            <?php include 'partials/_footer.php'; ?>

<!-- end footer -->
</div></div>
<!-- start js include path -->

            <?php include 'partials/_script.php'; ?>

<!-- end js include path -->
</body>
</html>