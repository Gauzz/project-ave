<?php
require '../includes/functions.php';
if (isset($_POST["token"])) {
$token=$_POST["token"];
$getUserValidate=select("facebook_users","id='$token'");
if (howMany($getUserValidate) > 0) {

$queryGetUpdate=update("facebook_users",["fullname" => $_POST["fullname"],"email" => $_POST["email"], "occupation" => $_POST["occupation"] ,"country" => $_POST["country"]],"id='$token'");

if ($queryGetUpdate) {
exit(json_encode(array("response" => array("code" => "1","msg" => "User Information Updated Successfully!"))));
}
else{
exit(json_encode(array("response" => array("code" => "0","msg" => "Error Something went Wrong While Updating User Information!"))));
}
}
exit();
}


if (isset($_GET["user"])) {
$token=$_GET["user"];
$queryGetUser=select("facebook_users","id='$token'");
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
                                    <header class="w-100">Edit facebook_users User Form
                                        <!-- <button type="button" data-email="<?php echo $userInfo["email"]; ?>" class="btn dark btn-outline float-right reset-link">Send Password reset Link</button> -->
                                    </header>
                                </div>
                                <form method="POST" id="formUpdateUserInfo">
                                    <div class="card-body " id="bar-parent">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="simpleFormEmail mdl-textfield__label">Full Name</label>
                                                <input type="text" value="<?php echo $userInfo["fullname"]; ?>" required="" name="fullname" class="form-control" id="simpleFormFirst" placeholder="Enter Full Name">
                                                <span class = "mdl-textfield__error">Alphabets Required!</span>
                                            </div>
                                            
                                            <div class="form-group col-md-6">
                                                <label for="simpleFormPassword">Email</label>
                                                <input name="email" value="<?php echo $userInfo["email"];?>" type="email" required="" class="form-control" id="simpleFormEmail" placeholder="Enter Email" readonly/>
                                                <input type="hidden" name="token" value="<?php echo $userInfo["id"]; ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="simpleFormPassword">Occupation</label>
                                                <input name="occupation" value="<?php echo $userInfo["occupation"]; ?>" type="text" class="form-control" id="simpleFormNotes" placeholder="Enter Occupation">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="simpleFormPassword">Country</label>
                                                <input name="country" value="<?php echo $userInfo["country"]; ?>" type="text" class="form-control" id="simpleFormNotes" placeholder="Enter Country">
                                            </div>
                                            <!--<div class="form-group col-md-6">
                                                <label for="simpleFormPassword">Notes</label>
                                                <input name="notes" value="<?php //echo $userInfo["notes"]; ?>" type="text" class="form-control" id="simpleFormNotes" placeholder="Enter Notes (Optional)">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="simpleFormPassword mdl-textfield__label">Phone</label>
                                                <input name="phone" pattern = "-?[0-9]*(\.[0-9]+)?"  value="<?php //echo $userInfo["phone"]; ?>" type="text" title="Please Enter A Valid Phone Number!" class="form-control" id="simpleFormPassword" placeholder="Enter Phone">
                                                <span class = "mdl-textfield__error">Numbers Required!</span>
                                            </div>
                                           
                                            <div class="form-group col-md-12">
                                                <label for="simpleFormPassword">Address</label>
                                                <textarea name="address" placeholder="Address"  required="" class="form-control"><?php //echo $userInfo["address"]; ?></textarea>
                                            </div> -->
                                            <div class="form-group col-md-12">
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
    /*View user update*/
    
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