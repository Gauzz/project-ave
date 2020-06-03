
<?php
include('../conn.php');
if (isset($_POST["id"])) {
  $id= $_POST['id'];


  $select = " select * from add_product  where id='$id'" ;
  $query=mysqli_query($conn,$select);
  $num=mysqli_num_rows($query);
     //$row=mysqli_fetch_array($query);
 }
  if($num > 0){
   $row=mysqli_fetch_array($query);


  


?>

<form method="POST" id="addProductForm" enctype="multipart/form-data" action="">
<div class="card-body row">
	<h3 style="text-align:center;margin-left: 435px;color: red;"><b><?php echo $invoice=rand(00000,11111);?></b></h3>
     <div class="col-lg-12 p-t-20">
        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <input required="" onchange="invoice(this.value)" class = "mdl-textfield__input" type = "text" name="invoice_no"  id = "invoice_no" value="<?php echo $id;?>">
            <label style="text-align: center;" class = "mdl-textfield__label">Product Id</label>
        </div>
    </div>
   
     						 <div class="col-lg-6 p-t-20"> 
                                     <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <input class = "mdl-textfield__input" type = "text" name="lastname"  value="<?php echo $row['product_name']; ?>" 
                                        id ="product_name" required="">
                                         <label class = "mdl-textfield__label" >Product Name</label>
                                      </div>
                                    </div>
    <div class="col-lg-6 p-t-20">
        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <input required=""  value="<?php echo  $row['product_vendor']; ?>" class = "mdl-textfield__input" type = "text" name="short_desc" id = "product_vendor">
            <label class = "mdl-textfield__label" >Product Vendor<label>
        </div>
    </div>

 

 <div class="col-lg-6 p-t-20">
        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <input required="" class = "mdl-textfield__input" type = "text" name="short_desc" id = "product_price"  value='<?php echo $row['product_price'];?>'>
            <label class = "mdl-textfield__label" >Product Price<label>
        </div>
    </div>
    <div class="col-lg-6 p-t-20">
        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <input type="hidden" name="offdiscount" value="" class="offdiscount">
            <input class = "mdl-textfield__input"  value="<?php echo $row['discount_off'];?>" type = "text" name="short_desc" id = "offdiscount" >
            <label class = "mdl-textfield__label" >Off Discount<label>
        </div>
    </div>
 <div class="col-lg-6 p-t-20">
        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <input class = "mdl-textfield__input" type = "text" value="<?php echo $row['selling_price'];?>" name="short_desc" id = "selling_price" >
            <label class = "mdl-textfield__label" >Selling Price<label>
        </div>
    </div>
     <div class="col-lg-6 p-t-20">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height txt-full-width">
            <input class="mdl-textfield__input category"  type="text" id="sample3" value="<?php echo $row['product_category'];?>" readonly tabIndex="-1">
            <label for="sample3" class="pull-right margin-0">
                <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
            </label>
            <label for="sample3" class="mdl-textfield__label">Catrgory</label>
            <ul data-mdl-for="sample3" class="mdl-menu mdl-menu--bottom-left mdl-js-menu" >
        <li ><?php echo $row["product_category"]; ?></li> 
            </ul>
        </div>
    </div>
    <div class="col-lg-12 p-t-20">
        <div class = "mdl-textfield mdl-js-textfield txt-full-width">
            <textarea readonly="" class = "mdl-textfield__input" rows =  "4"
            id="ProductsBrief" name="ingredients"><?php echo 
           $row['brief'];?></textarea>
            <label class = "mdl-textfield__label" for = "text7">Brief</label>
        </div>
    </div>  
    <div class="col-lg-12 p-t-20 text-center">
        <button id="submit-all" onclick="submit_data()" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink">Submit</button>
        
        <a href="view-product.php" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-default">Cancel</a>
    </div>
 
</form>

    <?php }else{
    	?>
    	<div class="card-body row">
     <div class="col-lg-12 p-t-20">
        <div class = "mdl-textfield mdl-js-textfield mdl-textfield-floating-label txt-full-width">
            <input required="" onchange="invoice(this.value)" class = "mdl-textfield__input" type = "text" name="" id = "productName">
            <label style="text-align: center;" class = "mdl-textfield__label">Product Id</label>
        </div>
    </div>
    </div>
    <?php 
    	echo "<script>swal('Error','Id does not exist','error');</script>";
    } ?>
    <script>

            function submit_data()
            {
                //alert('submittes');
             var product_name=document.getElementById('product_name').value;
               var product_vendor=document.getElementById('product_vendor').value;
                 var product_price=document.getElementById('product_price').value;
                   var offdiscount=document.getElementById('offdiscount').value;
                   var selling_price=document.getElementById('selling_price').value;
                   var category=$(".category").val();
                    $.ajax({
                  type: "POST",
                  url: "ajax/add_invoice.php",
                  data:{product_name:product_name,product_vendor:product_vendor,product_price:product_price,offdiscount:offdiscount,selling_price:selling_price,category:category},
                  success: function(data){
                 alert(data);
                 // $("#bar-parent2").html(response);
                  }
                });

            }
           
    </script>
   