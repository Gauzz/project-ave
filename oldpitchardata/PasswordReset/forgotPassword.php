<?php
ini_set('display_errors', 1);
    use PHPMailer\PHPMailer\PHPMailer;
    require_once "function.php";

    if (isset($_POST['email'])) {
        $conn = new mysqli('host', 'makerite_Yashgup', 'admin@123', 'makerite_student_admin');

        $email = $conn->real_escape_string($_POST['email']);
        
         
        
                
                 // Checking Mail for student
         $checkforstd=mysqli_query($conn,"SELECT * FROM tbl_student WHERE email='$email'");
         $countforstd= mysqli_num_rows($checkforstd);
            if($countforstd == 1){
                $q1=mysqli_query($conn,"SELECT * FROM tbl_student WHERE email='$email'");
                $std_data=mysqli_fetch_array($q1);
                 $user_name= $std_data["fullname"];
                   echo $user_email= $std_data["email"];
                   echo $user_occ= $std_data["occupation"];
                 $user_country= $std_data["country"];
            }
            
        
          // Checking Mail for teacher
         $checkforteach=mysqli_query($conn,"SELECT * FROM tbl_teacher WHERE email='$email'");
          $countforteach= mysqli_num_rows($checkforteach);
         if($countforteach ==1){
              $q1=mysqli_query($conn,"SELECT * FROM tbl_teacher WHERE email='$email'");
                $teach_data=mysqli_fetch_array($q1);
                 $user_name= $teach_data["fullname"];
                 echo $user_email= $teach_data["email"];
                 echo $user_occ= $teach_data["occupation"];
                 $user_country= $teach_data["country"];
         }
        
        
        

        $sql = $conn->query("SELECT id FROM tbl_$user_occ WHERE email='$email'");
        if ($sql->num_rows > 0) {

            $token = generateNewString();

	        $conn->query("UPDATE tbl_$user_occ SET token='$token', 
                      tokenExpire=DATE_ADD(NOW(), INTERVAL 5 MINUTE)
                      WHERE email='$email'
            ");

	        require_once "PHPMailer/PHPMailer.php";
	        require_once "PHPMailer/Exception.php";

	        $mail = new PHPMailer();
	        $mail->addAddress($email);
	        $mail->setFrom("hello@Yashgupta.work", "Yash");
	        $mail->Subject = "Reset Password";
	        $mail->isHTML(true);
	        $mail->Body = "
	            Hi,<br><br>
	            
	            In order to reset your password, please click on the link below:<br>
	            <a href='
	           http://makerites.com/Student_Admin/PasswordReset/resetPassword.php?email=$email&token=$token
	            '>http://makerites.com/Student_Admin/PasswordReset/resetPassword.php?email=$email&token=$token</a><br><br>
	            
	            Kind Regards,<br>
	            My Name
	        ";

	        if ($mail->send())
    	        exit(json_encode(array("status" => 1, "msg" => 'Please Check Your Email Inbox!')));
    	    else
    	        exit(json_encode(array("status" => 0, "msg" => 'Something Wrong Just Happened! Please try again!')));
        } else
            exit(json_encode(array("status" => 0, "msg" => 'Please Check Your Inputs!')));
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password System</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container" style="margin-top: 100px;">
        <div class="row justify-content-center">
            <div class="col-md-6 col-md-offset-3" align="center">
                <img src="images/logo.png"><br><br>
                <input class="form-control" id="email" placeholder="Your Email Address"><br>
                <input type="button" class="btn btn-primary" value="Reset Password">
                <br><br>
                <p id="response"></p>
            </div>
        </div>
    </div>
    <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        var email = $("#email");

        $(document).ready(function () {
            $('.btn-primary').on('click', function () {
                if (email.val() != "") {
                    email.css('border', '1px solid green');

                    $.ajax({
                       url: 'forgotPassword.php',
                       method: 'POST',
                       dataType: 'json',
                       data: {
                           email: email.val()
                       }, success: function (response) {
                            if (!response.success)
                                $("#response").html(response.msg).css('color', "red");
                            else
                                $("#response").html(response.msg).css('color', "green");
                        }
                    });
                } else
                    email.css('border', '1px solid red');
            });
        });
    </script>
</body>
</html>
