<?php
include 'secure_session.php';
if (isset($_GET["project"])) {
  $token=$_GET["project"];
  $query=mysqli_query($conn,"SELECT * FROM tbl_std_project WHERE token='$token'");
  $data=mysqli_fetch_array($query);
  $gettoken=$data["token"];
  $getName=$data["project_name"];
  $getID=$data["id"];
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
      <?php include 'favicon.php'; ?>

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

      <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

      <style>.btn-danger {

         background-color: black;

         border-color: black;

         width: 100px;

         margin-top: 20px;

         }

         

         .dngr{

                 background-color: #dd4b39;

    border-color: #d73925;

         }

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

                     <h2>

                        <span class="text-primary">Inviting For </span><?=  $getName ; ?></p> 

                     </h2>

                  </div>

               </div>

            </section>

            <!-- Main content -->

            <section class="content">

                

                <form method="POST">

                    <select required="" class="form-control js-example-tags" name="mails[]"  multiple="multiple" style="width: 80%;">
                    </select>
                    <input class="btn btn-primary" type="submit" name="share" value="Invite">

                </form>

                <?php
                  if (isset($_POST["share"])) {
                        $mailarr=$_POST["mails"];
                    foreach ($mailarr as $user_mails) {
                        $invite_insert_query= mysqli_query($conn,"INSERT INTO share_projects(token,std_id,std_email,std_name,tch_email,tch_id,project_name,project_id,type,date_time)VALUES('$gettoken','Not available','$user_mails','Not available','$getEmail','$user_name','$getName','$getID','invite',NOW())");
                                 $string_emails = $string_emails.",".$user_mails; 
                    }
                      $string_emails; 
                     $email_receipients =$string_emails;
                     require_once ('SendGrid-Starter-Kit-master/SendGrid-API/vendor/autoload.php'); 
                       $arr_value =  explode(',', $string_emails);
          

                        /*Post Data*/
                        /*Content*/
                        $from = new SendGrid\Email("pitchar", "Info@pitchar.io");
                        $subject = "Invitation";


                        $response="";
                        foreach($arr_value as $userEmails)
                        {       
                                // Sharing Link
                              $htmllink="https://pitchar.io/view-project.php?project=$gettoken&type=invite";
                              $link=htmlspecialchars($htmllink);
                               /*Send the mail*/
                            include 'assets/_php/invitation_email.php';
                        $content = new SendGrid\Content("text/html", $email_temp);
                        $to = new SendGrid\Email("Mayank",$userEmails);
                        $mail = new SendGrid\Mail($from, $subject, $to, $content);
                        $apiKey = ('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');
                        $sg = new \SendGrid($apiKey);

                        /*Response*/
                        $response = $sg->client->mail()->send()->post($mail);

                        }
                        if($response){
                        $_SESSION["mailsent"]="1";
                        header("Location:../../index.php");
                        }
                 
                    



                  }
                ?>

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

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script type="text/javascript">

// In your Javascript (external .js resource or <script> tag)

$(document).ready(function() {

   $(".js-example-tags").select2({
  tags: true,
   placeholder: "Enter Email Address"
});

 

});

</script>

   </body>

</html>