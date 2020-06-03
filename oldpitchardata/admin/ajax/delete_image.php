 <?php
 include('../conn.php');
 if(isset($_POST['id'])){
 	$id=$_POST['id'];
 	
 	$select=mysqli_query($conn,"select * from product_image where id='$id'");
 	$r=mysqli_fetch_array($select);
    $token=$r['token']; 
 	$delete_qry=mysqli_query($conn,"delete from product_image where id='$id'");
 	if($delete_qry==true){
                        $get_img=mysqli_query($conn,"select * from product_image where token='$token'");
                        while($all_img=mysqli_fetch_array($get_img)){
                      ?>
                     <div class="col-md-3 float-left center">
<div class="col-md-12 center">
<img src="uploads/<?php echo $all_img['name'];?>" id="imgshowhere3" style="height: 150px;width: 150px;border-radius: 50% 50%;box-shadow: 0px 0px 15px #888888;">
</div><br>
<button type="button" onclick="delete_img(<?php echo $all_img['id'];?>);" data-id="3" class="btn delete-product-image" style="text-align: center;">Remove</button>
<button onclick="" type="button" data-id="3" class="btn update-image" style="text-align: center;">Change</button>
</div>
                                        <?php } } } ?>
                                       
                                      