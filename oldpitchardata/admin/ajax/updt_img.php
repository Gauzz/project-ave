<?php
	include('../conn.php');
	if(isset($_POST['id']))
	{
		echo $img=$_FILES['img']['name'];
		$id=$_POSt['id'];
		$temp=$_['img']['tmp_name'];
		if(move_uploaded_file($temp,"../uploads/".$img)){
		$update=mysqli_query($conn," update product_image set name='$img' where id='$id' ");
		$sql=mysqli_query($conn," select * from product_image where id='$id' ");
			$r=mysqli_fetch_array($sql);
		?>
		<div class="col-md-12 center">
<img src="uploads/<?php echo $r['name'];?>" id="imgshowhere<?php echo $r['id'];?>" style="height: 150px;width: 150px;border-radius: 50% 50%;box-shadow: 0px 0px 15px #888888;">
</div><br>
<button type="button" onclick="delete_img(<?php echo $r['id'];?>);" data-id="" class="btn delete-product-image" style="text-align: center;">Remove</button>
<button onclick="document.getElementById('trig').click()"  type="button" data-id="" class="btn update-image" style="text-align: center;">Change</button>
<input  type="file" name="file" style="display: none;" id='trig' onchange="updt_img(this.value,<?php echo $r['id']?>);" >
<button style="display: none;" type="button" class="upload3" value="Upload">Upload</button>
<?php
														}
	}
?>