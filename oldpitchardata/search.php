<?php
ini_set('display_errors', 1);
$email= $_SESSION["user_mail"];
$status= $_SESSION["user_occ"];
$conn=mysqli_connect("localhost","pitchar_project","111444777aaa@@@","pitchar_project");

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
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0){ 
	while($row = mysqli_fetch_array($result)) {
?> 
			<section class="col-lg-6 connectedSortable">
                     <!-- solid sales graph -->
                     <div class="box box-solid bg-teal-gradient">
   
                        <!-- /.box-body -->
                        <div class="box-footer no-border">
                           <div class="row">
                              <div class="col-lg-12">
                                 <div class="col-lg-3">
                                    <img src="dist/img/user2-160x160.jpg" class="stimg">
                                 </div>
                                 <div class="col-lg-7 col-lg-offset-1"id="stdetails">
                                    <h3><a href="view-global.php?project=<?php echo $row["token"];?>"><?= $row["project_name"];?></a></h3>
                                    <p><?= $row["subject"]?><?php echo $_POST["ids"]; ?></p>
                                    <p><?= $row["language"]?></p>
                                    <div class="">
                                       <a href="<?php echo (!empty($row["docs"])) ? "uploads/docs/".$row["docs"] : " " ; ?>" onClick="<?php echo (!empty($row["docs"])) ? " " : "alert('No Documents Attached to This Project!')" ; ?>" class="btn btn-social-icon btn-instagram"><i class="fa fa-file"></i></a>
                                       <a href="<?php echo (!empty($row["image"])) ? "uploads/imgs/".$row["image"] : " " ; ?>" onClick="<?php echo (!empty($row["image"])) ? " " : "alert('No Images Attached to This Project!')" ; ?>" class="btn btn-social-icon btn-twitter"><i class="fa fa-image"></i></a>
                                       <a class="btn btn-social-icon btn-facebook"><i class="fa fa-cube"></i></a>
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
 
}
else
{ ?>
	<p class="text-center text-info h2">Oops! No Data Here...</p>
<?php }
?>
 