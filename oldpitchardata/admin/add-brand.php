<?php
require '../includes/functions.php';
if (isset($_POST["send"])) {
$cname=$_POST['categoryName'];
$valid_formats = array("png","jpeg","jpg");

$logoimage = $_FILES['image']['name'];
$imageSize = $_FILES['image']['size'];
if(strlen($logoimage)) {
list($txt, $ext) = explode(".", $logoimage);
if(in_array($ext,$valid_formats)) {
if($imageSize<(10240*10240)) {
$imageName = time().".".$ext;
$tmp = $_FILES['image']['tmp_name'];
move_uploaded_file($tmp,"uploads/BrandImages/".$imageName);
}
}
}else{
$imageName='no-thumbnail.png';
}

$logo = $_FILES['logo']['name'];
$logoSize = $_FILES['logo']['size'];
if(strlen($logo)) {
list($txt, $ext) = explode(".", $logo);
if(in_array($ext,$valid_formats)) {
if($logoSize<(10240*10240)) {
$logoName = time().".".$ext;
$tmp = $_FILES['logo']['tmp_name'];
move_uploaded_file($tmp,"uploads/BrandImages/BrandLogo/".$logoName);
}
}
}else{
$logoName='no-logo.png';
}
$query=select("brand","category_name='$cname'");
if (howMany($query)=='1') {
exit(json_encode(array('response' =>array("code" =>'2', "msg" => 'This Brand Already Exists'))));
}
else{
$send=saveData("brand",["category_name" => $_POST["categoryName"],"descr" => $_POST["categoryDescrip"],"image" => $imageName,"category_logo" => $logoName,"token" => token(12)]);
if ($send) {
$_SESSION["success"]="true";
exit(json_encode(array('response' => array("code" =>'1', "msg" => 'New Brand Created Successfully!'))));
}
else{
exit(json_encode(array('response' =>array("code" =>'0', "msg" => 'Opps There is An Error In Adding brand!'))));
}
}
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
                                    <div class="page-title">Add Brand</div>
                                </div>
                                <ol class="breadcrumb page-breadcrumb pull-right">
                                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Add Brand</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <div class="card-head">
                                <header>Add New</header>
                            </div>
                            <form id="formCategoryAdd" enctype="multipart/form-data">
                                <div class="card-body row">
                                    <div class="col-lg-4 p-t-20">
                                        <div class = "mdl-textfield mdl-js-textfield">
                                            <input autocomplete="off" required="" class = "mdl-textfield__input cname" type = "text" id = "text1" name="categoryName" pattern="[A-Z a-z]+">
                                            <label class = "mdl-textfield__label lblname" for = "text1">Brand Name</label>
                                            <span class = "mdl-textfield__error">Alphabets Required!</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 p-t-20">
                                        <div class = "mdl-textfield mdl-js-textfield txt-width" style="max-width: 100% !important;">
                                            <textarea  class = "mdl-textfield__input cdesc" rows =  "3"
                                            id = "text7" name="categoryDescrip" ></textarea>
                                            <label class = "mdl-textfield__label lbldesc" for = "text7">Description <small>(optional)</small></label>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-lg-12 p-t-20">
                                        <div class="row">
                                            <div class="col-lg-6 p-t-20">
                                                <h4>Brand Image</h4>
                                                <img src="https://images.disitu.com/MICROSITE/nothumbnail.png" id="category_image" height="250px" width="250px">
                                                <br><br>
                                                <input type="file" name="image" id="inputImage" onchange="document.getElementById('category_image').src = window.URL.createObjectURL(this.files[0])" style="display: none;">
                                                <button type="button" id="cateImage" class="btn btn-info">Upload Image</button>
                                            </div>
                                            <div class="col-lg-6 p-t-20">
                                                <h4>Brand Logo</h4>
                                                <img src="https://images.disitu.com/MICROSITE/nothumbnail.png" id="category_logo" height="250px" width="250px">
                                                <br><br>
                                                <input type="file" name="logo" id="inputLogo" onchange="document.getElementById('category_logo').src = window.URL.createObjectURL(this.files[0])" style="display: none;">
                                                <button type="button" id="cateLogo" class="btn btn-info">Upload Logo</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 p-t-20">
                                        <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"
                                        name="send">
                                        Create
                                        </button>
                                        <input type="hidden" name="send" value="true">
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
$("#cateLogo").click(function(event) {
$("#inputLogo").click();
});
$(document).ready(function (e) {
$('#formCategoryAdd').on('submit',(function(e) {
e.preventDefault();
var formData = new FormData(this);
$.ajax({
type:'POST',
url: 'add-brand.php',
data:formData,
cache:false,
dataType:'json',
contentType: false,
processData: false,
success:function(data){
if (data.response.code=='1') {
window.location.href='view-brand.php';
}
if (data.response.code=='0') {
swal("Oh Snap",data.response.msg,"error");
}
if (data.response.code=='2') {
swal("Oh Snap",data.response.msg,"warning");
}
},
error: function(data){
console.log("error");
console.log(data);
}
});
}));
});
</script>

</body>
</html>