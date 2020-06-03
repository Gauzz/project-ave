<?php
include '../../conn.php';
if(isset($_POST["set"])) {
			
      $i=$_POST["set"];
			$token=$_POST["token"];
			$doc= $_FILES["userImage"];
           $docname= $_FILES["userImage"]["name"];
           $doctempname= $_FILES["userImage"]["tmp_name"];
           $iName=rand().$docname;
           if (move_uploaded_file($doctempname, "../../uploads/imgs/".$iName)) {
           	mysqli_query($conn,"UPDATE tbl_project_image SET image='$iName' WHERE id='$i'");
            // update New Assets
            $imageUrlPath = 'https://pitchar.io/uploads/imgs/'.$iName;
            mysqli_query($conn,"UPDATE assets SET image='$getObjThumbnail' WHERE authtoken='$token'");

           	echo '<strong class="text-success">Success!</strong> <span class="text-success">Image update Successfully.</span>';
           }
		
		
	
}
?>
           