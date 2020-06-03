<?php 
	require_once 'config.php';

	$redirectURL="https://pitchar.io/facebook/fb-callback.php";

	$permissions =['email'];
	  $logiURL=$helper->getLoginUrl($redirectURL,$permissions);

 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
</head>
<body>
 
 <div class="container mt-5">
 	<div class="row">
 		<div class="col-md-6 offset-md-3" align="center">
	 		 <div class="card">
	 		 	<div class="card-header">Log Ins</div>
	 		 	<div class="card-body">
	 		 		<div class="form-group">

	 		 			<input type="" class="form-control mt-3" name="" placeholder="Full Email:">

	 		 			<input type="" class="form-control mt-3" name="" placeholder="Full Password:">

	 		 		
	 		 		</div>
	 		 	</div>
	 		 	<div class="card-footer p-0 pb-3">
	 		 			<button class="btn btn-primary  mt-3" >Log In</button>
	 		 		 
	 		 			<a href="<?php echo $logiURL ?>" class="btn btn-primary  mt-3"  >Login With facebook</a>
	 		 	</div>
	 		 </div>
 		</div>
 	</div>
 </div>








<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>