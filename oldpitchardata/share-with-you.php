<?php include 'secure_session.php'; ?>

<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Share Projects</title>
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
      <?php include 'favicon.php'; ?>
      <link rel="stylesheet" href="bower_components/morris.js/morris.css">
      <!-- jvectormap -->
      <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
      <!-- Date Picker -->
      <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
      <!-- Daterange picker -->
      <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
      <!-- bootstrap wysihtml5 - text editor -->
      <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
      <!-- Google Font -->
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
               <div class="row">
                  <div class="col-md-6">
                     <h3 class="srb">
                        Share With You

                     </h3>
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
 
               <div class="row">
<!--section for loop-->
<?
$query=mysqli_query($conn,"SELECT * FROM share_projects WHERE std_email='$getEmail' ORDER BY date_time DESC");
$count= mysqli_num_rows($query);


if ($count==0) {
   echo "<p class='text-center text-primary h5'>No Projects Found!</p>";
}
 
while($data=mysqli_fetch_array($query)){

?>
                  <section class="col-lg-6 connectedSortable">
                     <!-- solid sales graph -->
                     <div class="box box-solid bg-teal-gradient" style="min-height: 150px;">
    
                        <!-- /.box-body -->
                        <div class="box-footer no-border">
                           <div class="row">
                              <div class="col-lg-12">
                                  <div class="alert alert-success alert-dismissible">
               
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
               <a href="#"> <i class="fa fa-pencil" aria-hidden="true" id="fi"></i></a>
                                 <div class="col-lg-3">
                                    <img src="../img/doc-placeholder-blue.png" class="stimg">
                                 </div>
                                 <div class="col-lg-7 col-lg-offset-1"id="stdetails">
                                    <h3 class="head1"><a href="view-global.php?project=<?php echo $data["token"];?>"><?= $data["project_name"];?></a></h3>
                                    <p><strong>Shared By: </strong> <?= $data["tch_id"]?></p>
                                    <p><strong>At: </strong><?php $datetime= $data["date_time"]; $date=date_create($datetime);echo date_format($date,"d M,Y h:s A");?></p>
                                    <div class="">
                                       <a href="<?php echo (!empty($data["docs"])) ? "uploads/docs/".$data["docs"] : " " ; ?>" onClick="<?php echo (!empty($data["docs"])) ? " " : "alert('No Documents Attached to This Project!')" ; ?>" class=""><i class="fa fa-file"id="gr"></i></a>
                                       <a href="<?php echo (!empty($data["image"])) ? "uploads/imgs/".$data["image"] : " " ; ?>" onClick="<?php echo (!empty($data["image"])) ? " " : "alert('No Images Attached to This Project!')" ; ?>" class=""><i class="fa fa-image"id="gr"></i></a>
                                       <a class=""><i class="fa fa-cube"id="gr"></i></a>
                                    </div>
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
            
    
                 
                  
 
                  <!-- right col -->

               <!-- /.row (main row) -->
            </section>
            <!-- /.content -->
         </div>
         <!-- /.content-wrapper -->
         <?php include'footer.php';?>
         <!-- Control Sidebar -->
         
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