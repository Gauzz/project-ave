<?php
require '../includes/functions.php';
if (isset($_POST["deleteUser"])) {
$id=$_POST["deleteUser"];
$querygetdelete=deleteRow("contact","id=$id");
if ($querygetdelete) {
exit(json_encode(array("response" => array("code" => "1" ,"msg" => "View Enquiry deleted Successfully"))));
}
else{
exit(json_encode(array("response" => array("code" => "0" ,"msg" => "Something Went Wrong! Please try Again Later"))));
}
}
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
                                    <div class="page-title">View Enquiry</div>
                                </div>
                                <ol class="breadcrumb page-breadcrumb pull-right">
                                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">View Enquiry</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="card  card-box">
                                <div class="card-head">
                                <header>All Enquiry</header>
                            </div>
                            <div class="card-body ">
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table class="table display product-overview mb-30" id="support_table5">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Subject</th>
                                                    <th>Message</th>
                                                    <th>Created On</th>
                                                    <th>Delete</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $query=select("contact");
                                                $i=1;
                                                while($getEnquiry=fetch($query)){
                                                $date=date_create($getEnquiry["created_at"]);
                                                ?>
                                                <tr class="row<?= $getEnquiry["id"]; ?>">
                                                    <td><?= $i++ ?></td>
                                                    <td><?php echo $getEnquiry['fname'].$getEnquiry['lname'];?></td>
                                                    <td><?php echo $getEnquiry['email'];  ?></td>
                                                     <td><?php echo $getEnquiry['subject'];  ?></td>
                                                    <td><?php echo $getEnquiry['msg'];  ?></td>
                                                    <td><?php echo date_format($date,"d/m/Y");?></td>
                                                    <td>
                                                        <input type="button" name="view" value="view" id="<?php echo $getEnquiry["id"]; ?>" class="btn blue-bgcolor btn-outline btn-circle usermodel view_data"/>
                                                        <button class="btn dark btn-outline btn-circle delete-user" data-id="<?= $getEnquiry["id"] ?>" aria-pressed="true">
                                                        <i class="fa fa-trash"></i>
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
                <!-- end Enquiry Details -->
            </div>
            <!-- Modal -->
            <div id="dataModal" class="modal fade">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">View Enquiry</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            
                        </div>
                        <div class="modal-body" id="enquiry_detail">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page content -->
    </div>
    <?php include 'partials/_footer.php'; ?>
    <!-- end footer -->
</div>
<?php include 'partials/_script.php'; ?>
<script type="text/javascript">
$(".delete-user").click(function() {
$(this).html("<i class='fa fa-ellipsis-h'></i>");
var id=$(this).data("id");
swal({
title: "Are you sure?",
text: "This will delete Enquiry Account From Database And You'll Not be Able to recover it",
icon: "warning",
buttons: true,
dangerMode: true,
})
.then((willDelete) => {
if (willDelete) {
$.ajax({
url: 'view_enquiry.php',
type: 'POST',
dataType:'json',
data: {deleteUser: id},
})
.always(function(data) {
console.log(data.response.code=='1');
$(".row"+id).fadeOut('slow');
$(this).html("<i class='fa fa-trash' ></i>");
swal("Enquiry Delete!",data.response.msg,"success");
});
}
else {
swal("Your User is Safe!");
$(this).html("<i class='fa fa-trash'></i>");
}
});
});
</script>
<script>
$(document).ready(function(){
$('.view_data').click(function(){
var enquiry_id = $(this).attr("id");
$.ajax({
url:"modal_customised.php",
method:"post",
data:{enquiry_id:enquiry_id},
success:function(data){
$('#enquiry_detail').html(data);
$('#dataModal').modal("show");
}
});
});
});
</script>
</body>
</html>