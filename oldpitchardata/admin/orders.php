<?php 
require '../includes/functions.php';
use PHPMailer\PHPMailer\PHPMailer;
$orderId="";
if(isset($_POST['changeStatus'])){
$id=$_POST['chagneStatus'];
$orderId=$id;
$getQuery=mysqli_query($conn,"SELECT * FROM orders WHERE id='$id'");
$fetchQuery=mysqli_fetch_array($getQuery);
if ($fetchQuery["order_request"]=='0'){
$status='1';
}
if ($fetchQuery["order_request"]=='1'){
$status='0';
}
if ($fetchQuery["order_request"]=='2'){
$queryGetOrderUpdate=update("orders",["order_request" => "1"],"id='$orderId'");
if ($queryGetOrderUpdate) {

require_once "../PHPMailer/PHPMailer.php";
require_once "../PHPMailer/Exception.php";
require_once '../includes/orderConfirmationTemp.php';
$mailToUser =new PHPMailer();
$mailToUser->addAddress($fetchQuery['email']);
$mailToUser->setFrom(site_email,site_name);
$mailToUser->Subject = "New Order";
$mailToUser->isHTML(true);
$mailToUser->Body = $emailTempForUser;
$mailToUser->send();
$getVariant=select("order_items","order_id='".$fetchQuery['id']."'");
while ($fetchVariant=fetch($getVariant)) {
$queryGetVariantInfo=select("productInfo","id='".$fetchVariant["product_id"]."'");
$fetchVariantInfo=fetch($queryGetVariantInfo);
$getSize=strtolower($fetchVariant["size"]).'TotalQuantity';
$getTotalQuantity=$fetchVariantInfo[$getSize]-$fetchVariant["quantity"];
$up=update("productInfo",[$getSize => $getTotalQuantity],"id='".$fetchVariant["product_id"]."'");
if($getTotalQuantity <= 5)
{
$alert =new PHPMailer();
$alert->addAddress(admin_email);
$alert->setFrom(site_email,site_name);
$alert->Subject = "Order Alert";
$alert->isHTML(true);
$alert->Body = '
<h1 align="center">Alert!</h1>
<p>We Are Running Low On Quantity For this Product!</p>
<p>Remain Quantity : '.$getTotalQuantity.'</p>
<p>Link: <a href="'.site_url.'/product-cart.php?token='.base64_encode($fetchVariantInfo["token"]).'">View Product</a></p>
';
$alert->send();
}
if($up)
{
$status='1';
}
}
}
}

if($status==0){
$statusChange=mysqli_query($conn,"UPDATE orders SET order_request='1' WHERE id='$id'");
}else{
$statusChange=mysqli_query($conn,"UPDATE orders SET order_request='$status' WHERE id='$id'");
}
if ($statusChange){
exit(json_encode(["response"=>["code"=>"1","status"=>$status,"user"=>$fetchQuery['id']]]));
}
else{
exit(json_encode(["response"=>["code"=>"0","status"=>$status]]));
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
                                    <div class="page-title">Orders And Invoices</div>
                                </div>
                                <ol class="breadcrumb page-breadcrumb pull-right">
                                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Orders And Invoices</li>
                            </ol>
                        </div>
                    </div>
                    <!-- add content here -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-topline-red">
                                <div class="card-head">
                                <header>Orders</header>
                            </div>
                            <div class="card-body ">
                                <div class="table-scrollable">
                                    <table id="example1" class="display full-width">
                                        <thead>
                                            <tr>
                                                <th>Order #</th>
                                                <th>Name</th>
                                                <th>Payment Method</th>
                                                
                                                <th>On</th>
                                                <th>Amount</th>
                                                <th>Edit Order Status</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query=query("SELECT * FROM orders ORDER BY id DESC");
                                            while($data=fetch($query)){  ?>
                                            <tr>
                                                <td><?php
                                                    echo $data["id"];
                                                ?></td>
                                                <td><?php
                                                    $queryGetFullname=select("customers","id='".$data["uid"]."'");
                                                    $fetchFullname=fetch($queryGetFullname);
                                                    echo $fetchFullname["fullname"];
                                                ?></td>
                                                <td><?php echo $data['paymentmode'];?></td>
                                                
                                                <td><?php
                                                    $date=date_create($data["timestamp"]);
                                                echo date_format($date,"d-m-y")." At ".date_format($date,"h:m A");?></td>
                                                <td>&#8377; <?php echo round($data["totalprice"]);?></td>
                                                <?php $status=("SELECT * FROM order_status");
                                                
                                                $res = mysqli_query($conn,$status); ?>
                                                <td><select data-rowid="<?= $data["id"] ?>" class="statusdll" data-appid="ASM7605281" id="NewStatus" name="NewStatus"><option selected="selected" value="Select">Select</option>
                                                <?php
                                                while($w=mysqli_fetch_array($res)) {?>
                                                
                                                <option <?php echo ($w['status']==$data["orderstatus"]) ? 'selected=""' : ' ' ;?> value="<?php echo $w['status']; ?>"><?php echo $w['status']; ?></option>
                                                <?php  }
                                                ?>
                                            </select></td>
                                            <td class="myStatus<?= $data["id"]?>"><?php echo $data['orderstatus']; ?></td>
                                            <td>
                                                <a href="order-details.php?orderId=<?= $data["id"];?>" class="btn blue-bgcolor btn-outline btn-circle m-b-10">order Details</a>
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
    </div>
</div>
<?php include 'partials/_footer.php'; ?>
<!-- end footer -->
</div>
<?php include 'partials/_script.php'; ?>
<!-- data tables -->
<script type="text/javascript">
$(".status").click(function() {
var id=$(this).data("id");
// /alert(id);
$.ajax({
url: 'orders.php',
type: 'POST',
dataType: 'json',
data: {changeStatus: id},
})
.done(function(data) {
if(data.response.code=='1'){
if(data.response.status=='1'){
$("#status"+id).html('<i class="fa fa-refresh fa-spin"></i> Approving');
setTimeout(function(){
$("#status"+id).removeClass('label-danger');
$("#status"+id).removeClass('label-warning');
$("#status"+id).addClass('label-success');
$("#status"+id).html('Approved');
}, 500);
}
if(data.response.status=='0'){
$("#status"+id).html('<i class="fa fa-refresh fa-spin"></i> Redirecting');
var user=data.response.user;
setTimeout(function(){
window.location="view-email.php?action=compose&user="+user;
}, 500);
}
if(data.response.status=='2'){
$("#status"+id).html('<i class="fa fa-refresh fa-spin"></i> Approving');
setTimeout(function(){
$("#status"+id).removeClass('label-success');
$("#status"+id).removeClass('label-danger');
$("#status"+id).addClass('label-warning');
$("#status"+id).html('Pending');
}, 500);
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
$(document).ready(function()
{
$(".statusdll").change(function() {
var val=$(this).val();
var id=$(this).data("rowid");
$.ajax({
url: 'change_status.php',
type: 'POST',
data: {done: '1',value:val,id:id},
success: function(data) {
$(".myStatus"+id).html(val);
$(".mystime"+id).html(data);
},
error: function(data) {
//called when there is an error
}
})
});
});
</script>
</body>
</html>