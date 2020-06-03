<?php
require '../includes/functions.php';
/*Update Category*/
if (isset($_POST["editCategory"])) {
$token = $_POST['token'];
$query = select("brand", "token='$token'");
$getCategory = fetch($query);
$categoryId = $getCategory["id"];
if (howMany($query) == '0') {
exit(json_encode(array(
'response' => array(
"code" => '2',
"msg" => 'This brand Not Exists'
)
)));
}
else {
$image=rand().".jpg";
$logoName = (!empty($_FILES["logo"]["name"])) ? $image : $getCategory["category_logo"] ;
if (!empty($_FILES["logo"]["name"])) {
if ($_FILES["logo"]["type"]=="image/jpeg" OR $_FILES["logo"]["type"]=="image/png" OR $_FILES["logo"]["type"]=="image/jpg") {
move_uploaded_file($_FILES["logo"]["tmp_name"],'uploads/BrandImages/BrandLogo/'.$image);
}
else{
exit(json_encode(array("response" => array("code" => "0" ,"msg" => "File type Must be Image"))));
}
}
$imageName = (!empty($_FILES["image"]["name"])) ? $image : $getCategory["image"] ;
if (!empty($_FILES["image"]["name"])) {
$name = $_FILES["image"]["name"];
$tmp = $_FILES["image"]["tmp_name"];
if ($_FILES["image"]["type"] == 'image/png' OR $_FILES["image"]["type"] == 'image/jpeg') {
if ($_FILES["image"]["size"] < 10000000) {
if (move_uploaded_file($tmp, "uploads/BrandImages/".$imageName)) {
$send = update("brand", ["category_name" => $_POST["category_name"], "descr" => $_POST["descr"], "image" => $imageName,"category_logo" => $logoName],"token='$token'");
if ($send) {
$_SESSION["update"] = "true";
exit(json_encode(array(
'response' => array(
"code" => '1',
"msg" => 'Your Brand Updated Successfully!'
)
)));
}
else {
exit(json_encode(array(
'response' => array(
"code" => '0',
"msg" => 'Opps There is An Error In Updating brand!'
)
)));
}
}
else {
exit(json_encode(array(
'response' => array(
"code" => '01',
"msg" => 'Opps There is An Error In Updating brand Image!'
)
)));
}
}
else {
exit(json_encode(array(
'response' => array(
"code" => '02',
"msg" => 'Opps There is Too Big Size Image!'
)
)));
}
}
else {
exit(json_encode(array(
'response' => array(
"code" => '03',
"msg" => 'Opps This File Type Does Not Support!'
)
)));
}
}
else{
$send = update("brand", ["category_name" => $_POST["category_name"], "descr" => $_POST["descr"],"category_logo" => $logoName],"token='$token'");
if ($send) {

$_SESSION["update"] = "true";
exit(json_encode(array(
'response' => array(
"code" => '1',
"msg" => 'Your Brand Updated Successfully!'
)
)));
}
else {
exit(json_encode(array(
'response' => array(
"code" => '0',
"msg" => 'Opps There is An Error In Updating brand!'
)
)));
}
}
}
}
if (isset($_GET["token"]) AND !empty($_GET["token"])) {
$categoryToken = $_GET["token"];
$selectCategory = select("brand","token='$categoryToken'");
if (howMany($selectCategory) > 0) {
$getCategory = fetch($selectCategory);
}
else{
move("view-brand.php");
}
}
else{
move("view-brand.php");
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
                                    <div class="page-title">Edit brand</div>
                                </div>
                                <ol class="breadcrumb page-breadcrumb pull-right">
                                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Edit brand</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <div class="card-head">
                                <header>Edit New</header>
                            </div>
                            <form id="formCategoryEdit" enctype="multipart/form-data">
                                <div class="card-body row">
                                    <div class="col-lg-4 p-t-20">
                                        <div class = "mdl-textfield mdl-js-textfield">
                                            <input autocomplete="off" required="" class = "mdl-textfield__input cname" value="<?php echo $getCategory["category_name"]?>" type = "text" id = "text1" name="category_name">
                                            <label class = "mdl-textfield__label lblname" for = "text1">brand Name</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 p-t-20">
                                        <div class = "mdl-textfield mdl-js-textfield txt-width" style="max-width: 100% !important;">
                                            <textarea  class = "mdl-textfield__input cdesc" rows =  "3"
                                            id = "text7" name="descr" ><?php echo $getCategory["descr"]?></textarea>
                                            <label class = "mdl-textfield__label lbldesc" for = "text7">Description <small>(optional)</small></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 p-t-20">
                                        <div class="row">
                                            <div class="col-lg-6 p-t-20">
                                                <h4>brand Image</h4>
                                                <img src="<?php echo (!empty($getCategory["image"])) ? 'uploads/BrandImages/'.$getCategory["image"] : 'uploads/BrandImages/no-thumbnail.png' ?>" id="category_image" height="250px" width="250px">
                                                <br><br>
                                                <input type="file" name="image" id="inputImage" onchange="document.getElementById('category_image').src = window.URL.createObjectURL(this.files[0])" style="display: none;">
                                                <button type="button" id="cateImage" class="btn btn-info">Upload Image</button>
                                            </div>
                                            <div class="col-lg-6 p-t-20">
                                                <h4>brand Logo</h4>
                                                <img src="<?php echo (!empty($getCategory["category_logo"])) ? 'uploads/BrandImages/BrandLogo/'.$getCategory["category_logo"] : 'uploads/BrandImages/BrandLogo/no-logo.png' ?>" id="category_logo" height="250px" width="250px">
                                                <br><br>
                                                <input type="file" name="logo" id="inputLogo" onchange="document.getElementById('category_logo').src = window.URL.createObjectURL(this.files[0])" style="display: none;">
                                                <button type="button" id="cateLogo" class="btn btn-info">Upload Logo</button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-12 p-t-20" style="text-align: center">
                                        <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"
                                        name="send">
                                        Update
                                        </button>
                                        <input type="hidden" name="token" value="<?php echo $categoryToken ;?>">
                                        <input type="hidden" name="editCategory" value="true">
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
$('#formCategoryEdit').on('submit',(function(e) {
e.preventDefault();
var formData = new FormData(this);
$.ajax({
type:'POST',
url: 'edit-brand.php',
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
window.location.href='view-brand.php';
}
if (data.response.code=='01') {
swal("Oh Snap",data.response.msg,"warning");
}
if (data.response.code=='02') {
swal("Oh Snap",data.response.msg,"warning");
}
if (data.response.code=='03') {
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