 <?php
if(isset($_POST["limit"], $_POST["start"]))
{
$conn=mysqli_connect("localhost","arvrinte_Yashgup","_pmx4vNuySob","arvrinte_project");
 $query = "SELECT * FROM tbl_customer ORDER BY countries_id ASC LIMIT ".$_POST["start"].", ".$_POST["limit"]."";
 $result = mysqli_query($conn, $query);
 while($row = mysqli_fetch_array($result))
 {
  echo '
  <h3>'.$row["CustomerID"].'</h3>
  <p>'.$row["CustomerName"].'</p>
  <p>'.$row["Address"].'</p>
  <p>'.$row["Country"].'</p>

  <hr />
  ';
 }
}
 
?>