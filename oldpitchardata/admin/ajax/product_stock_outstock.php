<?php
 include '../conn.php';

	$id=$_POST['id']; 

 	$sql="SELECT * FROM add_product WHERE id='$id'"; 

	$query=mysqli_query($conn,$sql);

	$r1=mysqli_fetch_array($query);

	

	if($r1['status']=='0')

	{

		$update="UPDATE add_product SET status='1' WHERE id='$id'";

		

	}else

	{

		$update="UPDATE add_product SET status='0' WHERE id='$id'";

		

	}

	$query1=mysqli_query($conn,$update);

?>

<?php

	$select="SELECT * FROM add_product WHERE id='$id' ";

	$query2=mysqli_query($conn,$select);

	$rows=mysqli_fetch_array($query2);

	

?>

	<?php if($rows['status']=='1'){?>

	<button name="update" onclick="change_status(<?php echo $rows['id'];?>)" type="submit" value="<?php echo $rows["id"] ?>" class="btn btn-success btn-xs">
		
	</i>Instock</button>

	<?php }else{?>

	<button onclick="change_status(<?php echo $rows['id'];?>)" name="update" type="submit" value="<?php echo $rows["id"] ?>" class="btn btn-danger btn-xs">
		
	</i>Out Stock</button>

	<?php }?>



