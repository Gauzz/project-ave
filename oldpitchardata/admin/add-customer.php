<?php 

  require '../includes/functions.php';


    if (isset($_POST["adduser"])) {

      $query=select("customers","email='".$_POST["email"]."'");      

      if (howMany($query) > 0) {

        exit(json_encode(array("response" => array("code" => "00","msg" => "email already Register! Please try With Diffrent One"))));

      }

      else{

        $password_bcrypt=password_hash($_POST["password"],PASSWORD_BCRYPT);


            $queryAddUser=saveData("customers",["fullname" => $_POST['fullname'],"email" => $_POST["email"] , "password" => $password_bcrypt,"token" => token(8) ,"notes" => $_POST["notes"] ,"phone" => $_POST["phone"] , "address" => $_POST["address"],"profile_image" => 'userDefault.png']);

     

            if ($queryAddUser) {

                exit(json_encode(array("response" => array("code" => "1" ,"msg" => "User Added Successfully!"))));

            }

            else{

                exit(json_encode(array("response" => array("code" => "0" ,"msg" => "Something Went Wrong Please Try Again!"))));

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

                <div class="page-content">

                    <div class="page-bar">

                        <div class="page-title-breadcrumb">

                            <div class=" pull-left">

                                <div class="page-title">Add Customer Details</div>

                            </div>

                            <ol class="breadcrumb page-breadcrumb pull-right">

                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>

                                </li>

                                <li><a class="parent-item" href="#">Customer</a>&nbsp;<i class="fa fa-angle-right"></i>

                                </li>

                                <li class="active">Add Customer Details</li>

                            </ol>

                        </div>

                    </div>

                     <div class="row">

                            <div class="col-sm-12">

                                <div class="card-box">

                                    <div class="card-head">

                                        <header>Basic Information</header>

                                    </div>

                                    <form method="POST" id="addingUser">

                                    <div class="card-body row">

                                       

                                        <div class="col-lg-6 p-t-20"> 

                                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                             <input name="fullname" class = "mdl-textfield__input" type = "text" id = "txtLasttName " pattern="[A-Z a-z]+"  required="">

                                             <label class = "mdl-textfield__label" >Full Name</label>

                                              <span class = "mdl-textfield__error">Alphabets Required!</span>

                                          </div>

                                        </div>

                                         <div class="col-lg-6 p-t-20"> 

                                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                             <input required="" name="email" class = "mdl-textfield__input" type = "email" id = "txtemail">

                                             <label class = "mdl-textfield__label" >Email</label>

                                              <span class = "mdl-textfield__error">Enter Valid Email Address!</span>

                                          </div>

                                        </div>

                         

                                        <div class="col-lg-6 p-t-20"> 

                                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                             <input  pattern=".{6,}" title="Password Must be 6 Character long" required="" name="password" class = "mdl-textfield__input" type = "password" id = "txtPwd">

                                             <label class = "mdl-textfield__label" >Password</label>

                                          </div>

                                        </div>

                                        <div class="col-lg-6 p-t-20"> 

                                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                             <input  name="notes" class = "mdl-textfield__input" type = "text" id = "designation">

                                             <label class = "mdl-textfield__label" >Notes (Optional)</label>

                                          </div>

                                        </div>

                                        <div class="col-lg-6 p-t-20">

                                           <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                             <input name="phone" class = "mdl-textfield__input" type = "text" maxlength="10" pattern = "-?[0-9]*(\.[0-9]+)?" id = "text5">

                                             <label class = "mdl-textfield__label" for = "text5">Mobile Number</label>

                                             <span class = "mdl-textfield__error">Number required!</span>

                                          </div>

                                        </div>

                                        <div class="col-lg-12 p-t-20"> 

                                          <div class = "mdl-textfield mdl-js-textfield txt-full-width">

                                             <textarea  name="address" class = "mdl-textfield__input" rows =  "4" 

                                                id = "text7" ></textarea>

                                             <label class = "mdl-textfield__label" for = "text7">Address</label>

                                          </div>

                                         </div>

                                       
                                        <input type="hidden" name="adduser" value="true">
                                         <div class="col-lg-12 p-t-20 text-center"> 

                                            <button type="submit" id="" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink submitbtns">Submit</button>

                                            <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-default">Cancel</button>

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

      /*add user admin*/

function opendialog() {

  $("#imagebox").trigger('click');

}





$(document).ready(function (e) {

    $('#addingUser').on('submit',(function(e) {

        e.preventDefault();

       $(".submitbtns").html("<i class='fa fa-ellipsis-h'></i>");

        var formData = new FormData(this);



        $.ajax({

            type:'POST',

            url: 'add-customer.php',

            data:formData,

            cache:false,

            dataType:'json',

            contentType: false,

            processData: false,

            success:function(data){

                if (data.response.code=='1') {

                    swal("Success",data.response.msg,"success");

                   setTimeout(function(){ 
                    window.location='view-customer.php';
                 }, 3000);



                }

                if (data.response.code=='0') {
                   console.log(data);
                    swal("error",data.response.msg,"error");
                }

                if (data.response.code=='00') {

                    swal("Oh Snap",data.response.msg,"warning");

                    $(".submitbtns").html("Submit");



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