<?php
require '../includes/functions.php';
$getInfoVal=query("SELECT * FROM contactInfo");
$countRow=howMany($getInfoVal);
$row=mysqli_fetch_array($getInfoVal);
if(isset($_POST["info"])){
$description=mysqli_real_escape_string($conn,$_POST["description"]);
$address=mysqli_real_escape_string($conn,$_POST["address"]);
$phone=mysqli_real_escape_string($conn,$_POST["phone"]);
$sphone=mysqli_real_escape_string($conn,$_POST["sphone"]);
$email=mysqli_real_escape_string($conn,$_POST["email"]);
$semail=mysqli_real_escape_string($conn,$_POST["semail"]);
if($countRow > 0)
{
if (strlen($description) < 1000) {
$updateInfo=query(" UPDATE contactInfo SET description='$description',
address='$address',phone='$phone',supportphone='$sphone',email='$email',supportemail='$semail'");
}else
{
exit(json_encode(["response"=>["code"=>"00","msg"=>"You Entered More rhen 1000 Characters!"]]));
}
if($updateInfo){
exit(json_encode(["response"=>["code"=>"1","msg"=>"Information Updated successfully"]]));
}
else{
exit(json_encode(["response"=>["code"=>"0","msg"=>"Error!!"]]));
}
}else{
if (strlen($description) < 1000) {
$query=mysqli_query($conn,"INSERT INTO contactInfo(description,address,phone,supportphone,email,supportemail)VALUES('$description','$address','$phone','$sphone','$email','$semail')");

if($query){
  exit(json_encode(["response"=>["code"=>"1","msg"=>"Information Added successfully"]]));
}
else{
exit(json_encode(["response"=>["code"=>"000","msg"=>"Error!!"]]));
}
}
else
{
exit(json_encode(["response"=>["code"=>"00","msg"=>"You Entered More then 1000 Characters!"]]));
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
      <div class="page-container">
        <!-- start sidebar menu -->
        <?php include 'partials/_sidebar.php'; ?>
        <!-- end sidebar menu -->
        <!-- start page content -->
        <div class="page-content-wrapper">
          <div class="page-content tre">
            <div class="page-bar">
              <div class="page-title-breadcrumb">
                <div class=" pull-left">
                  <div class="page-title">Contact Information</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                  <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="#">Contact</a>&nbsp;<i class="fa fa-angle-right"></i>
              </li>
              <li class="active">Add Contact Information</li>
            </ol>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="card-box">
              <div class="card-head">
              <header>Contact  Info</header>
            </div>
            <form method="POST" id="addContactinfo" enctype="multipart/form-data">
              <div class="card-body row">
                <div class="col-lg-12 p-t-20">
                  <div class="mdl-textfield mdl-js-textfield txt-full-width">
                    <textarea name="description" class="mdl-textfield__input" rows="2" id = "text7" ><?php
                    if($countRow > 0){ echo $row['description'];}
                    ?></textarea>
                    <label class="mdl-textfield__label" for="text7">Description (Max. Characters 1000)</label>
                  </div>
                </div>
                <input type="hidden" name="info" value="true">
                <div class="col-lg-6 p-t-20">
                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                    <input required="" class="mdl-textfield__input" name="address" type= "text" value="<?php
                    if($countRow > 0){ echo $row['address'];}
                    ?>">
                    <label class = "mdl-textfield__label">Address</label>
                  </div>
                </div>
                <div class="col-lg-6 p-t-20">
                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                    <input name="phone" maxlength="13" class = "mdl-textfield__input" type="text" required="" value="<?php
                    if($countRow > 0){ echo $row['phone'];}
                    ?>">
                    <label class = "mdl-textfield__label">Phone</label>
                  </div>
                </div>
                <div class="col-lg-6 p-t-20">
                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                    <input name="sphone" maxlength="13" class = "mdl-textfield__input" type="text" required="" value="<?php
                    if($countRow > 0){ echo $row['supportphone'];}
                    ?>">
                    <label class = "mdl-textfield__label">Support Phone</label>
                  </div>
                </div>
                <div class="col-lg-6 p-t-20">
                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                    <input name="email"  class = "mdl-textfield__input" type="email" required="" value="<?php
                    if($countRow > 0){ echo $row['email'];}
                    ?>">
                    <label class = "mdl-textfield__label">Email</label>
                  </div>
                </div>
                <div class="col-lg-6 p-t-20">
                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                    <input name="semail"  class = "mdl-textfield__input" type="email" required="" value="<?php
                    if($countRow > 0){ echo $row['supportemail'];}
                    ?>">
                    <label class = "mdl-textfield__label">Support Email</label>
                  </div>
                </div>
                <div class="col-lg-12 p-t-20 text-center">
                  <button type="submit" id="" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink"><?php if($countRow > 0){ echo "Update";}else{ echo "Insert";}?></button>
                  <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-default">Cancel</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <di
    </div>
  </div>
</div>
<?php include 'partials/_footer.php'; ?>
</div>
<?php include 'partials/_script.php'; ?>
<script type="text/javascript">
  $(document).ready(function (e) {
  $('#addContactinfo').on('submit',(function(e) {
  e.preventDefault();
  var formData = new FormData(this);
  $.ajax({
  type:'POST',
  url: 'contactInfo.php',
  data:formData,
  cache:false,
  dataType:'json',
  contentType: false,
  processData: false,
  success:function(data){
  if (data.response.code=='1') {
$("#addContactinfo").trigger('reset');
swal("success",data.response.msg,"success");
setTimeout(function(){
window.location="contactInfo.php";
}, 1000);
  }
  if (data.response.code=='00') {
  swal("Oh Snap",data.response.msg,"warning");
  }
if (data.response.code=='0') {
swal("Error",data.response.msg,"error");
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