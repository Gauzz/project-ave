<?php require '../includes/functions.php';

if (isset($_FILES["file"])) {
   
     $productName=$_POST["productName"];
    $imageNo=1;
    foreach ($_FILES["file"]["name"] as $i => $pImage) {
        $primaryImage=($imageNo=='1') ? "1" : "0";
        $imagename=rand().".jpg";
        if (move_uploaded_file($_FILES["file"]["tmp_name"][$i],"uploads/product-images/".$imagename)) {
            $queryInsertImage=saveData("product_image",["token" =>  $_POST["token"],"name" => $imagename,"primaryImage" => $primaryImage]);    
        }
        else{
           echo "0";
           exit();
        }
        $imageNo++;
        
    }

$getfetchfeatureone=$_POST["getfetchfeatureone"];
$selectfeature = select("product_feature","id='$getfetchfeatureone'");
$fetchfeature = fetch($selectfeature);
$getfeature = $fetchfeature["name"];

// getfeatureIdtwo 

$getfeatureIdtwo=$_POST["getfeatureIdtwo"];
$selectfeaturetwo = select("product_feature","id='$getfeatureIdtwo'");
$fetchfeaturetwo = fetch($selectfeaturetwo);
$getfeaturetwo = $fetchfeaturetwo["name"];

// getfeatureIdtree 

$getfeatureIdtree=$_POST["getfeatureIdtree"];
$selectfeaturetree = select("product_feature","id='$getfeatureIdtree'");
$fetchfeaturetree = fetch($selectfeaturetree);
$getfeaturetree = $fetchfeaturetree["name"];


// getfeatureIdtree 

$getfeatureIdforth=$_POST["getfeatureIdforth"];
$selectfeatureforth = select("product_feature","id='$getfeatureIdforth'");
$fetchfeatureforth = fetch($selectfeatureforth);
$getfeatureforth = $fetchfeatureforth["name"];

// getfeatureIdfive 

$getfeatureIdfive=$_POST["getfeatureIdfive"];
$selectfeaturefive = select("product_feature","id='$getfeatureIdfive'");
$fetchfeaturefive = fetch($selectfeaturefive);
$getfeaturefive = $fetchfeaturefive["name"];




    if ($queryInsertImage) {
             $updateProductInfo=saveData("productInfo",[
                "brand" => $_POST["getfetchcategory"],
                 "device_type" => $_POST["getfetchSubcategory"],
                 "device" => $_POST["getfetchMultisubcategory"], 
                 "accessory_type" => $_POST["getfetchMultisub_Subcategory"],
                 "product_cat" => $_POST["getfetchProductcategory"],
                 "product_type" => $_POST["getfetchProductType"],
                 "product_name" =>  $_POST["productName"],
                 "quantity" =>  $_POST["Quantity"],
                 "base_price" => $_POST["price"],
                 "discount" => $_POST["discount"],
                 "tottal_price" => $_POST["total"],
                 "gander" => $_POST["getForId"],
                 "theme" => $_POST["getfetchtheme"],
                 "product_feature_one" => $getfeature,
                 "product_feature_tow" => $getfeaturetwo,
                 "product_feature_tree" => $getfeaturetree,
                 "product_feature_four" => $getfeatureforth,
                 "product_feature_five" => $getfeaturefive,
                 "tranding" => $_POST["checkbox_product1"],
                "most_popular" => $_POST["checkbox_product2"],
                "latest" => $_POST["checkbox_product3"],
                "uniques" => $_POST["checkbox_product4"],
                "short_description" => $_POST["overview"],
                "description" => $_POST["description"],
                "token" => $_POST["token"]
             ]);
             if ($updateProductInfo) {
                 echo "00";
                 exit();
             }

 }
 



}
secureAdmin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <?php include 'partials/_style.php'; ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link href="assets/css/dropzone.css" rel="stylesheet" media="screen">

</head>
<style type="text/css">
    .check
    {
        margin-left: 8%;
    }
</style>
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
       <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Add Product Details</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="#">Product</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                   <li class="active">Add Product</li>
                            </ol>
                        </div>
                    </div>
                    <form method="POST" id="addProductForm">
                     
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <div class="card-head">
                                    <header>Product Information</header>
                                </div>
                                <div class="card-body row">


                                    <div class="col-md-6">
                                         <select name="getfetchcategory" id="getfetchcategory" class="form-control" required="">
                                                <option value="" redonly="">Select Brand</option>
                                                <?php $selectQuery=select("brand");
                                                    while ($category=fetch($selectQuery)) {     
                                                ?>
                                                    <option id="getCategory" data-id="<?= $category["id"]; ?>" value="<?= $category["id"]; ?>"><?php echo $category["category_name"]; ?>
                                                        
                                                    </option>  
                                                <?php } ?>
                                            </select>
  
                                    </div>
                                   <div class="col-md-6">
                                       <select name="sub-category" id="sub-category" class="form-control" required="">
                                                    
                                     <option value="">Select Device Type</option>
                                                
                                            </select>
                                    </div>

                                     <div class="col-md-6" style="padding-top:4%;">
                                       <select name="multi-sub-category" id="multi-sub-category" class="form-control" required="">
                                                    
                                     <option value="" readonly="" >Select Device</option>
                                                
                                        </select>
                                    </div>

                                     <div class="col-md-6" style="padding-top:4%;">
                                       <select name="multi-sub-sub-category" id="multi-sub-sub-category" class="form-control" required="">
                                                    
                                     <option value="" readonly="" >Select Accessory Type</option>
                                                
                                        </select>
                                    </div>

                                     <div class="col-md-6" style="padding-top:4%;">
                                       <select name="product-category" id="product-category" class="form-control" required="">
                                                    
                                     <option value="" readonly="" >Select Product Category</option>
                                                
                                        </select>
                                    </div>

                                    <div class="col-md-6" style="padding-top:4%;">
                                       <select name="product-type" id="product-type" class="form-control" required="">
                                                    
                                     <option value="" readonly="" >Select Product Type</option>
                                                
                                        </select>
                                    </div>






                                    <div class="col-lg-6 p-t-20">
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                                            <input name="productName" class = "mdl-textfield__input" type = "text"  id = "productName" required="">
                                            <label class = "mdl-textfield__label" for = "productName">Product Name</label>
                                          
                                              
                                        </div>
                                    </div>            

                                    <div class="col-lg-6 p-t-20">
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                                            <input name="Quantity" class = "mdl-textfield__input" type = "text" pattern = "-?[0-9]*(\.[0-9]+)?" id = "Quantity" required="">
                                            <label class = "mdl-textfield__label" for = "Quantity">Quantity</label>

                                             <span class = "mdl-textfield__error">Number required!</span>
                                        </div>
                                    </div>

                                   


                                    <div class="col-lg-6 p-t-20">
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                                            <input name="price" id="price" class = "mdl-textfield__input" type = "text" pattern = "-?[0-9]*(\.[0-9]+)?" required="">
                                            <label class = "mdl-textfield__label" for = "Price">Base Price</label>

                                             <span class = "mdl-textfield__error">Number required!</span>
                                        </div>
                                    </div>
                                    

                                  <div class="col-lg-6 p-t-20">
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                                            <input name="discount" id="discount" class = "mdl-textfield__input" type = "text" pattern = "-?[0-9]*(\.[0-9]+)?" id = "discount">
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
                                            <button onclick="getPrice()">Get Discounted Price</button>
                                            
                                        </div>
                                    </div>


                         <div class="col-md-6" style="padding-top: 4%;">
                                         <select name="getForId" id="getForId" class="form-control" required="">
                                            <option value="" redonly="">Select For</option>
                                          <option value="male">Him</option>
                                         <option value="female">Her</option>
                                         <option value="all">All</option>
                                        

                                                
                                            </select>
                                    </div>

                                    
                                    

                                     <div class="col-md-6" style="padding-top: 4%;">
                                         <select name="getfetchtheme" id="getfetchtheme" class="form-control">
                                                <option value="" redonly="">Select Theme (Optional)</option>
                                                <?php $selectQuery=select("product_theme");
                                                    while ($category=fetch($selectQuery)) {
                                                ?>
                                                    <option id="getCategory" data-id="<?= $category["id"]; ?>" value="<?= $category["id"]; ?>"><?php echo $category["name"]; ?>
                                                    </option>  
                                                <?php } ?>
                                            </select>
                                    </div>
                                     <div class="col-md-6" style="padding-top: 4%;">
                                         <select name="getfetchfeatureone" id="getfetchfeatureone" class="form-control" required="">
                                                <option value="" redonly="">Select Product Feature 1</option>
                                                <?php $selectQueryfeatureOne=select("product_feature");
                                                    while ($fetchfeatureOne=fetch($selectQueryfeatureOne)) {
                                                ?>
                                                    <option id="getCategory" data-id="<?= $fetchfeatureOne["id"]; ?>" value="<?= $fetchfeatureOne["id"]; ?>"><?php echo $fetchfeatureOne["name"]; ?>
                                                    </option>  
                                                <?php } ?>
                                            </select>
                                    </div>

                                    <div class="col-md-6" style="padding-top: 4%;">
                                         <select name="getfeatureIdtwo" id="getfeatureIdtwo" class="form-control" required="">
                                                <option value="" redonly="">Select Product Feature 2</option>
                                                <?php $selectQueryfeaturetwo=select("product_feature");
                                                    while ($fetchfeaturetwo=fetch($selectQueryfeaturetwo)) {
                                                ?>
                                                    <option id="getCategory" data-id="<?= $fetchfeaturetwo["id"]; ?>" value="<?= $fetchfeaturetwo["id"]; ?>"><?php echo $fetchfeaturetwo["name"]; ?>
                                                    </option>  
                                                <?php } ?>
                                            </select>
                                    </div>

                                    <div class="col-md-6" style="padding-top: 4%;">
                                         <select name="getfeatureIdtree" id="getfeatureIdtree" class="form-control" required="">
                                                <option value="" redonly="">Select Product Feature 3</option>
                                                <?php $selectQueryfeaturetree=select("product_feature");
                                                    while ($fetchfeaturetree=fetch($selectQueryfeaturetree)) {
                                                ?>
                                                    <option id="getCategory" data-id="<?= $fetchfeaturetree["id"]; ?>" value="<?= $fetchfeaturetree["id"]; ?>"><?php echo $fetchfeaturetree["name"]; ?>
                                                    </option>  
                                                <?php } ?>
                                            </select>
                                    </div>

                                    <div class="col-md-6" style="padding-top: 4%;">
                                         <select name="getfeatureIdforth" id="getfeatureIdforth" class="form-control" required="">
                                                <option value="" redonly="">Select Product Feature 4</option>
                                                <?php $selectQueryfeatureforth=select("product_feature");
                                                    while ($fetchfeatureforth=fetch($selectQueryfeatureforth)) {
                                                ?>
                                                    <option id="getCategory" data-id="<?= $fetchfeatureforth["id"]; ?>" value="<?= $fetchfeatureforth["id"]; ?>"><?php echo $fetchfeatureforth["name"]; ?>
                                                    </option>  
                                                <?php } ?>
                                            </select>
                                    </div>

                                    <div class="col-md-6" style="padding-top: 4%;">
                                         <select name="getfeatureIdfive" id="getfeatureIdfive" class="form-control" required="">
                                                <option value="" redonly="">Select Product Feature 5</option>
                                                <?php $selectQueryfeaturefive=select("product_feature");
                                                    while ($fetchfeaturefive=fetch($selectQueryfeaturefive)) {
                                                ?>
                                                    <option id="getCategory" data-id="<?= $fetchfeaturefive["id"]; ?>" value="<?= $fetchfeaturefive["id"]; ?>"><?php echo $fetchfeaturefive["name"]; ?>
                                                    </option>  
                                                <?php } ?>
                                            </select>
                                    </div>



                                     <div class="col-lg-12 p-t-20">
                            <label class="textfield__label" for="text7">Product Tag</label>

                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width" data-upgraded=",MaterialTextfield" style="max-width: none !important;">

                                    <input type="checkbox" class="check" name="checkbox_product1" id="checkbox_product1" value="0" autocomplete="off">
                                    <label class="textfield__label " for="productTag">Trending</label> 

                                      <input type="checkbox" class="check" name="checkbox_product2" id="checkbox_product2" value="0" autocomplete="off">
                                      <label class="textfield__label" for="productTag">Most Popular</label> 
                                       
                                        <input type="checkbox" class="check" name="checkbox_product3" id="checkbox_product3" value="0" autocomplete="off">
                                        <label class="textfield__label" for="productTag">Latest</label> 
                                          
                                          <input type="checkbox" class="check" name="checkbox_product4" id="checkbox_product4" value="0" autocomplete="off">
                                          <label class="textfield__label" for="productTag">Unique</label> 
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class = "mdl-textfield mdl-js-textfield txt-full-width">
                                            <textarea name="overview" class = "mdl-textfield__input" rows =  "2"
                                            id = "overview" required=""></textarea>
                                            <label class = "mdl-textfield__label" for = "text7">Short Description</label>
                                        </div>
                                    </div>
                                     
                                    <div class="col-lg-12">
                                        <div class = "mdl-textfield mdl-js-textfield txt-full-width">
                                            <textarea name="description" class = "mdl-textfield__input" rows =  "3"
                                            id = "description" required=""></textarea>
                                            <label class = "mdl-textfield__label" for = "text7">Description</label>
                                        </div>
                                    </div>
                               

                                    <div class="col-lg-12">
                                        <input type="hidden" value="0" id="issubmited" name="">
                                        <input style="display: none;" type="submit" id="main">
                                        <input type="hidden" name="token" id="token" value="<?php echo token(12); ?>">
                                    </div>

                                     <div class="col-lg-12 p-t-20">
                                        <p>Select Avalible Colors (Hexa Code Require!)
                                            <button id="chooseColor" type="button" class="btn dark btn-outline  ml-3 btn-sm" data-toggle="modal" data-target="#openColorPicker">More Colors</button>
                                            <input type="color" id="colorPicker" style="display: none;">
                                        </p>
                                        <select  class="form-control js-example-tags"  multiple="multiple">
                                            <option selected="selected">#000000</option>
                                            <option>#ff0000</option>
                                            <option selected="selected">#ffffff</option>
                                        </select>
                                        <input type="hidden" name="colors" value="#000000,#ffffff" id="colors">
                                    </div>

                                </div>
                                </div>
                            </div>
                        </div>

                    </form>
                                <!-- Modal -->
<div id="openColorPicker" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Modal Header</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
        <input type="color" style="    height: 100px;
        width: 100%;" id="colorpicker" name="color" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="#333333"/>
        <input onclick="copyText()" type="text" class="form-control copycolor" style="height: 100px;font-size: 42px;cursor: pointer;" id="hexcolor" name="colorHex" value="#333333" />

            <p id="textToCopied" onclick="copyText()" class="text-dark text-center mb-0 mt-3 " style="cursor: pointer;">Click Here to Copy Hex Code</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <div class="card-head">
                                <header>Products Secondary Images</header>
                                </div>
                                <label class="control-label col-md-3" style="margin-top: 50px">Upload Products Photos</label>
                                <div class="col-lg-12 p-t-20">
                                    <form action="add-product.php" class="dropzone" id="my-dropzone">
                                        <div class="dz-message">
                                            <div class="dropIcon">
                                                <i class="material-icons">cloud_upload</i>
                                            </div>
                                            <h3>Drop files here or click to upload.</h3>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-lg-12 p-t-20 text-center">
                                    <button id="submit-all" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink">Submit</button>
                                    
                                    <a href="view-product.php" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-default">Cancel</a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script type="text/javascript" src="assets/js/dropzone.js"></script>
    <script type="text/javascript">

/*Fetch Multi Sub Categories*/
$("#getfetchcategory").change(function(event) {
        var sub_id=$(this).val();
        $.ajax({
            url: 'php/auth.php',
            type: 'POST',
            dataType: 'html',
            data: {sub_id: sub_id},
        })
        .done(function(data) {
            $("#sub-category").html(data);
            //console.log(data);
        });
 
});

function opendialog() {

  $("#imagebox").trigger('click');

}
 $(".js-example-tags").select2({
          tags: true,
          placeholder: "Enter Hexa Code",
          tokenSeparators: [',', ' ']
        });

        $(".js-example-tags").change(function(){
            var color=$(this).val();
            $("#colors").val(color);
        });

        $('#colorpicker').on('change', function() {
            $('#hexcolor').attr("value",this.value);
            $("#hexcolor").css('color', this.value);
        });

        function copyText() {
            var copyText = document.getElementById("hexcolor");
            copyText.select();
            document.execCommand("copy");
            //alert("Copied the text: " + copyText.value);
            $("#textToCopied").html("Hex Code Copied Paste It In Option And Press Enter");

        }


$("#sub-category").change(function(event) {
        var multi_sub_id=$(this).val();
        $.ajax({
            url: 'php/auth.php',
            type: 'POST',
            dataType: 'html',
            data: {multi_sub_id:multi_sub_id},
        })
        .done(function(data) {
            $("#multi-sub-category").html(data);
            //console.log(data);
        });
 
});


$("#multi-sub-category").change(function(event) {
        var multi_sub_sub_id=$(this).val();
        $.ajax({
            url: 'php/auth.php',
            type: 'POST',
            dataType: 'html',
            data: {multi_sub_sub_id:multi_sub_sub_id},
        })
        .done(function(data) {
            $("#multi-sub-sub-category").html(data);
            //console.log(data);
        });
 
});

$("#multi-sub-sub-category").change(function(event) {
        var product_id=$(this).val();
        $.ajax({
            url: 'php/auth.php',
            type: 'POST',
            dataType: 'html',
            data: {product_id:product_id},
        })
        .done(function(data) {
            $("#product-category").html(data);
            //console.log(data);
        });
 
});



$("#product-category").change(function(event) {
        var product_type=$(this).val();
        $.ajax({
            url: 'php/auth.php',
            type: 'POST',
            dataType: 'html',
            data: {product_type:product_type},
        })
        .done(function(data) {
            $("#product-type").html(data);
            //console.log(data);
        });
 
});


/*Add Product*/

$(document).ready(function(event) {
    $("#addProductForm").on('submit', function(event) {
        event.preventDefault();
        $("#issubmited").val('1');
    });
});


Dropzone.options.myDropzone = {
    // Prevents Dropzone from uploading dropped files immediately
    autoProcessQueue: false,
    init: function() {
        var submitButton = document.querySelector("#submit-all");
        myDropzone = this; // closure
        submitButton.addEventListener("click", function() {
            $('#main').trigger('click');
            var val = $("#issubmited").val();
            if (val == '1') {
                myDropzone.processQueue();
            }
            // Tell Dropzone to process all queued files.

        });
        // You might want to show the submit button only when
        // files are dropped here:
        this.on("addedfile", function() {
            // Show submit button here and/or inform user to click it.


            // $("#submit-all").show();

        });
        myDropzone.on('sending', function(file, xhr, formData) {
           
          
            
            var getfetchcategory = $("#getfetchcategory").val();
            var getfetchSubcategory = $("#sub-category").val();
            var getfetchMultisubcategory = $("#multi-sub-category").val();
            var getfetchMultisub_Subcategory = $("#multi-sub-sub-category").val();
            var getfetchProductcategory = $("#product-category").val();
            var getfetchProductType = $("#product-type").val();
            var productName = $("#productName").val();
            var Quantity = $("#Quantity").val();
            var price = $("#price").val();
            var discount = $("#discount").val();
            var total = $("#total").val();
            var getForId = $("#getForId").val();
            var getfetchtheme = $("#getfetchtheme").val();
            var getfetchfeatureone = $("#getfetchfeatureone").val();
            var getfeatureIdtwo = $("#getfeatureIdtwo").val();
            var getfeatureIdtree = $("#getfeatureIdtree").val();
            var getfeatureIdforth = $("#getfeatureIdforth").val();
            var getfeatureIdfive = $("#getfeatureIdfive").val();
            var imagebox = $("#imagebox").val();
            var checkbox_product1 = $("#checkbox_product1").prop('checked');
            var checkbox_product2 = $("#checkbox_product2").prop('checked');
            var checkbox_product3 = $("#checkbox_product3").prop('checked');
            var checkbox_product4 = $("#checkbox_product4").prop('checked');
            var overview = $("#overview").val();
            var description = $("#description").val();
            var token = $("#token").val();
                
            // var Price = $("#Price").val();
            // var overview = $("#overview").val();
            //var checkbox_product1 = $("#checkbox_product1").val();
           // var gender2 = $("#gender2").val();
            //var checkbox_product1 = $("#checkbox_product1").prop('checked');

           
            formData.append('getfetchcategory', getfetchcategory);
            formData.append('getfetchSubcategory', getfetchSubcategory);
            formData.append('getfetchMultisubcategory', getfetchMultisubcategory);
            formData.append('getfetchMultisub_Subcategory', getfetchMultisub_Subcategory);
            formData.append('getfetchProductcategory', getfetchProductcategory);
            formData.append('getfetchProductType', getfetchProductType);
            formData.append('productName', productName);
            formData.append('Quantity', Quantity);
            formData.append('price', price);
            formData.append('discount', discount);
            formData.append('total', total);
            formData.append('getForId', getForId);
            formData.append('getfetchtheme', getfetchtheme);
            formData.append('getfetchfeatureone', getfetchfeatureone);
            formData.append('getfeatureIdtwo', getfeatureIdtwo);
            formData.append('getfeatureIdtree', getfeatureIdtree);
            formData.append('getfeatureIdforth', getfeatureIdforth);
            formData.append('getfeatureIdfive', getfeatureIdfive);
            formData.append('checkbox_product1', checkbox_product1);
            formData.append('checkbox_product2', checkbox_product2);
            formData.append('checkbox_product3', checkbox_product3);
            formData.append('checkbox_product4', checkbox_product4);
            formData.append('image', imagebox);
            formData.append('overview', overview);
            formData.append('description', description);
            formData.append('token', token);
       
           //formData.append('checkbox_product1', checkbox_product1); 
            //formData.append('genderfemale', gender2);
            //formData.append('gender', gender);       
        });
        myDropzone.on('success', function(file, resp) {
           console.log(resp);
            var id=btoa(resp);
            if (resp=='00') {
                swal("Success","Product Added To Database Successfully!","success");
                setTimeout(function(){ 
                    window.location='view-product.php';
                 }, 3000);
            }
            else{
                swal("Oh Snap","Product Added Not Successfully!","warning");
            }
            

        });
    }
};
        

      
    </script>

    <script>
getPrice = function() {
var numVal1 = Number(document.getElementById("price").value);
var numVal2 = Number(document.getElementById("discount").value) / 100;
var totalValue = numVal1 - (numVal1 * numVal2)
var totalvalround = Math.round(totalValue);
document.getElementById("total").value = totalvalround.toFixed(2);
}
</script>
    
</body>
</html>