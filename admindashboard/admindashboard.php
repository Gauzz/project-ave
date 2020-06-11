<?php
ob_start();
// connection to database
include('../includes/functions.php');
if(!array_key_exists("user",$_SESSION))
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

  <title>Pitchar Admin</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet">
  <link href="css/accordionstyling.css" rel="stylesheet">

</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
             <div class="container">
        <div class="row">
          <div class="col-sm-12">
              <a href="settings.html"> <h2 class="mt-4">Dashboard <div class="float-right text-secondary font16"><img class="border border-info rounded-circle p-1 ml-2" height="40" src="https://punchthrough.com/wp-content/uploads/2019/07/Anonymous-Testimonial.png"><span style="font-size: medium;">&nbsp;Sankalp</span></div></h2></a>
          <a href="../pitchar/logout.php" style="float: right;">Logout</a>
          </div>
        </div>
          </div>

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
          </div>
          <div class="container-fluid">
          <!-- Content Row -->
          <div class="row">

            <div class="col-xl-3 col-md-6 mb-4" style = "cursor:pointer;" onclick="location.href='users.php';">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Users</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id='users'></div>
                    </div>
                    <div class="col-auto">
                    <i class="fas fa-child fa-2x text-gray-300" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4" style = "cursor:pointer;" onclick=";">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Sales</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id='sales'></div>
                    </div>
                    <div class="col-auto">
                      <i class="fa fa-users fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4" style = "cursor:pointer;" onclick="">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Media</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" id = "media"></div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                    <i class="fa fa-picture-o" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4" style = "cursor:pointer;" onclick="location.href='';">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Assets</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id = "assets"></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>



          </div>


          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-7 col-lg-6">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Revenue Overview</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-5 col-lg-6">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Subscription Chart</h6>
                  <div class="dropdown no-arrow">
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                  </div>
                  <div class="mt-4 text-center small">
                    <span class="mr-2">
                      <i class="fas fa-circle text-primary"></i> Silver Plan
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-success"></i> Golden Plan
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-info"></i> Platinum Plan
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->



    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <div style = "z-index : 999;" id = 'spinner'>
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

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Charts.min.js"></script>
  <span id = 'confirmedstyling'></span>
  <span id = 'pendingstyling'>
  </span>
  <span id = 'cancelledstyling'></span>
  <span id = 'declinedstyling'></span>
   <?php
         $a = array(4,3,6);                       
    ?>
  <!-- Page level custom scripts -->
  <script src="js/demo/charts-area-demo.js"></script>
    <script>
    var jArray =<?php echo json_encode($a); ?>;</script>
  <script src="js/demo/graph-pie-demo.js"></script>
<script>
    $(document).ready(function(){
        $("#spinner").show();
        setInterval(() => {
            $("#allusers").load("allusers.php")
        }, 2000);
        $("#spinner").hide();
    })
  

</script>

</body>

</html>

