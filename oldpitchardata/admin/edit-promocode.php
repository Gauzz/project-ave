<?php
include '../includes/functions.php';
if (isset($_GET["token"]) AND !empty($_GET["token"])) {
$token = base64_decode($_GET["token"]);
$selectPromoCode = select("promocode","token='$token'");
if (howMany($selectPromoCode) > 0) {
$fetchPromoCode = fetch($selectPromoCode);
}
else{
move('index.php');
}

}else{
move('index.php');
}
secureAdmin();
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
                                    <div class="page-title">Edit Promo Code</div>
                                </div>
                                <ol class="breadcrumb page-breadcrumb pull-right">
                                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Edit Promo Code</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <div class="card-head">
                                <header>Edit New</header>
                            </div>
                            <form id="editPromoCode" enctype="multipart/form-data">
                                <div class="card-body row">
                                    <div class="col-lg-6 p-t-20">
                                        <div class = "mdl-textfield mdl-js-textfield full-width">
                                            <input autocomplete="off" value="<?php echo $fetchPromoCode["promocode"]?>" required="" class = "mdl-textfield__input cname" type = "text" id = "text1" name="promocode" style="text-transform: uppercase;">
                                            <label class = "mdl-textfield__label lblname" for = "text1">Promo Code Name</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 p-t-20">
                                        <div class = "mdl-textfield mdl-js-textfield full-width" id="staticParent">
                                            <input autocomplete="off" value="<?php echo $fetchPromoCode["promocode_persentage"]?>" maxlength="3" required="" class = "mdl-textfield__input cname" type = "text" id = "child" name="promocodePercentage">
                                            <label class = "mdl-textfield__label lblname" for = "text1">Promo Code Percentage</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 p-t-20">
                                        <div class = "mdl-textfield mdl-js-textfield full-width">
                                            <input id="datepicker" value="<?php echo $fetchPromoCode["exp_date"]?>" placeholder="Promo Code Expire Date" name="expDate" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="col-lg-12 p-t-20">
                                        <div class = "mdl-textfield mdl-js-textfield txt-width" style="max-width: 100% !important;">
                                            <textarea  class = "mdl-textfield__input cdesc" rows =  "3"
                                            id = "text7" name="desc" ><?php echo $fetchPromoCode["description"]?></textarea>
                                            <label class = "mdl-textfield__label lbldesc" for = "text7">Description <small>(optional)</small></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 p-t-20">
                                        
                                        
                                        <h4>Promo Code Banner</h4>
                                        <img src="<?php echo (isset($fetchPromoCode["banner"])) ? 'uploads/slider/'.$fetchPromoCode["banner"]:'http://hcdpierre.com/wp-content/themes/Ciola/library/images/thumbnail-600x350.png' ;?>" id="category_image" height="auto" width="100%">
                                        <br><br>
                                        <input type="file" name="banner" id="inputImage" onchange="document.getElementById('category_image').src = window.URL.createObjectURL(this.files[0])" style="display: none;">
                                        <button type="button" id="cateImage" class="btn btn-info">Upload Image</button>
                                        
                                        
                                    </div>
                                    
                                    <div class="col-lg-12 p-t-20" style="text-align: center">
                                        <button type="submit" id="promocode" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"
                                        name="send">
                                        Create
                                        </button>
                                        <input type="hidden" name="editPromoCode" value="true">
                                        <input type="hidden" name="token" value="<?php echo $token?>">
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
$("#cateImage").click(function(event) {
$("#inputImage").click();
});
$(function() {
$('#staticParent').on('keydown', '#child', function(e){-1!==$.inArray(e.keyCode,[46,8,9,27,13,110])||(/65|67|86|88/.test(e.keyCode)&&(e.ctrlKey===true||e.metaKey===true))&&(!0===e.ctrlKey||!0===e.metaKey)||35<=e.keyCode&&40>=e.keyCode||(e.shiftKey||48>e.keyCode||57<e.keyCode)&&(96>e.keyCode||105<e.keyCode)&&e.preventDefault()});
});
$('#datepicker').datepicker();
</script>
</body>
</html>