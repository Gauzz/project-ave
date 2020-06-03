<?php
include '../includes/functions.php';
secureAdmin();

if (isset($_POST["check"])) {

    $password=mysqli_real_escape_string($conn,$_POST["pass"]);



    $query=mysqli_query($conn,"SELECT * FROM giftvoucher_password WHERE giftvoucher_password='$password'");
    

    if (mysqli_num_rows($query)=='1') { 
        
        $getData=mysqli_fetch_array($query);
        

        $_SESSION["giftvoucher_password"]=$getData;

         exit(json_encode(array('response' =>array("code" =>'1', "msg" => 'Login Success!'))));
        }
        else{

         exit(json_encode(array('response' =>array("code" => '0', "msg" => 'Invalid Password!'))));

        }

       exit();

}

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
                                    <div class="page-title">Verify Password To Open Gift Promo Code</div>
                                </div>
                                <ol class="breadcrumb page-breadcrumb pull-right">
                                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Verify Gift Promo Code</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6" style="margin-left: 25%;margin-top: 10%;">
                            <div class="card-box">
                                <div class="card-head">
                                <header>Verify</header>
                            </div>
                            <form id="formvalidate" enctype="multipart/form-data">
                                <div class="card-body row">
                                    <div class="col-lg-6 p-t-20">
                                        <div class = "mdl-textfield mdl-js-textfield full-width">
                                            <input autocomplete="off" required="" class = "mdl-textfield__input cname" type = "password" id = "text1" name="pass">
                                            <label class = "mdl-textfield__label lblname" for = "text1">Enter Password</label>
                                        </div>
                                    </div>                         
                                   
                                        <input type="hidden" name="check" value="checked">
                                        <div class="col-lg-12 p-t-20login100-form-btn" style="text-align: center">
                                            
                                            <button type="submit" id="promocode" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent login100-form-btn">
                                            Verify
                                            </button>
                                           
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
    $(function() {
    $('#staticParent').on('keydown', '#child', function(e){-1!==$.inArray(e.keyCode,[46,8,9,27,13,110])||(/65|67|86|88/.test(e.keyCode)&&(e.ctrlKey===true||e.metaKey===true))&&(!0===e.ctrlKey||!0===e.metaKey)||35<=e.keyCode&&40>=e.keyCode||(e.shiftKey||48>e.keyCode||57<e.keyCode)&&(96>e.keyCode||105<e.keyCode)&&e.preventDefault()});
    });
    $('#datepicker').datepicker();
    </script>
     <script type="text/javascript">

    $(document).ready(function (e) {

        $('#formvalidate').on('submit',(function(e) {

            e.preventDefault();

            var formData = new FormData(this);

            $(".login100-form-btn").html("Validating..");

            $.ajax({

                type:'POST',

                url: 'verify_giftpromocode.php',

                data:formData,

                cache:false,

                dataType:'json',

                contentType: false,

                processData: false,

                success:function(data){

                   if (data.response.code=='1') {

                    $(".login100-form-btn").html("Redirecting..");

                    setTimeout(function(){ window.location.href="add-giftpromocode.php"; }, 3000);      

                   }

                   // if (data.response.code=="00") {

                   //      swal("Oh Snap","This Is an Invalid Email!","warning");

                   //      $(".login100-form-btn").html("Login");

                   // }

                   if (data.response.code=='0') {

                        swal("Oh Snap","You Entered a Wrong Password","error");

                    $(".login100-form-btn").html("Login");

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