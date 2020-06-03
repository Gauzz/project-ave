<?php
ini_set('display_errors', 1);
$email= $_SESSION["user_mail"];
$status= $_SESSION["user_occ"];
include 'conn.php';

if(isset($_POST["query"]))
{    $email= $_POST["ids"];
	$search = mysqli_real_escape_string($conn, $_POST["query"]);
	$query = "
	SELECT * FROM tbl_std_project WHERE email='$email' AND project_name LIKE '%$search%' ";
}
else
{  $email= $_POST["ids"];
	$query = "SELECT * FROM tbl_std_project WHERE email='$email' ORDER BY id";
}
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0){ 
	while($row = mysqli_fetch_array($result)) {
?> 
			<section id="fg" class="col-lg-6 connectedSortable get<?php echo $row["id"];?>">
                     <!-- solid sales graph -->
                     <div class="box box-solid bg-teal-gradient" style="min-height: 150px;">
   
                        <!-- /.box-body -->
                        <div class="box-footer no-border">
                           <div class="row">
                              <div class="col-lg-12">
                                  <div class="alert alert-success alert-dismissible">
               
                 <a href="javascript:void(0)" data-token='<?= $row["token"]; ?>' data-email="<?= $email; ?>" id="Close" data-id="get<?php echo $row["id"];?>" class="close CloseProject">×</a>
               <a href="https://arvrintedu.com/edit2.php?pid=<?= $row["token"]; ?>"> <i class="fa fa-pencil" aria-hidden="true" id="fi"></i></a>
                                 <div class="col-lg-3">
                                    <img src="../img/doc-placeholder-blue.png" class="stimg">
                                 </div>
                                 <div class="col-lg-7 col-lg-offset-1"id="stdetails">
                                    <h3 class="head1"><a href="view-global.php?project=<?php echo $row["token"];?>"><?= $row["project_name"];?></a></h3>
                                    <p><?= $row["subject"]?></p>
                                    <p><?= $row["book"]?></p>
                                    <div class="">
                                       <a href="<?php echo (!empty($row["docs"])) ? "uploads/docs/".$row["docs"] : " " ; ?>" onClick="<?php echo (!empty($row["docs"])) ? " " : "alert('No Documents Attached to This Project!')" ; ?>" class=""><i class="fa fa-file"id="gr"></i></a>
                                       <a href="<?php echo (!empty($row["image"])) ? "uploads/imgs/".$row["image"] : " " ; ?>" onClick="<?php echo (!empty($row["image"])) ? " " : "alert('No Images Attached to This Project!')" ; ?>" class="r"><i class="fa fa-image" id="gr"></i></a>
                                       <a class=""><i class="fa fa-cube" id="gr"></i></a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           </div>
                           <!-- /.row -->
                        </div>
                        <!-- /.box-footer -->
                     </div>
                     <!-- /.box -->
                     <!-- /.box -->
                  </section>
<?php
	}
?> 

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
        $(document).ready(function() {
           $(".CloseProject").click(function() {
              var val=$(this).data("id");
              var email=$(this).data("email");
              var token=$(this).data("token");
                swal({
                  title: "Are you sure?",
                  text: "Once deleted, you will not be able to recover this Project!",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                })
                .then((willDelete) => {
                  if (willDelete) {
                    swal("Success! Your Project has been deleted!", {
                      icon: "success",
                    });
                  
                    $('.'+val).hide('slow');
                    $.ajax({
                            url: "assets/_php/ProjectDelete.php",
                            type:"POST",
                            async:false,
                            data:{
                                "done" : 1,
                                "pid" : val,
                                "email":email,
                                "token":token
                            },
                            success:function(data){
                                //displaydata();
                                //$("#like").val('');
                            }
                            });

                  } else {
                    swal("Your Project is safe!");
                  }
                });
              
           });

         
        });
</script>
<?php }
else
{ ?>
	<p class="text-center text-info h2">Oops! No Data Here...</p>
<?php }
?>
 