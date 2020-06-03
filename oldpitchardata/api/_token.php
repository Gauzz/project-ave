<?php
header("Content-type:application/json");
include '../conn.php';

if (isset($_REQUEST["submit"])) {
    $project= array();
    $project["project"] = array();
$query=mysqli_query($conn,"SELECT * FROM tbl_users ");
while($Data=mysqli_fetch_assoc($query))
{

array_push($project["project"],array('authtoken'=>$Data["authtoken"],'email'=>$Data["email"],'username'=>$Data["fullname"],));
}
    echo json_encode(($project),JSON_PRETTY_PRINT);

}
?>