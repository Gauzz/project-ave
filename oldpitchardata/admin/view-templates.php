<?php
require '../includes/functions.php';
if (isset($_POST["deleteTempl"])) {
$id=$_POST["deleteTempl"];
$querygetdelete=deleteRow("post_templates","id=$id");
if ($querygetdelete) {
exit(json_encode(array("response" => array("code" => "1" ,"msg" => "Template deleted Successfully"))));
}
else{
exit(json_encode(array("response" => array("code" => "0" ,"msg" => "Something Went Wrong! Please try Again Later"))));
}
}

secureAdmin();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'partials/_style.php'; ?>
        <!-- data tables -->
        <link href="assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
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
                                <div class="pull-left">
                                    <div class="page-title">All Curated Templates</div>
                                </div>
                                <ol class="breadcrumb page-breadcrumb pull-right">
                                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="#">Templates</a>&nbsp;<i class="fa fa-angle-right"></i>
                            </li>
                            <li class="active">All Templates</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-topline-aqua">
                            <div class="card-head">
                            <header>ALL TEMPLATES</header>
                        </div>
                        <div class="card-body ">
                            <div class="table-scrollable">
                                <table id="example1" class="display full-width">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Type</th>
                                            <th>Content</th>
                                            <th>Thumbnail</th>
                                            <th>Project Name</th>                                            
                                            <th>Created At</th>
                                            <th width="20%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i=1;
                                        $selectTemplate=query("SELECT * FROM post_templates ORDER BY id");
                                                while($fetchTempl=mysqli_fetch_array($selectTemplate)){
                                                $date=date_create($fetchTempl["created_date"]);
                                        ?>
                                        <tr class="row<?= $fetchTempl["id"];?>">
                                            <td class="user-circle-img">
                                                <?= $i;?>
                                            </td>
                                            <td><?php echo $fetchTempl["type"]; ?></td>
                                            <td><a href="<?php echo $fetchTempl["content"];?>" target="_blank">
                                            <?php echo $fetchTempl["content"]; ?></a></td>
                                            <td><a href="<?php echo $fetchTempl["thumbnail"];?>" target="_blank">
                                                <img src="<?php echo (!empty($fetchTempl["thumbnail"])) ? $fetchTempl["thumbnail"] : 'https://www.korsbakken.no/content/images/thumbs/default-image_450.png' ;?>" style="border-radius: 50%;width: 100px;height: 100px;"></a>
                                            <!--  ? 'uploads/CategoryImages/' --></td>
                                            <td><?php echo $fetchTempl["project_name"]; ?></td>
                                            <td><?php echo date_format($date,"d/m/Y");?></td>
                                            
                                            <td>
                                                <button onclick="editTempl('<?php echo $fetchTempl["id"]; ?>');" class="btn deepPink btn-outline btn-circle " aria-pressed="true">
                                                <i class="fa fa-pencil"></i>
                                                </button>
                                                <button class="btn dark btn-outline btn-circle delete-user" data-id="<?= $fetchTempl["id"] ?>" aria-pressed="true">
                                                <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <?php $i++; } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- user Modal -->
    <div id="userModel" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content"  style="background-color: transparent !important;box-shadow: none;">
                
                <div class="modal-body" style="background-color: transparent !important;">
                    <div class="col-md-12">
                        <div class="card" style="border: none;">
                            <div class="m-b-20">
                                <div class="doctor-profile">
                                    <div class="profile-header bg-b-purple">
                                        <div class="user-name">UserName</div>
                                        <div class="name-center Join-on">UserType</div>
                                    </div>
                                    <img height="112" width="112" src="assets/img/user/usrbig1.jpg" class="user-img user-img-modal"  alt="">
                                    
                                    <div>
                                        <p>
                                            <i class="fa  fa-envelope"></i > <a class="user-email-modal" href="mailto:(123)456-7890">
                                            (123sd)456-7890</a>
                                        </p>
                                        <p>
                                            <i class="fa fa-phone phone"></i > <a href="tel:(123)456-7890">
                                            </a>
                                        </p>
                                    </div>
                                    <div class="profile-userbuttons">
                                        <a href="javascript;" data-dismiss="modal" class="btn btn-circle deepPink-bgcolor btn-sm">close</a>
                                    </div>
                                    <div class="profile-userbuttons">
                                        <a href="#"  class="btn btn-circle deepPink- btn-sm Uid">Order History</a>
                                    </div>
                                </div>
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
<!-- data tables -->
<script type="text/javascript">
/*View User*/
$(".usermodel").click(function() {
var name=$(this).data("name");
var email=$(this).data("email");
var phone=$(this).data("phone");
var address=$(this).data("address");
var date=$(this).data("date");
var Uid=$(this).data("id");
$(".user-name").html(name);
$(".user-email-modal").html(email);
$(".phone").html(phone);
$(".user-email-modal").attr("href","mailto:"+email);
$(".user-address").html(address);
$(".user-img-modal").attr("src","../images/userDefault.png");
$(".Uid").attr("href","user-order-history.php?Uid="+Uid);
$(".Join-on").html("joined On "+date);

});
$(".delete-user").click(function() {
$(this).html("<i class='fa fa-ellipsis-h'></i>");
var id=$(this).data("id");
swal({
title: "Are you sure?",
text: "This will delete user Account From Database And You'll Not be Able to recover it",
icon: "warning",
buttons: true,
dangerMode: true,
})
.then((willDelete) => {
if (willDelete) {
$.ajax({
url: 'view-templates.php',
type: 'POST',
dataType:'json',
data: {deleteTempl: id},
})
.always(function(data) {
console.log(data.response.msg);
$(".row"+id).fadeOut('slow');
$(this).html("<i class='fa fa-trash' ></i>");
});
}
else {
swal("Your User is Safe!");
$(this).html("<i class='fa fa-trash'></i>");
}
});
});
function editTempl(token){
window.location="edit-templates.php?template="+token;
}

</script>
</body>
</html>