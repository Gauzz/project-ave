<?php 
	include('../conn.php');
	if(isset($_POST['id'])){
	 $id=$_POST['id']; 
	
	
?>                      <div class="col-lg-12 p-t-20">
 						<div class="form-group row">
                            <label for="horizontalFormEmail"> Sub Category</label>
                                <select name='subcategory' id='myselect' onchange='get_brand(this.value);' required="" class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true"  style="width: 100%; padding-left: 38%;" >
                                    <option selected="" disabled="" value="">Select Sub Category</option>
                                    <?php 
                                        $sql=" select * from subcategory where cat_id='$id'";
                                        $qry=mysqli_query($conn,$sql);
                                        while($row=mysqli_fetch_array($qry)){
                                    ?>
                                        <option value="<?php echo $row['sub_cat_id'];?>"><?php echo $row['sub_cat_name'];?></option>
                                    <?php }?>
                                </select>
                        </div>
                    </div>
                    
                        <?php } ?>