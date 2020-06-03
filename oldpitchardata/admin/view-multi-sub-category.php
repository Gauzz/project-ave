<?php
require '../includes/functions.php';
//   Deleting SUB-Category
if (isset($_POST["data"])) {
$token=$_POST["data"];
$query=deleteRow("multi_sub_category","token='$token'");
if ($query) {
exit(json_encode(array('response' => array("code" =>'1', "msg" => 'Category deleted Successfully!'))));
}
else{
exit(json_encode(array('response' => array("code" =>'0', "msg" => 'Something went wrong!'))));
}
}
/*Change Status*/
if(isset($_POST['changeStatus'])){
$id=$_POST['changeStatus'];
$getQuery=mysqli_query($conn,"SELECT * FROM multi_sub_category WHERE id='$id'");
$fetchQuery=mysqli_fetch_array($getQuery);
if ($fetchQuery["status"]=='0'){
$status='1';
}
if ($fetchQuery["status"]=='1'){
$status='0';
}
$statusChange=mysqli_query($conn,"UPDATE multi_sub_category SET status='$status' WHERE id='$id'");
if ($statusChange){
exit(json_encode(["response"=>["code"=>"1","status"=>$status]]));
}
else{
exit(json_encode(["response"=>["code"=>"0","status"=>$status]]));
}
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
                                    <div class="page-title">View Accessory Type</div>
                                </div>
                                <ol class="breadcrumb page-breadcrumb pull-right">
                                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">View Accessory Type</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="card  card-box">
                                <div class="card-head">
                                <header>View Accessory Type</header>
                            </div>
                            <div class="card-body ">
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table class="table display product-overview mb-30" id="support_table5">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Image</th>
                                                    <th>Brand Name</th>
                                                    <th>Device Type</th>
                                                    <th>Device</th>
                                                    <th>Accessory Name</th>
                                                    <th>Created On</th>
                                                    <th>Status</th>
                                                    <th>Action </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $query=select("multi_sub_category");
                                                $i=1;
                                                while($getCategory=fetch($query)){
                                                $date=date_create($getCategory["created_at"]);
                                                ?>
                                                <tr class="<?= 'cls'.$getCategory["id"]; ?>">
                                                    <td><?= $i++ ?></td>
                                                    <td>
                                                        <img src="<?php echo (!empty($getCategory["images"])) ? 'uploads/MultiSubCategoryImages/'.$getCategory["images"]: 'https://www.korsbakken.no/content/images/thumbs/default-image_450.png' ;?>" style="border-radius: 50%;width: 100px;height: 100px;">
                                                    </td>
                                                    <td><?php
                                                        $mainId=$getCategory['brand_id'];
                                                        $queryGetMainCategory=select("brand","id='$mainId'");
                                                        $fetchMainCategory=fetch($queryGetMainCategory);
                                                        echo $fetchMainCategory["category_name"];
                                                    ?></td>
                                                    <td>
                                                        <?php
                                                        $maincatId=$getCategory['category_id'];
                                                        $queryGetCategory=select("category","id='$maincatId'");
                                                        $fetchCategory=fetch($queryGetCategory);
                                                        echo $fetchCategory["name"];
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $subcatId=$getCategory['sub_cat_id'];
                                                        $queryGetsubCategory=select("subcategory","id='$subcatId'");
                                                        $fetchsubCategory=fetch($queryGetsubCategory);
                                                        echo $fetchsubCategory["name"];
                                                        ?>
                                                    </td>
                                                    <td id="token_<?= $getCategory["token"]; ?>"><?php echo $getCategory["name"];?></td>
                                                    <td><?php echo date_format($date,"d/m/Y");?></td>
                                                    <td>
                                                        <button id="status<?php echo $getCategory['id']; ?>" type="button" data-id="<?php echo $getCategory['id']; ?>" class="btn btn-circle <?php echo ($getCategory['status']=='1')? "btn-success":"btn-danger"; ?> status"><?php echo ($getCategory['status']=='1')? "Active":"Deactive"; ?></button>
                                                    </td>
                                                    <td>
                                                        <a href="edit-multi-sub-category.php?token=<?php echo $getCategory["token"];?>" class="btn btn-tbl-edit btn-xs editcategory">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                        <button data-id="<?= $getCategory["id"]; ?>" value="<?= $getCategory["token"]?>" class="btn btn-tbl-delete btn-xs deletethat">
                                                        <i class="fa fa-trash-o "></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end category Details -->
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
$(".deletethat").click(function() {
var token=$(this).val();
var id=$(this).data("id");
swal({
title: "Are you sure?",
text: "want to delete this Accessory Type!",
icon: "warning",
buttons: true,
dangerMode: true,
})
.then((willDelete) => {
if (willDelete) {
$.ajax({
url: 'view-multi-sub-category.php',
type: 'POST',
dataType: 'json',
data: {data:token},
})
.done(function(data) {
if (data.response.code=='1') {
swal(data.response.msg, {
icon: "success",
});
$(".cls"+id).hide('slow');
}
if (data.response.code=='0') {
swal(data.response.msg, {
icon: "error",
});
}
})
} else {
swal("Your imaginary file is safe!");
}
});
});
<?php if (isset($_SESSION["success"])): ?>
swal("Success","New Category Created!","success");
<?php endif;unset($_SESSION["success"]); ?>
$(".status").click(function() {
var id=$(this).data("id");
$.ajax({
url: 'view-multi-sub-category.php',
type: 'POST',
dataType: 'json',
data: {changeStatus: id},
})
.done(function(data) {
if(data.response.code=='1'){
if(data.response.status=='1'){
$("#status"+id).removeClass('btn-danger');
$("#status"+id).addClass('btn-success');
$("#status"+id).html('Active');
}
if(data.response.status=='0'){
$("#status"+id).removeClass('btn-success');
$("#status"+id).addClass('btn-danger');
$("#status"+id).html('Deactive');
}
}
if(data.response.code=='0'){
swal("oh snap","Something Went Wrong Please Contact Developers!","error");
}
})
.fail(function() {
swal("oh snap","Something Went Wrong Please Contact Developers!","error");
})
.always(function(data) {
console.log(data);
});
});
</script>
</body>
</html>