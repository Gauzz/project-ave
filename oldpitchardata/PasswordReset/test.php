<?php
ini_set('display_errors', 1);
$conn = new mysqli('host', 'makerite_Yashgup', 'admin@123', 'makerite_student_admin');

 if (isset($_POST['sub'])) {
        
      
        $email =$_POST['email'];
        
                
                 // Checking Mail for student
         $checkforstd=mysqli_query($conn,"SELECT * FROM tbl_student WHERE email='$email'");
         $countforstd= mysqli_num_rows($checkforstd);
            if($countforstd == 1){
                $q1=mysqli_query($conn,"SELECT * FROM tbl_student WHERE email='$email'");
                $std_data=mysqli_fetch_array($q1);
                 $user_name= $std_data["fullname"];
                  echo $user_email= $std_data["email"];
                 echo  $user_occ= $std_data["occupation"];
                 $user_country= $std_data["country"];
            }
            
        
          // Checking Mail for teacher
         $checkforteach=mysqli_query($conn,"SELECT * FROM tbl_teacher WHERE email='$email'");
          $countforteach= mysqli_num_rows($checkforteach);
         if($countforteach ==1){
              $q1=mysqli_query($conn,"SELECT * FROM tbl_teacher WHERE email='$email'");
                $teach_data=mysqli_fetch_array($q1);
                 $user_name= $teach_data["fullname"];
               echo  $user_email= $teach_data["email"];
               echo  $user_occ= $teach_data["occupation"];
                 $user_country= $teach_data["country"];
         }
}



?>
<form method="POST">
    <input type="text" name="email">
    <input type="submit" name="sub">
</form>