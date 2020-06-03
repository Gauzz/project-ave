<?php
require '../includes/functions.php';
if (!isset($_GET["orderId"]) And empty($_GET["orderId"])) {
move("index.php");
}
else{
$orderId=$_GET["orderId"];
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'partials/_style.php'; ?>
    </head>
    <body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
        <div class="page-wrapper">
            <!-- start header -->
            <?php include 'partials/_header.php'; ?>
            <!-- end header -->
            <!-- start page container -->
            <div class="page-container">
                <!-- start sidebar menu -->
                <?php include 'partials/_sidebar.php'; ?>
                <!-- end sidebar menu -->
                <!-- start page content -->
                <div class="page-content-wrapper">
                    <div class="page-content">
                        <div class="page-bar">
                            <div class="page-title-breadcrumb">
                                <div class=" pull-left">
                                    <div class="page-title">Order Details</div>
                                </div>
                                <ol class="breadcrumb page-breadcrumb pull-right">
                                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Order Details</li>
                            </ol>
                        </div>
                    </div>
                    <!-- add content here -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card card-topline-green">
                                <div class="card-head">
                                <header style="text-transform: uppercase;">Items Details</header>
                            </div>
                            <div class="card-body ">
                                <div class="table-scrollable">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Product</th>
                                                <!--    <th>Order Status</th> -->
                                                <th>Quantity</th>
                                                <th>Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $queryGetDetails=select("orderitems","orderid='".$orderId."'");
                                            $i=1;
                                            while ($fetchDetails=fetch($queryGetDetails)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php
                                                    $queryGetProductDetail=select("productInfo","id='".$fetchDetails["pid"]."'");
                                                    $getToken=fetch($queryGetProductDetail);
                                                    $token=$getToken['id'];
                                                    // $fetchInfo=select("products","token='$token'");
                                                    // $ProductInfo=mysqli_fetch_array($fetchInfo);
                                                    echo $getToken["product_name"];
                                                ?></td>
                                                
                                                <td><?= $fetchDetails["pquantity"]; ?></td>
                                                <td>&#8377; <?= $fetchDetails["productprice"]; ?></td>
                                            </tr>
                                            <?php $i++; } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--      <div class="row">
                    <div class="col-md-12">
                        <div class="card card-topline-red">
                            <div class="card-head">
                            <header class="text-uppercase">Order Notes</header>
                        </div>
                        <div class="card-body "><?php //
                            $queryGetMoreDetails=select("orders","id='$orderId'");
                            $billingDetail=fetch($queryGetMoreDetails);
                            $cid= $billingDetail["uid"];
                            $queryGetemail=select("customers","id='$cid'");
                            $cus_email=fetch($queryGetemail);
                            $cid_email=$cus_email['email'];
                            // if($billingDetail['notes']=="")
                            //  {
                            //   }else{
                            //      echo $billingDetail['notes'];
                            //    }
                        ?></div>
                    </div>
                </div>
                
            </div> -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-topline-lightblue">
                        <div class="card-head">
                        <header class="text-uppercase">Billing And Address</header>
                    </div>
                    <?php
                    
                    
                    // $queryGetCustomerDetails=select("customers","uid='$cid'");
                    // $user=fetch($queryGetCustomerDetails);
                    ?>
                    <div class="card-body ">
                        <b> FULL NAME:</b> <?= $cus_email["fullname"]; ?>
                       <br>
                        <b> EMAlL:</b> <?= $cus_email['email']; ?>
                        <br>
                        <b>PHONE:</b> <?= $cus_email["phone"]; ?>
                        <br>
                        <b>ADDRESS:</b> <?= $cus_email["address"]; ?>
                        <?php if (!empty($billingDetail["address2"])): ?>
                        <br>
                        <?= $user["address2"]; ?>
                        <?php endif ?>
                        <br>
                        <b>POSTCODE:</b> <?= $cus_email["zipcode"]; ?>
                        <br>
                        <b>PAYMENT METHOD:</b><?php echo $billingDetail['paymentmode'];?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end page content -->
</div>
<!-- end page container -->
<!-- start footer -->
<?php include 'partials/_footer.php'; ?>
<!-- end footer -->
</div>
<?php include 'partials/_script.php'; ?>
</body>
</html>