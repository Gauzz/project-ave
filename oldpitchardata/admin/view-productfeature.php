<?php
require '../includes/functions.php';
//   Deleting Category
if (isset($_POST["data"])) {
$token=$_POST["data"];
$query=deleteRow("product_feature","token='$token'");
if ($query) {
exit(json_encode(array('response' => array("code" =>'1', "msg" => 'Product Feature deleted Successfully!'))));
}
else{
exit(json_encode(array('response' => array("code" =>'0', "msg" => 'Something went wrong!'))));
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
    <body class="text-capitalize page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
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
                                    <div class="page-title">View Product Features</div>
                                </div>
                                <ol class="breadcrumb page-breadcrumb pull-right">
                                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">View Product Feature</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="card  card-box">
                                <div class="card-head">
                                <header>All Product Feature</header>
                            </div>
                            <div class="card-body ">
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table class="table display product-overview mb-30" id="support_table5">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Product Feature Name</th>
                                                    <th>Description</th>
                                                    <th>Created On</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $query=select("product_feature");
                                                $i=1;
                                                while($getCategory=fetch($query)){
                                                $date=date_create($getCategory["created_at"]);
                                                ?>
                                                <tr class="<?= 'cls'.$getCategory["id"]; ?>">
                                                    <td><?= $i++ ?></td>
                                                    <td id="token_<?= $getCategory["token"]; ?>"><?php echo $getCategory["name"];?></td>
                                                    <td>
                                                        <?php echo $getCategory["description"];?>
                                                    </td>
                                                    <td><?php echo date_format($date,"d/m/Y");?></td>
                                                    <td>
                                                        <a href="edit-productfeature.php?token=<?php echo $getCategory["token"];?>" class="btn btn-tbl-edit btn-xs editcategory">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                        
                                                    </td>
                                                    <td>
                                                        <button data-id="<?= $getCategory["id"]; ?>" value="<?= $getCategory["token"];?>" class="btn btn-tbl-delete btn-xs deletethat">
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
            <!-- Modal -->
            <!--   <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form method="POST" class="updateform">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Category</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                
                                <div class="form-group col-md-6">
                                    <label for="text1">Category Name</label>
                                    <input id="text1" placeholder="Category Name" type="text" class="form-control" name="categoryName" required="">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="text2">Category Description (Optional)</label>
                                    <textarea placeholder="Category Description" id="text2" class="form-control" name="categoryDesc"></textarea>
                                    <input type="hidden" value="" id="hiddenToken" name="tokenForUpdate">
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success float-left" >Save</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> -->
        </div>
        <!-- end page content -->
    </div>
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
text: "want to delete this Brand!",
icon: "warning",
buttons: true,
dangerMode: true,
})
.then((willDelete) => {
if (willDelete) {
$.ajax({
url: 'view-productfeature.php',
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
</script>
</body>
</html>
</html>