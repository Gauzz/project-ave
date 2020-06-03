<?php
	require_once "function.php";

	if (isset($_GET['email']) && isset($_GET['token'])) {
		$conn = new mysqli('host', 'makerite_Yashgup', 'admin@123', 'makerite_student_admin');

		$email = $conn->real_escape_string($_GET['email']);
		$token = $conn->real_escape_string($_GET['token']);
		
// Checking Mail for student
         $checkforstd=mysqli_query($conn,"SELECT * FROM tbl_student WHERE email='$email'");
         $countforstd= mysqli_num_rows($checkforstd);
            if($countforstd == 1){
                $q1=mysqli_query($conn,"SELECT * FROM tbl_student WHERE email='$email'");
                $std_data=mysqli_fetch_array($q1);
                   $user_email= $std_data["email"];
                   $user_occ= $std_data["occupation"];

            }
            
        
// Checking Mail for teacher
         $checkforteach=mysqli_query($conn,"SELECT * FROM tbl_teacher WHERE email='$email'");
          $countforteach= mysqli_num_rows($checkforteach);
         if($countforteach ==1){
              $q1=mysqli_query($conn,"SELECT * FROM tbl_teacher WHERE email='$email'");
                $teach_data=mysqli_fetch_array($q1);
                 $user_email= $teach_data["email"];
                 $user_occ= $teach_data["occupation"];

         }
        
		
		
		

		$sql = $conn->query("SELECT id FROM tbl_$user_occ WHERE
			email='$email' AND token='$token' AND token<>'' AND tokenExpire > NOW()
		");

		if ($sql->num_rows > 0) {
			$newPassword = generateNewString();
			$newPasswordEncrypted = password_hash($newPassword, PASSWORD_BCRYPT);
			$conn->query("UPDATE tbl_$user_occ SET token='', password = '$newPasswordEncrypted'
				WHERE email='$email'
			");

			echo "Your New Password Is $newPassword<br><a href='login.php'>Click Here To Log In</a>";
		} else
			redirectToLoginPage();
	} else {
		redirectToLoginPage();
	}
?>
