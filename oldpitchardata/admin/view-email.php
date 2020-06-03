<?php
require '../includes/functions.php';
require_once ('../email-API/vendor/autoload.php');
if (isset($_POST['myHidden']))
{
$orderID=$_POST['myHidden'];

$updateOrder=query("UPDATE orders SET order_request='0' WHERE id='$orderID'");
}

if (isset($_POST["trash"])) {
$msgId=$_POST["id"];
$moveToTrash=update("contact",["trash" => '1'],"id='$msgId'");
if ($moveToTrash) {
exit(json_encode(array('response' => array('code' => '1','msg' => 'Email Move To Trash Successfully'))));
}
else{
exit(json_encode(array('response' => array('code' => '0','msg' => 'Something Went Wrong please Try Again'))));
}
}
if (isset($_POST["Undotrash"])) {
$msgId=$_POST["id"];
$moveToTrash=update("contact",["trash" => '0'],"id='$msgId'");
if ($moveToTrash) {
exit(json_encode(array('response' => array('code' => '1','msg' => 'Email Move To Inbox Successfully'))));
}
else{
exit(json_encode(array('response' => array('code' => '0','msg' => 'Something Went Wrong please Try Again'))));
}
}
if (isset($_POST["seen"])) {
$msgid=$_POST["id"];
$getseen=update("contact",["read_status" => '1'],"id='$msgid'");
if ($getseen) {
exit(json_encode(array('response' => array('code' => '1'))));
}
}
if (isset($_POST["emailsent"])) {
/*Content*/
$from = new SendGrid\Email(site_name,site_email);
$subject = mysqli_real_escape_string($conn,$_POST["subject"]);
$to = new SendGrid\Email('Costomer',mysqli_real_escape_string($conn,$_POST["toEmail"]));
$content = new SendGrid\Content("text/html",mysqli_real_escape_string($conn,$_POST["summernote"]));
/*Send the mail*/
$mail = new SendGrid\Mail($from, $subject, $to, $content);
$apiKey = ('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');
$sg = new \SendGrid($apiKey);
/*Response*/
$response = $sg->client->mail()->send()->post($mail);
if ($response) {
$emailSent=saveData("contact",["name" => $fullname,"email" => $email,"emailTo" => $_POST["toEmail"],"msg" => $_POST["summernote"],"subject" => $_POST["subject"],"ip" => getUserIP(),"isAdmin" => '1'],"created_at");
if ($emailSent) {
exit(json_encode(array('response' => array('code' => '1','msg' => "Email Sent Successfully"))));
}
else{
exit(json_encode(array('response' => array('code' => '0','msg' => "Something Went wrong Email Not Sent"))));
}
}
}
if (isset($_POST["delete"])) {
$id=$_POST["id"];
$queryGetDelete=deleteRow("contact","id='$id'");
if ($queryGetDelete) {
exit(json_encode(array('response' => array('code' => '1','msg' => "Email Deleted Successfully!"))));
}
else{
exit(json_encode(array('response' => array('code' => '0','msg' => "Something Went Wrong Email Not Deleted!" ))));
}
}
if (isset($_POST["deleteSendEmail"])) {
foreach ($_POST["deleteThat"] as $key) {
$querygetdelete=deleteRow("contact","id='$key'");
}
if ($querygetdelete) {
exit(json_encode(array("response" => array('code' => '1' ,"msg" => 'Selected Message Deleted Successfully!'))));
}
else{
exit(json_encode(array('response' => array('code' => '0',"msg" => "ERROR: Something Went Wrong!" ))));
}
}
if (isset($_GET["action"]) OR empty($_GET["action"])) {
$action=$_GET["action"];
if ($action!='view-inbox' AND $action!='compose' AND $action!='view-trash' AND $action!='my-emails') {
move("index.php");
}
}
else{
move("index.php");
}
secureAdmin();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'partials/_style.php'; ?>
        <link href="assets/css/pages/inbox.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/summernote/summernote.css" rel="stylesheet">
        <style type="text/css">
        #example4_wrapper{
        margin-top: 15px;
        }
        .dataTables_scrollBody{
        min-height: 300px;
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
                    <div class="page-content">
                        <div class="page-bar">
                            <div class="page-title-breadcrumb">
                                <div class=" pull-left">
                                    <div class="page-title">Inbox</div>
                                </div>
                                <ol class="breadcrumb page-breadcrumb pull-right">
                                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="view-email.php?action=view-inbox">Email</a>&nbsp;<i class="fa fa-angle-right"></i>
                            </li>
                            <li class="active">Inbox</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-topline-gray">
                            <div class="card-body no-padding height-9">
                                <div class="inbox">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="inbox-sidebar">
                                                <a href="view-email.php?action=compose" data-title="Compose" class="btn red compose-btn btn-block">
                                                <i class="fa fa-edit"></i> Compose </a>
                                                <ul class="inbox-nav inbox-divider">
                                                    <?php
                                                    $querygetNoOfEmails=select("contact","trash='0' AND NOT isAdmin='1' ORDER BY created_at DESC");
                                                    ?>
                                                    <li class="<?php echo ($action=='view-inbox') ? 'active' : ' ' ; ?>"><a href="view-email.php?action=view-inbox"><i
                                                        class="fa fa-inbox"></i> Inbox <span
                                                        class="label mail-counter-style label-danger pull-right"><?php echo howMany($querygetNoOfEmails); ?></span></a>
                                                    </li>
                                                    <li class="<?php echo ($action=='my-emails') ? 'active' : ' ' ; ?>">
                                                        <a href="view-email.php?action=my-emails"><i
                                                        class="fa fa-envelope"></i> Sent Mail</a>
                                                    </li>
                                                    
                                                    
                                                    <li class="<?php echo ($action=='view-trash') ? 'active' : ' ' ; ?>"><a href="view-email.php?action=view-trash"><i
                                                    class=" fa fa-trash-o"></i> Trash</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php if ($action=='view-inbox'): ?>
                                    <div class="col-md-9">
                                        <div class="inbox-body " style="overflow-y: scroll;min-height: 500px;">
                                            <div class="card-head">
                                            <header class="w-100">EMAILS AND MESSAGES INBOX <button class="btn btn-danger btn-sm  m-b-10 float-right delete-sendemail" disabled="">Delete</button></header>
                                        </div>
                                        <table class="mt-5 table table-striped table-bordered table-hover table-checkable order-column full-width" id="example4">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        #
                                                    </th>
                                                    <th width="20%"> Name </th>
                                                    <th> Email </th>
                                                    
                                                    <th> Time </th>
                                                    <th> Actions </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $queryGetEmail=select("contact","trash='0' AND NOT isAdmin='1' ORDER BY created_at DESC");
                                                while ($emailData=fetch($queryGetEmail)) {
                                                ?>
                                                <tr class="odd gradeX row<?= $emailData["id"]; ?>">
                                                    <td>
                                                        <label class="rt-chkbox rt-chkbox-single rt-chkbox-outline">
                                                            <input type="checkbox" name="check-sendemail[]" class="checkboxes check-sendemail" value="<?= $emailData["id"]; ?>" />
                                                            <span></span>
                                                        </label>
                                                    </td>
                                                    <td> <?= $emailData["name"];?> </td>
                                                    <td>
                                                        <a href="mailto:<?= $emailData["email"] ?>"> <?= $emailData["email"] ?> </a>
                                                        <span class="label label-sm <?php echo ($emailData["read_status"]=='1') ? 'label-success' : 'label-info'; ?> label<?= $emailData["id"]?>"> <?php echo ($emailData["read_status"]=='1') ? 'Read' : 'Unread'; ?> </span>
                                                    </td>
                                                    <td> <?php echo timeAgo($emailData["created_at"]);?> </td>
                                                    <td class="valigntop">
                                                        <div class="btn-group">
                                                            <button class="btn btn-xs deepPink-bgcolor dropdown-toggle no-margin" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                            <i class="fa fa-angle-down"></i>
                                                            </button>
                                                            <ul class="dropdown-menu pull-left" role="menu">
                                                                <li class="openviewmodel" data-msg="<?= $emailData["msg"]; ?>" data-id="<?= $emailData["id"] ?>" data-toggle="modal" data-target="#myModal">
                                                                    <a href="javascript:;">
                                                                    <i class="fa fa-eye"></i> View Message </a>
                                                                </li>
                                                                <li>
                                                                    <a href="view-email.php?action=compose&emailTo=<?= $emailData["email"]; ?>">
                                                                    <i class="fa fa-reply"></i> Reply</a>
                                                                </li>
                                                                <li class="movetotrash" data-id="<?= $emailData["id"] ?>">
                                                                    <a href="javascript:;">
                                                                    <i class="fa fa-trash"></i> Move to Trash </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if ($action=='view-trash'): ?>
                                <div class="col-md-9">
                                    <div class="inbox-body " style="overflow-y: scroll;min-height: 500px;">
                                        <div class="card-head">
                                        <header class="w-100">TRASH EMAILS <button class="btn btn-danger btn-sm  m-b-10 float-right delete-sendemail" disabled="">Delete</button></header>
                                    </div>
                                    <table class="mt-5 table table-striped table-bordered table-hover table-checkable order-column full-width" id="example4">
                                        <thead>
                                            <tr>
                                                <th>
                                                    #
                                                </th>
                                                <th width="20%"> Name </th>
                                                <th> Email </th>
                                                
                                                <th> Time </th>
                                                <th> Actions </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $queryGetEmail=select("contact","trash='1' AND NOT isAdmin='1' ORDER BY created_at DESC");
                                            while ($emailData=fetch($queryGetEmail)) {
                                            ?>
                                            <tr class="odd gradeX row<?= $emailData["id"]; ?>">
                                                <td>
                                                    <label class="rt-chkbox rt-chkbox-single rt-chkbox-outline">
                                                        <input type="checkbox" name="check-sendemail[]" class="checkboxes check-sendemail" value="<?= $emailData["id"]; ?>" />
                                                        <span></span>
                                                    </label>
                                                </td>
                                                <td> <?= $emailData["name"];?> </td>
                                                <td>
                                                    <a href="mailto:<?= $emailData["email"] ?>"> <?= $emailData["email"] ?> </a>
                                                    <span class="label label-sm <?php echo ($emailData["read_status"]=='1') ? 'label-success' : 'label-info'; ?> label<?= $emailData["id"]?>"> <?php echo ($emailData["read_status"]=='1') ? 'Read' : 'Unread'; ?> </span>
                                                </td>
                                                <td> <?php echo timeAgo($emailData["created_at"]);?> </td>
                                                <td class="valigntop">
                                                    <div class="btn-group">
                                                        <button class="btn btn-xs deepPink-bgcolor dropdown-toggle no-margin" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                        <i class="fa fa-angle-down"></i>
                                                        </button>
                                                        <ul class="dropdown-menu pull-left" role="menu">
                                                            <li class="openviewmodel" data-msg="<?= $emailData["msg"]; ?>" data-id="<?= $emailData["id"] ?>" data-toggle="modal" data-target="#myModal">
                                                                <a href="javascript:;">
                                                                <i class="fa fa-eye"></i> View Message </a>
                                                            </li>
                                                            <li>
                                                                <a href="view-email.php?action=compose&emailTo=<?= $emailData["email"]; ?>">
                                                                <i class="fa fa-reply"></i> Reply</a>
                                                            </li>
                                                            <li class="undotrash" data-id="<?= $emailData["id"] ?>">
                                                                <a href="javascript:;">
                                                                <i class="fa fa-undo"></i> Undo </a>
                                                            </li>
                                                            <li class="deletePerma" data-id="<?= $emailData["id"] ?>">
                                                                <a href="javascript:;">
                                                                <i class="fa fa-trash"></i> Delete  </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php if ($action=='my-emails'): ?>
                            <div class="col-md-9">
                                <div class="inbox-body " style="overflow-y: scroll;min-height: 500px;">
                                    <div class="card-head">
                                    <header class="w-100">SENT EMAILS <button class="btn btn-danger btn-sm  m-b-10 float-right delete-sendemail" disabled="">Delete</button></header>
                                </div>
                                <table class="mt-5 table table-striped table-bordered table-hover table-checkable order-column full-width" id="example4">
                                    <thead>
                                        <tr>
                                            <th>
                                                
                                                #
                                            </th>
                                            <th width="20%"> Name </th>
                                            <th> Email </th>
                                            
                                            <th> Time </th>
                                            <th> Actions </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $queryGetEmail=select("contact","isAdmin='1' ORDER BY created_at DESC");
                                        while ($emailData=fetch($queryGetEmail)) {
                                        ?>
                                        <tr class="odd gradeX row<?= $emailData["id"]; ?>">
                                            <td>
                                                <label class="rt-chkbox rt-chkbox-single rt-chkbox-outline">
                                                    <input type="checkbox" name="check-sendemail[]" class="checkboxes check-sendemail" value="<?= $emailData["id"]; ?>" />
                                                    <span></span>
                                                </label>
                                            </td>
                                            <td> <?= $emailData["name"];?> </td>
                                            <td>
                                                <a href="mailto:<?= $emailData["emailTo"] ?>"> <?= $emailData["emailTo"] ?> </a>
                                            </td>
                                            <td> <?php echo timeAgo($emailData["created_at"]);?> </td>
                                            <td class="valigntop">
                                                <div class="btn-group">
                                                    <button class="btn btn-xs deepPink-bgcolor dropdown-toggle no-margin" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                    <i class="fa fa-angle-down"></i>
                                                    </button>
                                                    <ul class="dropdown-menu pull-left" role="menu">
                                                        <li class="openviewmodel" data-msg="<?= $emailData["msg"]; ?>" data-id="<?= $emailData["id"] ?>" data-toggle="modal" data-target="#myModal">
                                                            <a href="javascript:;">
                                                            <i class="fa fa-eye"></i> View Message </a>
                                                        </li>
                                                        <li class="deletePerma" data-id="<?= $emailData["id"] ?>">
                                                            <a href="javascript:;">
                                                            <i class="fa fa-trash"></i> Delete  </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php endif ?>
                        <?php if ($action=='compose'): ?>
                        <div class="col-md-9">
                            <div class="inbox-body">
                                
                                <div class="inbox-body no-pad">
                                    <div class="mail-list">
                                        <div class="compose-mail">
                                            <form method="post" id="emailform">
                                                <div class="form-group">
                                                    <label for="to" class="">To:</label>
                                                    <input value="<?php echo (isset($_GET["emailTo"])) ? $_GET["emailTo"] : ''; if(isset($_GET['user'])){
                                                    $orderID=$_GET['user'];
                                                    $getUserDetail=select("orders","id='".$orderID."'");
                                                    $userDetails=fetch($getUserDetail);
                                                    echo $userDetails['email']; }?>" required="" type="email" tabindex="1" id="to" name="toEmail" class="form-control">
                                                    <?php if(isset($_GET['user'])){?>
                                                    <input type="hidden" name="myHidden" value="<?php echo $_GET['user'];?>">
                                                    <?php } ?>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="subject" class="">Subject:</label>
                                                    <input type="text" tabindex="1" id="subject" value="<?php if(isset($_GET['user'])){ echo "Order Rejection"; } ?>" name="subject" class="form-control">
                                                </div>
                                                <div class="compose-editor p-0">
                                                    <textarea required="" name="summernote" id="summernote"></textarea>
                                                </div>
                                                <input type="hidden" name="emailsent" value="true">
                                                <button type="submit" class="btn red btn-outline m-b-10 emailsendbtn">SEND <i class="fa fa-paper-plane"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- end page content -->
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
<div class="modal-dialog modal-lg">
<!-- Modal content-->
<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Message</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
    </div>
    <div class="modal-body">
        <p class="showmsghere"></p>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</div>
</div>
</div>
</div>
<!-- end page container -->
<!-- start footer -->
<?php include 'partials/_footer.php'; ?>
<!-- end footer -->
</div>
<?php include 'partials/_script.php'; ?>
<script src="assets/plugins/summernote/summernote.min.js" ></script>


<script type="text/javascript">
$(document).ready(function() {
$('#summernote').summernote({
placeholder: 'Write Your Mail Here',
tabsize: 2,
height: 300
});
$(".openviewmodel").click(function() {
var text=$(this).data("msg");
var id=$(this).data("id");
$(".showmsghere").html(text);
$.ajax({
url: 'view-email.php',
type: 'POST',
dataType: 'json',
data: {seen: 'true',id:id},
})
.done(function(data) {
if (data.response.code=='1') {
$(".label"+id).removeClass('label-info');
$(".label"+id).addClass('label-success');
$(".label"+id).html('Read');

}
})
.fail(function() {
console.log("error");
})
.always(function() {
console.log("complete");
});

});
$(".undotrash").click(function() {
var id= $(this).data("id");
$.ajax({
url: 'view-email.php',
type: 'POST',
dataType: 'json',
data: {Undotrash: 'true',id:id},
})
.done(function(data) {
if (data.response.code) {
swal("Success",data.response.msg,"success");
$(".row"+id).hide('slow');
}
console.log(data.response.msg);
})
.fail(function() {
console.log("error");
})
.always(function() {
console.log("complete");
});

});
$(".movetotrash").click(function() {
var id= $(this).data("id");
$.ajax({
url: 'view-email.php',
type: 'POST',
dataType: 'json',
data: {trash: 'true',id:id},
})
.done(function(data) {
if (data.response.code) {
swal("Success",data.response.msg,"success");
$(".row"+id).hide('slow');
}
console.log(data.response.msg);
})
.fail(function() {
console.log("error");
})
.always(function() {
console.log("complete");
});

});
});
$(".deletePerma").click(function() {
var id=$(this).data("id");
$.ajax({
url: 'view-email.php',
type: 'POST',
dataType: 'json',
data: {delete: 'true',id:id},
})
.done(function(data) {
if (data.response.code) {
swal("success",data.response.msg,"success");
$(".row"+id).hide('slow');
}
else{
swal("Oh Snap",data.response.msg,"error");
}
console.log(data.response.msg);
})
});
$(document).ready(function(event) {
$("#emailform").on('submit',function(event) {
event.preventDefault();
$('.emailsendbtn').html('SENDING...');
var formdata= new FormData(this);
$.ajax({
url: 'view-email.php',
type: 'POST',
dataType:'json',
data: formdata,
cache:false,
contentType: false,
processData: false,
success:function(data){
if (data.response.code=='1') {
swal("success",data.response.msg,"success");
$('.emailsendbtn').html('SEND <i class="fa fa-paper-plane"></i>');
$('#summernote').summernote('reset');
$('#emailform').trigger("reset");
}
if (data.response.code=="0") {
swal("Oh Snap",data.response.msg,"warning");

}
console.log(data);
},
error: function(data){
console.log("error");
console.log(data);
}
})
});
});
var arr = [];
i = 0;
var checkboxes = $(".check-sendemail"),
submitButt = $(".delete-sendemail");
checkboxes.click(function() {
submitButt.attr("disabled", !checkboxes.is(":checked"));
//alert($(this).val());
arr[i++] = $(this).val();
$(".delete-sendemail").click(function() {
//alert(arr);
$.ajax({
url: 'view-email.php',
type: 'POST',
dataType: 'json',
data: {deleteSendEmail: 'true',deleteThat:arr},
})
.always(function(data) {
if (data.response.code) {
swal("Success",data.response.msg,"success");
var array = ['a', 'b', 'c'];
var str=array.toString(); // result: a,b,c
$.each(arr,function(idx2,val2){
$(".row"+val2).hide('slow');
});
}
else{
swal("Oh Snap",data.response.msg,"error");
}
});
});
});
</script>
</body>
</html>