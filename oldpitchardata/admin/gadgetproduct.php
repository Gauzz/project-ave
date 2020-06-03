<?php require '../includes/functions.php';

    if (isset($_POST["product"])) {
        $overview=realEscape($_POST["overview"]);
        $description=realEscape($_POST["description"]);

       
        $checkbox_product1 = (isset($_POST["checkbox_product1"])) ? '1' : '0';
        $checkbox_product2 = (isset($_POST["checkbox_product2"])) ? '1' : '0';
        $checkbox_product3 = (isset($_POST["checkbox_product3"])) ? '1' : '0';
        $checkbox_product4 = (isset($_POST["checkbox_product4"])) ? '1' : '0';
      
        // $InsertProduct=mysqli_query($conn,"INSERT INTO products(token,name,colors,category,subcategory,brand,shortDesc,longDesc,discount)VALUES('$token','".$_POST["product"]."','".$_POST["colors"]."','".$_POST["category"]."','".$_POST["subcategory"]."','".$_POST["brand"]."','$overview','$description','$discount')");
$token=token(10);
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

         // $InsertProduct=saveData("productInfo",[
         //         "brand" => $_POST["getfetchcategory"],
         //         "device_type" => $_POST["sub-category"],
         //         "device" => $_POST["multi-sub-category"], 
         //         "accessory_type" => $_POST["multi-sub-sub-category"],
         //         "product_cat" => $_POST["product-category"],
         //         "product_type" => $_POST["product-type"],
         //         "product_name" =>  $_POST["product"],
         //          "gander" => $_POST["getForId"],
         //         "theme" => $_POST["getfetchtheme"],
         //         "product_feature_one" => $getfeature,
         //         "product_feature_tow" => $getfeaturetwo,
         //         "product_feature_tree" => $getfeaturetree,
         //         "product_feature_four" => $getfeatureforth,
         //         "product_feature_five" => $getfeaturefive,
         //         "tranding" => $checkbox_product1,
         //        "most_popular" => $checkbox_product2,
         //        "latest" => $checkbox_product3,
         //        "uniques" => $checkbox_product4,
         //        "short_description" => $overview,
         //        "description" => $description,
         //        "token" => $token
         //     ]);

       
   $InsertProduct=mysqli_query($conn,"INSERT INTO productInfo(brand,device_type,device,accessory_type,product_cat,product_type,product_name,gander,theme,product_feature_one,product_feature_tow,product_feature_tree,product_feature_four,product_feature_five,tranding,most_popular,latest,uniques,short_description,description,token)VALUES('".$_POST["getfetchcategory"]."','".$_POST["sub-category"]."','".$_POST["multi-sub-category"]."','".$_POST["multi-sub-sub-category"]."','".$_POST["product-category"]."','".$_POST["product-type"]."','".$_POST["product"]."','".$_POST["getForId"]."','".$_POST["getfetchtheme"]."','$getfeature','$getfeaturetwo','$getfeaturetree','$getfeatureforth','$getfeaturefive','$checkbox_product1','$checkbox_product2','$checkbox_product3','$checkbox_product4','$overview','$description','$token')");
  
        if ($InsertProduct) {
            $array=explode(',',$_POST["colors"]);
            $id=mysqli_insert_id($conn);
            foreach ($array as $key) {
                $insertSubProduct=mysqli_query($conn,"INSERT INTO products(productId,color,productToken,token)VALUES('$id','$key','$token','".token(10)."')");
            }
            $subProductId='';
            $queryGetId=mysqli_query($conn,"SELECT * FROM products WHERE productId='$id' AND created='0'");
            while ($getId=mysqli_fetch_array($queryGetId)) {
                $subProductId .=$getId["id"].',';
            }

            if ($insertSubProduct) {
                exit(json_encode(["response" => ["code" => "1","token" => $token,"ids" => base64_encode(substr($subProductId,0,-1))]]));
            }
            else{
                exit(json_encode(["response" => ["code" => "0"]]));
            }
        }
        else{
            exit(json_encode(["response" => ["code" => "00"]]));
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
                    <form method="POST" id="productForm">
                     <div class="row"> 
                        <div class="col-sm-12">
                            <div class="card-box">
                                <div class="card-head">
                                    <header>Product Type</header>
                                </div>
                                <div class="card-body ">
                                    <div class="row">

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
                                                    
                                     <option value="" readonly="" >Select Product Caregory</option>
                                                
                                        </select>
                                    </div>

                                    <div class="col-md-6" style="padding-top:4%;">
                                       <select name="product-type" id="product-type" class="form-control" required="">
                                                    
                                     <option value="" readonly="" >Select Product Type</option>
                                                
                                        </select>
                                    </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                     </div> 
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <div class="card-head">
                                    <header>Product Information</header>
                                </div>
                                <div class="card-body row">
                                    <div class="col-lg-6 p-t-20">
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                                            <input required="" name="product" class = "mdl-textfield__input" type = "text" id = "productName">
                                            <label class = "mdl-textfield__label" for = "productName">Product Name</label>
                                        </div>
                                    </div>

                                     <div class="col-md-6" style="padding-top: 4%;">
                                         <select name="getForId" id="getForId" class="form-control" required="">
                                            <option value="" readonly="">Select For</option>
                                          <option value="male">Men</option>
                                         <option value="female">Women</option>
                                         <option value="all">Unisex</option>
                                        

                                                
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

                                    <input type="checkbox" class="check" name="checkbox_product1" id="checkbox_product1" autocomplete="off">
                                    <label class="textfield__label " for="productTag">Trending</label> 

                                      <input type="checkbox" class="check" name="checkbox_product2" id="checkbox_product2" autocomplete="off">
                                      <label class="textfield__label" for="productTag">Most Popular</label> 
                                       
                                        <input type="checkbox" class="check" name="checkbox_product3" id="checkbox_product3" autocomplete="off">
                                        <label class="textfield__label" for="productTag">Latest</label> 
                                          
                                          <input type="checkbox" class="check" name="checkbox_product4" id="checkbox_product4" autocomplete="off">
                                          <label class="textfield__label" for="productTag">Unique</label> 
                                        </div>
                                    </div>

                               

                                    <div class="col-lg-12">
                                        <div class = "mdl-textfield mdl-js-textfield txt-full-width">
                                            <textarea required="" name="overview" class = "mdl-textfield__input" rows =  "2"
                                            id = "education" ></textarea>
                                            <label class = "mdl-textfield__label" for = "text7">Overview</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class = "mdl-textfield mdl-js-textfield txt-full-width">
                                            <textarea required="" name="description" class = "mdl-textfield__input" rows =  "3"
                                            id = "education" ></textarea>
                                            <label class = "mdl-textfield__label" for = "text7">Description</label>
                                        </div>
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

                                    <div class="col-lg-12">
                                        <button type="submit" class="mt-3 float-right mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-circle btn-pink" data-upgraded=",MaterialButton,MaterialRipple">Next<span class="mdl-button__ripple-container"><span class="mdl-ripple is-animating" style="width: 153.482px; height: 153.482px; transform: translate(-50%, -50%) translate(36px, 12px);"></span></span></button>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        </form>
                </div>
            </div>
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

            <!-- end page content -->
        </div>
        <!-- end page container -->
        <!-- start footer -->
            <?php include 'partials/_footer.php'; ?>
        <!-- end footer -->
    </div>
    <?php include 'partials/_script.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script type="text/javascript">


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


    $(document).ready(function(event) {
        $("#productForm").on('submit', function(event) {
            var formdata=new FormData(this);
            event.preventDefault();
            $.ajax({
                url: 'gadgetproduct.php',
                type: 'POST',
                dataType: 'json',
                data:formdata,
                cache:false,
                contentType: false,
                processData: false,
            })
            .done(function(data) {
                console.log(data);
                if (data.response.code=='0') {
                    swal("Oh Snap","Something Went wrong Please Refresh the Page!","error");
                }
                if (data.response.code=='00') {
                    swal("Oh Snap","Something!","error");
                }
                if (data.response.code=='1') {
                    window.location='gadgetproduct-info.php?token='+data.response.token+'&ids='+data.response.ids;
                }
            })
            .fail(function(data) {
                console.log(data);
            })
        
        });
                                
    });        

      
    </script>
    
</body>
</html>