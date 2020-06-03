<?php
require '../includes/functions.php';
if (isset($_POST["AddSubCategory"])) {

    $cname=$_POST['subcategoryName'];

    $id=$_POST['getsubCategory'];
     $cat_id=$_POST['getCategoryId'];

   
   

 $valid_formatss = array("png","jpeg","jpg"); 
$logoimage = $_FILES['image']['name'];
$imageSize = $_FILES['image']['size'];
if(strlen($logoimage)) {
list($txt, $ext) = explode(".", $logoimage);
if(in_array($ext,$valid_formatss)) {
if($imageSize<(10240*10240)) {
$imageName = time().".".$ext;
$tmps = $_FILES['image']['tmp_name'];
move_uploaded_file($tmps,"uploads/SubCategoryImages/".$imageName);
}
}
}else{
    $imageName='no-thumbnail.png';
}

    $query=select("subcategory","name='$cname'");

    if (howMany($query)=='1') {

        exit(json_encode(array('response' =>array("code" =>'2', "msg" => 'This Category Already Exists'))));
    }

    else{

        $send=saveData("subcategory",["category_id" => $id,"brand_id" => $cat_id,"name" => $_POST["subcategoryName"],"modal_name_one" => $_POST["ModalName1"],"modal_name_tow" => $_POST["ModalName2"],"modal_name_tree" => $_POST["ModalName3"],"modal_name_four" => $_POST["ModalName4"],"description" => $_POST["categoryDescrip"],"images" => $imageName,"token" => token(12)]);

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
                                    <div class="page-title">Add Device</div>
                                </div>
                                <ol class="breadcrumb page-breadcrumb pull-right">
                                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Add Device</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <div class="card-head">
                                <header>Add Device</header>
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
                                                    
                                     <option value="" readonly="" >Select Device Type</option>
                                                
                                            </select>
                                    </div>


                                    <div class="col-lg-4 p-t-20">
                                        <div class = "mdl-textfield mdl-js-textfield">
                                            <input autocomplete="off" class = "mdl-textfield__input cname" type = "text" id = "text1" name="ModalName1">
                                            <label class = "mdl-textfield__label lblname" for = "text1">Modal Name 1 (optional)</label>
                                        </div>
                                    </div>

                                     <div class="col-lg-4 p-t-20">
                                        <div class = "mdl-textfield mdl-js-textfield">
                                            <input autocomplete="off" class = "mdl-textfield__input cname" type = "text" id = "text1" name="ModalName2">
                                            <label class = "mdl-textfield__label lblname" for = "text1">Modal Name 2 (optional)</label>
                                         </div>
                                    </div>

                                     <div class="col-lg-4 p-t-20">
                                        <div class = "mdl-textfield mdl-js-textfield">
                                            <input autocomplete="off" class = "mdl-textfield__input cname" type = "text" id = "text1" name="ModalName3">
                                            <label class = "mdl-textfield__label lblname" for = "text1">Modal Name 3 (optional)</label>
                                        </div>
                                    </div>


                                     <div class="col-lg-4 p-t-20">
                                        <div class = "mdl-textfield mdl-js-textfield">
                                            <input autocomplete="off" class = "mdl-textfield__input cname" type = "text" id = "text1" name="ModalName4">
                                            <label class = "mdl-textfield__label lblname" for = "text1">Modal Name 4 (optional)</label>
                                        </div>
                                    </div>



                                    <div class="col-lg-6 p-t-20">
                                        <div class = "mdl-textfield mdl-js-textfield">
                                            <input autocomplete="off" required="" class = "mdl-textfield__input cname" type = "text" id = "text1" name="subcategoryName">
                                            <label class = "mdl-textfield__label lblname" for = "text1">Add Device</label>
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
                                                <h4>Brand Category Image</h4>


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
url: 'add-sub-category.php',
data:formData,
cache:false,
dataType:'json',
contentType: false,
processData: false,
success:function(data){
if (data.response.code=='1') {
   
window.location.href='view-sub-category.php';
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
</script>

</body>
</html>