<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ob_start();
require '../includes/functions.php';
//$sql_query=mysqli_query($conn,"SELECT * FROM productInfo");
if(isset($_GET['delete_id']))
{
	$id = $_GET['delete_id'];
	$sql_query = mysqli_query($conn,"SELECT * FROM productInfo WHERE id ='$id'");
	$sql_result = mysqli_fetch_array($sql_query);
$token_product = $sql_result['token'];
	$result = "DELETE FROM productInfo WHERE token='$token_product'";
	$result1 = mysqli_query($conn,$result);
		if($result1)
{
	$Success_image = mysqli_query($conn,"SELECT * FROM product_image WHERE token='$token_product'");
	while ($data = mysqli_fetch_array($Success_image)) {
		
echo $image_id = $data['id'];
$result = "DELETE FROM product_image WHERE id='$image_id'";
	$result1 = mysqli_query($conn,$result);
	}
		
			}
	header("Location:view-product.php");
}
	
	
?>