<?php require '../includes/functions.php';

if (isset($_POST["updateProduct"])) {
    $token=post("updateProduct");
    $queryGetProduct=select("products","token='$token'");
    if (howMany($queryGetProduct) > 0) {
        $getDetails=fetch($queryGetProduct);
        $parentToken=$getDetails["token"];
        $productColor=$getDetails["color"];
          
            $updateColorsInParentTable=update("products",["color" => $productColor ],"token='$parentToken'");
            if ($updateColorsInParentTable) {
                $updatedData=[
                    "color"             => $_POST["colorHex"],
                    "product_price"           => $_POST["product_price"],
                    "discount"   => $_POST["discount"],
                    "discounted_price"            => $_POST["total"],
                    "app_price"    => $_POST["app_price"],
                    "app_discount"            => $_POST["app_discount"],
                    "discounted_app_price"    => $_POST["app_total"],
                    "quantity"            => $_POST["quantity"]
                   
                ];
                
                $queryForProductUpdate=update("products",$updatedData,"token='$token'");

                if ($queryForProductUpdate) {
                    returnJson(1,"Product Updated Successfully!");   
                }
                else{
                    returnJson(0,"Something Went Wrong While Updating Product Detailsssssss!");
                }
            }
            else{
                returnJson(0,"Something Went Wrong While Updating Product Detailsaaaaaaa!");
            }
        }
    else{
        returnJson(0,"Invalid Product Token");
    }


}

/* For Removing Images*/

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
      
    }   

if (isset($_GET["token"])) {
    $token=$_GET["token"];
    /*Query For Product*/
    $queryGetProduct=select("products","token='$token'");
    if(howMany($queryGetProduct) > 0){
        /*fetch Product Details*/
        $getProduct=fetch($queryGetProduct);
        $parentProductToken=$getProduct["token"];
        /* fetch parent Product Details*/
         //$getParentProduct=select("productInfo","token='$parentProductToken'");
         //$parentProduct=fetch($getParentProduct);

    }
    else{
        move("index.php");
    }
}
else{
   move("index.php");
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
                                <div class="page-title">Edit Product : </div>
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
                                <div class="card-head">
                                <header>Product Details</header>
                            </div>
                            <form method="POST" id="product-info">
                                <div class="card-body row">

                                    <div class="col-lg-12">
                                        <input type="color" style="    height: 100px;
                                        width: 100%;" id="colorpicker" name="color" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="<?php echo $getProduct["color"];?>"/>
                                        <input type="text" class="form-control copycolor" style="height: 100px;font-size: 42px;cursor: pointer;display: none;" id="hexcolor" name="colorHex" value="<?php echo $getProduct["color"];?>" />
                                    </div>

                                    <div class="col-lg-6 p-t-20">
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                        <input name="quantity" value="<?= $getProduct["quantity"]; ?>" class = "mdl-textfield__input" type = "text" pattern = "-?[0-9]*(\.[0-9]+)?" id = "quantity" required="">
                        <label class = "mdl-textfield__label" for = "quantity">Quantity</label>
                        <span class = "mdl-textfield__error">Number required!</span>
                      </div>
                    </div>
                    
                    <div class="col-lg-6 p-t-20">
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                        <input name="product_price" value="<?= $getProduct["product_price"]; ?>" id="product_price" class = "mdl-textfield__input" type = "text" pattern = "-?[0-9]*(\.[0-9]+)?" required="">
                        <label class = "mdl-textfield__label" for = "Price">Base Price</label>
                        <span class = "mdl-textfield__error">Number required!</span>
                      </div>
                    </div>
                    
                    <div class="col-lg-6 p-t-20">
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                        <input name="discount" value="<?= $getProduct["discount"]; ?>" id="discount" class = "mdl-textfield__input" type = "text" pattern = "-?[0-9]*(\.[0-9]+)?">
                        <label class = "mdl-textfield__label" for = "discount" required="">Discount (In %)</label> 
                        <span class = "mdl-textfield__error">Number required!</span>
                      </div>
                    </div>
                    <div class="col-lg-4 p-t-20">
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                        <input name="total" value="<?= $getProduct["discounted_price"]; ?>" class = "mdl-textfield__input" type = "text" id = "total" required="">
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
                        <input name="app_price" value="<?= $getProduct["app_price"]; ?>" id="app_price" class = "mdl-textfield__input" type = "text" pattern = "-?[0-9]*(\.[0-9]+)?" required="">
                        <label class = "mdl-textfield__label" for = "Price">App Base Price</label>
                        <span class = "mdl-textfield__error">Number required!</span>
                      </div>
                    </div>
                    
                    <div class="col-lg-6 p-t-20">
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                        <input name="app_discount" value="<?= $getProduct["app_discount"]; ?>" id="app_discount" class = "mdl-textfield__input" type = "text" pattern = "-?[0-9]*(\.[0-9]+)?">
                        <label class = "mdl-textfield__label" for = "app_discount" required="">Discount (In %)</label>
                        <span class = "mdl-textfield__error">Number required!</span>
                      </div>
                    </div>
                    <div class="col-lg-4 p-t-20">
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                        <input name="app_total" value="<?= $getProduct["discounted_app_price"]; ?>" class = "mdl-textfield__input" type = "text" id = "app_total" required="">
                        <label class = "mdl-textfield__label" for = "total_price">Discounted Price</label>
                      </div>
                    </div>
                    <div class="col-lg-2 p-t-20">
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                        <button type="button" onclick="getPrice()">Get Discounted Price</button>
                        
                      </div>
                    </div>
                                 <div class="col-lg-12">
                                        <input type="submit" id="main" name="updateForm" class="btn btn-primary " value="UPDATE">
                                        <input type="hidden" id="updateProduct" value="<?= $token; ?>" name="updateProduct">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                        <div class="col-sm-12 ">
                            <div class="card-box">
                                <div class="card-head">
                                    <header>Images</header> <a href="update-product-image.php?token=<?= $token;?>">UPLOAD IMAGES?</a>
                                 </div>
                                <div class="card-body row">
                                    <?php 
                                        $queryImages=select("product_image","token='$parentProductToken'");       
                                        while ($images=fetch($queryImages)) {
                                    ?>
                                    <div class="col-lg-4 mt-2 img<?php echo $images["id"]; ?>">
                                        <img style="border-radius: 5px;" height="300" width="300" src="uploads/product-images/<?php echo $images["name"];?>">
                                        <center>
                                            <button onclick="removeImages('<?php echo $images["id"]; ?>')" class="btn btn-dark mt-2"><i class="fa fa-trash"></i></button>
                                            <button id="primary<?= $images["id"]; ?>" onclick="setPrimary('<?= $images["id"]; ?>','<?= $token; ?>')" title="Set as Primary Image" class="btn <?php echo ($images["primaryImage"]=='1') ? 'btn-primary' : 'btn-dark ' ;?> mt-2 set-primary"><i class="fa fa-star"></i></button>
                                        </center>
                                    </div>
                                    <?php } ?>
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
 


        $("#product-info").on('submit', function(event) {
            event.preventDefault();
            var updateForm=new FormData(this);
 
            $.ajax({
                url: 'edit-product-details.php',
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
            .fail(function() {
                console.log("error");
                swal("Oh Snap","Something Went Wrong Please Contact Your Devloper","error");
            })
            .always(function(data) {
                console.log(data);
            });
            
        });

        function removeImages(id) {
            $.ajax({
                url: 'edit-product-details.php',
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
                swal("Oh Snap","Something Went Wrong Please Contact Your Devloper","error");
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
                    url: 'edit-product-details.php',
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
                                    
        }        
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