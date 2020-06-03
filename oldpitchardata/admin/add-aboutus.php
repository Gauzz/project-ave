<?php
require '../includes/functions.php';
if(isset($_POST['about_update']))
{
$heading_1=mysqli_real_escape_string($conn,$_POST["heading_1"]);
$content_1=mysqli_real_escape_string($conn,$_POST["content_1"]);
// $content_2=mysqli_real_escape_string($conn,$_POST["content_2"]);
$image=rand().".jpg";
if (!empty($_FILES["image"]["name"])) {
if ($_FILES["image"]["type"]=="image/jpeg" OR $_FILES["image"]["type"]=="image/png" OR $_FILES["image"]["type"]=="image/jpg") {
move_uploaded_file($_FILES["image"]["tmp_name"],'uploads/product-images/'.$image);
$query=mysqli_query($conn,"UPDATE aboutus SET heading_1='$heading_1',content_1='$content_1' , image='$image' WHERE id='1'");
if ($query)
{
exit(json_encode(["response"=>["code"=>"1","msg"=>"Data Update Succesfully!"]]));
}
else
{
exit(json_encode(["response"=>["code"=>"0","msg"=>"Error in update!"]]));
}
}
else{
exit(json_encode(array("response" => array("code" => "00" ,"msg" => "File type Must be Image"))));
}
}
else{
if(empty($_FILES["image"]["name"])){
$query=mysqli_query($conn,"UPDATE aboutus SET heading_1='$heading_1',content_1='$content_1' WHERE id='1'");
if ($query)
{
exit(json_encode(["response"=>["code"=>"1","msg"=>"Data Update Succesfully!"]]));
}
else
{
exit(json_encode(["response"=>["code"=>"0","msg"=>"Error in update!"]]));
}
}
}


}
$getAbout=mysqli_query($conn,"SELECT * FROM aboutus");
$fetchAbout=mysqli_fetch_array($getAbout);
secureAdmin();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'partials/_style.php'; ?>
        <link href="assets/plugins/summernote/summernote.css" rel="stylesheet">
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
                                    <div class="page-title">About us page</div>
                                </div>
                                <ol class="breadcrumb page-breadcrumb pull-right">
                                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">About us</li>
                            </ol>
                        </div>
                    </div>
                    <!-- add content here -->
                    <div class="card-body no-padding height-9">
                        <div class="row">
                            <div class="col-md-12">
                                
                                <form method="POST" class="form">
                                    <div class="col-lg-12 p-t-20">
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input class = "mdl-textfield__input" type = "text" name="heading_1" value="<?php echo $fetchAbout['heading_1']; ?>" required/>
                                            <label class = "mdl-textfield__label">Heading 1</label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-12 p-t-20">
                                        <div class = "mdl-textfield mdl-js-textfield txt-full-width">
                                            <textarea class = "summernote mdl-textfield__input" rows =  "4"
                                            id = "text7" name="content_1" value="" required/><?php echo $fetchAbout['content_1']; ?></textarea>
                                            <label class = "mdl-textfield__label" for = "text7">Content 1</label>
                                        </div>
                                    </div>
                                   <!--  <div class="col-lg-12 p-t-20">
                                        <div class = "mdl-textfield mdl-js-textfield txt-full-width">
                                            <textarea class ="summernote mdl-textfield__input" rows =  "4" id = "text8" name="content_2" value="" required><?php // echo $fetchAbout['content_2']; ?></textarea>
                                            <label class = "mdl-textfield__label" for = "text7">Content 2</label>
                                        </div>
                                    </div> -->
                                    <div class="col-lg-12 p-t-20">
                                        <img onclick="opendialog()" style="cursor: pointer;" id="img_pre" src="uploads/product-images/<?php echo $fetchAbout["image"];?>" height="100px" width="100px" border="1">
                                        <label onclick="opendialog()" style="cursor: pointer;" class="control-label col-md-3">Upload User Image</label>
                                        <input id="imagebox" onchange="document.getElementById('img_pre').src = window.URL.createObjectURL(this.files[0])" style="display: none;"  type="file" class="form-control" name="image">
                                        <input type="hidden" name="adduser" value="true">
                                    </div>
                                    
                                    <div class="col-lg-12 p-t-20 text-center">
                                        <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink" name="btnsubmit">Submit</button>
                                        
                                        
                                        <input type="hidden" name="about_update" value="true">
                                        <input type="hidden" name="id" value="<?php //echo $id; ?>">
                                    </div>
                                </form>
                                
                                
                            </div></div></div></div>
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
            <script src="assets/plugins/summernote/summernote.min.js" ></script>
            <script type="text/javascript">
            function opendialog() {
            $("#imagebox").trigger('click');
            }
            $(document).ready(function (e) {
            $('.summernote').summernote();
            $('.form').on('submit',(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
            type:'POST',
            url: 'add-aboutus.php',
            data: formData,
            cache:false,
            dataType:'json',
            contentType: false,
            processData: false,
            success:function(data){
            if (data.response.code=='1') {
            $(".form").trigger('reset');
            
            swal("success",data.response.msg,"success");
            
            setTimeout(function(){
            window.location="add-aboutus.php";
            }, 1000);
            }
            if (data.response.code=='00') {
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