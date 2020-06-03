<?php
include '../includes/functions.php';
secureAdmin();
if(isset($_SESSION['giftvoucher_password'])){
 $SESSION=$_SESSION['giftvoucher_password'];
}else{
   unset($_SESSION['giftvoucher_password']);
   header("Location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'partials/_style.php'; ?>
    </head>
    <!-- END HEAD -->
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
                    <div class="page-content" style="min-height: 800px !important;">
                        <div class="page-bar">
                            <div class="page-title-breadcrumb">
                                <div class=" pull-left">
                                    <div class="page-title">Send Gift Promo Code</div>
                                </div>
                                <ol class="breadcrumb page-breadcrumb pull-right">
                                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Send Gift Promo Code</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <div class="card-head">
                                <header>Add New</header>
                                <a href="logOut-giftPromocode.php" class="btn dark btn-outline float-right">Log Out</a>
                            </div>
                            <form id="sendgiftPromoCode" enctype="multipart/form-data">
                                <div class="card-body row">
                                    <div class="col-lg-6 p-t-20">
                                        <div class = "mdl-textfield mdl-js-textfield full-width">
                                            <input autocomplete="off" required="" class = "mdl-textfield__input cname" type = "text" id = "text1" name="promocode" style="text-transform: uppercase;">
                                            <label class = "mdl-textfield__label lblname" for = "text1">Promo Code Name</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 p-t-20">
                                        <div class = "mdl-textfield mdl-js-textfield full-width" id="staticParent">
                                            <input autocomplete="off" maxlength="4" required="" class = "mdl-textfield__input cname" type = "text" id = "child" name="promocodePrice">
                                            <label class = "mdl-textfield__label lblname" for = "text1">Promo Code Price</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 p-t-20">
                                        <div class = "mdl-textfield mdl-js-textfield full-width">
                                            <input id="datepicker" placeholder="Promo Code Expire Date" name="expDate" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 p-t-20">
                                        <div class = "mdl-textfield mdl-js-textfield full-width">
                                            <input list="brow" autocomplete="off" placeholder="User Email" value="" class="mdl-textfield__input cname" name="email">
                                            <datalist id="brow">
                                            <?php
                                            $selectCustomers = select("customers");
                                            while ($fetchCustomer = fetch($selectCustomers)) { ?>
                                            
                                            <option value="<?php echo $fetchCustomer["email"]?>">
                                                <?php echo $fetchCustomer["email"]?>
                                                
                                                <?php } ?>
                                                </datalist>
                                                
                                                
                                                
                                                
                                            </div>
                                        </div>
                                        <div class="col-lg-12 p-t-20">
                                            <div class = "mdl-textfield mdl-js-textfield txt-width" style="max-width: 100% !important;">
                                                <textarea  class = "mdl-textfield__input cdesc" rows =  "3"
                                                id = "text7" name="desc" ></textarea>
                                                <label class = "mdl-textfield__label lbldesc" for = "text7">Description <small>(optional)</small></label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-12 p-t-20" style="text-align: center">
                                            <button type="submit" id="promocode" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"
                                            name="send">
                                            Send Gift Card
                                            </button>
                                            <input type="hidden" name="sendgiftPromoCode" value="true">
                                        </div>
                                    </div>
                                </form>
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
    <script type="text/javascript">
    $(function() {
    $('#staticParent').on('keydown', '#child', function(e){-1!==$.inArray(e.keyCode,[46,8,9,27,13,110])||(/65|67|86|88/.test(e.keyCode)&&(e.ctrlKey===true||e.metaKey===true))&&(!0===e.ctrlKey||!0===e.metaKey)||35<=e.keyCode&&40>=e.keyCode||(e.shiftKey||48>e.keyCode||57<e.keyCode)&&(96>e.keyCode||105<e.keyCode)&&e.preventDefault()});
    });
    $('#datepicker').datepicker();
    </script>
</body>
</html>