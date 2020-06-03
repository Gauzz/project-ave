<?php

 
 $thefile = $_FILES['file'];
 if(!empty($thefile))
 {
     echo "Success!";
 }
 else
 {
     echo "Failed!";
 }
 
?> 