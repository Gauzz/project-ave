<?php
session_start();
include 'conn.php';
 if(!isset($_SESSION[login])){
     header("Location:register.php");
 }
 
 $eid=' ';
    
    $gmail=$_SESSION['userData']['emails']['0']['value'];
    $fbid=$_SESSION['userDatafb']['email'];
    $lmail= $_SESSION["email"];
 
 if(empty($gmail) AND empty($fbid) ){
     $eid= $lmail;
 }
 
 if(empty($fbid) AND empty($lmail)){
     $eid= $gmail;
 }
 
  if(empty($gmail) AND empty($lmail)){
     $eid= $fbid;
 }
 
  
 // Checking Mail for student
 $checkforstd=mysqli_query($conn,"SELECT * FROM tbl_student WHERE email='$eid'");
 $countforstd= mysqli_num_rows($checkforstd);
    if($countforstd == 1){
        $q1=mysqli_query($conn,"SELECT * FROM tbl_student WHERE email='$eid'");
        $std_data=mysqli_fetch_array($q1);
         $user_name= $std_data["fullname"];
          $user_email= $std_data["email"];
          $user_occ= $std_data["occupation"];
         $user_country= $std_data["country"];
         $_SESSION["user_mail"]=$user_email;
         $_SESSION["user_occ"]=$user_occ;
     
    }
    

  // Checking Mail for teacher
 $checkforteach=mysqli_query($conn,"SELECT * FROM tbl_teacher WHERE email='$eid'");
  $countforteach= mysqli_num_rows($checkforteach);
 if($countforteach ==1){
      $q1=mysqli_query($conn,"SELECT * FROM tbl_teacher WHERE email='$eid'");
        $teach_data=mysqli_fetch_array($q1);
         $user_name= $teach_data["fullname"];
         $user_email= $teach_data["email"];
         $user_occ= $std_data["occupation"];
         $user_country= $teach_data["country"];
         $_SESSION["user_mail"]=$user_email;
         $_SESSION["user_occ"]=$user_occ;
 }
 


 
  $id=1;
   $start=0;
   $limit=12;
    
	if(isset($_GET["id"]))
{
	$id=$_GET["id"];
	$start=($id-1)*$limit;
}

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
      <!-- Theme style -->
      <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
      <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
      <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
      <link rel="stylesheet" href="dist/css/new.css">
      <!-- Morris chart -->
      <link rel="stylesheet" href="bower_components/morris.js/morris.css">
      <?php include 'favicon.php'; ?>
      <!-- jvectormap -->
      <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
      <!-- Date Picker -->
      <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
      <!-- Daterange picker -->
      <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
      <!-- bootstrap wysihtml5 - text editor -->
      <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
      <!-- Google Font -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
       <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
      <style>
         .bg-teal-gradient{background:white !important;}
      </style>
   </head>
   <body class="hold-transition skin-blue sidebar-mini">
      <div class="wrapper">
         <header class="main-header">
            <!-- Logo -->
            <a href="index.php" class="logo">
               <!-- mini logo for sidebar mini 50x50 pixels -->
               <span class="logo-mini"><b>A</b>M</span>
               <!-- logo for regular state and mobile devices -->
               <span class="logo-lg"><b>Admin</b></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
               <!-- Sidebar toggle button-->
               <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
               <span class="sr-only">Toggle navigation</span>
               </a>
               <div class="navbar-custom-menu">
                  <ul class="nav navbar-nav">
                     <!-- Messages: style can be found in dropdown.less-->
                     <!-- User Account: style can be found in dropdown.less -->
                     <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                        <span class="hidden-xs">Tap24 ARInt.EDU</span>
                        </a>
                        <ul class="dropdown-menu">
                           <!-- User image -->
                           <li class="user-header">
                              <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                              <p>
                                 Alexander Pierce - Web Developer
                                 <small>Member since Nov. 2012</small>
                              </p>
                           </li>
                           <!-- Menu Body -->
                           <!-- Menu Footer-->
                           <li class="user-footer">
                              <div class="pull-left">
                                 <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
                              </div>
                              <div class="pull-right">
                                 <a href="#" class="btn btn-default btn-flat">Sign out</a>
                              </div>
                           </li>
                        </ul>
                     </li>
                     <!-- Control Sidebar Toggle Button -->
                  </ul>
               </div>
            </nav>
         </header>
         <!-- Left side column. contains the logo and sidebar -->
         <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
               <!-- Sidebar user panel -->
               <div class="user-panel">
                  <div class="pull-left image">
                     <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                  </div>
                  <div class="pull-left info">
                     <p>Tap24 ARInt.EDU</p>
                     <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                  </div>
               </div>
               <!-- search form -->
               <form action="#" method="get" class="sidebar-form">
                  <div class="input-group">
                     <input type="text" name="q" class="form-control" placeholder="Search...">
                     <span class="input-group-btn">
                     <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                     </button>
                     </span>
                  </div>
               </form>
               <!-- /.search form -->
               <!-- sidebar menu: : style can be found in sidebar.less -->
               <ul class="sidebar-menu" data-widget="tree">
                  <li class="header">MAIN NAVIGATION</li>
                  <li class="active"><a href="index.php"><i class="fa fa-home"></i>  AR Projects</a></li>
                  <li><a href="student.php"><i class="fa fa-user"></i> Students</a></li>
                  <li class="treeview">
                     <a href="#"> 
                     <i class="fa fa-star"></i> <span> Favorites</span>  
                     </a>
                  </li>
                  <li class="treeview">
                     <a href="#"> 
                     <i class="fa fa-globe"></i> <span> Help</span>  
                     </a>
                  </li>
               </ul>
            </section>
            <!-- /.sidebar -->
         </aside>
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <div class="row">
                  <div class="col-md-6">
                     <h2>
                        AR Projects
                     </h2>
                  </div>
                  <div class="col-md-6">
                     <ol class="breadcrumb">
                        <div class="input-group">
                           <input type="text" name="q" class="form-control" placeholder="Search...">
                           <span class="input-group-btn">
                           <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                           </button>
                           </span>
                        </div>
                     </ol>
                  </div>
               </div>
            </section>
            <!-- Main content -->
            <section class="content">
               <!-- /.row -->
               <!-- Main row -->
               <div class="row">
                  <!-- Left col -->
                  <!-- /.Left col -->
                  <!-- right col (We are only adding the ID to make the widgets sortable)-->
                  <section class="col-lg-6 connectedSortable">
                     <!-- solid sales graph -->
                     <div class="box box-solid bg-teal-gradient">
                        <div class="box-header">
                           <div class="box-tools pull-right">
                              <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                              </button>
                              <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                              </button>
                           </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer no-border">
                           <div class="row">
                              <a href="choose.php">
                                 <div class="col-lg-12">
                                    <div class="col-lg-3">
                                       <img src="dist/img/plus.png" class="stimg">
                                    </div>
                                    <div class="col-lg-7 col-lg-offset-1"id="stdetails">
                                       <h3>Create an AR Project</h3>
                                    </div>
                                 </div>
                              </a>
                           </div>
                           <!-- /.row -->
                        </div>
                        <!-- /.box-footer -->
                     </div>
                     <!-- /.box -->
                     <!-- /.box -->
                  </section>
                  <!-- right col -->
               </div>
               <div class="row">
<!--section for loop-->
<?
$query=mysqli_query($conn,"SELECT * FROM tbl_std_project WHERE email='$user_email' LIMIT $start,$limit");
while($data=mysqli_fetch_array($query)){
?>
                  <section class="col-lg-6 connectedSortable">
                     <!-- solid sales graph -->
                     <div class="box box-solid bg-teal-gradient">
                        <div class="box-header">
                           <div class="box-tools pull-right">
                              <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                              </button>
                              <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                              </button>
                           </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer no-border">
                           <div class="row">
                              <div class="col-lg-12">
                                 <div class="col-lg-3">
                                    <img src="dist/img/user2-160x160.jpg" class="stimg">
                                 </div>
                                 <div class="col-lg-7 col-lg-offset-1"id="stdetails">
                                    <h3><a href="view-global.php?project=<?php $pid=$data["id"]; echo base64_encode($pid);?>"><?= $data["project_name"];?></a></h3>
                                    <p><?= $data["subject"]?></p>
                                    <p><?= $data["language"]?></p>
                                    <div class="">
                                       <a href="<?php echo (!empty($data["docs"])) ? "uploads/docs/".$data["docs"] : " " ; ?>" onClick="<?php echo (!empty($data["docs"])) ? " " : "alert('No Documents Attached to This Project!')" ; ?>" class="btn btn-social-icon btn-instagram"><i class="fa fa-file"></i></a>
                                       <a href="<?php echo (!empty($data["image"])) ? "uploads/imgs/".$data["image"] : " " ; ?>" onClick="<?php echo (!empty($data["image"])) ? " " : "alert('No Images Attached to This Project!')" ; ?>" class="btn btn-social-icon btn-twitter"><i class="fa fa-image"></i></a>
                                       <a class="btn btn-social-icon btn-facebook"><i class="fa fa-cube"></i></a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- /.row -->
                        </div>
                        <!-- /.box-footer -->
                     </div>
                     <!-- /.box -->
                     <!-- /.box -->
                  </section>
<!--section for loop-->
<?php } ?>

 


 

 

                  <!-- right col -->
               </div>
            
    
                 
                  
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="col-sm-5">
                           <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>
                        </div>
                        <div class="col-sm-7">
                           <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                              <ul class="pagination">
  					
  					<?php
$rows=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM tbl_std_project "));
$total=ceil($rows/$limit);

if($id>1)
{
	echo '<li class="disabled" ><a href="?id='.($id-1).'"">&laquo; </a></li>';
}

for($i=1;$i<=$total;$i++)
{
	echo "<li><a href=?id=".($i)."' >$i</a></li>";
}
if($id!=$total)
{
	
	
	echo "<li><a href='?id=".($id+1)."'>&raquo;</a></li>";
}




?>
                              
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- right col -->

               <!-- /.row (main row) -->
            </section>
            <!-- /.content -->
         </div>
         <!-- /.content-wrapper -->
         <?php include'footer.php'?>
         <!-- Control Sidebar -->
         <aside class="control-sidebar control-sidebar-dark">
            <!-- Create the tabs -->
            <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
               <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
               <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
               <!-- Home tab content -->
               <div class="tab-pane" id="control-sidebar-home-tab">
                  <h3 class="control-sidebar-heading">Recent Activity</h3>
                  <ul class="control-sidebar-menu">
                     <li>
                        <a href="javascript:void(0)">
                           <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                           <div class="menu-info">
                              <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                              <p>Will be 23 on April 24th</p>
                           </div>
                        </a>
                     </li>
                     <li>
                        <a href="javascript:void(0)">
                           <i class="menu-icon fa fa-user bg-yellow"></i>
                           <div class="menu-info">
                              <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                              <p>New phone +1(800)555-1234</p>
                           </div>
                        </a>
                     </li>
                     <li>
                        <a href="javascript:void(0)">
                           <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
                           <div class="menu-info">
                              <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                              <p>nora@example.com</p>
                           </div>
                        </a>
                     </li>
                     <li>
                        <a href="javascript:void(0)">
                           <i class="menu-icon fa fa-file-code-o bg-green"></i>
                           <div class="menu-info">
                              <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                              <p>Execution time 5 seconds</p>
                           </div>
                        </a>
                     </li>
                  </ul>
                  <!-- /.control-sidebar-menu -->
                  <h3 class="control-sidebar-heading">Tasks Progress</h3>
                  <ul class="control-sidebar-menu">
                     <li>
                        <a href="javascript:void(0)">
                           <h4 class="control-sidebar-subheading">
                              Custom Template Design
                              <span class="label label-danger pull-right">70%</span>
                           </h4>
                           <div class="progress progress-xxs">
                              <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                           </div>
                        </a>
                     </li>
                     <li>
                        <a href="javascript:void(0)">
                           <h4 class="control-sidebar-subheading">
                              Update Resume
                              <span class="label label-success pull-right">95%</span>
                           </h4>
                           <div class="progress progress-xxs">
                              <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                           </div>
                        </a>
                     </li>
                     <li>
                        <a href="javascript:void(0)">
                           <h4 class="control-sidebar-subheading">
                              Laravel Integration
                              <span class="label label-warning pull-right">50%</span>
                           </h4>
                           <div class="progress progress-xxs">
                              <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                           </div>
                        </a>
                     </li>
                     <li>
                        <a href="javascript:void(0)">
                           <h4 class="control-sidebar-subheading">
                              Back End Framework
                              <span class="label label-primary pull-right">68%</span>
                           </h4>
                           <div class="progress progress-xxs">
                              <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                           </div>
                        </a>
                     </li>
                  </ul>
                  <!-- /.control-sidebar-menu -->
               </div>
               <!-- /.tab-pane -->
               <!-- Stats tab content -->
               <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
               <!-- /.tab-pane -->
               <!-- Settings tab content -->
               <div class="tab-pane" id="control-sidebar-settings-tab">
                  <form method="post">
                     <h3 class="control-sidebar-heading">General Settings</h3>
                     <div class="form-group">
                        <label class="control-sidebar-subheading">
                        Report panel usage
                        <input type="checkbox" class="pull-right" checked>
                        </label>
                        <p>
                           Some information about this general settings option
                        </p>
                     </div>
                     <!-- /.form-group -->
                     <div class="form-group">
                        <label class="control-sidebar-subheading">
                        Allow mail redirect
                        <input type="checkbox" class="pull-right" checked>
                        </label>
                        <p>
                           Other sets of options are available
                        </p>
                     </div>
                     <!-- /.form-group -->
                     <div class="form-group">
                        <label class="control-sidebar-subheading">
                        Expose author name in posts
                        <input type="checkbox" class="pull-right" checked>
                        </label>
                        <p>
                           Allow the user to show his name in blog posts
                        </p>
                     </div>
                     <!-- /.form-group -->
                     <h3 class="control-sidebar-heading">Chat Settings</h3>
                     <div class="form-group">
                        <label class="control-sidebar-subheading">
                        Show me as online
                        <input type="checkbox" class="pull-right" checked>
                        </label>
                     </div>
                     <!-- /.form-group -->
                     <div class="form-group">
                        <label class="control-sidebar-subheading">
                        Turn off notifications
                        <input type="checkbox" class="pull-right">
                        </label>
                     </div>
                     <!-- /.form-group -->
                     <div class="form-group">
                        <label class="control-sidebar-subheading">
                        Delete chat history
                        <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                        </label>
                     </div>
                     <!-- /.form-group -->
                  </form>
               </div>
               <!-- /.tab-pane -->
            </div>
         </aside>
         <!-- /.control-sidebar -->
         <!-- Add the sidebar's background. This div must be placed
            immediately after the control sidebar -->
         <div class="control-sidebar-bg"></div>
      </div>
      <!-- ./wrapper -->
      <!-- jQuery 3 -->
      <script src="bower_components/jquery/dist/jquery.min.js"></script>
      <!-- jQuery UI 1.11.4 -->
      <script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
      <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
      <script>
         $.widget.bridge('uibutton', $.ui.button);
      </script>
      <!-- Bootstrap 3.3.7 -->
      <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
      <!-- Morris.js charts -->
      <script src="bower_components/raphael/raphael.min.js"></script>
      <script src="bower_components/morris.js/morris.min.js"></script>
      <!-- Sparkline -->
      <script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
      <!-- jvectormap -->
      <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
      <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
      <!-- jQuery Knob Chart -->
      <script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
      <!-- daterangepicker -->
      <script src="bower_components/moment/min/moment.min.js"></script>
      <script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
      <!-- datepicker -->
      <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
      <!-- Bootstrap WYSIHTML5 -->
      <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
      <!-- Slimscroll -->
      <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
      <!-- FastClick -->
      <script src="bower_components/fastclick/lib/fastclick.js"></script>
      <!-- AdminLTE App -->
      <script src="dist/js/adminlte.min.js"></script>
      <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
      <script src="dist/js/pages/dashboard.js"></script>
      <!-- AdminLTE for demo purposes -->
      <script src="dist/js/demo.js"></script>
   </body>
</html>