<?php
include('../conn.php');
 $id=$_POST['id'];
 $sql=mysqli_query($conn," delete from subcategory where sub_cat_id = '$id' ");


     
     $cat=mysqli_query($conn,"SELECT * FROM subcategory");

       while ($row=mysqli_fetch_array($cat)) {
                                                  ?>
            <tr class="">
                 <td><?php echo $row["sub_cat_id"];?></td>
                <td><?php echo $row["sub_cat_name"];?></td>
              	 <td><?php echo $row["sub_cat_description"];?></td>
                <td><?php echo $row["cat_name"];?></td>
                 <td><?php echo $row["stock"];?></td>
           		  <td class="">
                <a href="edit-subcat.php?id=<?php echo $row['sub_cat_id'];?>" class="btn btn-tbl-edit btn-xs">
                    <i class="fa fa-pencil"></i>
                </a>
                <button type="submit" onclick="delete_rec(<?php echo $row['sub_cat_id'];?>);" class="btn btn-tbl-delete btn-xs deleteRow">
                    <i class="fa fa-trash-o"></i>
                </button>
             
           		 </td>
           </tr> 
                <?php }?>