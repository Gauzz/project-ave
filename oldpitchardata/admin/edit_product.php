<?phprequire '../includes/functions.php';secureAdmin();$token="U".mt_rand(1111111,9999999);?><!DOCTYPE html><html lang="en">  <head>    <?php include 'partials/_style.php'; ?>    <style type="text/css">        .mdl-menu__item:hover    {    width: 100% !important;    }    .mdl-menu__item    {    width: 100% !important;    }    .mdl-menu__container{    width: 100% !important;    }    .mdl-menu__outline{    width: 100% !important;    }    .field-icon {    float: right;    margin-left: -25px;    margin-top: -25px;    position: relative;    z-index: 2;    }    </style>  </head>  <!-- END HEAD -->  <body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">    <div class="page-wrapper">      <!-- start header -->      <?php include 'partials/_header.php'; ?>      <!-- end header -->      <!-- start page container -->      <div class="page-container">        <!-- start sidebar menu -->        <?php include 'partials/_sidebar.php'; ?>        <!-- end sidebar menu -->        <!-- start page content -->        <div class="page-content-wrapper">          <div class="page-content" style="min-height: 800px !important;">            <div class="page-bar">              <div class="page-title-breadcrumb">                <div class=" pull-left">                  <div class="page-title">Add Product</div>                </div>                <ol class="breadcrumb page-breadcrumb pull-right">                  <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>                </li>                <li class="active">Add Product</li>              </ol>            </div>          </div>          <div class="col-md-12 col-sm-12">            <div class="card card-box">              <div class="card-head">              Add Product</header>                                        </div>            <div class="card-body " id="bar-parent1">              <?php              if(isset($_GET['token']))              {              $token=$_GET['token'];              $sql=mysqli_query($conn," select * from add_product where token='$token' ");              $row=mysqli_fetch_array($sql);              //$token=$row['token'];              }                            if(isset($_POST['sub']))              {                            $product_name=mysqli_real_escape_string($conn,$_POST['product_name']);              $product_status=mysqli_real_escape_string($conn,$_POST['product_status']);              $product_prise=mysqli_real_escape_string($conn,$_POST['product_prise']);              $vendor=mysqli_real_escape_string($conn,$_POST['vendor']);              $product_discount=mysqli_real_escape_string($conn,$_POST['product_discount']);              $stock_qty=mysqli_real_escape_string($conn,$_POST['stock_qty']);              $off_discount=mysqli_real_escape_string($conn,$_POST['off_discount']);              $stock_weight=mysqli_real_escape_string($conn,$_POST['stock_weight']);              $selling_price=mysqli_real_escape_string($conn,$_POST['selling_price']);              $category=mysqli_real_escape_string($conn,$_POST['category']);              $subcategory=mysqli_real_escape_string($conn,$_POST['subcategory']);              $brand_id=mysqli_real_escape_string($conn,$_POST['brand']);              $color=mysqli_real_escape_string($conn,$_POST['color']);              $size=mysqli_real_escape_string($conn,$_POST['size']);              $description=mysqli_real_escape_string($conn,$_POST['description']);              $sql=mysqli_query($conn," select * from brand where id ='$brand_id' ");              $r=mysqli_fetch_array($sql);              $cat_name=mysqli_real_escape_string($conn,$r['cat_name']);              $cat_id=$r['cat_id'];              $sub_cat_name=mysqli_real_escape_string($conn,$r['sub_cat_name']);              $sub_cat_id=$r['sub_cat_id'];              $brand_name=mysqli_real_escape_string($conn,$r['name']);              $query=mysqli_query($conn,"UPDATE add_product set product_name='$product_name',status='$product_status',cat_id='$cat_id',cat_name='$cat_name',sub_cat_id='$sub_cat_id',sub_cat_name='$sub_cat_name',brand_id='$brand_id',brand_name='$brand_name',product_color='$color',product_size='$size',product_vendor='$vendor',product_price='$product_prise',product_dis='$product_discount',discount_off='$off_discount',selling_price='$selling_price',Product_quantity='$stock_qty',product_weight='$stock_weight',brief='$description' where token='$token'");              if($query==true){              foreach ($_FILES["image"]["name"] as $i => $pImage) {              $image= $_FILES["image"]["name"][$i];              $temp=$_FILES["image"]["tmp_name"][$i];              $imagetoken=$token.$image;              // echo  $imagetoken;              move_uploaded_file($temp,"uploads/".$imagetoken);                                          $update=mysqli_query($conn," update  product_image set name='$imagetoken' where token='$token'");              if($update==true)              {              echo " <script>swal('done','Product Updated Successfully','success');</script> ";              }              }              }              }              ?>              <form class="form-horizontal" method="post" enctype="multipart/form-data">                <div class="row">                  <div class="col-md-6 col-sm-6">                    <!-- text input -->                    <div class="form-group">                      <label>Product Name</label>                      <input type="text" class="form-control" name="product_name" required="" placeholder="Product Name" value="<?php echo $row['product_name'];?>">                    </div>                    <div class="form-group">                      <label>Product Price</label>                      <input type="number"  class="form-control" name="product_prise" required="" placeholder="Product Price"                      id="price" value="<?php echo $row['product_price'];?>">                    </div>                    <div class="form-group">                      <label>Product Discount</label>                      <input type="text" maxlength="2" class="form-control" name="product_discount" onkeyup="percent(this.value)" required="" id = "discount" placeholder="Product Discount"                      value="<?php echo $row['product_dis'];?>">                    </div>                    <div class="form-group">                      <label>Off Discount</label>                      <input type="number" class="form-control" name="off_discount" id = "off_discount" placeholder="Off Discount"  required="" value="<?php echo $row['discount_off'];?>">                    </div>                    <div class="form-group">                      <label>Selling Prise</label>                      <input type="number" required="" class="form-control" name="selling_price" id = "selling_price" placeholder="Selling Price" value="<?php echo $row['selling_price'];?>">                    </div>                    <div class="form-group" id='sub'>                      <label> Sub Category</label>                      <select  required="" class="form-control" onchange="get_brand(this.value)" name="subcategory" ="" >                        <option  selected="" value="<?php echo $row['sub_cat_id'];?>"><?php echo $row['sub_cat_name'];?></option>                        <option value="" disabled="">Select Sub                        Category</option>                        <?php                        $sel1=mysqli_query($conn," select * from subcategory ");                        while($cat=mysqli_fetch_array($sel1)){                        ?>                        <option value="<?php echo $cat['sub_cat_id']?>"><?php echo $cat['sub_cat_name']?></option>                        <?php }?>                                              </select>                    </div>                  </div>                  <div class="col-md-6 col-sm-6">                    <!-- textarea -->                    <div class="form-group">                      <label>Status</label>                      <?php if($row['status']=='1'){?>                      <select required="" class="form-control" name="product_status" ="" >                        <option value="1" selected="">Instock</option>                        <option disabled="">Select Status</option>                        <option value="0">Outstock</option>                                                                      </select>                      <?php }else{?>                      <select required="" class="form-control" name="product_status" ="" >                        <option value="0" selected="">Outstock</option>                        <option disabled="">Select Status</option>                        <option value="1" >Instock</option>                                              </select>                      <?php }?>                    </div>                    <div class="form-group">                      <label>Vendor</label>                      <select class="form-control" name="vendor" required="" >                        <option selected="" value="<?php echo $v_id=$row['product_vendor'];?>">                          <?php  $sql1=mysqli_query($conn,"select * from add_vendor where id='$v_id'");                          $r=mysqli_fetch_array($sql1);                          echo $r['name'];                          ?>                        </option>                        <option value=""  disabled="">Select Vendor</option>                        <?php                        $sel=mysqli_query($conn," select * from add_vendor where id !='$v_id' ");                        while($ven=mysqli_fetch_array($sel)){                        ?>                        <option value="<?php echo $ven['id']?>"><?php echo $ven['name']?></option>                        <?php }?>                                              </select>                    </div>                    <div class="form-group">                      <label>Stock Qty</label>                      <input required="" type="text" class="form-control" name="stock_qty" placeholder="Stock Quintity" value="<?php echo $row['Product_quantity'];?>">                    </div>                    <div class="form-group">                      <label>Product Weight:<span style="color: orange;">Optional[ml:Kg]</span></label>                      <input type="text" class="form-control" name="stock_weight" placeholder="Product Weight" value="<?php echo $row['product_weight'];?>">                    </div>                    <div class="form-group">                      <label>Category</label>                      <select required="" class="form-control" onchange="get_sub_cat(this.value)" name="category" required="" >                        <option selected="" value="<?php echo $old_cat=$row['cat_id'];?>"><?php                        echo $row['cat_name'];?></option>                        <option value=""  disabled="">Select                        Category</option>                        <?php                        $sel1=mysqli_query($conn," select * from category where id !='$old_cat' ");                        while($cat=mysqli_fetch_array($sel1)){                        ?>                        <option value="<?php echo $cat['id']?>"><?php echo $cat['categoryname']?></option>                        <?php }?>                      </select>                    </div>                    <div class="form-group" id="brand">                      <label>Brand</label>                      <select  required="" class="form-control"  name="brand">                        <option selected="" value="<?php echo $row['brand_id'];?>"><?php                        echo $row['brand_name'];?></option>                        <option value=""  disabled="">Brand                        </option>                        <?php                        $sel1=mysqli_query($conn," select * from brand ");                        while($cat=mysqli_fetch_array($sel1)){                        ?>                        <option value="<?php echo $cat['id']?>"><?php echo $cat['name']?></option>                        <?php }?>                                              </select>                    </div>                  </div>                </div>                <div class="col-md-12 col-sm-12">                  <div class="form-group">                    <label class="control-label">Color:<span style="color: orange">(Optional)</span></label>                    <input type="text" name="color"  class="tags tags-input" data-type="tags" id="tags1535107134574" value="<?php echo $row['product_color'];?>">                  </div>                </div>                <div class="col-md-12 col-sm-12">                  <div class="form-group">                    <label class="control-label">Size:<span style="color:orange">(Optional)</span></label>                    <input type="text" name="size" class="tags tags-input" data-type="tags" value='<?php echo $row['product_size']?>'  id="tags1535107134574" >                  </div>                </div>                <div class="col-md-12 col-sm-12">                  <div class="form-group">                    <label class="control-label">Description</span></label>                    <textarea class="form-control" required="" placeholder="Product Description" name="description"><?php echo $row['brief'];?></textarea>                  </div>                </div>                <div  id='preview' class="col-xl-3 col-lg-4 col-md-6 col-sm-12 m-b-20  class="img-fluid img-thumbnail"">  </div>                <div class="col-md-12 col-sm-12">                  <div class="form-group">                    <label class="control-label">Main Image</span></label>                    <input required="" type="file" multiple="" onchange="previewImages()" name="image[]" class="form-control" id="userImage" >                  </div>                </div>                <div id="img_res">                  <?php                  $token=$row['token'];                  $get_img=mysqli_query($conn,"select * from product_image where token='$token'");                  while($all_img=mysqli_fetch_array($get_img)){                  ?>                  <div class="col-md-3 float-left center" id="img_<?php echo $all_img['id'];?>">                    <div class="col-md-12 center">                      <img src="uploads/<?php echo $all_img['name'];?>" id="imgshowhere<?php echo $all_img['id'];?>" style="height: 150px;width: 150px;border-radius: 50% 50%;box-shadow: 0px 0px 15px #888888;">                    </div><br>                    <button type="button" onclick="delete_img(<?php echo $all_img['id'];?>);" data-id="" class="btn delete-product-image" style="text-align: center;">Remove</button>                    <button onclick="document.getElementById('trig<?php echo $all_img['id'];?>').click()"  type="button" data-id="" class="btn update-image" style="text-align: center;">Change</button>                    <input  type="file" name="file" style="display: none;" id='trig<?php echo $all_img['id'];?>' onchange="updt_img(<?php echo $all_img['id']?>);" >                    <button style="display: none;" type="button" class="upload3" value="Upload">Upload</button>                  </div>                  <?php }?>                </div>                              </div>              <div class="form-group">                <div class="offset-md-5 col-md-9">                  <button type="submit" name="sub" class="btn btn-info">Submit</button>                  <button type="button" class="btn btn-default">Cancel</button>                </div>              </div>            </form>                      </div>          <script type="text/javascript">          function updt_img(id)          {          //console.log();          // var img=document.getElementById('trig'+id);          //    var file = photo.files[0];          // alert (file);          // alert(id);          // $.ajax({          //   type: "POST",          //   url: "ajax/updt_img.php",          //   data:{img:img,id:id},          //   success: function(response){          //   $("#img_"+id).html(response);          //   }          // });          }          function fun()          {          document.getElementById('trig').click();          }          function previewImages() {          var preview = document.querySelector('#preview');                    if (this.files) {          [].forEach.call(this.files, readAndPreview);          }          function readAndPreview(file) {          // Make sure `file.name` matches our extensions criteria          if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {          return alert(file.name + " is not an image");          } // else...                    var reader = new FileReader();                    reader.addEventListener("load", function() {          var image = new Image();          image.height = 100;          image.title  = file.name;          image.name='image[]';          image.src    = this.result;          //image.class  =img-fluid img-thumbnail;          preview.appendChild(image);          }, false);                    reader.readAsDataURL(file);                    }          }          document.querySelector('#userImage').addEventListener("change", previewImages, false);          function percent(discount)            {              var price=$("#price").val();              if(price=="")              {                swal("Opps!","Please Enter Price First","warning");              }else{              var off=price*discount/100;              var off_discount=Math.floor(off);              var selling_price=price-off_discount;              $("#off_discount").val(off_discount);                $("#selling_price").val(selling_price);              }                          }                    </script>        </div>      </div>    </div>  </div></div><?php include 'partials/_footer.php'; ?><!-- end footer --></div><?php include 'partials/_script.php'; ?><script type="text/javascript">function  get_sub_cat(id){var edit='edit';$.ajax({type: "POST",url: "ajax/get_sub_cat.php",data:{id:id,edit:edit},success: function(response){$("#sub").html(response);}});}function  get_brand(id){var edit='edit';$.ajax({type: "POST",url: "ajax/get_brand.php",data:{id:id,edit:edit},success: function(response){$("#brand").html(response);}});//alert(id);}function delete_img(id){$.ajax({type: "POST",url: "ajax/delete_image.php",data:{id:id},success: function(response){$("#img_res").html(response);}});}</script></body></html>