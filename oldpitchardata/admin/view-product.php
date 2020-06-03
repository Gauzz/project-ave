<?php
require '../includes/functions.php';
	if(isset($_POST['token']))
	{
		$productToken=$_POST['token'];
		$deleteVariant=deleteRow('productInfo',"token='$productToken'");
		if($deleteVariant)
		{
			$deleteProduct=deleteRow('products',"productToken='$productToken'");
			if($deleteProduct)
			{
				returnJson(1,"Product Deleted Successfully!");
			}else
			{
				exit(json_encode(["response" => ["code" => "0","msg" =>"Something Went Wrong!"]]));
			}
		}else
		{
			exit(json_encode(["response" => ["code" => "0","msg" =>"Something Went Wrong!"]]));
		}
		exit();
	}
	if (isset($_POST["changeStatus"])) {
		$id=$_POST["changeStatus"];
		$queryGetId=select("productInfo","id='$id'");
		$fetchDetails=fetch($queryGetId);
			if ($fetchDetails["status"]=='0') {
				$status='1';
			}
			if ($fetchDetails["status"]=='1') {
				$status='0';
			}
				$changeStatus=update("productInfo",["status" => $status],"id='$id'");
				if ($changeStatus) {
					response(["code" => "1" ,"status" => $status]);
				}
				else{
					response(["code" => "0"]);
				}
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php
		include 'partials/_style.php';
		?>
		<link href="assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
	</head>
	<!-- END HEAD -->
	<body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
		<div class="page-wrapper">
			<!-- start header -->
			<?php include 'partials/_header.php'; ?>
			<!-- end header -->
			<!-- start page container -->
			<div class="page-container">
				<!-- start sidebar menu -->
				<?php include 'partials/_sidebar.php'; ?>
				<!-- end sidebar menu -->
				<!-- start page content -->
				<div class="page-content-wrapper">
					<div class="page-content">
						<div class="page-bar">
							<div class="page-title-breadcrumb">
								<div class=" pull-left">
									<div class="page-title">All Product</div>
								</div>
								<ol class="breadcrumb page-breadcrumb pull-right">
									<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
								</li>
								<li><a class="parent-item" href="#">Product</a>&nbsp;<i class="fa fa-angle-right"></i>
							</li>
							<li class="active">All Product</li>
						</ol>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="card-box">
							<div class="card-head pl-3">
								All Product List
							</div>
							<div class="card-body ">
								<div class="table-scrollable">
									<table class="table table-hover table-checkable order-column full-width" id="example4">
										<thead>
											<tr>
												<!-- 		<th class="center">#</th>
												<th class="center">image</th>
												<th class="center">Name</th>
												<th class="center">quantity</th>
												<th class="center">Brand</th>
												<th class="center">Device Type</th>
												<th class="center">Device</th>
												<th class="center">Accessory Type</th>
												<th class="center">Product Category</th>
												<th class="center">Product Type</th>
												<th class="center">Base Price</th>
												<th class="center">Discounted %</th>
												<th class="center">Discounted Price</th>
												<th class="center">overview</th>
												<th class="center">gender</th>
												<th class="center">Status</th>
												<th class="center">Deal Status</th>
												<th class="center">Action</th> -->
												<th class="center">#</th>
												<th class="center">image</th>
												<th class="center">Name</th>
												<th class="center">Brand</th>
												<th class="center">Device Type</th>
												<th class="center">Device</th>
												<th class="center">Accessory Type</th>
												<th class="center">Product Category</th>
												<th class="center">Product Type</th>
												<th class="center">Theme</th>
												<th class="center">Short Description</th>
												<th class="center">Description</th>
												<th class="center">gender</th>
												<th class="center">Variant</th>
												<th class="center">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$i=1;
											$query=mysqli_query($conn,"SELECT * FROM productInfo where complete ='1' ORDER BY id DESC");
											while ($data=mysqli_fetch_array($query))
											{
											?>
											<tr class="odd gradeX tr<?php echo $data['token'];?>">
												<td class="center"><?php echo $i++; ?></td>
												<td class="user-circle-img sorting_1">
													<?php
														$token=$data["token"];
														$tokenquery=mysqli_query($conn,"SELECT * FROM products WHERE productToken='$token' limit 1");
														$r=mysqli_fetch_array($tokenquery);
														$imgToken=$r['token'];
														$selectImage=mysqli_query($conn,"SELECT * FROM product_image WHERE token='$imgToken' ORDER BY primaryImage DESC");
														$row=mysqli_fetch_array($selectImage);
													?>
													<a href="uploads/product-images/<?php echo $row["name"]; ?>"><img src="uploads/product-images/<?php echo $row["name"]; ?>" height="50" width="50" >
													</td>
													<td class="center"><?php echo $data["product_name"]; ?></td>
													<td class="center">
														<?php $catid=$data["brand"];
														$sql=mysqli_query($conn,"SELECT * FROM brand where id='$catid'");
														$r=mysqli_fetch_array($sql);
														echo $r['category_name'];
														?>
													</td>
													<td class="center">
														<?php $device_type=$data["device_type"];
														$sqldeviceT=mysqli_query($conn,"SELECT * FROM category where id='$device_type'");
														$deviceT=mysqli_fetch_array($sqldeviceT);
														echo $deviceT['name'];
														?>
													</td>
													<td class="center">
														<?php $device=$data["device"];
														$sqldevice=mysqli_query($conn,"SELECT * FROM subcategory where id='$device'");
														$device=mysqli_fetch_array($sqldevice);
														echo $device['name'];
														?>
													</td>
													<td class="center">
														<?php $accessory_type=$data["accessory_type"];
														$sqlaccessory_type=mysqli_query($conn,"SELECT * FROM multi_sub_category where id='$accessory_type'");
														$fetchaccessory_type=mysqli_fetch_array($sqlaccessory_type);
														echo $fetchaccessory_type['name'];
														?>
													</td>
													<td class="center">
														<?php $product_cat=$data["product_cat"];
														$sqlproduct_cat=mysqli_query($conn,"SELECT * FROM multi_sub_sub_category where token='$product_cat'");
														$fetchproduct_cat=mysqli_fetch_array($sqlproduct_cat);
														echo $fetchproduct_cat['name'];
														?>
													</td>
													<td class="center">
														<?php $product_type=$data["product_type"];
														$sqlproduct_type=mysqli_query($conn,"SELECT * FROM product_type where id='$product_type'");
														$fetchproduct_type=mysqli_fetch_array($sqlproduct_type);
														echo $fetchproduct_type['product_type'];
														?>
													</td>
													<td class="center">
														<?php $theme=$data["theme"];
														$sqltheme=mysqli_query($conn,"SELECT * FROM product_theme where id='$theme'");
														$fetchtheme=mysqli_fetch_array($sqltheme);
														echo $fetchtheme['name'];
														?>
													</td>
													<td class="center"><?php echo $data["short_description"]; ?></td>
													<td class="center"><?php echo $data["description"]; ?></td>
													<td class="center"><?php echo $data["gander"]; ?></td>
													<td class="center">
														<a href="view-product-info.php?token=<?php echo $data['token']; ?>">
															<?php
																$getVariant=query("SELECT * FROM products WHERE productToken='$token'");
																$num=mysqli_num_rows($getVariant);
																echo $num;
														?></a>
													</td>
													<td class="">
														<a  href="view-product-info.php?token=<?php echo $data['token']; ?>" class="tooltips btn btn-tbl-edit btn-xs bg-info" data-placement="top" data-original-title="View Variant">
															<i class="fa fa-eye"></i>
														</a>
														
														<a href="edit-product.php?token=<?php echo $data["token"];?>" class="tooltips  btn btn-tbl-edit btn-xs" data-placement="top" data-original-title="Edit Product Details">
															<i class="fa fa-pencil"></i>
														</a>
														<button  id="status<?php echo $data["id"];?>" class="tooltips btn btn-tbl-edit btn-xs <?php echo ($data["status"]=='1') ? "bg-success" : "bg-danger"; ?> status" value="<?php echo $data["id"];?>"  data-placement="top" data-original-title="<?php echo ($data["status"]=='1') ? "Active" : "Deactive"; ?>">
														<i class="fa <?php echo ($data["status"]=='1') ? " fa-thumbs-up" : "fa-thumbs-down"; ?>"></i>
														</button>
														
														<button type="submit" id="deleteParentProduct" data-id="<?php echo $data['id']; ?>" value="<?php echo $data['token']; ?>" class="btn btn-tbl-delete btn-xs deleteParentProduct">
														<i class="fa fa-trash-o"></i>
														</button>
														
													</td>
												</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal -->
			<div class="modal fade" id="myModal" role="dialog">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Modal Header</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body">
							<p>This is a large modal.</p>
						</div>
						
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include 'partials/_footer.php'; ?>
</div>
<?php include 'partials/_script.php'; ?>
<script type="text/javascript">
	$(document).ready(function() {
		$(".deleteParentProduct").on('click',function() {
			var token=$(this).val();
			var id=$(this).data("id");
			swal({
				title: "Are you sure?",
				text: "Once deleted, you will not be able to recover this imaginary file!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
				})
					.then((willDelete) => {
						if (willDelete) {
						$.ajax({
								type:'POST',
								url: 'view-product.php',
								data:{token:token},
								dataType:'json',
								success:function(data){
									console.log(data);
									if(data.response.code=='1')
									{
										swal("Done",data.response.msg,"success");
										$(".tr"+token).hide('slow');
									}
									if(data.response.code=='0')
									{
										swal("Opps!",data.response.msg,"error");
										}
								},
								error: function(data){
									console.log("error");
									console.log(data);
								}
							});
						}
						else {
						swal("Your imaginary file is safe!");
						}
					});
					});
					});
		$(".status").click(function() {
			/* Act on the event */
			var id=$(this).val();
			
			$.ajax({
				url: 'view-product.php',
				type: 'POST',
				dataType: 'json',
				data: {changeStatus: id},
			})
			.done(function(data) {
				if (data.response.code=='1') {
					if (data.response.status=='1') {
						$("#status"+id).removeClass('bg-danger');
						$("#status"+id).addClass('bg-success');
						$("#status"+id).html("<i class='fa fa-thumbs-up'></i>");
						$("#status"+id).attr("data-original-title","Active");
					}
					if (data.response.status=='0') {
						$("#status"+id).removeClass('bg-success');
						$("#status"+id).addClass('bg-danger');
						$("#status"+id).html("<i class='fa fa-thumbs-down'></i>");
						$("#status"+id).attr("data-original-title","Deactive");
					}
				}
			})
			.fail(function() {
				console.log("error");
			})
			.always(function(data) {
				console.log(data);
			});
			
		});
</script>
</body>
</html>