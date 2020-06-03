<?php require '../includes/functions.php';

if (isset($_POST["updateDetails"])) {

        $token=post("updateDetails");
        $checkbox_product1 = (isset($_POST["checkbox_product1"])) ? '1' : '0';
        $checkbox_product2 = (isset($_POST["checkbox_product2"])) ? '1' : '0';
        $checkbox_product3 = (isset($_POST["checkbox_product3"])) ? '1' : '0';
        $checkbox_product4 = (isset($_POST["checkbox_product4"])) ? '1' : '0';

$queryGetProduct=select("productInfo","token='$token'");

if (howMany($queryGetProduct) > 0) {
$getDetails=fetch($queryGetProduct);
if ($queryGetProduct) {
$updatedData=[
"brand"                => $_POST["getfetchcategory"],
"device_type"          => $_POST["sub-category"],
"device"               => $_POST["multi-sub-category"],
"accessory_type"       => $_POST["multi-sub-sub-category"],
"product_cat"          => $_POST["product-category"],
"product_type"         => $_POST["product-type"],
"product_name"         => $_POST["productName"],
"gander"               => $_POST["getForId"],
"theme"                => $_POST["getfetchtheme"],
"product_feature_one"  => $_POST["getfetchfeatureone"],
"product_feature_tow"  => $_POST["getfeatureIdtwo"],
"product_feature_tree" => $_POST["getfeatureIdtree"],
"product_feature_four" => $_POST["getfeatureIdforth"],
"product_feature_five" => $_POST["getfeatureIdfive"],
"tranding"             => $checkbox_product1,
"most_popular"         => $checkbox_product2,
"latest"               => $checkbox_product3,
"uniques"              => $checkbox_product4,
"short_description"    => $_POST["overview"],
"description"          => $_POST["description"]
];
$queryForProductUpdate=update("productInfo",$updatedData,"token='$token'");
if ($queryForProductUpdate) {
returnJson(1,"Product Updated Successfully!");
}
else{
returnJson(0,"Something Went Wrong While Updating Product Details!");
}
}
else{
returnJson(0,"Something Went Wrong While Updating Product Details!");
}
}
else{
returnJson(0,"Invalid Product Token");
}
}
/* For Removing Images
if (isset($_POST["removeImage"])) {
$id=$_POST["removeImage"];
$queryForImageDelete=deleteRow("product_image","id='$id'");
if ($queryForImageDelete) {
returnJson(1,"Product Image Deleted Successfully!");
}
else{
returnJson(0,"Something Went Wrong While Deleting Image!");
}
}
if (isset($_POST["setPrimary"])) {
$id=$_POST["setPrimary"];
$token=$_POST["token"];
$updateAllImages=update("product_image",["primaryImage" => "0"],"token='$token'");
if ($updateAllImages) {
$querySetPrimary=update("product_image",["primaryImage" => "1"],"id='$id'");
if ($querySetPrimary) {
returnJson($id,"Image Set to Primary Successfully!");
}
else{
returnJson(0,"Something went Wrong While Setting Image to Primary");
}
}
else{
returnJson(0,"Something went Wrong While Setting Image to Primary");
}
}*/



if (isset($_GET["token"])) {
$token=$_GET["token"];
/*Query For Product*/
$queryGetProduct=select("productInfo","token='$token'");
if(howMany($queryGetProduct) > 0){

$getProduct=fetch($queryGetProduct);
}
else{
move("view-product.php");
}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'partials/_style.php'; ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
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
                  <div class="page-title">Edit Product :</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                  <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">Edit Product</li>
              </ol>
            </div>
          </div>
          <!-- page main content -->
          <div class="row">
            <div class="col-sm-12">
              <div class="card-box">
                
                <form method="POST" id="editProductForm">
                  
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card-box">
                        <div class="card-head">
                        <header>Product Information</header>
                      </div>
                      <div class="card-body row">
                        
                        
                        <div class="col-md-6">
                          <select name="getfetchcategory" id="getfetchcategory" class="form-control" required="">
                            <option value="" readonly="">Select Brand</option>
                            <?php $selectQuery=select("brand");
                            while ($category=fetch($selectQuery)) {
                            ?>
                            <option <?php echo ($getProduct["brand"]==$category["id"]) ? "selected=''" : "" ;?> id="getCategory" data-id="<?= $category["id"]; ?>" value="<?= $category["id"]; ?>"><?php echo $category["category_name"]; ?>
                              
                            </option>
                            <?php } ?>
                          </select>
                          
                        </div>

                          <div class="col-md-6">
                          <select name="sub-category" id="sub-category" class="form-control" required="">
                            <option value="" readonly="">Select Device Type</option>
                            <?php $selectQueryCat=select("category");
                            while ($categoryCat=fetch($selectQueryCat)) {
                            ?>
                            <option <?php echo ($getProduct["device_type"]==$categoryCat["id"]) ? "selected=''" : "" ;?> id="getCategory" data-id="<?= $categoryCat["id"]; ?>" value="<?= $categoryCat["id"]; ?>"><?php echo $categoryCat["name"]; ?>
                              
                            </option>
                            <?php } ?>
                          </select>
                          
                        </div>

                          <div class="col-md-6" style="padding-top:4% !important;">
                          <select name="multi-sub-category" id="multi-sub-category" class="form-control" required="">
                            <option value="" readonly="">Select Device </option>
                            <?php $selectQuerySubcat=select("subcategory");
                            while ($categorySubcat=fetch($selectQuerySubcat)) {
                            ?>
                            <option <?php echo ($getProduct["device"]==$categorySubcat["id"]) ? "selected=''" : "" ;?> id="getCategory" data-id="<?= $categorySubcat["id"]; ?>" value="<?= $categorySubcat["id"]; ?>"><?php echo $categorySubcat["name"]; ?>
                              
                            </option>
                            <?php } ?>
                          </select>
                          
                        </div>


                          <div class="col-md-6" style="padding-top:4% !important;">
                          <select name="multi-sub-sub-category" id="multi-sub-sub-category" class="form-control" required="">
                            <option value="" readonly="">Select Accessory Type</option>
                            <?php $selectQueryMULSubcat=select("multi_sub_category");
                            while ($categoryMULSubcat=fetch($selectQueryMULSubcat)) {
                            ?>
                            <option <?php echo ($getProduct["accessory_type"]==$categoryMULSubcat["id"]) ? "selected=''" : "" ;?> id="getCategory" data-id="<?= $categoryMULSubcat["id"]; ?>" value="<?= $categoryMULSubcat["id"]; ?>"><?php echo $categoryMULSubcat["name"]; ?>
                              
                            </option>
                            <?php } ?>
                          </select>
                          
                        </div>


                          <div class="col-md-6" style="padding-top:4% !important;">
                          <select name="product-category" id="product-category" class="form-control" required="">
                            <option value="" readonly="">Select Product Category</option>
                            <?php $selectQueryProSubcat=select("multi_sub_sub_category");
                            while ($categoryProSubcat=fetch($selectQueryProSubcat)) {
                            ?>
                            <option <?php echo ($getProduct["product_cat"]==$categoryProSubcat["id"]) ? "selected=''" : "" ;?> id="getCategory" data-id="<?= $categoryProSubcat["id"]; ?>" value="<?= $categoryProSubcat["id"]; ?>"><?php echo $categoryProSubcat["name"]; ?>
                              
                            </option>
                            <?php } ?>
                          </select>
                          
                        </div>


                          <div class="col-md-6" style="padding-top:4% !important;">
                          <select name="product-type" id="product-type" class="form-control" required="">
                            <option value="" readonly="">Select Product Type</option>
                            <?php $selectQueryProType=select("product_type");
                            while ($categoryProType=fetch($selectQueryProType)) {
                            ?>
                            <option <?php echo ($getProduct["product_type"]==$categoryProType["id"]) ? "selected=''" : "" ;?> id="getCategory" data-id="<?= $categoryProType["id"]; ?>" value="<?= $categoryProType["id"]; ?>"><?php echo $categoryProType["product_type"]; ?>
                              
                            </option>
                            <?php } ?>
                          </select>
                          
                        </div>

                         
                        <div class="col-lg-6 p-t-20">
                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                            <input name="productName" class = "mdl-textfield__input" type = "text"  id = "productName" value="<?php echo $getProduct["product_name"];?>" required="">
                            <label class = "mdl-textfield__label" for = "productName">Product Name</label>
                            
                            
                          </div>
                        </div>
                               <div class="col-md-6" style="padding-top: 4%;">
                            <select name="getForId" id="getForId" class="form-control" required="">
                              <option value="<?php echo $getProduct["gander"]; ?>" readonly=""><?php echo $getProduct["gander"]; ?>
                                  </option>
                                <option value="male">Men</option>
                               <option value="female">Women</option>
                               <option value="Unisex">Unisex</option>
                          </select>
                      </div>
                        
                        
                        <div class="col-md-6" style="padding-top: 4%;">
                          <select name="getfetchtheme" id="getfetchtheme" class="form-control">
                            <option value="" redonly="">Select Theme (Optional)</option>
                            <?php $selectQueryThe=select("product_theme");
                            while ($categoryThe=fetch($selectQueryThe)) {
                            ?>
                             <option <?php echo ($getProduct["theme"]==$categoryThe["id"]) ? "selected=''" : "" ;?> id="getCategory" data-id="<?= $categoryThe["id"]; ?>" value="<?= $categoryThe["id"]; ?>"><?php echo $categoryThe["name"]; ?>
                              
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
                            <option <?php echo ($getProduct["product_feature_one"]==$fetchfeatureOne["id"]) ? "selected=''" : "" ;?> id="getCategory" data-id="<?= $fetchfeatureOne["id"]; ?>" value="<?= $fetchfeatureOne["id"]; ?>"><?php echo $fetchfeatureOne["name"]; ?>
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
                              <option <?php echo ($getProduct["product_feature_tow"]==$fetchfeaturetwo["id"]) ? "selected=''" : "" ;?> id="getCategory" data-id="<?= $fetchfeaturetwo["id"]; ?>" value="<?= $fetchfeaturetwo["id"]; ?>"><?php echo $fetchfeaturetwo["name"]; ?>
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
                             <option <?php echo ($getProduct["product_feature_tree"]==$fetchfeaturetree["id"]) ? "selected=''" : "" ;?> id="getCategory" data-id="<?= $fetchfeaturetree["id"]; ?>" value="<?= $fetchfeaturetree["id"]; ?>"><?php echo $fetchfeaturetree["name"]; ?>
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
                             <option <?php echo ($getProduct["product_feature_four"]==$fetchfeatureforth["id"]) ? "selected=''" : "" ;?> id="getCategory" data-id="<?= $fetchfeatureforth["id"]; ?>" value="<?= $fetchfeatureforth["id"]; ?>"><?php echo $fetchfeatureforth["name"]; ?>
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
                              <option <?php echo ($getProduct["product_feature_five"]==$fetchfeaturefive["id"]) ? "selected=''" : "" ;?> id="getCategory" data-id="<?= $fetchfeaturefive["id"]; ?>" value="<?= $fetchfeaturefive["id"]; ?>"><?php echo $fetchfeaturefive["name"]; ?>
                          </option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="col-lg-12 p-t-20">
                          <label class="textfield__label" for="text7">Product Tag</label>
                          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width" data-upgraded=",MaterialTextfield" style="max-width: none !important;">
                            <input type="checkbox" class="check" name="checkbox_product1" id="checkbox_product1" value="" <?php echo ($getProduct["tranding"]=='1') ? 'checked':'' ; ?> autocomplete="off">
                            <label class="textfield__label " for="productTag">Trending</label>
                            <input type="checkbox" class="check" name="checkbox_product2" id="checkbox_product2" value="" <?php echo ($getProduct["most_popular"]=='1') ? 'checked':'' ; ?> autocomplete="off">
                            <label class="textfield__label" for="productTag">Most Popular</label>
                            
                            <input type="checkbox" class="check" name="checkbox_product3" id="checkbox_product3" value="" <?php echo ($getProduct["latest"]=='1') ? 'checked':'' ; ?> autocomplete="off">
                            <label class="textfield__label" for="productTag">Latest</label>
                            
                            <input type="checkbox" class="check" name="checkbox_product4" id="checkbox_product4" value="" <?php echo ($getProduct["uniques"]=='1') ? 'checked':'' ; ?> autocomplete="off">
                            <label class="textfield__label" for="productTag">Unique</label>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class = "mdl-textfield mdl-js-textfield txt-full-width">
                            <textarea name="overview" class = "mdl-textfield__input" rows =  "2"
                            id = "overview" required=""><?php echo $getProduct["short_description"];?></textarea>
                            <label class = "mdl-textfield__label" for = "text7">Short Description</label>
                          </div>
                        </div>
                        
                        <div class="col-lg-12">
                          <div class = "mdl-textfield mdl-js-textfield txt-full-width">
                            <textarea name="description" class = "mdl-textfield__input" rows =  "3"
                            id = "description" required=""><?php echo $getProduct["description"];?></textarea>
                            <label class = "mdl-textfield__label" for = "text7">Description</label>
                          </div>
                        </div>
                     <!--    
                        <div class="col-lg-12">
                          <input type="hidden" value="0" id="issubmited" name="">
                          <input style="display: none;" type="submit" id="main">
                          <input type="hidden" name="token" id="token" value="<?php //echo token(12); ?>">
                        </div -->
                        <input type="hidden" value="<?= $token; ?>" name="updateDetails">
                          <div class="col-lg-12">
                                        <button type="submit" class="mt-3 float-right mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-circle btn-pink" data-upgraded=",MaterialButton,MaterialRipple">Update<span class="mdl-button__ripple-container"><span class="mdl-ripple is-animating" style="width: 153.482px; height: 153.482px; transform: translate(-50%, -50%) translate(36px, 12px);"></span></span></button>
                                    </div>
                      </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript">
$(".js-example-tags").select2({
tags: true,
placeholder: "Enter Hexa Code",
tokenSeparators: [',', ' ']
});
$('#colorpicker').on('change', function() {
$('#hexcolor').attr("value",this.value);
$("#hexcolor").css('color', this.value);
});


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
            console.log(data);
        });
 
});


$("#editProductForm").on('submit', function(event) {
event.preventDefault();
var updateForm=new FormData(this);
$.ajax({
url: 'edit-product.php',
type: 'POST',
dataType: 'json',
data: updateForm,
cache:false,
contentType:false,
processData:false,
})
.done(function(data) {
if (data.response.code==1) {
swal("Success",data.response.msg,"success");
setTimeout(function(){
window.location='view-product.php';
}, 3000);
}
if (data.response.code==0) {
swal("Oh Snap",data.response.msg,"error");
}
})
.fail(function(data) {
console.log("error");
swal("Oh Snap","Something Went Wrong Please Contact Your Devloper","error");
})
.always(function(data) {
console.log(data);
});
});
/*function removeImages(id) {
$.ajax({
url: 'edit-product.php',
type: 'POST',
dataType: 'json',
data: {removeImage: id},
})
.done(function(data) {
if (data.response.code==1) {
$(".img"+id).hide('slow');
}
if (data.response.code==0) {
swal("Opps",data.response.msg,"warning");
}
})
.fail(function(data) {
console.log("error");
swal("Oh Snap","Something Went Wrong Please Contact Your Developer","error");
})
.always(function(data) {
console.log(data);
});
}
function setPrimary(id,token) {
$(".set-primary").removeClass('btn-primary');
$(".set-primary").addClass('btn-dark');
$("#primary"+id).removeClass('btn-dark');
$("#primary"+id).addClass('btn-primary');
$.ajax({
url: 'edit-product.php',
type: 'POST',
dataType: 'json',
data: {setPrimary: id,token:token},
})
.done(function(data) {
console.log("success");
})
.fail(function(data) {
console.log("error");
})
.always(function(data) {
console.log(data);
});
}*/
</script>
</body>
</html>