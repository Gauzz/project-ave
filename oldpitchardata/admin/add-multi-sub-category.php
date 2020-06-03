<?php
require '../includes/functions.php';
if (isset($_POST["AddmultiSubCategory"])) {

    $cname=$_POST['subcategoryName'];

    $cat_id=$_POST['getsubCategory'];
     $brand_id=$_POST['getCategoryId'];
     $multi_sub_id=$_POST['getmultisubCategory'];

   
   

 $valid_formatss = array("png","jpeg","jpg"); 
$logoimage = $_FILES['image']['name'];
$imageSize = $_FILES['image']['size'];
if(strlen($logoimage)) {
list($txt, $ext) = explode(".", $logoimage);
if(in_array($ext,$valid_formatss)) {
if($imageSize<(10240*10240)) {
$imageName = time().".".$ext;
$tmps = $_FILES['image']['tmp_name'];
move_uploaded_file($tmps,"uploads/MultiSubCategoryImages/".$imageName);
}
}
}else{
    $imageName='no-thumbnail.png';
}
$query = mysqli_query($conn,"SELECT * FROM multi_sub_category WHERE name='$cname' AND sub_cat_id='$multi_sub_id'");
  

    if (howMany($query)=='1') {

        exit(json_encode(array('response' =>array("code" =>'2', "msg" => 'This Multi Sub Category Already Exists'))));
    }

    else{

        $send=saveData("multi_sub_category",["category_id" => $cat_id,"brand_id" => $brand_id,"sub_cat_id" => $multi_sub_id,"name" => $_POST["subcategoryName"],"description" => $_POST["categoryDescrip"],"images" => $imageName,"token" => token(12)]);

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
                                    <div class="page-title">Add Accessory Type</div>
                                </div>
                                <ol class="breadcrumb page-breadcrumb pull-right">
                                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Add Accessory Type</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <div class="card-head">
                                <header>Add Accessory Type</header>
                            </div>
                            <form id="formSubCategoryAdd">
                                <div class="card-body row">
                                     <div class="col-md-6">
                                         <select name="getCategoryId" id="getfetchcategory" required="" class="form-control">
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
                                       <select name="getsubCategory" id="sub-category" required="" class="form-control">
                                                    
                                     <option value="">Select Device Type</option>
                                                
                                            </select>
                                    </div>

                                     <div class="col-md-6" style="padding-top:4%;">
                                       <select name="getmultisubCategory" id="multi-sub-category" required="" class="form-control">
                                                    
                                     <option value="" readonly="" >Select Device</option>
                                                
                                        </select>
                                    </div>
                                    <div class="col-lg-6" style="padding-top:3%;">
                                        <div class = "mdl-textfield mdl-js-textfield" style="width: 100% !important;">
                                            <input autocomplete="off" required="" class = "mdl-textfield__input cname" type = "text" id = "text1" name="subcategoryName">
                                            <label class = "mdl-textfield__label lblname" for = "text1">Accessory Type Name</label>
                                           <!--  <span class = "mdl-textfield__error">Alphabets Required!</span> -->
                                        </div>
                                    </div>
                                   


                                    <div class="col-lg-12 p-t-20">
                                        <div class = "mdl-textfield mdl-js-textfield txt-width" style="max-width: 100% !important;">
                                            <textarea  class = "mdl-textfield__input cdesc" rows =  "3"
                                            id = "text7" name="categoryDescrip" ></textarea>
                                            <label class = "mdl-textfield__label lbldesc" for = "text7">Description <small>(optional)</small></label>
                                        </div>
                                    </div>
                                     
                                         <div class="col-lg-12 p-t-20">
                                        <div class="row">
                                            <div class="col-lg-6 p-t-20">
                                                <h4>Accessory Type Image</h4>


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
                                        <input type="hidden" name="AddmultiSubCategory" value="true">
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
$("#getCategoryId").val(id)
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
url: 'add-multi-sub-category.php',
data:formData,
cache:false,
dataType:'json',
contentType: false,
processData: false,
success:function(data){
if (data.response.code=='1') {
   
window.location.href='view-multi-sub-category.php';
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
</script>

</body>
</html>