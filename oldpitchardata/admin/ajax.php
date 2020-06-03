<?php 
session_start();
include 'conn.php';
	if (isset($_FILES["file"])) {
		$productName=mysqli_real_escape_string($conn,$_POST["productName"]);
		$ProductVendor=mysqli_real_escape_string($conn,$_POST["ProductVendor"]);
		$getProductVal=mysqli_real_escape_string($conn,$_POST["getProductVal"]);
		$category=mysqli_real_escape_string($conn,$_POST["category"]);
		$productPrice=mysqli_real_escape_string($conn,$_POST["productPrice"]);
		$ProductDiscount=mysqli_real_escape_string($conn,$_POST["ProductDiscount"]);
		$offdiscount=mysqli_real_escape_string($conn,$_POST["offdiscount"]);
		$sellingPrice=mysqli_real_escape_string($conn,$_POST["sellingPrice"]);
		$ProductQuantity=mysqli_real_escape_string($conn,$_POST["ProductQuantity"]);
		$ProductColor=mysqli_real_escape_string($conn,$_POST["ProductColor"]);
		$ProductSize=mysqli_real_escape_string($conn,$_POST["ProductSize"]);
		$ProductsBrief=mysqli_real_escape_string($conn,$_POST["ProductsBrief"]);
		$token="PRO".tokenInt(6);
	$query=mysqli_query($conn,"INSERT INTO add_product(product_name,token,status,product_category,product_color,product_size,product_vendor,product_price,product_dis,discount_off,selling_price,Product_quantity,brief,date_time)VALUES('$productName','$token','$getProductVal','$category','$ProductColor','$ProductSize','$ProductVendor','$productPrice','$ProductDiscount','$offdiscount','$sellingPrice','$ProductQuantity','$ProductsBrief',NOW())");
	if($query)
	{

	foreach ($_FILES["file"]["name"] as $i => $pImage) {
			$imageName=$token."_".tokenInt(6).'.jpg';
	    	move_uploaded_file($_FILES["file"]["tmp_name"][$i], 'uploads/'.$imageName);
	    	$queryUploadImage=mysqli_query($conn,"INSERT INTO product_image(token,name,created_at)VALUES('$token','$imageName',NOW())");
	    	if ($queryUploadImage) {
	    		$_SESSION["success"]="true";
	    	}
		}
	}
		
	}


?>