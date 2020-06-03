<?php 
	include('../conn.php');
	if(isset($_POST['id'])){
	   $id=$_POST['id']; 

   } 
if(isset($_POST['edit'])){

?>
                      
                           <div class="form-group row">
                            <label for="horizontalFormEmail">Brand</label>
                        <select name='brand' id='myselect'  required="" class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                <option value="">Select Brand</option>
                                <?php 
                                    $sql2=" select * from brand where sub_cat_id='$id'  ";
                                    $qry2=mysqli_query($conn,$sql2);
                                    while($row2=mysqli_fetch_array($qry2)){
                                ?>
                            <option value="<?php echo $row2['id'];?>"><?php echo $row2['name'];?></option>
                                    <?php }?>
                                </select>
                        </div>
                          <?php }else{?>
                   
 						<div class="form-group">
                            <label>Brand</label>
                                <select name='brand' id='brand' class="form-control" >
                                    <option selected="" disabled="" value="">Select Brand</option>
                                    <?php 
                                        $sql=" select * from brand where sub_cat_id='$id'";
                                        $qry=mysqli_query($conn,$sql);
                                        while($row=mysqli_fetch_array($qry)){
                                    ?>
                                        <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                                    <?php }?>
                                </select>
                        </div>
                  
                        <?php } ?>