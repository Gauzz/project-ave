<?php
require '../includes/functions.php';
if (isset($_POST["AddImages"])) {
$pname=$_POST['projectname'];
/*$id=$_POST['getCategoryId'];*/
$valid_formatss = array("png","jpeg","jpg");
$cont = $_FILES['content']['name'];
$contSize = $_FILES['content']['size'];
if(strlen($cont)) {
list($txt, $ext) = explode(".", $cont);
if(in_array($ext,$valid_formatss)) {
if($contSize<(10240*10240)) {
$contName = time().".".$ext;
$tmps = $_FILES['content']['tmp_name'];
move_uploaded_file($tmps,"images/".$contName);
$getContent = 'https://pitchar.io/admin/images/'.$contName;
}
}
}else{
$contName='no-thumbnail.png';
}

$valid_formats = array("png","jpeg","jpg");
$thumb = $_FILES['thumbnail']['name'];
$thumbSize = $_FILES['thumbnail']['size'];
if(strlen($thumb)) {
list($txt, $ext) = explode(".", $thumb);
if(in_array($ext,$valid_formats)) {
if($thumbSize<(10240*10240)) {
$thumbName = time().".".$ext;
$tmp = $_FILES['thumbnail']['tmp_name'];
move_uploaded_file($tmp,"../uploads/Thumbnail/".$thumbName);
$getThumb = 'https://pitchar.io/uploads/Thumbnail/'.$thumbName;
}
}
}else{
$thumbName='no-logo.png';
}
$query=select("post_images","project_name='$pname'");
if (howMany($query)=='1') {
exit(json_encode(array('response' =>array("code" =>'2', "msg" => 'This Image Already Exists'))));
}
else{
$send=saveData("post_images",["type" => $_POST["type"],"project_name" => $_POST["projectname"],"tags" => $_POST["tags"],"description" => $_POST["description"],"content" => $getContent,"thumbnail" => $getThumb,"token" => token(15)]);
if ($send) {
$_SESSION["success"]="true";
exit(json_encode(array('response' => array("code" =>'1', "msg" => 'New Image Created Successfully!'))));
}
else{
exit(json_encode(array('response' =>array("code" =>'0', "msg" => 'Oops There is An Error In Adding Image!'))));
}
}
}
secureAdmin();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'partials/_style.php'; ?>
        <style type="text/css">
        
        .mdl-menu__item:hover
        {
        width: 100% !important;
        }
        .mdl-menu__item
        {
        width: 100% !important;
        }
        .mdl-menu__container{
        width: 100% !important;
        }
        .mdl-menu__outline{
        width: 100% !important;
        }
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
                    <div class="page-content" style="min-height: 800px !important;">
                        <div class="page-bar">
                            <div class="page-title-breadcrumb">
                                <div class=" pull-left">
                                    <div class="page-title">Add Images</div>
                                </div>
                                <ol class="breadcrumb page-breadcrumb pull-right">
                                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Add Images</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <div class="card-head">
                                <header>Add Images</header>
                            </div>
                            <form id="formAddImage" enctype="multipart/form-data">
                                <div class="card-body row">
                                    <div class="col-lg-4 p-t-20">
                                        <div class = "mdl-textfield mdl-js-textfield">
                                            <input autocomplete="off" required="" class = "mdl-textfield__input type" type = "text" id = "text1" name="type" value="images" readonly/>
                                            <label class = "mdl-textfield__label lblname" for = "text1">Type</label>
                                            <!--  <span class = "mdl-textfield__error">Alphabets Required!</span> -->
                                        </div>
                                    </div>

                                    <div class="col-lg-4 p-t-20">
                                        <div class = "mdl-textfield mdl-js-textfield">
                                            <input autocomplete="off" required="" class = "mdl-textfield__input pname" type = "text" id = "text1" name="projectname">
                                            <label class = "mdl-textfield__label lblname" for = "text1">Project Name</label>
                                            <!--  <span class = "mdl-textfield__error">Alphabets Required!</span> -->
                                        </div>
                                    </div>

                                    <div class="col-lg-4 p-t-20">
                                        <div class = "mdl-textfield mdl-js-textfield">
                                            <input autocomplete="off" required="" class = "mdl-textfield__input tags" type = "text" name="tags">
                                            <label class = "mdl-textfield__label lblname" for = "text1">Tags</label>
                                            <!--  <span class = "mdl-textfield__error">Alphabets Required!</span> -->
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-12 p-t-20">
                                        <div class = "mdl-textfield mdl-js-textfield txt-width" style="max-width: 100% !important;">
                                            <textarea  class = "mdl-textfield__input cdesc" rows =  "3"
                                            id = "text7" name="description" ></textarea>
                                            <label class = "mdl-textfield__label lbldesc" for = "text7">Description <small>(optional)</small></label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-12 p-t-20">
                                        <div class="row">
                                            <div class="col-lg-6 p-t-20">
                                                <h4>Content</h4>
                                                <img src="https://images.disitu.com/MICROSITE/nothumbnail.png" id="category_cont" height="250px" width="250px">
                                                <br><br>
                                                <input type="file" name="content" id="inputCont" onchange="document.getElementById('category_cont').src = window.URL.createObjectURL(this.files[0])" style="display: none;" required="">
                                                <button type="button" id="cateCont" class="btn btn-info">Upload Content</button>
                                            </div>
                                            <div class="col-lg-6 p-t-20">
                                                <h4>Thumbnail</h4>
                                                <img src="https://images.disitu.com/MICROSITE/nothumbnail.png" id="category_thumb" height="250px" width="250px">
                                                <br><br>
                                                <input type="file" name="thumbnail" id="inputThumb" onchange="document.getElementById('category_thumb').src = window.URL.createObjectURL(this.files[0])" style="display: none;" required="">
                                                <button type="button" id="cateThumb" class="btn btn-info">Upload Thumbnail</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 p-t-20">
                                        <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"
                                        name="send">
                                        Create
                                        </button>
                                        <input type="hidden" name="AddImages" value="true">
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
$("#cateThumb").click(function(event) {
$("#inputThumb").click();
});
/*$(".getCatgory").click(function(event) {
var id= $(this).data("id");
$("#getCategoryId").val(id)
var val= $(this).data("val");
$("#getCategory").val(val)
});*/
$("#cateCont").click(function(event) {
$("#inputCont").click();
});
$(document).ready(function (e) {
$('#formAddImage').on('submit',(function(e) {
e.preventDefault();
var formData = new FormData(this);
$.ajax({
type:'POST',
url: 'add-images.php',
data:formData,
cache:false,
dataType:'json',
contentType: false,
processData: false,
success:function(data){
if (data.response.code=='1') {
window.location.href='view-images.php';
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