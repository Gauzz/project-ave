 <?php
session_start();
include 'conn.php';
 if(!isset($_SESSION[login])){
     header("Location:register.php");
 }
       $email= $_SESSION["user_mail"];
           $status= $_SESSION["user_occ"];
         $query1=mysqli_query($conn,"SELECT * FROM tbl_$status WHERE email='$email'");
         $userdata=mysqli_fetch_array($query1);
         
   
         
  $id=1;
   $start=0;
   $limit=12;
    
	if(isset($_GET["id"]))
{
	$id=$_GET["id"];
	$start=($id-1)*$limit;
}

?>

<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Admin Dashboard</title>
      <!-- Tell the browser to be responsive to screen width -->
 
       
      <style>
         .bg-teal-gradient{background:white !important;}
      </style>
   </head>
   <body class="hold-transition skin-blue sidebar-mini">
      <div class="wrapper">

         <!-- Left side column. contains the logo and sidebar -->

         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <div class="row">
                  <div class="col-md-6">
                     <h2>
                        PITCHAR.IO Projects
                     </h2>
                  </div>
                  <div class="col-md-6">
                     <ol class="breadcrumb">
                        <div class="input-group">
      
                           <span class="input-group-btn">
                           <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                           </button>
                           </span>
                        </div>
                     </ol>
                  </div>
               </div>
            </section>
            <!-- Main content -->
            <section class="content">
               <!-- /.row -->
               <!-- Main row -->
               <div class="row">
                  <!-- Left col -->
                  <!-- /.Left col -->
                  <!-- right col (We are only adding the ID to make the widgets sortable)-->
                  <section class="col-lg-6 connectedSortable">
                     <!-- solid sales graph -->
                     <div class="box box-solid bg-teal-gradient">
                        <div class="box-header">
                           <div class="box-tools pull-right">
                              <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                              </button>
                              <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                              </button>
                           </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer no-border">
                           <div class="row">
                              <a href="choose.php">
                                 <div class="col-lg-12">
                                    <div class="col-lg-3">
                                       <img src="dist/img/plus.png" class="stimg">
                                    </div>
                                    <div class="col-lg-7 col-lg-offset-1"id="stdetails">
                                       <h3>Create an AR Project</h3>
                                    </div>
                                 </div>
                              </a>
                           </div>
                           <!-- /.row -->
                        </div>
                        <!-- /.box-footer -->
                     </div>
                     <!-- /.box -->
                     <!-- /.box -->
                  </section>
                  <!-- right col -->
               </div>
               <div class="row">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

			<input type="text" name="search_text" id="search_text" placeholder="Search by Customer Details" class="form-control" />
			<div id="result"></div>

<script>

$(document).ready(function(){
	load_data();
	function load_data(query)
	{
		$.ajax({
			url:"search.php",
			method:"post",
			data:{query:query},
			success:function(data)
			{
			$('#result').html(data);
			}
		});
	}
	$('#search_text').keyup(function(){
		var search = $(this).val();
	if(search != '')
		{
			load_data(search);
		}
		else
		{
			load_data();			
		}
	});
});
</script>


 

 

                  <!-- right col -->
               </div>
            
    
                 
                  
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="col-sm-5">
                           <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>
                        </div>
                        <div class="col-sm-7">
                           <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                              <ul class="pagination">
  					
  					<?php
$rows=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM tbl_std_project "));
$total=ceil($rows/$limit);

if($id>1)
{
	echo '<li class="disabled" ><a href="?id='.($id-1).'"">&laquo; </a></li>';
}

for($i=1;$i<=$total;$i++)
{
	echo "<li><a href=?id=".($i)."' >$i</a></li>";
}
if($id!=$total)
{
	
	
	echo "<li><a href='?id=".($id+1)."'>&raquo;</a></li>";
}



 
?>
                              
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- right col -->

               <!-- /.row (main row) -->
            </section>
            <!-- /.content -->
         </div>
         <!-- /.content-wrapper -->
         <?php include'footer.php'; ?>

  
         <div class="control-sidebar-bg"></div>
      </div>
    

 
      
      
   </body>
</html>