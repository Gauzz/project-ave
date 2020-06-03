<?php 
require '../includes/functions.php';

if (isset($_FILES["file"])) {
    $ProductToken=token(10);
foreach ($_FILES["file"]["name"] as $i => $pImage) {
$imagename=rand().".jpg";
if (move_uploaded_file($_FILES["file"]["tmp_name"][$i],"uploads/product-images/".$imagename)) {
$queryInsertImage=saveData("product_image",["token" =>  $ProductToken,"name" => $imagename]);
}
else{
echo "0";
exit();
}

}
if ($queryInsertImage) {
    $parentProductToken=$_POST["parentProduct"];
$dataToInsert=[
"productId"  => $_POST["parentProductID"],
"color"       => $_POST["color"],
"productToken"=> $_POST["parentProduct"],
"token"       => $ProductToken,
"quantity"     => $_POST["xsPrice"],
"product_price"     => $_POST["product_price"],
"discount"     => $_POST["discount"],
"discounted_price"     => $_POST["total"],
"app_price"     => $_POST["app_price"],
"app_discount"     => $_POST["app_discount"],
"discounted_app_price"     => $_POST["app_total"],
"created"     => '1'
];
$queryForInsert=saveData("products",$dataToInsert);
if ($queryForInsert) {
    $queryGetProductAgain=select("products","token='$parentProductToken'");
    $GetParentProduct=fetch($queryGetProductAgain);
    $parentProductColors=$GetParentProduct["color"].','.$_POST["color"];
    update("products",["color" => $parentProductColors],"token='$parentProductToken'");
    echo "1";
exit();
}
else{
    echo "0";
    exit();
}
}
}



if (isset($_GET["token"])) {
$token=$_GET["token"];
$queryGetProduct=select("products","productToken='$token'");
if (howMany($queryGetProduct) > 0) {
$product=fetch($queryGetProduct);
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
                                    <div class="page-title"></div>
                                </div>
                                <ol class="breadcrumb page-breadcrumb pull-right">
                                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="parent-item"><a class="parent-item" href="product.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i></li>
                                
                                <li class="active">Add Variant</li>
                            </ol>
                        </div>
                    </div>
                    <!-- add content here -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <div class="card-head">
                                <header>Size And Quantity</header>
                            </div>
                            <form method="POST" id="product-info">
                                <div class="card-body row">
                                    <div class="col-lg-12">
                                        <input type="color" style="    height: 100px;
                                        width: 100%;" id="colorpicker" name="color" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="#000000"/>
                                        <input  type="text" class="form-control copycolor" style="height: 100px;font-size: 42px;cursor: pointer;display: none;" id="hexcolor" name="colorHex" value="#000000" />
                                    </div>
                                    <div class="col-lg-6 p-t-20">
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                                            <input class = "mdl-textfield__input" type = "text" id = "xsPrice">
                                            <label class = "mdl-textfield__label" for = "xsPrice"> <b>Quantity</b></label>
                                        </div>
                                    </div>
                                    
                                <div class="col-lg-6 p-t-20">
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                                    <input name="product_price" id="product_price" class = "mdl-textfield__input" type = "text" pattern = "-?[0-9]*(\.[0-9]+)?" required="">
                                    <label class = "mdl-textfield__label" for = "Price">Base Price</label>
                                    <span class = "mdl-textfield__error">Number required!</span>
                                  </div>
                                </div>

                        <div class="col-lg-6 p-t-20">
                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                            <input name="discount" id="discount" class = "mdl-textfield__input" type = "text" pattern = "-?[0-9]*(\.[0-9]+)?">
                            <label class = "mdl-textfield__label" for = "discount" required="">Discount (In %)</label>
                            <span class = "mdl-textfield__error">Number required!</span>
                          </div>
                        </div>

                                <div class="col-lg-4 p-t-20">
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                        <input name="total" class = "mdl-textfield__input" type = "text" id = "total" required="">
                        <label class = "mdl-textfield__label" for = "total_price">Discounted Price</label>
                      </div>
                    </div> 
                      <div class="col-lg-2 p-t-20">
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                        <button type="button" onclick="getPricee()">Get Discounted Price</button>
                        
                      </div>
                    </div>


                    <div class="col-lg-6 p-t-20">
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                        <input name="app_price" id="app_price" class = "mdl-textfield__input" type = "text" pattern = "-?[0-9]*(\.[0-9]+)?" required="">
                        <label class = "mdl-textfield__label" for = "Price">App Base Price</label>
                        <span class = "mdl-textfield__error">Number required!</span>
                      </div>
                    </div>

                    <div class="col-lg-6 p-t-20">
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                        <input name="app_discount" id="app_discount" class = "mdl-textfield__input" type = "text" pattern = "-?[0-9]*(\.[0-9]+)?">
                        <label class = "mdl-textfield__label" for = "app_discount" required="">Discount (In %)</label>
                        <span class = "mdl-textfield__error">Number required!</span>
                      </div>
                    </div>

                    <div class="col-lg-4 p-t-20">
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                        <input name="app_total" class = "mdl-textfield__input" type = "text" id = "app_total" required="">
                        <label class = "mdl-textfield__label" for = "total_price">Discounted Price</label>
                      </div>
                    </div>
                    <div class="col-lg-2 p-t-20">
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                        <button type="button" onclick="getPrice()">Get Discounted Price</button>
                        
                      </div>
                    </div>
                                    <div class="col-lg-12">
                                         <input type="hidden" id="isSubmit" value="0" name="">
                                            <input type="hidden" value="<?php echo $token; ?>" id="ParentProduct">
                                            <input type="hidden" value="<?php echo $product["id"]; ?>" id="ParentProductId">
                                        <input type="submit" id="main" name="" class="d-none">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <div class="card-head">
                            <header>Images</header>
                        </div>
                        <div class="card-body row">
                            <div class="col-lg-12 p-t-20">
                                <form action="add-variant.php?token=<?= $token; ?>" class="dropzone" id="my-dropzone">
                                    <div class="dz-message">
                                        <div class="dropIcon">
                                            <i class="material-icons">cloud_upload</i>
                                        </div>
                                        <h3>Drop files here or click to upload.</h3>
                                    </div>
                                </form>
                                <button class="btn btn-primary mt-3" style="display: none;" id="submit-all">upload</button>
                                
                            </div>
                        </div>
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
<script type="text/javascript" src="assets/js/dropzone.js"></script>
<script type="text/javascript">
$(document).ready(function(event) {
$("#product-info").on('submit',function(event) {
event.preventDefault();
$("#isSubmit").val('1');
});
});
</script>
<script type="text/javascript">
            $('#colorpicker').on('change', function() {
$('#hexcolor').attr("value",this.value);
$("#hexcolor").css('color', this.value);
});

Dropzone.options.myDropzone = {
// Prevents Dropzone from uploading dropped files immediately
autoProcessQueue: false,
init: function() {
var submitButton = document.querySelector("#submit-all")
myDropzone = this; // closure
submitButton.addEventListener("click", function() {
$('#main').trigger('click');
var val=$("#isSubmit").val();
if (val=='1') {
myDropzone.processQueue();
}
// Tell Dropzone to process all queued files.

});
// You might want to show the submit button only when
// files are dropped here:
this.on("addedfile", function() {
// Show submit button here and/or inform user to click it.
$("#submit-all").show();
});
myDropzone.on('sending', function(file, xhr, formData){
var ParentProductId=$("#ParentProductId").val();
var Producttoken=$("#ParentProduct").val();
var color=$("#hexcolor").val();
var xsPrice=$("#xsPrice").val();
var product_price=$("#product_price").val();
var discount=$("#discount").val();
var total=$("#total").val();
var app_price=$("#app_price").val();
var app_discount=$("#app_discount").val();
var app_total=$("#app_total").val();

var pageId=$("#pageId").val();
formData.append('parentProductID',ParentProductId);
formData.append('parentProduct',Producttoken);
formData.append('color',color);
formData.append('xsPrice',xsPrice);
formData.append('product_price',product_price);
formData.append('discount',discount);
formData.append('total',total);
formData.append('app_price',app_price);
formData.append('app_discount',app_discount);
formData.append('app_total',app_total);
});
myDropzone.on('success', function( file, resp ){

console.log(resp);
if (resp=='1') {
     swal("Success","Variant Added Successfully!","success");
  setTimeout(function(){
  window.location='view-product.php';
  }, 3000);
}
else{
    swal("Oh Snap","Something Went Wrong Please Contact Your Developer","error");
}


});
}
};
</script>
  <script>
  getPricee = function() {
  var numVal1 = Number(document.getElementById("product_price").value);
  var numVal2 = Number(document.getElementById("discount").value) / 100;
  var totalValue = numVal1 - (numVal1 * numVal2)
  var totalvalround = Math.round(totalValue);
  document.getElementById("total").value = totalvalround.toFixed(2);
  }
  </script>
    <script>
  getPrice = function() {
  var numVal1 = Number(document.getElementById("app_price").value);
  var numVal2 = Number(document.getElementById("app_discount").value) / 100;
  var totalValue = numVal1 - (numVal1 * numVal2)
  var totalvalround = Math.round(totalValue);
  document.getElementById("app_total").value = totalvalround.toFixed(2);
  }
  </script>
</body>
</html>