<?php
include_once 'conn.php';
if (isset($_POST["done"])) {
$id=$_POST["id"];
$val=$_POST["value"];
$query=mysqli_query($conn,"UPDATE orders SET orderstatus='$val' WHERE id='$id' ");
$queryFetch=mysqli_query($conn,"SELECT * FROM orders WHERE id='$id'");
$fetch=mysqli_fetch_array($queryFetch);
}
?>