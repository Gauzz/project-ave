<?php
session_start();
include 'connection.php';
if(!array_key_exists("admin",$_SESSION))
{
    header("location:../user/login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Users</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet">
  <link href="css/accordionstyling.css" rel="stylesheet">
  <style>
      </style>

</head>
  <!-- Page Wrapper -->
  <body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
                   <div class="container">
        <div class="row">
          <div class="col-sm-12">
              <a href="settings.html"> <h2 class="mt-4">Dashboard <div class="float-right text-secondary font16"><img class="border border-info rounded-circle p-1 ml-2" height="40" src="https://punchthrough.com/wp-content/uploads/2019/07/Anonymous-Testimonial.png"><span style="font-size: medium;">&nbsp;Sankalp</span></div></h2></a>
          <a href="../pitchar/logout.php" style="float: right;">Logout</a>
          </div>
        </div>


      
        <div class="container-fluid">

        <div id = "allusers"></div>
        
        <!-- /.container-fluid -->

      </div>
</div>
      </div>



  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>


  <div style = "z-index = 999;" id = 'spinner'>
            <img src = 'ajax-loader.gif' height = '64' width = '64' />
            <br>
            Loading...
            </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  <script>
$(function(){ 
        $("#spinner").show();
        $("#allusers").fadeOut();
          $.ajax({
        url: "userscode.php",
        type: "POST",
        success: function(data){
                    if(data)
                        {
                          $("#spinner").hide();
                             $("#allusers").html(data);
                             $("#allusers").slideDown();
                        }
        },
        error: function(){
          $("#spinner").hide();
            $("#allusers").html("<div class = 'alert alert-danger'>Issue with ajax call.Plz try later </div>");
            $("#allusers").slideDown();
        }
    });
  });
</script>

</body>

</html>
