<?php 
	include('../conn.php');
	if(isset($_POST['id'])){
	 $id=$_POST['id']; 
	} 
	
?>
 <?php if(isset($_POST['add'])){
                        ?>
                         <div class="form-group">
                        <label >Sub Category</label>
                    <select name='subcategory' id='myselect' onchange="get_brand(this.value);"  required="" class="form-control" tabindex="-1" aria-hidden="true">
                            <option value="">Select Sub Category</option>
                            <?php 
                                $sql1=" select * from subcategory where cat_id='$id' ";
                                $qry1=mysqli_query($conn,$sql1);
                                while($row1=mysqli_fetch_array($qry1)){
                            ?>
                            <option value="<?php echo $row1['sub_cat_id'];?>"><?php echo $row1['sub_cat_name'];?></option>
                            <?php }?>
                        </select>
                         </div>
                        <?php }if(isset($_POST['brand_add'])){?>
 						<div class="form-group row">
                            <label for="horizontalFormEmail" class="col-sm-2 control-label"> Sub Category</label>
                            <div class="col-sm-10">
                                <select name='subcategory' id='myselect'  required="" class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
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
                        <?php
                            if(isset($_POST['edit']))
                            {
                        ?>
                         <label> Sub Category</label>
                                              <select  required="" class="form-control" onchange="get_brand(this.value);" name="subcategory" >
                                                <option value="" selected="" disabled="">Select Sub
                                                Category</option>
                                                <?php
                                                $sel1=mysqli_query($conn," select * from subcategory where cat_id='$id'");
                                                  while($cat=mysqli_fetch_array($sel1)){
                                                ?>
                                                <option value="<?php echo $cat['sub_cat_id']?>"><?php echo $cat['sub_cat_name']?></option>
                                              <?php }?>
                                                
                                              </select>
                                        
                                          <?php }?>
