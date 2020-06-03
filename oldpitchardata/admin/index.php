<?php

require '../includes/functions.php';

secureAdmin();

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <?php include 'partials/_style.php'; ?>

</head>

<body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">

    <div class="page-wrapper">

		<?php include 'partials/_header.php'; ?>

        <div class="page-container">

 			    <?php include 'partials/_sidebar.php'; ?>

            <div class="page-content-wrapper">

                <div class="page-content">

                    <div class="page-bar">

                        <div class="page-title-breadcrumb">

                            <div class=" pull-left">

                                <div class="page-title">Dashboard</div>

                            </div>

                            <ol class="breadcrumb page-breadcrumb pull-right">

                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>

                                </li>

                                <li class="active">Dashboard</li>

                            </ol>

                        </div>

                    </div>

                    <div class="state-overview">

                        <div class="row">

                            <!--<div class="col-xl-3 col-md-6 col-12">

                              <div class="info-box bg-blue pb-5">

                                <span class="info-box-icon push-bottom"><i class="material-icons">style</i></span>

                                <div class="info-box-content">

                                  <span class="info-box-text">Orders</span>

                                  <span class="info-box-number"><?php /* $order=select("orders","status=1"); echo howMany($order); */

                                  ?></span>

                                </div>

                              </div>

                            </div>-->

                            <div class="col-xl-3 col-md-6 col-12">

                              <div class="info-box bg-orange pb-5">
                                <a href="view-customer.php" style="color: white;">
                                <span class="info-box-icon push-bottom"><i class="material-icons">group</i></span>

                                <div class="info-box-content">

                                  <span class="info-box-text">Users</span>

                                  <span class="info-box-number">
                                  <?php 


                                  $usersNum=query("SELECT * FROM tbl_users");
                                  $userTotal= howMany($usersNum);

                                  /*$usersNum=query("SELECT * FROM google");                          
                                  $userGog= howMany($usersNum);
                                  $usersFac=query("SELECT * FROM facebook_users");
                                  $userFb= howMany($usersFac);
                                  $usersTot= $userGog+$userFb;*/

                                  echo $userTotal;

                                  ?></span>

                                </div>
                                </a>

                              </div>

                            </div>

                            <div class="col-xl-3 col-md-6 col-12">

                              <div class="info-box bg-purple pb-5">
                                <a href="view_enquiry.php" style="color: white;">

                                <span class="info-box-icon push-bottom"><i class="material-icons">card_travel</i></span>

                                <div class="info-box-content">

                                  <span class="info-box-text">Templates</span>

                                  <span class="info-box-number"><?php

                                   $inqueryNo=select('post_templates');

                                   echo howMany($inqueryNo);

                                  ?></span>

                                </div>
                                </a>

                              </div>

                            </div>

                               <div class="col-xl-3 col-md-6 col-12">

                              <div class="info-box bg-orange pb-5">
                                 <a href="view_enquiry.php" style="color: white;">

                                <span class="info-box-icon push-bottom"><i class="material-icons">image</i></span>

                                <div class="info-box-content">

                                  <span class="info-box-text">Images</span>

                                  <span class="info-box-number"><?php $orderNum=query("SELECT * FROM post_images");

                                  echo howMany($orderNum);

                                  ?></span>

                                </div>
                              </a>
                              </div>

                            </div>

                               <div class="col-xl-3 col-md-6 col-12">

                              <div class="info-box bg-orange pb-5">

                                <span class="info-box-icon push-bottom"><i class="material-icons">3d_rotation</i></span>

                                <div class="info-box-content">

                                  <span class="info-box-text">3d Models</span>

                                  <span class="info-box-number"><?php $orderNum=query("SELECT * FROM post_models");

                                  echo howMany($orderNum);

                                  ?></span>

                                </div>

                              </div>

                            </div>

                          </div>

                        </div>

                         <div class="row">

                        <div class="col-md-12 col-sm-12">

                            <div class="card  card-box">

                                <div class="card-head">

                                    <header>Latest Users</header>

                                    <div id="viewbtn" onclick="viewCustomer();" class="label label-sm label-warning" style="margin-top: 10px;float:right;"><a style="font-size: 12px;font-weight: 400; ">View All</a></></div>

                                </div>

                                <div class="card-body ">

                                  <div class="table-wrap">



                                        <div class="table-responsive">

                                        <table class="table display product-overview mb-30" id="example1"><!-- support_table5 -->

                                                <thead>

                                                    <tr>

                                                        <th>No</th>

                                                        <!-- <th>Image</th> -->

                                                        <th>Firstname</th>

                                                        <th>Lastname</th>

                                                        <th>Email</th>

                                                        <th>Occupation</th>

                                                        <th>Country</th>

                                                        <th>User Type</th>

                                                        <th>Join On</th>

                                                    </tr>

                                                </thead>

                                                <tbody>

                                                <?php 

                                                $i=1;

                                                /*$selectGoogle=query("SELECT * FROM google ORDER BY id DESC LIMIT 10");
                                                $selectFacebook=query("SELECT * FROM facebook_users ORDER BY id DESC LIMIT 10");*/
                                                $selectCustomers=query("SELECT * FROM tbl_users ORDER BY id");
                                                while($row=mysqli_fetch_array($selectCustomers)){

                                                ?>

                                                    <tr>

                                                        <td><?= $i++; ?></td>

                                                       <!--  <td class="user-circle-img sorting_1"><img src="uploads/userDefault.png" height="50px" width="50px"></td> -->

                                                        <td><?php echo $row['firstname'];?></td>

                                                        <td><?php echo $row['lastname'];?></td>

                                                        <td><?php echo $row['email'];?></td>

                                                        <td><?php echo $row['occupation'];?></td>

                                                        <td><?php echo $row['country'];?></td>

                                                        <td><?php echo $row['user_type'];?></td>

                                                        <td><?php echo $row['reg_time'];?></td>

                                                    </tr>

                                                <?php } ?>

                                                </tbody>

                                            </table>

                                        </div>

                                    </div>  

                                </div>

                            </div>

                        </div>

                    </div>

               

                </div>

            </div>

        </div>

        <script type="text/javascript">

                function  viewCustomer()

                {

                    document.getElementById('viewbtn').innerHTML='<i class="fa fa-spinner fa-spin" style="font-size:20px"></i>Redirecting....';

                    setTimeout(function(){

                   window.location.href="view-customer.php";

                    }, 500);

                }

        </script>

            <?php include 'partials/_footer.php'; ?>

    </div>

    <?php include 'partials/_script.php'; ?>

</body>

</html>