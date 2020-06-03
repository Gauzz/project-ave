<?php require '../includes/functions.php';
if (isset($_FILES["file"])) {
foreach ($_FILES["file"]["name"] as $i => $pImage) {
$imagename=rand().".jpg";
if (move_uploaded_file($_FILES["file"]["tmp_name"][$i],"uploads/product-images/".$imagename)) {
$queryInsertImage=saveData("product_image",["token" =>  $_POST["token"],"name" => $imagename]);
}
if ($queryInsertImage) {
echo "1";
}
else{
echo "0";
exit();
}

}
}
if (isset($_GET["token"])) {
$token=$_GET["token"];
/*Query For Product*/
$queryGetProduct=select("products","token='$token'");
if(howMany($queryGetProduct) > 0){
/*fetch Product Details*/
$getProduct=fetch($queryGetProduct);
$parentProductToken=$getProduct["token"];
/* fetch parent Product Details*/
/* fetch Product related Images*/
$queryForImages=select("product_image","token='$token'");
$totalImages=howMany($queryForImages);
$remainImages=6-$totalImages;
}
else{
move("index.php");
}
}
else{
move("index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'partials/_style.php'; ?>
        <style type="text/css">
        .block{height: 20px;width: 20px;display: inline-block;border: 1px solid #333;border-radius: 100%;line-height: 40px;}
        </style>
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
                    <div class="page-content">
                        <div class="page-bar">
                            <div class="page-title-breadcrumb">
                                <div class=" pull-left">
                                    <div class="page-title">Upload New Images :  <span class="block mt-2" style="background: <?= $getProduct["color"]; ?>;"></div></span>
                                </div>
                                <ol class="breadcrumb page-breadcrumb pull-right">
                                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Image Upload</li>
                            </ol>
                        </div>
                    </div>
                    <!-- add content here -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <div class="card-head">
                                <header>Upload Images </header>
                            </div>
                            <div class="card-body row">
                                <div class="col-lg-12 p-t-20">
                                    <form action="update-product-image.php?token=<?= $token; ?>" class="dropzone" id="my-dropzone">
                                        <div class="dz-message">
                                            <div class="dropIcon">
                                                <i class="material-icons">cloud_upload</i>
                                            </div>
                                            <h3>Drop files here or click to upload.</h3>
                                        </div>
                                    </form>
                                    <button class="btn btn-primary mt-3" style="display: none;" id="submit-all">upload</button>
                                    
                                </div>
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
<script type="text/javascript" src="assets/js/dropzone.js"></script>
<script type="text/javascript">
Dropzone.options.myDropzone = {
// Prevents Dropzone from uploading dropped files immediately
autoProcessQueue: false,
maxFiles: <?php echo($remainImages); ?>,
init: function() {
var submitButton = document.querySelector("#submit-all")
myDropzone = this; // closure
submitButton.addEventListener("click", function() {
myDropzone.processQueue();
// Tell Dropzone to process all queued files.
});
// You might want to show the submit button only when
// files are dropped here:
this.on("addedfile", function() {
// Show submit button here and/or inform user to click it.
$("#submit-all").show();
});
myDropzone.on('sending', function(file, xhr, formData){
formData.append('token','<?= $token; ?>');
});
myDropzone.on('success', function( file, resp ){
if (resp=='1') {
swal("Success","All Images Added To Product Successfully!","success");

}
if (resp=='0') {
swal("Oh Snap","Something Went Wrong Please Contact Your Devloper","error");
}

console.log("success");
console.log(resp);
});
}
};
</script>
</body>
</html>