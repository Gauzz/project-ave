<?php
require '../includes/functions.php';
if (isset($_POST["token"])) {
$token=$_POST["token"];

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
}

$getImagesValidate=select("post_images","id='$token'");
if (howMany($getImagesValidate) > 0) {

if(!empty($getContent)){
$queryGetUpdate=update("post_images",["type" => $_POST["type"],"content" => $getContent,"project_name" => $_POST["project_name"],"tags" => $_POST["tags"],"description" => $_POST["description"]],"id='$token'");

if ($queryGetUpdate) {
exit(json_encode(array("response" => array("code" => "1","msg" => "Images Updated Successfully!"))));
}
else{
exit(json_encode(array("response" => array("code" => "0","msg" => "Error Something went Wrong While Updating Images Information!"))));
}
}
elseif(!empty($getThumb)){
$queryGetUpdate=update("post_images",["type" => $_POST["type"],"thumbnail" => $getThumb,"project_name" => $_POST["project_name"],"tags" => $_POST["tags"],"description" => $_POST["description"]],"id='$token'");

if ($queryGetUpdate) {
exit(json_encode(array("response" => array("code" => "1","msg" => "Images Updated Successfully!"))));
}
else{
exit(json_encode(array("response" => array("code" => "0","msg" => "Error Something went Wrong While Updating Images Information!"))));
}
}
else{
$queryGetUpdate=update("post_images",["type" => $_POST["type"],"content" => $getContent,"thumbnail" => $getThumb,"project_name" => $_POST["project_name"],"tags" => $_POST["tags"],"description" => $_POST["description"]],"id='$token'");

if ($queryGetUpdate) {
exit(json_encode(array("response" => array("code" => "1","msg" => "Images Updated Successfully!"))));
}
else{
exit(json_encode(array("response" => array("code" => "0","msg" => "Error Something went Wrong While Updating Images Information!"))));
}
}
}
exit();
}


if (isset($_GET["image"])) {
$token=$_GET["image"];
$queryGetImages=select("post_images","id='$token'");
if (howMany($queryGetImages) > 0) {
$ImagesInfo=fetch($queryGetImages);
}
else{
move("index.php");
}
}
else{
move("index.php");
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
                    <div class="page-content">
                        <div class="page-bar">
                            <div class="page-title-breadcrumb">
                                <div class=" pull-left">
                                    <div class="page-title">Edit Images</div>
                                </div>
                                <ol class="breadcrumb page-breadcrumb pull-right">
                                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Edit Images</li>
                            </ol>
                        </div>
                    </div>
                    <!-- add content here -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header class="w-100">Edit Images Form
                                        <!-- <button type="button" data-email="<?php //echo $ImagesInfo["email"]; ?>" class="btn dark btn-outline float-right reset-link">Send Password reset Link</button> -->
                                    </header>
                                </div>
                                <form id="formImagesInfo" enctype="multipart/form-data">
                                    <div class="card-body " id="bar-parent">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="simpleFormEmail mdl-textfield__label">Type</label>
                                                <input type="text" value="<?php echo $ImagesInfo["type"]; ?>" name="type" class="form-control" id="simpleFormFirst" placeholder="Type" readonly/>
                                                <span class = "mdl-textfield__error">Alphabets Required!</span>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="simpleFormPassword">Project Name</label>
                                                <input name="project_name" value="<?php echo $ImagesInfo["project_name"]; ?>" type="text" class="form-control" id="simpleFormNotes" placeholder="Enter Project Name">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="simpleFormPassword">Tags</label>
                                                <input name="tags" value="<?php echo $ImagesInfo["tags"]; ?>" type="text" class="form-control" id="simpleFormNotes" placeholder="Enter Tags">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="simpleFormPassword">Description</label>
                                                <textarea name="description" placeholder="Description" class="form-control"><?php echo $ImagesInfo["description"]; ?></textarea>
                                            </div>
                                            
                                            <div class="form-group col-md-12">
                                                <label for="simpleFormPassword">Content</label>
                                                <img src="<?php echo (!empty($ImagesInfo["content"])) ? $ImagesInfo["content"] : 'images/no-thumbnail.png' ?>" id="category_cont" height="250px" width="250px">
                                                <input type="file" name="content" id="inputCont" onchange="document.getElementById('category_cont').src = window.URL.createObjectURL(this.files[0])" style="display: none;">
                                                <button type="button" id="cateCont" class="btn btn-info">Upload Content</button>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="simpleFormPassword">Thumbnail</label>
                                                <img src="<?php echo (!empty($ImagesInfo["thumbnail"])) ? $ImagesInfo["thumbnail"] : '../uploads/Thumbnail/no-thumbnail.png' ?>" id="category_thumb" height="250px" width="250px">
                                                <input type="file" name="thumbnail" id="inputThumb" onchange="document.getElementById('category_thumb').src = window.URL.createObjectURL(this.files[0])" style="display: none;">
                                                <button type="button" id="cateThumb" class="btn btn-info">Upload Thumbnail</button>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <input type="hidden" name="token" value="<?php echo $ImagesInfo["id"]; ?>">
                                                <button type="submit" id="editimgSubmit" class="btn btn-primary">UPDATE</button>
                                            </div>
                                            
                                            
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
    
    $(document).ready(function(event) {
    $("#formImagesInfo").on('submit', function(event) {
    event.preventDefault();
    $("#editimgSubmit").html("<i class='fa fa-ellipsis-h'></i>");
    var formData = new FormData(this);
    //var ImagesToken = $("#Imagestoken").val();
    $.ajax({
    type:'POST',
    url: 'edit-images.php',
    data:formData,
    cache:false,
    contentType: false,
    dataType:'json',
    processData: false,
    success:function(data){
    if (data.response.code=='1') {
    window.location.href='view-images.php';
    console.log(data);
    }
    if (data.response.code=='0') {
    swal("Oh Snap",data.response.msg,"error");
    $("#editimgSubmit").html("UPDATE");
    console.log(data);
    }
    
    },
    error: function(data){
    console.log("error");
    console.log(data);
    }
    });  
    });
    });
       
    </script>
</body>
</html>