<?php
require '../includes/functions.php';
if (isset($_POST["token"])) {
$token=$_POST["token"];

$valid_formats = array("jpg","png","gif","bmp","jpeg");
$name = $_FILES['images']['name'];
$size = $_FILES['images']['size'];
if(strlen($name)) {
list($txt, $ext) = explode(".", $name);
if(in_array($ext,$valid_formats)) {
    if($size<(1024*1024)) {
        $image_name = time().".".$ext;
        $tmp = $_FILES['images']['tmp_name'];
        move_uploaded_file($tmp, "../uploads/user_profile_pic/".$image_name);
        //$getUser='https://pitchar.io/uploads/user_profile_pic/'.$image_name;
    }}
}  

$getUserValidate=select("tbl_users","id='$token'");
if (howMany($getUserValidate) > 0) {
if(empty($image_name)){
$queryGetUpdate=update("tbl_users",["firstname" => $_POST["firstname"],"lastname" => $_POST["lastname"],"fullname" => $_POST["firstname"]." ".$_POST["lastname"],"email" => $_POST["email"],"occupation" => $_POST["occupation"],"country" => $_POST["country"]],"id='$token'");

if ($queryGetUpdate) {
exit(json_encode(array("response" => array("code" => "1","msg" => "User Information Updated Successfully!"))));
}
else{
exit(json_encode(array("response" => array("code" => "0","msg" => "Error Something went Wrong While Updating User Information!"))));
}
}
if(!empty($image_name)){
$queryGetUpdate=update("tbl_users",["firstname" => $_POST["firstname"],"lastname" => $_POST["lastname"],"fullname" => $_POST["firstname"]." ".$_POST["lastname"],"email" => $_POST["email"],"occupation" => $_POST["occupation"],"country" => $_POST["country"],"display_pic" => $image_name],"id='$token'");

if ($queryGetUpdate) {
exit(json_encode(array("response" => array("code" => "1","msg" => "User Information Updated Successfully!"))));
}
else{
exit(json_encode(array("response" => array("code" => "0","msg" => "Error Something went Wrong While Updating User Information!"))));
}
}

}
exit();
}


if (isset($_GET["user"])) {
$token=$_GET["user"];
$queryGetUser=select("tbl_users","id='$token'");
if (howMany($queryGetUser) > 0) {
$userInfo=fetch($queryGetUser);
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
                                    <div class="page-title">Edit User</div>
                                </div>
                                <ol class="breadcrumb page-breadcrumb pull-right">
                                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Edit User</li>
                            </ol>
                        </div>
                    </div>
                    <!-- add content here -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header class="w-100">Edit User Form
                                        <!-- <button type="button" data-email="<?php// echo $userInfo["email"]; ?>" class="btn dark btn-outline float-right reset-link">Send Password reset Link</button> -->
                                    </header>
                                </div>
                                <form id="formUpdateUserInfo" method="POST" enctype="multipart/form-data">
                                    <div class="card-body " id="bar-parent">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="simpleFormEmail mdl-textfield__label">First Name</label>
                                                <input type="text" value="<?php echo $userInfo["firstname"]; ?>" name="firstname" class="form-control" id="simpleFormFirst" placeholder="Enter First Name">
                                                <span class = "mdl-textfield__error">Alphabets Required!</span>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="simpleFormEmail mdl-textfield__label">Last Name</label>
                                                <input type="text" value="<?php echo $userInfo["lastname"]; ?>" name="lastname" class="form-control" id="simpleFormFirst" placeholder="Enter Last Name">
                                                <span class = "mdl-textfield__error">Alphabets Required!</span>
                                            </div>
                                            
                                            <div class="form-group col-md-6">
                                                <label for="simpleFormPassword">Email</label>
                                                <input name="email" value="<?php echo $userInfo["email"];?>" type="email" class="form-control" id="simpleFormEmail" placeholder="Enter Email" readonly/>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="simpleFormPassword">Occupation</label>
                                                <input name="occupation" value="<?php echo $userInfo["occupation"]; ?>" type="text" class="form-control" id="simpleFormNotes" placeholder="Enter Occupation">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="simpleFormPassword">Country</label>
                                                <input name="country" value="<?php echo $userInfo["country"]; ?>" type="text" class="form-control" id="simpleFormNotes" placeholder="Enter Country">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="simpleFormPassword">Profile Image</label>
                                                <img src="<?php echo (!empty($userInfo["display_pic"])) ? '../uploads/user_profile_pic/'.$userInfo["display_pic"] : '../uploads/user_profile_pic/avatar-placeholder.png' ?>" id="category_img" height="250px" width="250px">
                                                <input type="file" name="images" id="inputUser" onchange="document.getElementById('category_img').src = window.URL.createObjectURL(this.files[0])" style="display: none;">
                                                <button type="button" id="cateUser" class="btn btn-info">Upload Profile Image</button>
                                            </div>

                                            <div class="form-group col-md-12">
                                                <input type="hidden" name="token" value="<?php echo $userInfo["id"]; ?>">
                                                <button type="submit" id="edituserSubmit" class="btn btn-primary">UPDATE</button>
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
    $("#cateUser").click(function(event) {
    $("#inputUser").click();
    });
    
    $(document).ready(function(event) {
    $("#formUpdateUserInfo").on('submit', function(event) {
    event.preventDefault();
    $("#edituserSubmit").html("<i class='fa fa-ellipsis-h'></i>");
    var formData = new FormData(this);
    //var userToken = $("#usertoken").val();
    $.ajax({
    type:'POST',
    url: 'edit-customers.php',
    data:formData,
    cache:false,
    contentType: false,
    dataType:'json',
    processData: false,
    success:function(data){
    if (data.response.code=='1') {
   window.location.href='view-customer.php';
    console.log(data);
    }
    if (data.response.code=='0') {
    swal("Oh Snap",data.response.msg,"error");
    $("#edituserSubmit").html("UPDATE");
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
    
    $(document).ready(function() {
    $(".reset-link").on('click', function() {
    var email=$(this).data("email");
    $.ajax({
    type:'POST',
    url: '//pitchar.io/forgotPassword.php',
    data:{email:email},
    success:function(data){
    console.log("success");
    },
    error: function(){
    console.log("error");
    
    
    }
    });
    });
    });
    </script>
</body>
</html>