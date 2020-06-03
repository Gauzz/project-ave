<?php
include '../includes/functions.php';
secureAdmin();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'partials/_style.php'; ?>
    </head>
    <!-- END HEAD -->
    <body class="text-capitalize page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
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
                                    <div class="page-title">View Promo Code</div>
                                </div>
                                <ol class="breadcrumb page-breadcrumb pull-right">
                                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">View Promo Code</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="card  card-box">
                                <div class="card-head">
                                <header>All Promo Code</header>
                            </div>
                            <div class="card-body ">
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table class="table display product-overview mb-30" id="support_table5">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Images</th>
                                                    <th>Promo Code</th>
                                                    <th>Promo Code Percentage</th>
                                                    <th>Exp Date</th>
                                                    <th>Description</th>
                                                    <th>Created On</th>
                                                    <th>Action </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $query=select("promocode ORDER BY id DESC");
                                                $i=1;
                                                while($getCategory=fetch($query)){
                                                $date=date_create($getCategory["created_date"]);
                                                ?>
                                                <tr class="<?= 'cls'.$getCategory["id"]; ?>">
                                                    <td><?= $i++ ?></td>
                                                    <td><img src="uploads/slider/<?php echo $getCategory["banner"] ;?>" style="width: 300px;height: 150px;"></td>
                                                    <td id="token_<?= $getCategory["token"]; ?>"><?php echo $getCategory["promocode"];?></td>
                                                    <td><?php echo $getCategory["promocode_persentage"];?>%</td>
                                                    <td><?php echo $getCategory["exp_date"];?></td>
                                                    <td><?php echo $getCategory["description"];?></td>
                                                    <td><?php echo date_format($date,"d/m/Y");?></td>
                                                    <td>
                                                        <a data-token="<?= $getCategory["token"]; ?>" href="edit-promocode.php?token=<?php echo base64_encode($getCategory["token"]);?>" class="btn btn-tbl-edit btn-xs editcategory">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                        <button data-id="<?= $getCategory["id"]; ?>" value="<?= $getCategory["token"]?>" class="btn btn-tbl-delete btn-xs deletepromocode">
                                                        <i class="fa fa-trash-o "></i>
                                                        </button>
                                                    </td>
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
                <!-- end category Details -->
            </div>
        </div>
        <!-- end page content -->
    </div>
    <?php include 'partials/_footer.php'; ?>
    <!-- end footer -->
</div>
<?php include 'partials/_script.php'; ?>
<script type="text/javascript">
<?php if (isset($_SESSION["add"])): ?>
swal("Success","New Promo Code Created Successfully!","success");
<?php endif;unset($_SESSION["add"]); ?>
<?php if (isset($_SESSION["update"])): ?>
swal("Success","Your Promo Code Updated Successfully!","success");
<?php endif;unset($_SESSION["update"]); ?>
</script>
</body>
</html>