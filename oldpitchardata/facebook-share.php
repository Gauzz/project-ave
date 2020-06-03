<?php 
ob_start();
include('conn.php');
session_start();
 ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (isset($_GET["project"])) {
  $username=$_GET["user"];
  $token=$_GET["project"];
  $query=mysqli_query($conn,"SELECT * FROM tbl_std_project WHERE token='$token'");
  $data=mysqli_fetch_array($query);

}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>AR Project</title>
	<meta property="og:title" content='<?php echo $username; ?> Shared "<?php echo $data["project_name"];?>" as a Augmented Reality Project!'/>
	<meta property="og:image" content="https://pitchar.io/img/Tap24hARInt.EDU.jpg"/>
	<meta property="og:type"   content="website" /> 
					<meta property="og:image:secure_url" content="https://pitchar.io/img/Tap24hARInt.EDU.jpg" /> 
					<meta property="og:image:type" content="image/jpeg" /> 
					<meta property="og:image:width" content="400" /> 
					<meta property="og:image:height" content="300" />
		<meta property="og:site_name" content="<?php echo $data["project_name"];?>"/>
		<meta property="og:description" content="A New project From PITCHAR.IO Project Share With You! Have A look.."/>
		<meta property="og:url" content="https://pitchar.io/facebook-share.php?project=<?php echo $token;?>&user=<?php echo $username;?>"/>
	
</head>
<body>

</body>
</html>

<?php 
//header("refresh:2;url=https://pitchar.io/index.php" );

?>

 