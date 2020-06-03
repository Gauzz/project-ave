<?php
ini_set('display_errors', 1);
$connect=mysqli_connect("localhost","arvrinte_Yashgup","_pmx4vNuySob","arvrinte_project");

if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($connect, $_POST["query"]);
	$query = "
	SELECT * FROM tbl_std_project WHERE name LIKE '%".$search."%' OR project_name LIKE '%".$search."%' OR email LIKE '%".$search."%' OR subject LIKE '%".$search."%' OR country LIKE '%".$search."%' ";
}
else
{
	$query = "SELECT * FROM tbl_std_project ORDER BY id";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{ ?>
 		<div class="table-responsive">
					<table class="table table bordered">
						<tr>
							<th>Customer Name</th>
							<th>Address</th>
							<th>City</th>
							<th>Postal Code</th>
							<th>Country</th>
						</tr> 
<?php	while($row = mysqli_fetch_array($result)) {
?>
			<tr>
				<td><?= $row["name"] ?></td>
				<td><?= $row["project_name"] ?></td>
				<td><?= $row["email"] ?></td>
				<td><?= $row["subject"] ?></td>
				<td><?= $row["country"] ?></td>
			</tr>
<?php
	}
 
}
else
{
	echo 'Data Not Found';
}
?>
 