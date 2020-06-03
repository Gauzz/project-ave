<?php
require '../includes/functions.php';
    if(isset($_POST['addslider']))
    {
        $title=post('title');
        $heading=post('heading');
        $description=post('description');
        $link=post('link');
        $image=$_FILES['image']['name'];
        $temp_name=$_FILES['image']['tmp_name'];
        move_uploaded_file($temp_name,"uploads/slider/".$image);
        $token=token(8);
        $getSildernum=query(' SELECT * FROM slider ');
        $sliderVal=howMany($getSildernum);
        if($sliderVal < 5 or $sliderVal=="4"){
$descriptionLength=strlen($description);
if ($descriptionLength < 150 or $descriptionLength==150) {
if(!empty($image)){
        $insertSlider=query("INSERT INTO slider (title,heading,description,link,image,token) VALUES('$title','$heading','$description','$link','$image','$token')");
}else
{
exit(json_encode(["response" =>["code" => "3","msg" => "Please Select An Image"]]));
}
}else
{
exit(json_encode(["response" => ["code" => "4","msg" => "You Entered '$descriptionLength' Characters"]]));
}
        if($insertSlider)
        {
            exit(json_encode(["response" =>["code" => "1","msg" => "Data Inserted Successfully"]]));
        }else
        {
            exit(json_encode(["response" => ["code" => "0","msg"=>"Opps! Something Went Wrong!"]]));
        }
        }else
        {
            exit(json_encode(["response" => ["code" => "2","msg" => "You can Only 5 Add Slider"]]));
        }
    }
    if(isset($_POST['token']))
    {
        $token=$_POST['token'];
        $deleteSlider=query(" DELETE FROM slider WHERE token ='$token'");
        if($deleteSlider)
        {
            exit(json_encode(["response" => ["code" => "1", "msg" => "Slider Deleted Successfully!"]]));
        }else
        {
            exit(json_encode(["response" => ["code" => "0" , "msg" => "Opps! Something Went Wrong!"]]));
        }
    }
/*Change Status*/
if(isset($_POST['changeStatus'])){
$id=$_POST['changeStatus'];
$getQuery=mysqli_query($conn,"SELECT * FROM slider WHERE id='$id'");
$fetchQuery=mysqli_fetch_array($getQuery);
if ($fetchQuery["status"]=='0'){
$status='1';
}
if ($fetchQuery["status"]=='1'){
$status='0';
}
$statusChange=mysqli_query($conn,"UPDATE slider SET status='$status' WHERE id='$id'");
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
    <body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
        <div class="page-wrapper">
            <?php include 'partials/_header.php'; ?>
            <div class="page-container">
                <?php include 'partials/_sidebar.php'; ?>
                <div class="page-content-wrapper">
                    <div class="page-content">
                        <div class="page-bar">
                            <div class="page-title-breadcrumb">
                                <div class=" pull-left">
                                    <div class="page-title">Slider</div>
                                </div>
                                <ol class="breadcrumb page-breadcrumb pull-right">
                                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Slider</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <div class="card-head">
                                <header>Slider</header>
                            </div>
                            <form method="POST" id="sliderForm">
                                <div class="card-body row">
                                    <div class="col-lg-6 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input class="mdl-textfield__input" type="text" name="title" id="title" required="">
                                            <label class="mdl-textfield__label">Title</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input class="mdl-textfield__input" type="text" name="heading" id="heading" required="">
                                            <label class="mdl-textfield__label">Heading</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input class="mdl-textfield__input" type="text" name="description" id="description" required="">
                                            <label class="mdl-textfield__label">Description</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input class="mdl-textfield__input" type="text" name="link" id="link" required="">
                                            <label class="mdl-textfield__label">Link</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 p-t-20">
                                        <img onclick="opendialog()" style="cursor: pointer;height:150px;width:300px;" id="img_pre" class="img-fluid img-thumbnail" src="uploads/slider/slider.png" border="1">
                                        <label onclick="opendialog()" style="cursor: pointer;" class="control-label col-md-3">Upload Slider Image</label>
                                        <input id="imagebox" onchange="document.getElementById('img_pre').src = window.URL.createObjectURL(this.files[0])" style="display: none;" type="file" class="form-control" name="image" autocomplete="off">
                                        <input type="hidden" name="addslider" value="true" autocomplete="off">
                                    </div>
                                    <div class="col-lg-12 p-t-20 text-center">
                                        <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink submitbtns" id="submit-all" name="submit">Submit</button>
                                        <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-default">Cancel</button>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="card  card-box">
                                    <div class="card-head">
                                    <header>All Slider</header>
                                </div>
                                <div class="card-body ">
                                    <div class="table-wrap">
                                        <div class="table-responsive">
                                            <table class="table display product-overview mb-30" id="support_table5">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Image</th>
                                                        <th>Title</th>
                                                        <th>Heading</th>
                                                        <th>Link</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $selectSlider=query("SELECT * FROM slider");
                                                        $i=1;
                                                        while($row=mysqli_fetch_array($selectSlider)){
                                                    ?>
                                                    <tr class="hide_<?php echo $row['token'];?>">
                                                        <td><?php echo $i++;?></td>
                                                        <td><a href="uploads/slider/<?php echo $row['image'];?>" data-sub-html="Demo Description"> <img class="img-fluid img-thumbnail" src="uploads/slider/<?php echo $row['image'];?>" alt="" style=" height:100px;width:200px;" > </a></td>
                                                        <td id=""><?php echo $row['title'];?></td>
                                                        <td><?php echo $row['heading'];?></td>
                                                        <td><?php echo $row['link'];?></td>
                                                        <td>
                                                            <button id="status<?php echo $row['id']; ?>" type="button" data-id="<?php echo $row['id']; ?>" class="btn btn-circle <?php echo ($row['status']=='1')? "btn-success":"btn-danger"; ?> status"><?php echo ($row['status']=='1')? "Active":"Deactive"; ?></button>
                                                        </td>
                                                        <td>
                                                            <button data-id="<?php echo $row['token'];?>" value="<?php echo $row['token'];?>" class="btn btn-tbl-delete btn-xs deletethat delete-user">
                                                            <i class="fa fa-trash-o "></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <?php }?>
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
        </div>
    </div>
</div>
<script type="text/javascript" src="assets/plugins/dropzone/dropzone.js"></script>
<?php include 'partials/_footer.php'; ?>
</div>
<?php include 'partials/_script.php'; ?>
</body>
<script type="text/javascript">
    function opendialog() {
    $("#imagebox").trigger('click');
        }
        $(document).ready(function (e) {
$('#sliderForm').on('submit',(function(e) {
e.preventDefault();
$(".submitbtns").html("<i class='fa fa-ellipsis-h'></i>");
var formData = new FormData(this);
$.ajax({
type:'POST',
url: 'slider.php',
data:formData,
cache:false,
dataType:'json',
contentType: false,
processData: false,
success:function(data){
if (data.response.code=='1') {
swal("Success",data.response.msg,"success");
$("#sliderForm").trigger('reset');
$(".submitbtns").html("SUBMIT");
setTimeout(function(){
window.location="slider.php";
}, 3000);
}
if (data.response.code=='0') {
swal("ERROR",data.response.msg,"error");
$("#sliderForm").trigger('reset');
$(".submitbtns").html("SUBMIT");
setTimeout(function(){
window.location="slider.php";
}, 3000);
}
if (data.response.code=='2') {
swal("ERROR",data.response.msg,"warning");
$("#sliderForm").trigger('reset');
$(".submitbtns").html("SUBMIT");
setTimeout(function(){
window.location="slider.php";
}, 3000);
}
if (data.response.code=='3') {
swal("ERROR",data.response.msg,"warning");
$(".submitbtns").html("SUBMIT");
}
if (data.response.code=='4') {
swal("Only 150 Characters Allows!",data.response.msg,"warning");
$(".submitbtns").html("SUBMIT");
}

},
error: function(data){
console.log("error");
console.log(data);
}
});
}));
});
        $(".delete-user").click(function() {
$(this).html("<i class='fa fa-ellipsis-h'></i>");
var token=$(this).data("id");
swal({
title: "Are you sure?",
text: "This will delete From Database And You'll Not be Able to recover it",
icon: "warning",
buttons: true,
dangerMode: true,
})
.then((willDelete) => {
if (willDelete) {
$.ajax({
url: 'slider.php',
type: 'POST',
dataType:'json',
data:{ token: token },
})
.always(function(data) {
$(".hide_"+token).fadeOut('slow');
$(this).html("<i class='fa fa-trash' ></i>");
});
}
else {
swal("Record is Safe!");
$(this).html("<i class='fa fa-trash'></i>");
}
});
});
$(".status").click(function() {
var id=$(this).data("id");
$.ajax({
url: 'slider.php',
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
</html>