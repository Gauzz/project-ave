<?php
 
session_start();
 
include 'conn.php';
ob_start();
 
 if(!isset($_SESSION["login"])){
     header("Location:register.php");
 }

if (isset($_SESSION["EMail"])) {
    

// Checking Which Session is Active or Set..
 if (isset($_SESSION["getEmail"])) {
    $manual=$_SESSION["getEmail"];
    $_SESSION["getEid"]=$manual;
 }

 if (isset($_SESSION['userData']['emails']['0']['value'])) {
    $gmail=$_SESSION['userData']['emails']['0']['value'];
    $_SESSION["getEid"]=$gmail;
 }
 if (isset($_SESSION['userDatafb']['email'])) {
    $fbid=$_SESSION['userDatafb']['email'];
    $_SESSION["getEid"]=$fbid;
 }
 if (isset($_SESSION["email"])) {
    $lmail= $_SESSION["email"];
    $_SESSION["getEid"]=$lmail;
 }
 
// one of them must be set to stay on this page
 if (empty($_SESSION["getEid"])) {
     header("Location:login.php");
 }
 if (!empty($_SESSION["getEid"])) {
    $eid=$_SESSION["getEid"];
 }
}

else{
    header("Location:login.php");
}
 //Getting Logged In user Info
 $fetchUserData=mysqli_query($conn,"SELECT * FROM tbl_users WHERE email='$eid'");
 $getUserData=mysqli_fetch_array($fetchUserData);
 //Basic details
 $getEmail=$getUserData["email"];
 $user_name=$getUserData["fullname"];
 $_SESSION["username"]=$user_name;
 $status=$getUserData["occupation"];
$getDisplayPic=$getUserData["display_pic"];

 
  $id=1;
   $start=0;
   $limit=25;
    
	if(isset($_GET["id"])) 
{

	$id=$_GET["id"];
	$start=($id-1)*$limit;
  if ($_GET["id"] < 0) {
    $id=1;
  }
}


  if(isset($_POST['createpdf'])){
    $post = $_POST;   
    $file_folder = "files/";  // folder to load files
    if(extension_loaded('zip')){  // Checking ZIP extension is available
      // Checking files are selected
        $zip = new ZipArchive();      // Load zip library 
        $zip_name = time().".zip";      // Zip name
        if($zip->open($zip_name, ZIPARCHIVE::CREATE)!==TRUE){   // Opening zip file to load files
          $error .=  "* Sorry ZIP creation failed at this time<br/>";
        }
              
          //$zip->addFile($file_folder.$file);      // Adding files into zip
          $zip->addFile("uploads/doc/9lessons.docx");     // Adding files into zip
          $zip->addFile("uploads/image/flowers.jpg");     // Adding files into zip
       
        $zip->close();
        if(file_exists($zip_name)){
          // push to download the zip
          header('Content-type: application/zip');
          header('Content-Disposition: attachment; filename="'.$zip_name.'"');
          readfile($zip_name);
          // remove zip file is exists in temp path
          unlink($zip_name);
        }
        
         
    }else
      $error = "* You dont have ZIP extension<br/>";
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
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
       <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
      <style>
         .bg-teal-gradient{background:white !important;}
      </style>
   </head>
   <body class="hold-transition skin-blue sidebar-mini">
<?php
 if(isset($_SESSION["mailsent"])){ ?>
  <div id="emailSuccessAlert" style="position: fixed;z-index: 9999;bottom: 0;right: 0;background: #43425D;color: white;" class="alert   alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Success!</strong> Your Project has Been Share With Mentioned Recipient!
    </div> 
<?php
     unset($_SESSION["mailsent"]);
 }
?>

      
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
                     <h2>
                        PITCHAR.IO Projects
                     </h2>
                  </div>
                  <form  method="GET" action="web-search.php">
                  <div class="col-md-6">
                     <ol class="breadcrumb">
                        <div class="input-group">
                           <input type="text" required="" name="query" class="form-control" placeholder="Search...">
                           <span class="input-group-btn">
                           <button type="submit"   id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                           </button>
                           </span>
                        </div>
                     </ol>
                  </div>
                  </form>
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
                     <div class="box box-solid bg-teal-gradient"id="fr">
                        
                        <!-- /.box-body -->
                        <div class="box-footer no-border">
                           <div class="row">
                              
                                 <div class="col-lg-12">
                                     
                                     
               <a href="choose.php">
                                    <div class="col-lg-3">
                                       <img src="dist/img/plus.png" class="stimg">
                                    </div>
                                    <div class="col-lg-7 col-lg-offset-1"id="stdetails">
                                       <h3>Create an PITCHAR.IO Project</h3>
                                    </div>
                                 </div>
                              </a>
                           </div>
                           <!-- /.row -->
                        </div>
                        <!-- /.box-footer -->
                   
                     <!-- /.box -->
                     <!-- /.box -->
                  </section>
                  <!-- right col -->
               </div>
               <div class="row">
<!--section for loop-->
<?

$query=mysqli_query($conn,"SELECT * FROM tbl_std_project WHERE email='$getEmail' ORDER BY submit_time DESC LIMIT $start,$limit ");
while($data=mysqli_fetch_array($query)){
?>
                  <section id="fg" class="col-lg-6 connectedSortable get<?php echo $data["id"];?>">
                     <!-- solid sales graph -->
                     <div style="min-height: 150px;" class="box box-solid bg-teal-gradient">
                       
                        <!-- /.box-body -->
                        <div class="box-footer no-border">
                           <div class="row">
                              <div class="col-lg-12">
                                  <div class="alert alert-success alert-dismissible">
               
                <a href="javascript:void(0)" data-token='<?= $data["token"]; ?>' data-email="<?= $eid; ?>" id="Close" data-id="get<?php echo $data["id"];?>" class="close CloseProject">×</a>
               <a href="edit2.php?pid=<?php echo $data["token"]; ?>" id="edit"> <i class="fa fa-pencil" aria-hidden="true" id="fi"></i></a>
                                 <div class="col-lg-3">
                                    <img src="../img/doc-placeholder-blue.png" class="stimg">
                                 </div>
                                 <div class="col-lg-7 col-lg-offset-1"id="stdetails">
                                    <h3 class="head1"><a href="view-global.php?project=<?php echo $data["token"];?>"><?= $data["project_name"];?></a></h3>
                                    <p><?= $data["subject"]?></p>
                                    <p><?= $data["book"]?></p>
                                    <div class="">
                                       <a href="<?php echo (empty($data["docs"])) ? 'javaScript:void(0)' : 'uploads/docs/'.$data["docs"] ; ?>" class="<?php echo (empty($data["docs"])) ? 'emptyFile' : ' ' ; ?>" ><i class="fa fa-file"id="gr"></i></a>

                                       <?php

                                       $queryGetImage=mysqli_query($conn,"SELECT * FROM tbl_project_image WHERE token='".$data["token"]."'");
                                        $checkImage=mysqli_fetch_array($queryGetImage);
                                       $countImages=mysqli_num_rows($queryGetImage);
                                       if ($countImages=='0') { ?>
                                         <a href="javaScript:void(0)" class="emptyFile"><i class="fa fa-image"id="gr"></i></a>
                                         
                                       <?php }
                                       if ($countImages>="1") {
                                         ?>
                                         <a href="uploads/imgs/<?php echo $checkImage["image"];?>"  ><i class="fa fa-image"id="gr"></i></a>
                                         <?php
                                       }

                                       ?>

                                      

                                       <a href="<?php echo (empty($data["objfile"])) ? 'javaScript:void(0)' : 'obj-viewer.php?token='.$data["token"] ; ?>" class="<?php echo (empty($data["objfile"])) ? 'emptyFile' : ' ' ; ?>"><i class="fa fa-cube"id="gr"></i></a>
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
<?php } 
?>

 


 

 

                  <!-- right col -->
               </div>
            
    
                 
                  
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="col-sm-5">
               
                        </div>
                        <div class="col-sm-7">
                           <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                              <ul class="pagination">
  					
  					<?php
$rows=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM tbl_std_project WHERE email='$getEmail' "));
$total=ceil($rows/$limit);

if($id>1)
{
	echo '<li class="disabled" ><a href="?id='.($id-1).'">&laquo; </a></li>';
}

for($i=1;$i<=$total;$i++)
{
	echo "<li><a href=?id=".($i)."' >$i</a></li>";
}
if($id!=$total)
{
	echo "<li><a href='?id=".($id+1)."'>&raquo;</a></li>";
}

if ($rows<=25) {
  echo "";
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
         
         <!-- Control Sidebar -->
         
         <!-- /.control-sidebar -->
         <!-- Add the sidebar's background. This div must be placed
            immediately after the control sidebar -->
         <div class="control-sidebar-bg"></div>
      </div>
      <!-- ./wrapper -->
      <!-- jQuery 3 -->
      <script src="bower_components/jquery/dist/jquery.min.js"></script>

      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
      <script type="text/javascript">
        $(document).ready(function() {
           $(".CloseProject").click(function() {
              var val=$(this).data("id");
              var email=$(this).data("email");
              var token=$(this).data("token");
                swal({
                  title: "Are you sure?",
                  text: "Once deleted, you will not be able to recover this Project!",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                })
                .then((willDelete) => {
                  if (willDelete) {
                    swal("Success! Your Project has been deleted!", {
                      icon: "success",
                    });
                  
                    $('.'+val).hide('slow');
                    $.ajax({
                            url: "assets/_php/ProjectDelete.php",
                            type:"POST",
                            async:false,
                            data:{
                                "done" : 1,
                                "pid" : val,
                                "email":email,
                                "token":token
                            },
                            success:function(data){
                                //displaydata();
                                //$("#like").val('');
                            }
                            });

                  } else {
                    swal("Your Project is safe!");
                  }
                });
              
           });

           $(".emptyFile").click(function() {
              swal("Oops", "No File Attached to This Media!", "info");
           });

          setTimeout(function () {
            $("#emailSuccessAlert").fadeOut();
          },6000);
        });
      </script>
      <?php include'footer.php'?>
      <?php if (isset($_SESSION["success"])): ?>
          <script type="text/javascript">
            swal("Success",'<?= $_SESSION["success"]?>',"success");
          </script>
      <?php endif;unset($_SESSION["success"]); ?>
   </body>
</html>