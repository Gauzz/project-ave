<?php
require '../includes/functions.php';

if (isset($_POST["AddSubCategory"])) {

    $cname=$_POST['categoryName'];
    $id=$_POST['multi_sub_sub_cat_id'];

$valid_formatss = array("png","jpeg","jpg"); 
$logoimage = $_FILES['image']['name'];
$imageSize = $_FILES['image']['size'];
if(strlen($logoimage)) {
list($txt, $ext) = explode(".", $logoimage);
if(in_array($ext,$valid_formatss)) {
if($imageSize<(10240*10240)) {
$imageName = time().".".$ext;
$tmps = $_FILES['image']['tmp_name'];
move_uploaded_file($tmps,"uploads/productTypeImages/".$imageName);
}
}
}else{
    $imageName='no-thumbnail.png';
}

    $query=select("product_type","multi_sub_sub_cat_id='$id' AND product_type='$cname'");

    if (howMany($query)=='1') {

        exit(json_encode(array('response' =>array("code" =>'2', "msg" => 'This Category Already Exists'))));
    }

    else{

        $send=saveData("product_type",["multi_sub_sub_cat_id" => $id,"product_type" => $_POST["categoryName"],"description" => $_POST["categoryDescrip"],"images" => $imageName,"token" => token(12)]);

        if ($send) {

            $_SESSION["success"]="true";

            exit(json_encode(array('response' => array("code" =>'1', "msg" => 'New Category Created Successfully!'))));
        }
        else{
            exit(json_encode(array('response' =>array("code" =>'0', "msg" => 'Opps There is An Error In Adding Category!'))));

        }
    }
}
secureAdmin();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'partials/_style.php'; ?>
        <style type="text/css">
        
        .mdl-menu__item:hover
        {
        width: 100% !important;
        }
        .mdl-menu__item
        {
        width: 100% !important;
        }
        .mdl-menu__container{
        width: 100% !important;
        }
        .mdl-menu__outline{
        width: 100% !important;
        }
        </style>
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
                    <div class="page-content" style="min-height: 800px !important;">
                        <div class="page-bar">
                            <div class="page-title-breadcrumb">
                                <div class=" pull-left">
                                    <div class="page-title">Add Product Type</div>
                                </div>
                                <ol class="breadcrumb page-breadcrumb pull-right">
                                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Add Product Type</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <div class="card-head">
                                <header>Add Product Type</header>
                            </div>
                            <form id="formSubCategoryAdd">
                                <div class="card-body row">
                                    <div class="col-lg-4 p-t-20">
                                        <div class = "mdl-textfield mdl-js-textfield">
                                            <input autocomplete="off" required="" class = "mdl-textfield__input cname" type = "text" id = "text1" name="categoryName">
                                            <label class = "mdl-textfield__label lblname" for = "text1">Product Type</label>
                                           <!--  <span class = "mdl-textfield__error">Alphabets Required!</span> -->
                                        </div>
                                    </div>
                                    <div class="col-lg-6 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height txt-full-width">
                                            <input class="mdl-textfield__input" type="text" id="sample2" value="" readonly tabIndex="-1" required="">
                                            <input type="hidden" name="getCategory" id="getCategory" value="">
                                            <input type="hidden" name="multi_sub_sub_cat_id" id="multi_sub_sub_cat_id" value="">
                                            <label for="sample2" class="pull-right margin-0">
                                                <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                                            </label>
                                            <label for="sample2" class="mdl-textfield__label">Select Product Category</label>
                                            <ul data-mdl-for="sample2" class="mdl-menu mdl-menu--bottom-left mdl-js-menu" style="clip: rect(0px, 500px, 111.953px, 0px);width: 100% !important;">
                                                <?php
                                                $getMainCategory = mysqli_query($conn,"SELECT DISTINCT name FROM multi_sub_sub_category");
                                                //$getMainCategory=select("multi_sub_sub_category");
                                                while ($fetchcategory=fetch($getMainCategory))
                                                 {
                                                    $name = $fetchcategory["name"];
                                                    $selectName = select("multi_sub_sub_category","name='$name'");
                                                    $getName = fetch($selectName);
                                                ?>
                                                <li class="mdl-menu__item getCatgory" data-val="<?php echo $fetchcategory["name"]; ?>" data-id="<?php echo $getName["token"]; ?>"><?php echo $fetchcategory["name"]; ?></li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>


                                    <div class="col-lg-12 p-t-20">
                                        <div class = "mdl-textfield mdl-js-textfield txt-width" style="max-width: 100% !important;">
                                            <textarea  class = "mdl-textfield__input cdesc" rows =  "3"
                                            id = "text7" name="categoryDescrip" ></textarea>
                                            <label class = "mdl-textfield__label lbldesc" for = "text7">Product Description <small>(optional)</small></label>
                                        </div>
                                    </div>
                                     
                                         <div class="col-lg-12 p-t-20">
                                        <div class="row">
                                            <div class="col-lg-6 p-t-20">
                                                <h4>Product Image</h4>


                                               <img src="https://images.disitu.com/MICROSITE/nothumbnail.png" id="category_image" height="250px" width="250px">

                                                <br><br>


                                                <input type="file" name="image" id="inputImage" onchange="document.getElementById('category_image').src = window.URL.createObjectURL(this.files[0])" style="display: none;">

                                                 <button type="button" id="cateImage" class="btn btn-info">Upload Image</button>
                                            </div>


                                          
                                        </div>
                                    </div>
                                    <div class="col-lg-12 p-t-20">
                                        <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"
                                        name="send">
                                        Create
                                        </button>
                                        <input type="hidden" name="AddSubCategory" value="true">
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




$(".getCatgory").click(function(event) {
var id= $(this).data("id");
$("#multi_sub_sub_cat_id").val(id)
var val= $(this).data("val");
$("#getCategory").val(val)
});
$("#cateImage").click(function(event) {
$("#inputImage").click();
});
$(document).ready(function (e) {
$('#formSubCategoryAdd').on('submit',(function(e) {
e.preventDefault();
var formData = new FormData(this);
$.ajax({
type:'POST',
url: 'add-product-type.php',
data:formData,
cache:false,
dataType:'json',
contentType: false,
processData: false,
success:function(data){
if (data.response.code=='1') {
window.location.href='view-product-type.php';
}
if (data.response.code=='0') {
swal("Oh Snap",data.response.msg,"error");
}
if (data.response.code=='2') {
swal("Oh Snap",data.response.msg,"warning");
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