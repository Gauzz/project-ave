<?php
ob_start();
// connection to database
include('../includes/functions.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Pitcher | Settings</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,600,700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/common.css">
    <script src="scripts/jquery-3.4.1.min.js" type="text/javascript"></script>
    <script src="scripts/bootstrap.min.js" type="text/javascript"></script>
  </head>
  <body style="margin:0">
    <section class="bg-light w-100 float-left container-fluid paddingtop80 pb-5">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <h2 class="mt-4">Settings <div class="float-right text-secondary font16"><img class="border border-info rounded-circle p-1 ml-2" height="40" src="https://punchthrough.com/wp-content/uploads/2019/07/Anonymous-Testimonial.png"> <?php echo $fullname?></div></h2>
          </div>
        </div>
      </div>
      <div class="container bg-white pt-4 pb-4 mt-4 rounded settings-page" style="display: -webkit-box;">
        <div class="w-100">
          <div class="col-sm-12">
              <div class="col-sm-12">
                <h5 class="mt-0 text-secondary">Profile settings</h5> <hr>
              </div>
              <div class="col-sm-7">
                <form action="/action_page.php">
                  <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter name" name="fullname" value="<?php echo $fullname?>">
                  </div>
                  <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" placeholder="Enter email" name="email" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label for="uploadPhoto">Avatar:</label><br>
                    <img class="border border-info rounded-circle p-1 mb-3" height="60" src="https://punchthrough.com/wp-content/uploads/2019/07/Anonymous-Testimonial.png"><br>
                    <input type="button" class="btnSubmit bg-grey" id="uploadPhoto" value="Upload Photo"><br>
                  </div>
                  <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" disabled value="<?php echo $email?>">
                  </div>
                  <div class="form-group">
                    <label for="pwd">Password:</label><br>
                    <input type="password" class="col-md-3 float-left form-control mr-1" placeholder="Old Password">
                    <input type="password" class="col-md-3 float-left form-control mr-1" placeholder="New Password">
                    <input type="password" class="col-md-3 float-left form-control mr-1" placeholder="Re-enter New Password"><br>
                    <input type="button" class="btnSubmit mt-2 bg-grey" id="uploadPhoto" value="Change Password">
                  </div><br>
                  <div class="col-md-12 float-left mt-4 p-0">
                      <button type="submit" class="btnSubmit pt-2 pb-2 text-white float-left">Save</button>
                  </div>
                </form>
              </div>
            </div>
        </div>
      </div>
      <div class="container bg-white pt-4 pb-4 mt-4 rounded settings-page" style="display: -webkit-box;">
        <div class="w-100">
          <div class="col-sm-12">
              <div class="col-sm-12 btns-link">
                <h5 class="mt-0 text-secondary">Link Accounts</h5> <hr>
                <button class="btn col-md-5"><i class="fa fa-home"></i> Link facebook to Scapic</button><br>
                <button class="btn col-md-5"><i class="fa fa-home"></i> Link Google to Scapic</button><br>
                <button class="btn col-md-5"><i class="fa fa-home"></i> Link Twitter to Scapic</button><br>
                <button class="btn col-md-5"><i class="fa fa-home"></i> Link Scatchfab to Scapic</button>
              </div>
          </div>
        </div>
      </div>
      <div class="container bg-white pt-4 pb-4 mt-4 rounded settings-page" style="display: -webkit-box;">
        <div class="w-100">
          <div class="col-sm-12">
              <div class="col-sm-12">
                <h5 class="mt-0 text-secondary">Delete My Account</h5> <hr>
              </div>
              <div class="col-sm-12 float-left">
                <p class="float-left mt-1">Taking a break from Scapic? You've found the right place.</p>
                <input type="button" class="btnSubmit float-right text-white pt-2 pb-2" id="uploadPhoto" value="Delete">
              </div>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>
