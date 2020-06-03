<?phprequire '../includes/functions.php';secureAdmin();if(isset($_GET['id'])){$id=$_GET['id'];}$queryselct=mysqli_query($conn,"SELECT * FROM add_vendor WHERE id='$id'");$fetchquery=mysqli_fetch_array($queryselct);$token=$fetchquery['token'];$oldemail=$fetchquery['email'];?><!DOCTYPE html><html lang="en">  <head>    <?php include 'partials/_style.php'; ?>    <style type="text/css">        .mdl-menu__item:hover    {    width: 100% !important;    }    .mdl-menu__item    {    width: 100% !important;    }    .mdl-menu__container{    width: 100% !important;    }    .mdl-menu__outline{    width: 100% !important;    }    .field-icon {    float: right;    margin-left: -25px;    margin-top: -25px;    position: relative;    z-index: 2;    }    </style>  </head>  <!-- END HEAD -->  <body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">    <div class="page-wrapper">      <!-- start header -->      <?php include 'partials/_header.php'; ?>      <!-- end header -->      <!-- start page container -->      <div class="page-container">        <!-- start sidebar menu -->        <?php include 'partials/_sidebar.php'; ?>        <!-- end sidebar menu -->        <!-- start page content -->        <div class="page-content-wrapper">          <div class="page-content" style="min-height: 800px !important;">            <div class="page-bar">              <div class="page-title-breadcrumb">                <div class=" pull-left">                  <div class="page-title">Update Vendor</div>                </div>                <ol class="breadcrumb page-breadcrumb pull-right">                  <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>                </li>                <li class="active">Update Vendor</li>              </ol>            </div>          </div>          <!-- Start widget -->          <div class="row">            <div class="col-sm-12">              <div class="card card-box">                <div class="card-head">                <header>Update Vendor Basic Info</header>              </div>              <div class="card-body" id="bar-parent2">                <?php                if(isset($_POST['usubmit']))                {                $vendorName=mysqli_real_escape_string($conn,$_POST['vendorName']);                $category=mysqli_real_escape_string($conn,$_POST['category']);                $dob=mysqli_real_escape_string($conn,$_POST['dob']);                $email=mysqli_real_escape_string($conn,$_POST['email']);                $number=mysqli_real_escape_string($conn,$_POST['number']);                $address=mysqli_real_escape_string($conn,$_POST['address']);                $brief=mysqli_real_escape_string($conn,$_POST['brief']);                $photo=$_FILES['fileup']['name'];                $tmp_name=$_FILES['fileup']['tmp_name'];                $photo_token=$token.$photo;                move_uploaded_file($tmp_name,"venderImage/".$photo_token);                $sql=mysqli_query($conn," select * from add_vendor where email !='$oldemail' and email='$email' ");                $num=mysqli_num_rows($sql);                if($num > 0 )                {                echo "<script>swal('Opps!','Email Is Already Exist','warning');</script>";                }else{                if(empty($photo)){                $sql=mysqli_query($conn,"UPDATE add_vendor SET name='$vendorName',gander='$category',date_of_birth='$dob',email='$email',phone='$number',address='$address',brief='$brief' WHERE id='$id'");                }else{                $sql=mysqli_query($conn,"UPDATE add_vendor SET name='$vendorName',gander='$category',date_of_birth='$dob',email='$email',phone='$number',address='$address',brief='$brief',images='$photo_token' WHERE id='$id'");                }                if ($sql==true) {                echo "<script>swal('Done','Updated Successfully','success');</script>";                header("location:view-vender.php");                }                }                }                ?>                <form method="POST" id="addProductForm" enctype="multipart/form-data" action="">                  <div class="card-body row">                                        <div class="col-lg-6 p-t-20">                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">                        <input required="" value="<?php echo $fetchquery["name"]; ?>" class = "mdl-textfield__input" type = "text" name="vendorName" id = "vendorName">                        <label class = "mdl-textfield__label">Name</label>                      </div>                    </div>                    <div class="col-lg-6 p-t-20">                      <div class="form-group row">                        <label for="horizontalFormEmail">Gender</label>                        <select name='category' id='myselect' onchange="get_sub_cat(this.value);" required="" class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">                          <option selected="" value="<?php echo $fetchquery["gander"]; ?>"><?php echo $fetchquery["gander"]; ?></option>                          <option disabled="" value="">Gender</option>                          <?php                          if($fetchquery['gander']=='Male'){                          ?>                          <option value="Female">Female</option>                          <?php }else{?>                          <option value="Male">Male</option>                          <?php }?>                        </select>                      </div>                    </div>                    <div class="col-lg-6 p-t-20">                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">                        <input required="" class = "mdl-textfield__input" value="<?php echo $fetchquery["date_of_birth"]; ?>" type = "date" name="dob" id = "dob">                        <label class = "mdl-textfield__label">Date Of Birth</label>                      </div>                    </div>                                                            <div class="col-lg-6 p-t-20">                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">                        <input required="" class = "mdl-textfield__input" value="<?php echo $fetchquery["email"]; ?>" type = "email" name="email" id = "email">                        <label class = "mdl-textfield__label" >Email<label>                        </div>                      </div>                      <div class="col-lg-6 p-t-20">                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">                          <input class = "mdl-textfield__input" value="<?php echo $fetchquery["phone"]; ?>" type = "text" name="number"                          pattern = "-?[0-9]*(\.[0-9]+)?" id = "text5" maxlength="10"                          required="">                          <label class = "mdl-textfield__label" for = "text5">Mobile Number</label>                          <span class = "mdl-textfield__error">Number required!</span>                        </div>                      </div>                      <div class="col-lg-6 p-t-20">                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">                          <input required="" class = "mdl-textfield__input" value="<?php echo $fetchquery["address"]; ?>" type = "text" name="address" id = "address">                          <label class = "mdl-textfield__label" >Address<label>                          </div>                        </div>                        <div class="col-lg-6 p-t-20">                          <div class = "mdl-textfield mdl-js-textfield txt-full-width">                            <textarea required="" class = "mdl-textfield__input"  rows =  "4"                            id="vendorBrief" name="brief"><?php echo $fetchquery["brief"]; ?></textarea>                            <label class = "mdl-textfield__label" for = "text7">Brief</label>                          </div>                        </div>                                                <div class="col-lg-12 p-t-20">                          <label>Profile Image</label>                          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height txt-full-width">                            <?php //echo "<img src='uploads/".$w[photo]."' width='135px'  height='110px' />" ; ?>                            <img id="img_pre" class="img-thumbnail" src="venderImage/<?php echo $fetchquery['images']; ?>" height="110px" width="135px">                            <!--  <img id="img_pre" src="https://www.chaarat.com/wp-content/uploads/2017/08/placeholder-user.png" height="110px" width="135px"> -->                            <input type="file" name="fileup" id="userImage" onchange="document.getElementById('img_pre').src = window.URL.createObjectURL(this.files[0])" >                            <!-- <input type="file" placeholder="90890" name="fileup" required="">                          -->    </div>                        </div                                                                        <input type="hidden" value="0" id="issubmited" name="">                        <input style="display: none;" type="submit" required="" id="main">                                                <div class="col-lg-12 p-t-20 text-center">                          <button id="submit-all" type="submit" name="usubmit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink">Submit</button>                                                    <a href="view-vendor.php" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-default">Cancel</a>                        </div>                      </form>                    </div>                  </div>                </div>              </div>            </div>          </div>          <!-- end page content -->        </div>        <!-- end page container -->        <!-- start footer -->        <?php include 'partials/_footer.php'; ?>        <!-- end footer -->      </div>      <?php include 'partials/_script.php'; ?>      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>      <script src="assets/plugins/jquery-tags-input/jquery-tags-input.js" ></script>      <script type="text/javascript">      $(".getType").click(function() {      var val=$(this).data("val");      var id=$(this).data("id");      $(".status").val(val);      });      </script>          </body>  </html>