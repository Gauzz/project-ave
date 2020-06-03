<?php require '../includes/functions.php';

if (isset($_FILES["file"])) {
    $imageNo=1;
    foreach ($_FILES["file"]["name"] as $i => $pImage) {
        $primaryImage=($imageNo=='1') ? "1" : "0";
        $imagename=rand().".jpg";
        if (move_uploaded_file($_FILES["file"]["tmp_name"][$i],"uploads/product-images/".$imagename)) {
            $queryInsertImage=saveData("product_image",["token" =>  $_POST["token"],"name" => $imagename,"primaryImage" => $primaryImage ]);    
        }
        else{
           echo "0";
           exit();
        }
        $imageNo++;
        
    }
// $gender = (isset($_POST["genderfemale"])) ? 'female':'male';
// $gender = (isset($_POST["gendermale"])) ? 'male':'female';

$subCategoryId=$_POST["subcategory"];
$selectSubCategory = select("subcategory","id='$subCategoryId'");
$fetchSubCategory = fetch($selectSubCategory);
$getSubCategory = $fetchSubCategory["name"];

    if ($queryInsertImage) {
             $updateProductInfo=saveData("productInfo",[
                "category" => $_POST["category"],
                "subcat_id" => $_POST["subcategory"],
                "subcategory_name" =>  $getSubCategory, 
                "product_name" => $_POST["productName"],
                "quantity" => $_POST["Quantity"],
                "price" => $_POST["Price"],
                "gender" =>  $_POST["gender"],
                "colors" =>  $_POST["colors"],
                "s" => $_POST["checkbox_product1"],
                "m" => $_POST["checkbox_product2"],
                "l" => $_POST["checkbox_product3"],
                "xl" => $_POST["checkbox_product4"],
                "xxl" => $_POST["checkbox_product5"],
                "xxxl" => $_POST["checkbox_product6"],
                "overview" => $_POST["overview"],
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
if (isset($_POST["sub_id"])) {
    $id=$_POST["sub_id"];
    $queryValidateString=select("subcategory","categories_id='$id'");
    if (howMany($queryValidateString) > 0) { ?>
             <option value="">Select Sub Category</option>
        <?php
        while($subcategory=fetch($queryValidateString)){ ?>
<option value="<?php echo $subcategory["id"]; ?>"><?php echo $subcategory["sub_category_name"]; ?></option>
<?php }
    }else{ ?>
        <option value="">Select Sub Category</option>
    <?php } 
}

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
                                    <div class="col-lg-6 p-t-20">
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                                            <input required="" name="productName" class = "mdl-textfield__input" type = "text" pattern="[A-Z a-z]+" id = "productName">
                                            <label class = "mdl-textfield__label" for = "productName">Product Name</label>

                                              <span class = "mdl-textfield__error">Alphabets Required!</span>
                                              
                                        </div>
                                    </div>            

                                    <div class="col-lg-6 p-t-20">
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                                            <input required="" name="Quantity" class = "mdl-textfield__input" type = "text" pattern = "-?[0-9]*(\.[0-9]+)?" id = "Quantity">
                                            <label class = "mdl-textfield__label" for = "Quantity">Quantity</label>

                                             <span class = "mdl-textfield__error">Number required!</span>
                                        </div>
                                    </div>

                                   


                                    <div class="col-lg-6 p-t-20">
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                                            <input required="" name="Price" class = "mdl-textfield__input" type = "text" pattern = "-?[0-9]*(\.[0-9]+)?" id = "Price">
                                            <label class = "mdl-textfield__label" for = "Price">Price</label>

                                             <span class = "mdl-textfield__error">Number required!</span>
                                        </div>
                                    </div>
                                    

                                    <div class="col-md-6 p-t-20">
                                         <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                                            <select name="category" id="category" required="" class="form-control">
                                                <option value="">Select Category</option>
                                                <?php $query=select("category");
                                                    while ($category=fetch($query)) {     
                                                ?>
                                                    <option value="<?= $category["id"]; ?>"><?php echo $category["category_name"]; ?></option>  
                                                <?php } ?>
                                            </select>
                                        </div>
                                        </div>



                                         <div class="col-md-6 p-t-20">
                                         <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                                           <select name="sub-category" id="sub-category" required="" class="form-control">
                                                <option value="">Select Sub Category</option>
                                                
                                            </select>   
                                        </div>
                                        </div>
                              <div class="col-lg-6 p-t-20">
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                                           
                                        <select name="gender" id="gender" required="" class="form-control">
                                                <option value="">Select Gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>  
                                             </select>
                                        </div>
                                    </div> 
                                    <div class="col-lg-6 p-t-20">
                                         <label class = "textfield__label" for = "text7">Size</label>
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">

                                    <input type="checkbox" class="check" name="" id="checkbox_product1" value="0">
                                    <label class = "textfield__label " for = "productName"> S</label> 

                                      <input type="checkbox" class="check" name="" id="checkbox_product2" value="0">
                                      <label class = "textfield__label" for = "productName"> m</label> 
                                       
                                        <input type="checkbox" class="check" name="" id="checkbox_product3" value="0">
                                        <label class = "textfield__label" for = "productName"> L</label> 
                                          
                                          <input type="checkbox" class="check" name="" id="checkbox_product4" value="0">
                                          <label class = "textfield__label" for = "productName">XL</label> 
                                            
                                    <input type="checkbox" class="check" name="" id="checkbox_product5" value="0">
                                  <label class = "textfield__label" for = "productName">XXL</label> 

                                         <input type="checkbox" class="check" name="" id="checkbox_product6" value="0">
                                  <label class = "textfield__label" for = "productName">XXXL</label>

                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-12">
                                        <div class = "mdl-textfield mdl-js-textfield txt-full-width">
                                            <textarea required="" name="overview" class = "mdl-textfield__input" rows =  "2"
                                            id = "overview" ></textarea>
                                            <label class = "mdl-textfield__label" for = "text7">Overview</label>
                                        </div>
                                    </div>
                                     <div class="col-lg-12 p-t-20">
                                        <p>Input Avalible Colors 
                                         
                                        </p>
                                        <select name="colors" id="colors" class="form-control js-example-tags"  multiple="multiple">
                                            <option selected="selected">White</option>
                                            <option selected="selected">Black</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class = "mdl-textfield mdl-js-textfield txt-full-width">
                                            <textarea required="" name="description" class = "mdl-textfield__input" rows =  "3"
                                            id = "description" ></textarea>
                                            <label class = "mdl-textfield__label" for = "text7">Description</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <input type="hidden" value="0" id="issubmited" name="">
                                        <input style="display: none;" type="submit" required="" id="main">
                                        <input type="hidden" name="token" id="token" value="<?php echo token(12); ?>">
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <div class="card-head">
                                <header>Product Information</header>
                                </div>
                                <label class="control-label col-md-3" style="margin-top: 50px">Upload Products Photos</label>
                                <div class="col-lg-12 p-t-20">
                                    <form action="product.php" class="dropzone" id="my-dropzone">
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
$("#getfetchcategory").change(function(event) {
        var sub_id=$(this).val();
        $.ajax({
            url: 'product.php',
            type: 'POST',
            dataType: 'html',
            data: {sub_id: sub_id},
        })
        .done(function(data) {
            $("#sub-category").html(data);
            $("#multi-sub-category").html('<option value="">Select Multi Sub Category</option>');
        });
 
});
/*Fetch Multi Sub Categories*/
$("#sub-category").change(function(event) {
        var multi_sub_id=$(this).val();
        $.ajax({
            url: 'product.php',
            type: 'POST',
            dataType: 'html',
            data: {multi_sub_id: multi_sub_id},
        })
        .done(function(data) {
            $("#multi-sub-category").html(data);
        });
 
});


     $(".js-example-tags").select2({
          tags: true,
          placeholder: "Enter Hexa Code",
          tokenSeparators: [',', ' ']
        });
$("#category").change(function(event) {
    var id=$(this).val();
    $.ajax({
        url: 'ajax/_sub-category.php',
        type: 'GET',
        dataType: 'html',
        data: {id: id},
    })
    .done(function(data) {
        $("#sub-category").html(data);
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
            var category = $("#category").val();
            var subcategory = $("#sub-category").val();
            var productName = $("#productName").val();
            var Quantity = $("#Quantity").val();
            var Price = $("#Price").val();
            var overview = $("#overview").val();
            var description = $("#description").val();
            var token = $("#token").val();
            var gender = $("#gender").val();
            var colors = $("#colors").val();
            //var checkbox_product1 = $("#checkbox_product1").val();
           // var gender2 = $("#gender2").val();
            var checkbox_product1 = $("#checkbox_product1").prop('checked');
            var checkbox_product2 = $("#checkbox_product2").prop('checked');
            var checkbox_product3 = $("#checkbox_product3").prop('checked');
            var checkbox_product4 = $("#checkbox_product4").prop('checked');
             var checkbox_product5 = $("#checkbox_product5").prop('checked');
              var checkbox_product6 = $("#checkbox_product6").prop('checked');
            
           
         

            formData.append('productName', productName);
            formData.append('subcategory', subcategory);
            formData.append('category', category);
            formData.append('Quantity', Quantity);
            formData.append('Price', Price);
            formData.append('overview', overview);
            formData.append('description', description);
            formData.append('token', token);
           formData.append('gender', gender);
           formData.append('colors', colors);
           formData.append('checkbox_product1', checkbox_product1);
           formData.append('checkbox_product2', checkbox_product2);
           formData.append('checkbox_product3', checkbox_product3);
           formData.append('checkbox_product4', checkbox_product4);
           formData.append('checkbox_product5', checkbox_product5);
          formData.append('checkbox_product6', checkbox_product6);
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
    
</body>
</html>