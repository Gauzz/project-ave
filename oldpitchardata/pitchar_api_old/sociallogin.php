<?php 



include('../conn.php');





	$mail=$_GET["email"];

  

    $verify=mysqli_query($conn,"SELECT * FROM tbl_users WHERE email='$mail'");

    	
  $getTotalNo=mysqli_num_rows($verify);
        if ($getTotalNo>0) {

  $verifypass=mysqli_fetch_assoc($verify);
				echo "1,".$verifypass['reg_time'].','.$verifypass['firstname'].','.$verifypass['lastname'].','.$verifypass['country'].','.$verifypass['occupation'];
    		 

    		 
}
else{
    echo '2';
}
    	
 







?>