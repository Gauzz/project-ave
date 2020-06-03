 <?php
if(isset($_POST["limit"], $_POST["start"]))
{
include '../conn.php';
 $query = "SELECT * FROM  tbl_users WHERE occupation='student' ORDER BY id ASC LIMIT ".$_POST["start"].", ".$_POST["limit"]."";
 $result = mysqli_query($conn, $query);
 while($row = mysqli_fetch_array($result))
 { ?>
      <section class="col-lg-6">
                     <!-- solid sales graph -->
                    
                        <!-- /.box-body -->
                          <div class="box box-solid bg-teal-gradient" style="min-height: 150px;">
                           <div class="row">
                 <div class="col-lg-12">
                   
                     <div class="alert alert-success alert-dismissible">
               
                <!-- <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> -->
                                 <div class="col-lg-3">
                                    <img style="padding: 20px;" src="uploads/user_profile_pic/<?php echo (empty($row["display_pic"])) ? "avatar-placeholder.png" : $row["display_pic"]; ?>  " class="stimg">
                                 </div>
                                 <div class="col-lg-7 col-lg-offset-1"id="stdetails">
                                    <h3 style="color: #333;"><?= $row["fullname"]?></h2>
                                    <p><?= $row["country"]?></p>
                                    <p><?= $row["email"]?></p>
                                 </div>
                              </div>
                                </div>
                           </div>
                           <!-- /.row -->
                       
                        <!-- /.box-footer -->
                     </div>
                     <!-- /.box -->
                     <!-- /.box -->
                  </section>
<?php }
}
 
?>