<?php
header('Content-Type: application/json');
require '../../includes/functions.php';

/*Add Promo Code*/
if (isset($_POST["addPromoCode"])) {
    $getpromo = mysqli_real_escape_string($conn,$_POST['promocode']);
    $promocode = strtoupper($getpromo);
    $token = token(12);
    $selectGiftCard=select("giftpromocode","promocode='$promocode'");
    if (howMany($selectGiftCard)=='0') {
    $query = select("promocode", "promocode='$promocode'");
    if (howMany($query) == '1') {
        exit(json_encode(array(
            'response' => array(
                "code" => '0',
                "msg" => 'This Promo Code Already Exists'
            )
        )));
    }
    else {
        $image = rand() . ".jpg";
        $bannerName = (!empty($_FILES["banner"]["name"])) ? $image : "no-image.png";
        if (!empty($_FILES["banner"]["name"])) {
            if ($_FILES["banner"]["type"] == "image/jpeg" OR $_FILES["banner"]["type"] == "image/png" OR $_FILES["banner"]["type"] == "image/jpg") {
                move_uploaded_file($_FILES["banner"]["tmp_name"], '../uploads/slider/' . $image);
            }
            else {
                exit(json_encode(array(
                    "response" => array(
                        "code" => "0",
                        "msg" => "File type Must be Image"
                    )
                )));
            }
        }

        $send = saveData("promocode", ["promocode" => $promocode, "promocode_persentage" => $_POST["promocodePercentage"], "exp_date" => $_POST["expDate"], "description" => $_POST["desc"],"banner" => $bannerName, "token" => $token ]);
        
        if ($send) {
            
            saveData("slider", ["title" => $promocode, "heading" => $_POST["promocodePercentage"],"description" => $_POST["desc"],"image" => $bannerName, "token" => $token ]);
            $_SESSION["add"] = "true";
            exit(json_encode(array(
                'response' => array(
                    "code" => '1',
                    "msg" => 'New Promo Code Created Successfully!'
                )
            )));
        }
        else {
            exit(json_encode(array(
                'response' => array(
                    "code" => '0',
                    "msg" => 'Opps There is An Error In Adding Promo Code!'
                )
            )));
        }
    }
        }
        else{
            returnJson(0,"This Promo Code is Already Axists in GiftCard Table!");
        }
}


/*Delete Promo Code*/

 if (isset($_POST["deletePromoCode"])) {
        $token=$_POST["deletePromoCode"];
        $query=deleteRow("promocode","token='$token'");
        if ($query) {
            deleteRow("slider","token='$token'");
          exit(json_encode(array('response' => array("code" =>'1', "msg" => 'Promo Code deleted Successfully!'))));
        }
        else{
             exit(json_encode(array('response' => array("code" =>'0', "msg" => 'Something went wrong!'))));
        }
    }

/*Edit Promo Code*/
if (isset($_POST["editPromoCode"])) {
    $token = $_POST["token"];
    $getpromo = mysqli_real_escape_string($conn,$_POST['promocode']);
    $promocode = strtoupper($getpromo);
    $query = select("promocode", "token='$token'");
    if (howMany($query) == '0') {
        exit(json_encode(array(
            'response' => array(
                "code" => '0',
                "msg" => 'This Promo Code Not Exists On Database'
            )
        )));
    }
    else {
        $fetchPromo = fetch($query);
        $image = rand() . ".jpg";
        $bannerName = (!empty($_FILES["banner"]["name"])) ? $image : $fetchPromo["banner"];
        if (!empty($_FILES["banner"]["name"])) {
            if ($_FILES["banner"]["type"] == "image/jpeg" OR $_FILES["banner"]["type"] == "image/png" OR $_FILES["banner"]["type"] == "image/jpg") {
                move_uploaded_file($_FILES["banner"]["tmp_name"], '../uploads/slider/' . $image);
            }
            else {
                exit(json_encode(array(
                    "response" => array(
                        "code" => "0",
                        "msg" => "File type Must be Image"
                    )
                )));
            }
        }

        $send = update("promocode", ["promocode" => $promocode, "promocode_persentage" => $_POST["promocodePercentage"], "exp_date" => $_POST["expDate"], "description" => $_POST["desc"],"banner" => $bannerName ],"token='$token'" );
        
        if ($send) {
            
            update("slider", ["title" => $promocode, "heading" => $_POST["promocodePercentage"],"description" => $_POST["desc"],"image" => $bannerName ],"token='$token'");
            $_SESSION["update"] = "true";
            exit(json_encode(array(
                'response' => array(
                    "code" => '1',
                    "msg" => 'Promo Code Upadted Successfully!'
                )
            )));
        }
        else {
            exit(json_encode(array(
                'response' => array(
                    "code" => '0',
                    "msg" => 'Opps There is An Error In Updating Promo Code!'
                )
            )));
        }
    }
}

/*Send Gift Card*/
if (isset($_POST["sendgiftPromoCode"])) {
    $getpromo = mysqli_real_escape_string($conn,$_POST['promocode']);
    $promocode = strtoupper($getpromo);
    $email=clean($_POST["email"]);
    if (filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $selectGiftCard=select("giftpromocode","promocode='$promocode'");
        if (howMany($selectGiftCard)=='0') {
            $selectPromoCode=select("promocode","promocode='$promocode'");
        if (howMany($selectPromoCode)=='0') {
        $validateEmail=select("customers","email='$email'");
        if (howMany($validateEmail) > 0) {
            $userInfo=fetch($validateEmail);
            $token=token(12);
            $tmp="
                <p>Hello ".$userInfo['fullname'].",</p>
                <p>In Order To you have Return your Order And your <br> Payble Money in your Gift card 
                <h4>Your Gift Card Code is:</h4>
                <h1>".$promocode."</h1>
                <h6>Validate For ".$_POST["expDate"]."</h6>
                <h6>Your Gift Card Price is: ".$_POST["promocodePrice"]."/-</h6>
               </p>
            ";
            $resp=sentEmail('Gadgets Stores',$userInfo["fullname"],$userInfo["email"],$tmp);
            if ($resp) {
               $send = saveData("giftpromocode", ["promocode" => $promocode, "price" => $_POST["promocodePrice"], "exp_date" => $_POST["expDate"], "description" => $_POST["desc"],"username" => $userInfo["fullname"],"user_id" =>$userInfo["id"],"user_email" => $email, "token" => $token ]);
                returnJson(1,"Gift Card Sent Successfully!");
            }
        }
        else{
            returnJson(0,"Email Not Found!");
        }

        }
    else{
        returnJson(0,"This Promo Code is Already Axists in PromoCode Table!");
    }

        }
    else{
        returnJson(0,"This Promo Code is Already Axists in GiftCard Table!");
    }

    }
    else{
        returnJson(0,"Please Enter A Valid Email!");
    }
}

/*Delete Gift Promo Code*/

 if (isset($_POST["deleteGiftPromoCode"])) {
        $token=$_POST["deleteGiftPromoCode"];
        $query=deleteRow("giftpromocode","token='$token'");
        if ($query) {
          exit(json_encode(array('response' => array("code" =>'1', "msg" => 'Gift Promo Code deleted Successfully!'))));
        }
        else{
             exit(json_encode(array('response' => array("code" =>'0', "msg" => 'Something went wrong!'))));
        }
    }

/*Fetch category in sub-category from*/

if (isset($_POST["sub_id"])) {
    $id=$_POST["sub_id"];
    $queryValidateString=select("category","categoryId='$id'");
    if (howMany($queryValidateString) > 0) { ?>
             <option value="">Select Device Type</option>
        <?php
        while($subcategory=fetch($queryValidateString)){ ?>
<option value="<?php echo $subcategory["id"]; ?>"><?php echo $subcategory["name"]; ?></option>
<?php }
    }else{ ?>
        <option value="">Select Device Type</option>
    <?php } 
}

/*Fetch Sub-category in multi-sub-category from*/

if (isset($_POST["multi_sub_id"])) {
    $id=$_POST["multi_sub_id"];
    $queryValidatesString=select("subcategory","category_id='$id'");
    if (howMany($queryValidatesString) > 0) { ?>
             <option value="">Select Device</option>
        <?php
        while($subcaetegory=fetch($queryValidatesString)){ ?>
<option value="<?php echo $subcaetegory["id"]; ?>"><?php echo $subcaetegory["name"]; ?></option>
<?php }
    }else{ ?>
        <option value="">Select Device</option>
    <?php } 
}

/*Fetch multi-Sub-category in multi-sub-sub-category from*/

if (isset($_POST["multi_sub_sub_id"])) {
    $id=$_POST["multi_sub_sub_id"];
    $queryValidatessString=select("multi_sub_category","sub_cat_id='$id'");
    if (howMany($queryValidatessString) > 0) { ?>
             <option value="">Select Accessory Type</option>
        <?php
        while($multisubcaetegory=fetch($queryValidatessString)){ ?>
<option value="<?php echo $multisubcaetegory["id"]; ?>"><?php echo $multisubcaetegory["name"]; ?></option>
<?php }
    }else{ ?>
        <option value="">Select Accessory Type</option>
    <?php } 
}
/*Fetch Prodcut type in  Prodcut category from*/

if (isset($_POST["product_id"])) {
    $id=$_POST["product_id"];
    $selectproductType=select("multi_sub_sub_category","multi_sub_cat_id='$id'");
    if (howMany($selectproductType) > 0) { ?>
             <option value="">Select Product Category</option>
        <?php
        while($fetchproductType=fetch($selectproductType)){ ?>
<option value="<?php echo $fetchproductType["token"]; ?>"><?php echo $fetchproductType["name"]; ?></option>
<?php }
    }else{ ?>
        <option value="">Select Product Category</option>
    <?php } 
}

/*Fetch Prodcut type in  Prodcut from*/

if (isset($_POST["product_type"])) {
    $id=$_POST["product_type"];
    $selectproductTypee=select("product_type","multi_sub_sub_cat_id='$id'");
    if (howMany($selectproductTypee) > 0) { ?>
             <option value="">Select Product Type</option>
        <?php
        while($fetchproductTypee=fetch($selectproductTypee)){ ?>
<option value="<?php echo $fetchproductTypee["id"]; ?>"><?php echo $fetchproductTypee["product_type"]; ?></option>
<?php }
    }else{ ?>
        <option value="">Select Product Type</option>
    <?php } 
}
/*Fetch State type in  Shipping from*/

if (isset($_POST["stateId"])) {
    $id=$_POST["stateId"];
    $selectState=select("states","country_id='$id'");
    if (howMany($selectState) > 0) { ?>
             <option value="">Select State</option>
        <?php
        while($fetchState=fetch($selectState)){ ?>
<option value="<?php echo $fetchState["id"]; ?>"><?php echo $fetchState["name"]; ?></option>
<?php }
    }else{ ?>
        <option value="">Select State</option>
    <?php } 
}

/*Fetch City type in  Shipping from*/

if (isset($_POST["cityId"])) {
    $id=$_POST["cityId"];
    $selectCity=select("cities","state_id='$id'");
    if (howMany($selectCity) > 0) { ?>
             <option value="">Select City</option>
        <?php
        while($fetchCity=fetch($selectCity)){ ?>
<option value="<?php echo $fetchCity["id"]; ?>"><?php echo $fetchCity["name"]; ?></option>
<?php }
    }else{ ?>
        <option value="">Select City</option>
    <?php } 
}