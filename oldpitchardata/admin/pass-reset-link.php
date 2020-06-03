<?php
session_start();
if(isset($_GET['email'])){
$email=$_GET['email'];
require_once "../function.php";
include('conn.php');
$sql = $conn->query("SELECT * FROM customers WHERE email='$email'");
if ($sql->num_rows > 0) {
$token = generateNewString();
$conn->query("UPDATE customers SET token='$token',
tokenExpire=DATE_ADD(NOW(), INTERVAL 5 MINUTE)
WHERE email='$email'");
$to = $email;
$subject = 'Password reset link';
$message = "Hi,
In order to reset your password, please click on the link below:

https://bloopersstore.in/resetPassword.php?email=$email&token=$token

Kind Regards
Ecommerce
";
$headers = 'Ecommerce';
if(mail($to, $subject, $message, $headers))
{
$_SESSION['success']='1';
echo "<script>window.location.href='view-customer.php';</script>";
}else{
$_SESSION['error']='1';
echo "<script>window.location.href='view-customer.php';</script>";
}
}
else{
$_SESSION['warning']='1';
echo "<script>window.location.href='view-customer.php';</script>";
}
}else{
echo "<script>window.location.href='view-customer.php';</script>";
}
?>