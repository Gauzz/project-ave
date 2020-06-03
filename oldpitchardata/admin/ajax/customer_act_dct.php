<?php
 include '../conn.php';

	$id=$_REQUEST['a']; 

 	$sql="SELECT * FROM customer WHERE id='$id'"; 

	$query=mysqli_query($conn,$sql);

	$r1=mysqli_fetch_array($query);

	

	if($r1['status']=='Deactive')

	{

		$update="UPDATE customer SET status='Active' WHERE id='$id'";

		

	}else

	{

		$update="UPDATE customer SET status='Deactive' WHERE id='$id'";

		

	}

	$query1=mysqli_query($conn,$update);

?>

<?php

	$select="SELECT * FROM customer WHERE id='$id' ";

	$query2=mysqli_query($conn,$select);

	$rows=mysqli_fetch_array($query2);

	

?>

	<?php if($rows['status']=='Active'){?>

	<button name="update" onclick="Deactive(<?php echo $rows['id'];?>)" type="submit" value="<?php echo $rows["id"] ?>" class="btn btn-success btn-xs"><i class="fa fa-thumbs-up" aria-hidden="true">
		
	</i>Active</button>

	<?php }else{?>

	<button onclick="Deactive(<?php echo $rows['id'];?>)" name="update" type="submit" value="<?php echo $rows["id"] ?>" class="btn btn-danger btn-xs"><i class="fa fa-thumbs-down" aria-hidden="true">
		
	</i>Deactive</button>

	<?php }?>



