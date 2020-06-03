<?php  
require '../includes/functions.php';
 if(isset($_POST["employee_id"]))  
 {  
      $output = '';  
      $query = mysqli_query($conn,"SELECT * FROM costomised WHERE id = '".$_POST["employee_id"]."'");  
         $row = mysqli_fetch_array($query);

     $category=$row['category'];
                                                
     $sql_cat = mysqli_query($conn,"SELECT * FROM category WHERE id ='$category'");
     $sql_result_cat = mysqli_fetch_array($sql_cat);
                                                
        $Subcategory=$row["subcategory"];
  $sql_subcat = mysqli_query($conn,"SELECT * FROM subcategory WHERE id ='$Subcategory'");
       $sql_result_subcat = mysqli_fetch_array($sql_subcat);
        
      $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';  
 
      
           $output .= '  
                <tr>  
                     <td width="30%"><label>Category Name</label></td>  
                     <td width="70%">'.$sql_result_cat['category_name'].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Sub Category Name</label></td>  
                     <td width="70%">'.$sql_result_subcat['name'].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Gender</label></td>  
                     <td width="70%">'.$row['gender'].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Size</label></td>  
                     <td width="70%">'.$row['size'].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Quantity</label></td>  
                     <td width="70%">'.$row['quantity'].' </td>  
                </tr> 
                 <tr>  
                     <td width="30%"><label>Overview</label></td>  
                     <td width="70%">'.$row['overview'].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Description</label></td>  
                     <td width="70%">'.$row['description'].' </td>  
                </tr>   
                ';  
       
      $output .= "</table></div>";  
      echo $output;  
 }  

 if(isset($_POST["enquiry_id"]))  
 {  
      $output = '';  
      $query_e = mysqli_query($conn,"SELECT * FROM contact WHERE id = '".$_POST["enquiry_id"]."'");  
         $row_e = mysqli_fetch_array($query_e);

  $date=date_create($row_e["created_at"]); 
       
      $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';  
 
      
           $output .= '  
                <tr>  
                     <td width="30%"><label>Name</label></td>  
                     <td width="70%">'.$row_e['fname'].$row_e['lname'].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Email</label></td>  
                     <td width="70%">'.$row_e['email'].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Subject</label></td>  
                     <td width="70%">'.$row_e['subject'].'</td>  
                </tr>
                <tr>  
                     <td width="30%"><label>Message</label></td>  
                     <td width="70%">'.$row_e['msg'].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Size</label></td>  
                     <td width="70%">'.date_format($date,"d/m/Y").'</td>  
                </tr>  
                 
                ';  
       
      $output .= "</table></div>";  
      echo $output;  
 }  
 ?>
