<?php 

  require '../includes/functions.php';

//   $var = mt_rand(1,8);

//     switch ($var) {

//     case '1':

//         $color = 'cyan-bgcolor';

//         break;

//         case '2':

//         $color = 'bg-b-purple';

//         break;

//         case '3':

//         $color = 'light-dark-bgcolor';

//         break;

//         case '4':

//         $color = 'bg-b-orange';

//         break;

//         case '5':

//         $color = 'bg-b-green';

//         break;

//         case '6':

//         $color = 'bg-b-danger';

//         break;

//         case '7':

//         $color = 'bg-b-pink';

//         break;

//     default:

//          $color = 'bg-b-yellow';

//         break;

// }

    if (isset($_POST["adduser"])) {

      $query=select("shiping","pincode='".$_POST["pincode"]."'");      

      if (howMany($query) > 0) {

        exit(json_encode(array("response" => array("code" => "00","msg" => "pincode already Their! Please try With Diffrent One"))));

      }

      else{

        $active = isset($_POST['checkbox']) && $_POST['checkbox']  ? "1" : "0";

        $charges = ($active=='1') ? '0' : $_POST["charges"] ;

          $queryAddShip=saveData("shiping",["country" =>$_POST['country'] ,"state" => $_POST['state'],"city" => $_POST["city"] , "pincode" => $_POST['pincode'],"ship_charge" => $charges,"free" => $active ,"token" => token(8),]);

     

            if ($queryAddShip) {

                exit(json_encode(array("response" => array("code" => "1" ,"msg" => "Shipping Added Successfully!"))));

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

                                <div class="page-title">Add Shipping Details</div>

                            </div>

                            <ol class="breadcrumb page-breadcrumb pull-right">

                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>

                                </li>

                                <li class="active">Add Shipping Details</li>

                            </ol>

                        </div>

                    </div>

                     <div class="row">

                            <div class="col-sm-12">

                                <div class="card-box">

                                    <div class="card-head">

                                        <header>Shipping Information</header>

                                    </div>

                                    <form method="POST" id="addingUser">

                                    <div class="card-body row">

                                       

                                        <div class="col-lg-6 p-t-20"> 

                                         <select name="country" class="form-control countries" id="countryId" required="required">
                                       <?php $selectQueryCountry=select("countries");
                                                    while ($country=fetch($selectQueryCountry)) {     
                                                ?>
                                                    <option id="getCategory" data-id="<?= $country["id"]; ?>" value="<?= $country["id"]; ?>"><?php echo $country["name"]; ?>
                                                        
                                                    </option>  
                                                <?php } ?>
                                         </select>

                                        </div>

                                         <div class="col-lg-6 p-t-20"> 

                                         <select name="state" class="form-control states" id="stateIds" required="required">
                                        <option value="">Select State</option>
                                            </select>

                                        </div>
<!-- 
                                         <div class="col-lg-6 p-t-20"> 

                                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                             <input required="" name="email" class = "mdl-textfield__input" type = "email" id = "txtemail">

                                             <label class = "mdl-textfield__label" >Email</label>

                                              <span class = "mdl-textfield__error">Enter Valid Email Address!</span>

                                          </div>

                                        </div> -->

                         

                                     <!--    <div class="col-lg-6 p-t-20"> 

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

                                        </div> -->

                                        <div class="col-lg-6 p-t-20" style="padding-top:4% !important;">

                                          <select name="city" class="form-control cities" id="cityId" required="required">
                                <option value="">Select City</option>
                                          </select>

                                        </div>

                                         <div class="col-lg-6 p-t-20">

                                           <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                             <input name="pincode" class = "mdl-textfield__input" type = "text" maxlength="6" pattern = "-?[0-9]*(\.[0-9]+)?"  id = "designation">

                                             <label class = "mdl-textfield__label" for = "text5">Pincode</label>

                                             <span class = "mdl-textfield__error">Number required!</span>

                                          </div>

                                        </div>

                                         <div class="col-lg-6 p-t-20">

                                           <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                             <input name="charges" class = "mdl-textfield__input" type = "text" maxlength="10" pattern = "-?[0-9]*(\.[0-9]+)?"  id = "designation">

                                             <label class = "mdl-textfield__label" for = "text5">Charges</label>

                                             <span class = "mdl-textfield__error">Number required!</span>

                                          </div>

                                        </div>

                                        <div class="col-lg-12 p-t-20"> 
                                        <p style="color: red;">Note: For free shipping pLease fill charges as 0%</p>
                                       </div>

                                            <div class="col-lg-6 p-t-20"> 
                                         <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-1">
                                        <input type="checkbox" id="checkbox-1" class="mdl-checkbox__input" name="checkbox" value="free">
                                              <span class="mdl-checkbox__label">Free Shipping!</span>
                                            </label>
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

            url: 'add-shipping.php',

            data:formData,

            cache:false,

            dataType:'json',

            contentType: false,

            processData: false,

            success:function(data){

                if (data.response.code=='1') {

                    swal("Success",data.response.msg,"success");

                   setTimeout(function(){ 
                    window.location='add-shipping.php';
                 }, 3000);



                }

                if (data.response.code=='0') {
                   console.log(data);
                    swal("ERROR",data.response.msg,"error");
                }

                if (data.response.code=='00') {

                    swal("Oh Snap",data.response.msg,"warning");

                    $(".submitbtns").html("SUBMIT");



                }



            },

            error: function(data){

                console.log("error");

                console.log(data);

            }

        });

    }));

});

$("#countryId").change(function(event) {
        var stateId=$(this).val();
        $.ajax({
            url: 'php/auth.php',
            type: 'POST',
            dataType: 'html',
            data: {stateId:stateId},
        })
        .done(function(data) {
            $("#stateIds").html(data);
            //console.log(data);
        });
 
});

$("#stateIds").change(function(event) {
        var cityId=$(this).val();
        $.ajax({
            url: 'php/auth.php',
            type: 'POST',
            dataType: 'html',
            data: {cityId:cityId},
        })
        .done(function(data) {
            $("#cityId").html(data);
            //console.log(data);
        });
 
});



    </script>

</body>

</html>