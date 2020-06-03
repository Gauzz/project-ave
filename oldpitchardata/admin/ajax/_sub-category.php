<?php 
require_once '../../includes/functions.php';
if (isset($_GET["id"])) {
	$id=$_GET["id"];
	$queryValidateString=select("category","id='$id'");
	if (howMany($queryValidateString) > 0) {
		$queryGetSubCategory=select("subcategory","categoryId='$id'");
		?>
			 <option value="">Choose Sub Category</option>
		<?php
		while($subcategory=fetch($queryGetSubCategory)){ ?>
			<option value="<?php echo $subcategory["id"]; ?>"><?php echo $subcategory["name"]; ?></option>

<?php	}
	}else{ ?>
		<option value="">Choose Sub Category</option>
	<?php }	
}	

?>