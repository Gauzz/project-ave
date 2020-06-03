<?php
require '../includes/functions.php';

if (isset($_POST["token"])) {
$token=$_POST["token"];
$getUserValidate=select("shiping","token='$token'");
if (howMany($getUserValidate) > 0) {

        $active = !empty($_POST['checkbox']) && $_POST['checkbox']  ? "1" : "0";

        $charges = ($active=='1') ? '0' : $_POST["charges"] ;

$queryGetUpdate=update("shiping",["ship_charge" => $charges,"free" => $active],"token='$token'");

if ($queryGetUpdate) {
exit(json_encode(array("response" => array("code" => "1","msg" => "Shipping Information Updated Successfully!"))));
}
else{
exit(json_encode(array("response" => array("code" => "0","msg" => "Error Something went Wrong While Updating User Information!"))));
}
}
exit();
}


if (isset($_GET["user"])) {
$token=$_GET["user"];
$queryGetUser=select("shiping","token='$token'");
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
                                    <div class="page-title">Edit Shipping</div>
                                </div>
                                <ol class="breadcrumb page-breadcrumb pull-right">
                                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Edit Shipping</li>
                            </ol>
                        </div>
                    </div>
                    <!-- add content here -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header class="w-100">Edit Shipping Form
                                    </header>
                                </div>
                                <form method="POST" id="formUpdateUserInfo">
                                    <div class="card-body " id="bar-parent">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="simpleFormEmail mdl-textfield__label">State</label>
                                                <input type="text" value="<?php echo $userInfo["state"]; ?>" required="" name="fullname" class="form-control" id="simpleFormFirst" placeholder="Enter First Name" readonly>
                                                <span class = "mdl-textfield__error">Alphabets Required!</span>
                                            </div>
                                            
                                            <div class="form-group col-md-6">
                                                <label for="simpleFormPassword">city</label>
                                                <input name="email" value="<?php echo $userInfo["city"];?>" type="email" required="" class="form-control" id="simpleFormEmail" placeholder="Enter Last Name" readonly>
                                                <input type="hidden" name="token" value="<?php echo $userInfo["token"]; ?>" >
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="simpleFormPassword">pincode</label>
                                                <input name="notes" value="<?php echo $userInfo["pincode"]; ?>" type="text" class="form-control" id="simpleFormNotes" placeholder="Enter Notes (Optional)" readonly>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="simpleFormPassword mdl-textfield__label">ship_charge<sub> &nbsp;in %</sub> </label>
                                                <input pattern = "-?[0-9]*(\.[0-9]+)?"  value="<?php echo $userInfo["ship_charge"]; ?>" type="text" title="Please Enter A Valid Phone Number!" class="form-control" id="simpleFormPassword" name="charges" placeholder="Enter Charge">
                                                <span class = "mdl-textfield__error">Numbers Required!</span>
                                            </div>
                                             <div class="col-lg-6 p-t-20">
                                             <?php 
                                             if ($userInfo["free"] =='1') { ?>
                                                 <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-1">
                                        <input type="checkbox" id="checkbox-1" class="mdl-checkbox__input" name="checkbox" value="free" checked>
                                              <span class="mdl-checkbox__label">Free Shipping!</span>
                                            </label>
                                                 
                                             <?php }else{?>

                                                 <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-1">
                                        <input type="checkbox" id="checkbox-1" class="mdl-checkbox__input" name="checkbox" value="free">
                                              <span class="mdl-checkbox__label">Free Shipping!</span>
                                            </label>

                                             <?php }?> 
                                     
                                            </div>
                                           
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
    url: 'edit-shipping.php',
    data:formData,
    cache:false,
    contentType: false,
    dataType:'json',
    processData: false,
    success:function(data){
    if (data.response.code=='1') {
   window.location.href='view-shipping.php';
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
    
    </script>
</body>
</html>