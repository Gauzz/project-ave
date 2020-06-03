<?php require '../includes/functions.php';
if (isset($_GET["token"]) AND isset($_GET["ids"])) {
$token=$_GET["token"];
$base64Ids=$_GET["ids"];
$ids=base64_decode($_GET["ids"]);
$queryGetProduct=select("products","token='$token'");
if (howMany($queryGetProduct) > 0) {
$product=fetch($queryGetProduct);
$IdArray=explode(',',$ids);
$currentPageId=$IdArray[0];
$queryGetProductInfo=select("productInfo","id='$currentPageId'");
$productInfo=fetch($queryGetProductInfo);
$allId='';
$queryGetNextPageDetails=mysqli_query($conn,"SELECT * FROM productInfo WHERE productToken='$token' AND created='0' AND id!='$currentPageId'");
while ($pageInfo=fetch($queryGetNextPageDetails)) {
$allId .=$pageInfo["id"].',';
}

}
else{
move("index.php");
}
}
else{
move("index.php");
}
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
if ($queryInsertImage) {
$updateProductInfo=update("productInfo",[
"xsPrice"     => $_POST["xsPrice"],
"xsQuantity"  => $_POST["xsquntity"],
"xsTotalQuantity"  => $_POST["xsquntity"],
"sPrice"      => $_POST["sPrice"] ,
"sQuantity"   => $_POST["squntity"],
"sTotalQuantity"   => $_POST["squntity"],
"mPrice"      => $_POST["mPrice"],
"mQuantity"   => $_POST["mquntity"],
"mTotalQuantity"   => $_POST["mquntity"],
"lPrice"      => $_POST["lPrice"],
"lQuantity"   => $_POST["lquntity"],
"lTotalQuantity"   => $_POST["lquntity"],
"xlPrice"     => $_POST["xlPrice"],
"xlQuantity"  => $_POST["xlquntity"],
"xlTotalQuantity"  => $_POST["xlquntity"],
"2xlPrice"    => $_POST["xl2Price"],
"2xlQuantity" => $_POST["xl2quntity"],
"2xlTotalQuantity" => $_POST["xl2quntity"],
"3xlPrice"    => $_POST["xl3Price"],
"3xlQuantity" => $_POST["xl3quntity"],
"3xlTotalQuantity" => $_POST["xl3quntity"],
"created"     => '1'
],"id='$currentPageId'");
if ($updateProductInfo) {
$remainIds=substr($allId,0,-1);
if (!empty($remainIds)) {
echo $remainIds;
}
else{
echo '00';
update("products",["completed" => '1'],"token='$token'");
}
exit();
}
}
}
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
                                    <div class="page-title"><?php echo  $product["name"]; ?></div>
                                </div>
                                <ol class="breadcrumb page-breadcrumb pull-right">
                                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Blank Page</li>
                            </ol>
                        </div>
                    </div>
                    <!-- add content here -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <div class="card-head" style="text-align: center;">
                                    <header><div style=" height: 25px;
                                        width: 25px;
                                        background-color:<?php echo $productInfo['color'];?>;
                                        border-radius: 10%;
                                        display: inline-block;
                                    border:1px solid #000;"></div></header>
                                </div>
                                <form method="POST" id="product-info">
                                    <div class="card-body row">
                                        <div class="col-lg-6 p-t-20">
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                                                <input class = "mdl-textfield__input" type = "text"
                                                pattern = "-?[0-9]*(\.[0-9]+)?" id = "xsPrice">
                                                <label class = "mdl-textfield__label" for = "xsPrice">
                                                Price For <b>XS</b></label>
                                                <span class = "mdl-textfield__error">Number required!</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 p-t-20">
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                                                <input class = "mdl-textfield__input" type = "text"
                                                pattern = "-?[0-9]*(\.[0-9]+)?" id = "xsquntity">
                                                <label class = "mdl-textfield__label" for = "xsquntity">
                                                Quntity For <b>XS</b></label>
                                                <span class = "mdl-textfield__error">Number required!</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 p-t-20">
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                                                <input class = "mdl-textfield__input" type = "text"
                                                pattern = "-?[0-9]*(\.[0-9]+)?" id = "sPrice">
                                                <label class = "mdl-textfield__label" for = "sPrice">
                                                Price For <b>S</b></label>
                                                <span class = "mdl-textfield__error">Number required!</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 p-t-20">
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                                                <input class = "mdl-textfield__input" type = "text"
                                                pattern = "-?[0-9]*(\.[0-9]+)?" id = "squntity">
                                                <label class = "mdl-textfield__label" for = "squntity">
                                                Quntity For <b>S</b></label>
                                                <span class = "mdl-textfield__error">Number required!</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 p-t-20">
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                                                <input class = "mdl-textfield__input" type = "text"
                                                pattern = "-?[0-9]*(\.[0-9]+)?" id = "mPrice">
                                                <label class = "mdl-textfield__label" for = "mPrice">
                                                Price For <b>M</b></label>
                                                <span class = "mdl-textfield__error">Number required!</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 p-t-20">
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                                                <input class = "mdl-textfield__input" type = "text"
                                                pattern = "-?[0-9]*(\.[0-9]+)?" id = "mquntity">
                                                <label class = "mdl-textfield__label" for = "mquntity">
                                                Quntity For <b>M</b></label>
                                                <span class = "mdl-textfield__error">Number required!</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 p-t-20">
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                                                <input class = "mdl-textfield__input" type = "text"
                                                pattern = "-?[0-9]*(\.[0-9]+)?" id = "lPrice">
                                                <label class = "mdl-textfield__label" for = "lPrice">
                                                Price For <b>L</b></label>
                                                <span class = "mdl-textfield__error">Number required!</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 p-t-20">
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                                                <input class = "mdl-textfield__input" type = "text"
                                                pattern = "-?[0-9]*(\.[0-9]+)?" id = "lquntity">
                                                <label class = "mdl-textfield__label" for = "lquntity">
                                                Quntity For <b>L</b></label>
                                                <span class = "mdl-textfield__error">Number required!</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 p-t-20">
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                                                <input class = "mdl-textfield__input" type = "text"
                                                pattern = "-?[0-9]*(\.[0-9]+)?" id = "xlPrice">
                                                <label class = "mdl-textfield__label" for = "xlPrice">
                                                Price For <b>XL</b></label>
                                                <span class = "mdl-textfield__error">Number required!</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 p-t-20">
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                                                <input class = "mdl-textfield__input" type = "text"
                                                pattern = "-?[0-9]*(\.[0-9]+)?" id = "xlquntity">
                                                <label class = "mdl-textfield__label" for = "xlquntity">
                                                Quntity For <b>XL</b></label>
                                                <span class = "mdl-textfield__error">Number required!</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 p-t-20">
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                                                <input class = "mdl-textfield__input" type = "text"
                                                pattern = "-?[0-9]*(\.[0-9]+)?" id = "xl2Price">
                                                <label class = "mdl-textfield__label" for = "xl2Price">
                                                Price For <b>2XL</b></label>
                                                <span class = "mdl-textfield__error">Number required!</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 p-t-20">
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                                                <input class = "mdl-textfield__input" type = "text"
                                                pattern = "-?[0-9]*(\.[0-9]+)?" id = "xl2quntity">
                                                <label class = "mdl-textfield__label" for = "xl2quntity">
                                                Quntity For <b>2XL</b></label>
                                                <span class = "mdl-textfield__error">Number required!</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 p-t-20">
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                                                <input class = "mdl-textfield__input" type = "text"
                                                pattern = "-?[0-9]*(\.[0-9]+)?" id = "xl3Price">
                                                <label class = "mdl-textfield__label" for = "xl3Price">
                                                Price For <b>3XL</b></label>
                                                <span class = "mdl-textfield__error">Number required!</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 p-t-20">
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                                                <input class = "mdl-textfield__input" type = "text"
                                                pattern = "-?[0-9]*(\.[0-9]+)?" id = "xl3quntity">
                                                <label class = "mdl-textfield__label" for = "xl3quntity">
                                                Quntity For <b>3XL</b></label>
                                                <span class = "mdl-textfield__error">Number required!</span>
                                                <input type="hidden" id="isSubmit" value="0" name="">
                                                <input type="hidden" id="pageId" value="<?php echo $currentPageId;?>" name="pageId">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
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
                                <div class="card-head" style="text-align: center;">
                                    <header><div style=" height: 25px;
                                        width: 25px;
                                        background-color:<?php echo $productInfo['color'];?>;
                                        border-radius: 10%;
                                        display: inline-block;
                                    border:1px solid #000;"></div></header>
                                </div>
                                <div class="card-body row">
                                    <div class="col-lg-12 p-t-20">
                                        <form action="product-info.php?token=<?= $token; ?>&ids=<?= $base64Ids;?>" class="dropzone" id="my-dropzone">
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
    var xsPrice=$("#xsPrice").val();
    var sPrice=$("#sPrice").val();
    var mPrice=$("#mPrice").val();
    var lPrice=$("#lPrice").val();
    var xlPrice=$("#xlPrice").val();
    var xl2Price=$("#xl2Price").val();
    var xl3Price=$("#xl3Price").val();
    var pageId=$("#pageId").val();
    if (xsPrice=="" && sPrice=="" && mPrice=="" && lPrice=="" && xlPrice=="" && xl2Price=="" && xl3Price=="") {
    swal("Oh Snap","Please fill at least one Price in Size to Create product!","info");
    }
    else{
    $("#isSubmit").val('1');
    }
    
    });
    });
    </script>
    <script type="text/javascript">
    Dropzone.options.myDropzone = {
    // Prevents Dropzone from uploading dropped files immediately
    autoProcessQueue: false,
    maxFiles:6,
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
    var xsPrice=$("#xsPrice").val();
    var xsquntity=$("#xsquntity").val();
    var sPrice=$("#sPrice").val();
    var squntity=$("#squntity").val();
    var mPrice=$("#mPrice").val();
    var mquntity=$("#mquntity").val();
    var lPrice=$("#lPrice").val();
    var lquntity=$("#lquntity").val();
    var xlPrice=$("#xlPrice").val();
    var xlquntity=$("#xlquntity").val();
    var xl2Price=$("#xl2Price").val();
    var xl2quntity=$("#xl2quntity").val();
    var xl3Price=$("#xl3Price").val();
    var xl3quntity=$("#xl3quntity").val();
    var pageId=$("#pageId").val();
    formData.append('xsPrice',xsPrice);
    formData.append('xsquntity',xsquntity);
    formData.append('sPrice',sPrice);
    formData.append('squntity',squntity);
    formData.append('mPrice',mPrice);
    formData.append('mquntity',mquntity);
    formData.append('lPrice',lPrice);
    formData.append('lquntity',lquntity);
    formData.append('xlPrice',xlPrice);
    formData.append('xlquntity',xlquntity);
    formData.append('xl2Price',xl2Price);
    formData.append('xl2quntity',xl2quntity);
    formData.append('xl3Price',xl3Price);
    formData.append('xl3quntity',xl3quntity);
    formData.append('pageId',pageId);
    });
    myDropzone.on('success', function( file, resp ){
    
    console.log(resp);
    var id=btoa(resp);
    if (resp=='00') {
    swal("Success","Product Added To Database Successfully!","success");
    setTimeout(function(){
    window.location='index.php';
    }, 3000);
    }
    else{
    window.location.href = 'product-info.php?token=<?= $token ?>&ids='+id;
    }
    
    
    });
    }
    };
    </script>
</body>
</html>