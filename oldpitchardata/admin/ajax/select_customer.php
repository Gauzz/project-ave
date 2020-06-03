<?php  
 if(isset($_POST["employee_id"]))  
 {  
      $output = '';  
     include 'conn.php';
      $query = "SELECT * FROM customer WHERE id = '".$_POST["employee_id"]."'";  
      $result = mysqli_query($conn, $query);  
      $output .= '  
      <div class="card-body" id="bar-parent2">
              <form method="POST" id="form_sample_2" enctype="multipart/form-data" class="form-horizontal">';  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                 <div class="card-body row">

                                    <div class="col-lg-12 p-t-20">
                                    <label>Profile Image</label>
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height txt-full-width">
                                    <?php //echo "<img src='uploads/".$row
                                    [photo]."' width='135px'  height='110px' />" ; ?>
                                    <img id="img_pre" class="img-thumbnail" src="uploads/<?php echo $w['photo']; ?>" height="110px" width="135px">
                                   <!--  <img id="img_pre" src="https://www.chaarat.com/wp-content/uploads/2017/08/placeholder-user.png" height="110px" width="135px"> -->
                                    <input type="file" name="fileup" id="userImage" onchange="document.getElementById('img_pre').src = window.URL.createObjectURL(this.files[0])" >
                                    <!-- <input type="file" placeholder="90890" name="fileup" required="">
                                     -->    </div>
                                    </div>
                                    
                                    <div class="col-lg-6 p-t-20"> 
                                     <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                       <input class = "mdl-textfield__input" type = "text" name="firstname" id = "txtFirstName" value="<?php echo $row['firstname']; ?>" required="">
                                         <label class = "mdl-textfield__label">First Name</label>
                                      </div>
                                    </div>
                                    <div class="col-lg-6 p-t-20"> 
                                     <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <input class = "mdl-textfield__input" type = "text" name="lastname" value="<?php echo $row['lastname']; ?>" id = "txtLasttName" required="">
                                         <label class = "mdl-textfield__label" >Last Name</label>
                                      </div>
                                    </div>
                                  <div class="col-lg-6 p-t-20"> 
                                   <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <input class = "mdl-textfield__input" type="password" name="password" value="<?php echo $row['password']; ?>" required="">
                                         <label class = "mdl-textfield__label" >Password</label>
                                         </div>
                                  </div>                                      
                                    <div class="col-lg-6 p-t-20"> 
                                         <label>Date Of Birth:</label>
                                          <span class = "mdl-textfield__error">Enter Date!</span>
                                     <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                         <input class = "mdl-textfield__input" type="date" name="dob" value="<?php echo $row['dateofbirth']; ?>" id="txtdate" required="">
                                      </div>
                                    </div>

                                <div class="col-lg-6 p-t-20">
                                    <label></label>
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height txt-full-width">
                                    <input class="mdl-textfield__input " type="text" id="sample1" value="<?php echo $row['gender']; ?>" readonly tabIndex="-1">
                                    <label for="sample1" class="pull-right margin-0">
                                        <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                                    </label>
                                    <label for="sample1" class="mdl-textfield__label">Gender</label>
                                    <ul data-mdl-for="sample1" class="mdl-menu mdl-menu--bottom-left mdl-js-menu" style="clip: rect(0px, 500px, 111.953px, 0px);width: 100% !important;">
                                      <li class="mdl-menu__item getType" data-val="Male"  data-id="1">Male</li>
                                      <li class="mdl-menu__item getType" data-val="Female" data-id="2">Female</li>       
                                    </ul>
                                    <input type="hidden" class="getusergender" name="gender">
                                </div>
                            </div>

                                    </div>


                                <div class="card-head">
                                    <header>Update Customer Contact Info</header>
                                    </div>
                                 <div class="card-body row">

                                    <div class="col-lg-6 p-t-20"> 
                                    <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                         <input class = "mdl-textfield__input" type="email" name="cemail" value="<?php echo $row['email']; ?>" id="txtemail" required="">
                                         <label class = "mdl-textfield__label" >Email</label>
                                          <span class = "mdl-textfield__error">Enter Valid Email Address!</span>
                                      </div>
                                    </div>

                                    <div class="col-lg-6 p-t-20">
                                     <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                         <input class = "mdl-textfield__input" type = "text" name="cmobnum" value="<?php echo $row['mobile']; ?>" 
                                            pattern = "-?[0-9]*(\.[0-9]+)?" id = "text5" maxlength="10"
                                            required="">
                                         <label class = "mdl-textfield__label" for = "text5">Mobile Number</label>
                                         <span class = "mdl-textfield__error">Number required!</span>
                                      </div>
                                    </div>
                                </div>

                                    <div class="col-lg-12 p-t-20"> 
                                      <div class = "mdl-textfield mdl-js-textfield txt-full-width">
                                         <textarea class = "mdl-textfield__input" rows =  "2" 
                                            id = "text7" name="address" required=""><?php echo $row['address']; ?></textarea>
                                         <label class = "mdl-textfield__label" for = "text7">Address</label>
                                      </div>
                                     </div>

                ';  
      }  
      $output .= " </form>
                    </div>";  
      echo $output;  
 }  
 ?>
