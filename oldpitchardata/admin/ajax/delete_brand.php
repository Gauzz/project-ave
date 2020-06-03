<?php
include('../conn.php');
 $id=$_POST['id'];
 $delete=mysqli_query($conn," delete from brand where id='$id'");
 if($delete==true){
 $brand=mysqli_query($conn,"SELECT * FROM brand");

  while ($getbrand=mysqli_fetch_array($brand)) {
                                                  ?>
                <tr class="">
                     <td><?php echo $getbrand["id"];?></td>
                    <td><?php echo $getbrand["name"];?></td>
                   <td><?php echo $getbrand["description"];?></td>
                    <td><?php echo $getbrand["cat_name"];?></td>
                     <td><?php echo $getbrand["sub_cat_name"];?></td>
                 <td class="">
                <a href="edit-brand.php?id=<?php echo $getbrand['id'];?>" class="btn btn-tbl-edit btn-xs">
                    <i class="fa fa-pencil"></i>
                </a>
                <button type="submit" onclick="delete_rec(<?php echo $getbrand['id'];?>);" class="btn btn-tbl-delete btn-xs deleteRow">
                    <i class="fa fa-trash-o"></i>
                </button>
             
            </td>
                                                    </tr> 
                                                    <?php }?> 
  <?php }?>