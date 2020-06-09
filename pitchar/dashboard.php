<?php
ob_start();
// connection to database
include('../includes/functions.php');
if(!array_key_exists("user",$_SESSION))
{
    header("location:../user/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Pitcher | Dashboard</title>
    
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
    <!-- header -->
    <section class="bg-light w-100 float-left container-fluid paddingtop80 pb-5">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
           <a href="settings.php"> <h2 class="mt-4">Dashboard <div class="float-right text-secondary font16"><img class="border border-info rounded-circle p-1 ml-2" height="40" src="https://punchthrough.com/wp-content/uploads/2019/07/Anonymous-Testimonial.png"> <?php echo $fullname;?></div></h2></a>
          <a href="logout.php" style="float: right;">Logout</a>
          </div>
        </div>
      </div>
      <div class="container bg-white pt-3 pb-4 mt-4 rounded">
        <div class="row">
          <div class="col-sm-12">
              <div class="col-sm-12">
                <h5 class="mt-0 text-secondary">Create A New Scape</h5>
              </div>
              <div class="col-sm-12 p-0 mt-3">
                
            <a href="http://studio.pitchar.io">    <div class="col-sm-5 float-left">
                  <div class="card mb-3">
                    <img src="https://assets.scapic.com/scapicAssets/thumbnails/mordern/rectangle/vr.jpg" class="card-img-top" height="200">
                    <div class="card-body">
                      <h5 class="card-title mb-1">AR Scape</h5>
                      <p class="card-text"><small class="text-muted">Create a VR Experience with media, 360° and 3D elements</small></p>
                    </div>
                    </div>
                </div>
               </a>
               <!-- <div class="col-sm-5 float-left">
                  <div class="card mb-3">
                    <img src="https://assets.scapic.com/scapicAssets/thumbnails/mordern/rectangle/vr.jpg" class="card-img-top" height="200">
                    <div class="card-body">
                      <h5 class="card-title mb-1">AR Scape</h5>
                      <p class="card-text"><small class="text-muted">Create a VR Experience with media, 360° and 3D elements</small></p>
                    </div>
                    </div>
                </div>-->
              </div>
            </div>

          <div class="col-sm-12 mt-5">
              <div class="col-sm-12">
                <h5 class="mt-0 text-secondary">My Scape
                  <div class="btn-group float-right bg-grey pointer">
                      <button type="button" class="btn bg-grey btn-secondary first-btn">Most Recent</button>
                      <button type="button" class="btn bg-grey btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <div class="dropdown-menu pointer">
                        <a class="dropdown-item pointer" href="javascript:void(0)">Most Recent</a>
                        <a class="dropdown-item pointer" href="javascript:void(0)">Most Viewed</a>
                        <a class="dropdown-item pointer" href="javascript:void(0)">By Size</a>
                        <!-- <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Separated link</a> -->
                      </div>
                    </div>
                </h5>
              </div>
              <div class="col-sm-12 mt-3">
                <div class="w-20 float-left ascape-ar">
                  <div class="card mb-3">
                    <img src="https://assets.scapic.com/scapicAssets/thumbnails/mordern/rectangle/vr.jpg" class="card-img-top" height="150">
                    <div class="card-body">
                      <h6 class="card-title mb-1">Costum AR Experience</h6>
                      <p class="card-text text-truncate"><small class="text-muted">Create a VR Experience with media, 360° and 3D elements</small></p>
                    </div>
                    <div class="icons float-right mt-3 mr-2">
                        <i class="fa fa-ellipsis-v custom-tooltip menu-icon pointer" aria-hidden="true">
                            <span class="tooltiptext">
                              <p class="w-100 float-left pointer"><i class="fa fa-link" aria-hidden="true"></i> &nbsp; Copy Scape Link</p>
                              <p class="w-100 float-left pointer"><i class="fa fa-share-alt" aria-hidden="true"></i> &nbsp; Share Scape</p>
                              <p class="w-100 float-left pointer"><i class="fa fa-clone" aria-hidden="true"></i> &nbsp; Duplicate</p>
                              <p class="w-100 float-left pointer"><i class="fa fa-line-chart" aria-hidden="true"></i> &nbsp; Analytics</p>
                              <p class="w-100 float-left pointer"><i class="fa fa-trash" aria-hidden="true"></i> &nbsp; Delete</p>
                            </span>
                        </i>
                      </div>
                  </div>
                </div>
                <div class="w-20 float-left ascape-ar">
                  <div class="card mb-3">
                    <img src="https://assets.scapic.com/scapicAssets/thumbnails/mordern/rectangle/vr.jpg" class="card-img-top" height="150">
                    <div class="card-body">
                      <h6 class="card-title mb-1">Costum AR Experience</h6>
                      <p class="card-text text-truncate"><small class="text-muted">Create a VR Experience with media, 360° and 3D elements</small></p>
                    </div>
                    <div class="icons float-right mt-3 mr-2">
                        <i class="fa fa-ellipsis-v custom-tooltip menu-icon pointer" aria-hidden="true">
                            <span class="tooltiptext">
                              <p class="w-100 float-left pointer"><i class="fa fa-link" aria-hidden="true"></i> &nbsp; Copy Scape Link</p>
                              <p class="w-100 float-left pointer"><i class="fa fa-share-alt" aria-hidden="true"></i> &nbsp; Share Scape</p>
                              <p class="w-100 float-left pointer"><i class="fa fa-clone" aria-hidden="true"></i> &nbsp; Duplicate</p>
                              <p class="w-100 float-left pointer"><i class="fa fa-line-chart" aria-hidden="true"></i> &nbsp; Analytics</p>
                              <p class="w-100 float-left pointer"><i class="fa fa-trash" aria-hidden="true"></i> &nbsp; Delete</p>
                            </span>
                        </i>
                      </div>
                    </div>
                </div>
                <div class="w-20 float-left ascape-ar">
                  <div class="card mb-3">
                    <img src="https://assets.scapic.com/scapicAssets/thumbnails/mordern/rectangle/vr.jpg" class="card-img-top" height="150">
                    <div class="card-body">
                      <h6 class="card-title mb-1">Costum AR Experience</h6>
                      <p class="card-text text-truncate"><small class="text-muted">Create a VR Experience with media, 360° and 3D elements</small></p>
                    </div>
                    <div class="icons float-right mt-3 mr-2">
                        <i class="fa fa-ellipsis-v custom-tooltip menu-icon pointer" aria-hidden="true">
                            <span class="tooltiptext">
                              <p class="w-100 float-left pointer"><i class="fa fa-link" aria-hidden="true"></i> &nbsp; Copy Scape Link</p>
                              <p class="w-100 float-left pointer"><i class="fa fa-share-alt" aria-hidden="true"></i> &nbsp; Share Scape</p>
                              <p class="w-100 float-left pointer"><i class="fa fa-clone" aria-hidden="true"></i> &nbsp; Duplicate</p>
                              <p class="w-100 float-left pointer"><i class="fa fa-line-chart" aria-hidden="true"></i> &nbsp; Analytics</p>
                              <p class="w-100 float-left pointer"><i class="fa fa-trash" aria-hidden="true"></i> &nbsp; Delete</p>
                            </span>
                        </i>
                      </div>
                    </div>
                </div>
                <div class="w-20 float-left ascape-ar">
                  <div class="card mb-3">
                    <img src="https://assets.scapic.com/scapicAssets/thumbnails/mordern/rectangle/vr.jpg" class="card-img-top" height="150">
                    <div class="card-body">
                      <h6 class="card-title mb-1">Costum AR Experience</h6>
                      <p class="card-text text-truncate"><small class="text-muted">Create a VR Experience with media, 360° and 3D elements</small></p>
                    </div>
                    <div class="icons float-right mt-3 mr-2">
                        <i class="fa fa-ellipsis-v custom-tooltip menu-icon pointer" aria-hidden="true">
                            <span class="tooltiptext">
                              <p class="w-100 float-left pointer"><i class="fa fa-link" aria-hidden="true"></i> &nbsp; Copy Scape Link</p>
                              <p class="w-100 float-left pointer"><i class="fa fa-share-alt" aria-hidden="true"></i> &nbsp; Share Scape</p>
                              <p class="w-100 float-left pointer"><i class="fa fa-clone" aria-hidden="true"></i> &nbsp; Duplicate</p>
                              <p class="w-100 float-left pointer"><i class="fa fa-line-chart" aria-hidden="true"></i> &nbsp; Analytics</p>
                              <p class="w-100 float-left pointer"><i class="fa fa-trash" aria-hidden="true"></i> &nbsp; Delete</p>
                            </span>
                        </i>
                      </div>
                    </div>
                </div>
                <div class="w-20 float-left ascape-ar" style="width: 20%;">
                  <div class="card mb-3">
                    <img src="https://assets.scapic.com/scapicAssets/thumbnails/mordern/rectangle/vr.jpg" class="card-img-top" height="150">
                    <div class="card-body">
                      <h6 class="card-title mb-1">Costum AR Experience</h6>
                      <p class="card-text text-truncate"><small class="text-muted">Create a VR Experience with media, 360° and 3D elements</small></p>
                    </div>
                    <div class="icons float-right mt-3 mr-2">
                        <i class="fa fa-ellipsis-v custom-tooltip menu-icon pointer" aria-hidden="true">
                            <span class="tooltiptext">
                              <p class="w-100 float-left pointer"><i class="fa fa-link" aria-hidden="true"></i> &nbsp; Copy Scape Link</p>
                              <p class="w-100 float-left pointer"><i class="fa fa-share-alt" aria-hidden="true"></i> &nbsp; Share Scape</p>
                              <p class="w-100 float-left pointer"><i class="fa fa-clone" aria-hidden="true"></i> &nbsp; Duplicate</p>
                              <p class="w-100 float-left pointer"><i class="fa fa-line-chart" aria-hidden="true"></i> &nbsp; Analytics</p>
                              <p class="w-100 float-left pointer"><i class="fa fa-trash" aria-hidden="true"></i> &nbsp; Delete</p>
                            </span>
                        </i>
                      </div>
                    </div>
                </div>
              </div>
            </div>
        </div>
      </div>
    </section>
    <script>
        $(document).ready(function(){
          $(".dropdown-menu a").click(function(){

            $(".first-btn").text($(this).text());
            $(".first-btn").val($(this).text());

          });

          // open upload media modal
          $('.m-option').click(function(){
            var tab = $(this).attr('tab')
            $('#modal-upload-media').modal('show');
            $(tab).click();
          });



          // tooltip
          $(".custom-tooltip").mouseenter(function() {
            $('.custom-tooltip .tooltiptext').css({'opacity':0});
            $(this).find('.tooltiptext').css({'opacity':1});
          }).mouseout(function() {
            $('.selected .custom-tooltip .tooltiptext').css({'opacity':1});
          })

          // popover
          $('[data-toggle="popover"]').popover({
              placement : 'top',
              trigger : 'hover'
          });

          var slider = document.getElementById("myRange");
          var output = document.getElementById("demo");
          output.innerHTML = slider.value;

          slider.oninput = function() {
            output.innerHTML = this.value;
          }
       });

    </script>
  </body>
</html>
