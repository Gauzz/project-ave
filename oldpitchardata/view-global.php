<?php
include 'secure_session.php';
if (isset($_GET["project"])) {
$token=$_GET["project"];
$query=mysqli_query($conn,"SELECT * FROM tbl_std_project WHERE token='$token'");
$data=mysqli_fetch_array($query);
$projectName= $data["project_name"];
$videofile= $data["video"];
$mtlfile= $data["mtlfile"];
$objfile= $data["objfile"];
$docfile= $data["docs"];
$zipfile= $data["zipfile"];
$fetchImage=mysqli_query($conn,"SELECT * FROM tbl_project_image WHERE token='$token'");
$countImage=mysqli_num_rows($fetchImage);
}
if(isset($_POST['download'])){
//$file_folder = "files/";  // folder to load files
if(extension_loaded('zip')){  // Checking ZIP extension is available
// Checking files are selected
$zip = new ZipArchive();      // Load zip library
$zip_name = $projectName.".zip";      // Zip name
if($zip->open($zip_name, ZIPARCHIVE::CREATE)!==TRUE){   // Opening zip file to load files
$error .=  "* Sorry ZIP creation failed at this time<br/>";
}
if (!empty($videofile)) {
$zip->addFile("uploads/video/".$videofile);
}
if (!empty($docfile)) {
$zip->addFile("uploads/docs/".$docfile);
}
if (!empty($objfile)) {
$zip->addFile("uploads/obj/".$objfile);
}
if (!empty($mtlfile)) {
$zip->addFile("uploads/mtl/".$mtlfile);
}
if (!empty($zipfile)) {
$zip->addFile("uploads/zip/".$zipfile);
}
if ($countImage>0) {
$getImages=mysqli_query($conn,"SELECT * FROM tbl_project_image WHERE token='$token'");
while($imgForDownload=mysqli_fetch_array($getImages)){
$zip->addFile("uploads/imgs/".$imgForDownload["image"]);
}
}
$zip->close();
if(file_exists($zip_name)){
// push to download the zip
header('Content-type: application/zip');
header('Content-Disposition: attachment; filename="'.$zip_name.'"');
readfile($zip_name);
// remove zip file is exists in temp path
unlink($zip_name);
}
}else
$error = "* You dont have ZIP extension<br/>";
}
?>
<!DOCTYPE html>
<html>
  <head> <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>View Project</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Facebook share -->
    <meta property="og:image" content="https://pitchar.io/<?= (!empty($data["image"])) ? 'uploads/imgs/'.$data["image"] : 'dist/img/eye.png' ; ?>"/>
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="dist/css/new.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="bower_components/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- Google Font -->
    <?php include 'favicon.php'; ?>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>.btn-danger {
    background-color: black;
    border-color: black;
    width: 100px;
    margin-top: 20px;
    }
    
    .dngr{
    background-color: #dd4b39;
    border-color: #d73925;
    }
    </style>
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
    fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <div class="wrapper">
      <header class="main-header">
        <!-- Logo -->
        <a href="index.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>Pit</b>char.IO</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>PITCHAR.IO</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <?php include 'header.php'; ?>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <?php include 'sidebar.php'; ?>
        <!-- /.sidebar -->
      </aside>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="row">
            <div class="col-md-6">
              <h2><?php
              $queryGetUserDetails=mysqli_query($conn,"SELECT * FROM tbl_users WHERE email='".$data["email"]."'");
              $fetchProjectOwner=mysqli_fetch_array($queryGetUserDetails);
              ?>
              <?= $data["project_name"]; ?><span style="font-size: 20px;"> (<?php echo ucfirst($fetchProjectOwner["occupation"])?> : <?php echo ucfirst($fetchProjectOwner["firstname"])?> <?php echo ucfirst($fetchProjectOwner["lastname"])?>)</span> <br><small><?= $data["subject"];?> <?php echo "( ".$data["start_date"]." to ".$data["end_date"]." )" ?></small>
              <br>
              <small><?php echo (!empty($data["education"])) ? "education: ".$data["education"]." |" : "" ;?><?php echo (!empty($data["book"])) ? "Book: ".$data["book"]." |" : "" ; ?><?php echo (!empty($data["magaz"])) ? "Magazines:".$data["magaz"] : "" ;?></small>
              </h2>
              <p><?= $data["language"]?></p>
            </div>
            <div class="col-md-6 ">
              
              <form method="POST">
                
                <?php
                $favgetcount=mysqli_query($conn,"SELECT * FROM favourite WHERE token='$token' AND email='$getEmail' AND fav='1'");
                $Favcounts=mysqli_num_rows($favgetcount);
                ?>
                <button type="button" class="btn btn-primary favorite " id="favourite" name="fav"  value="<?php echo  $Favcounts; ?>" style="<?php echo ($Favcounts=='0') ? 'color:#000;' : 'color:#367fa9;' ;?>margin-top:0px ;background-color: white;height: 40px;"><i class="fa fa-star"></i>&nbsp;&nbsp;&nbsp;Favorite </button>
                
                
                
                
                <?php
                if($status=="teacher"){ ?>
                <a style="  background-color: white;
                  color: black;
                height: 40px;line-height: 2;" href="share.php?project=<?= $token; ?>" class="btn btn-info"><i class="fa fa-share-alt"></i>&nbsp;&nbsp;&nbsp; Share</a>
                <a style="  background-color: white;
                  color: black;
                height: 40px;line-height: 2;" href="invite.php?project=<?= $token; ?>" class="btn btn-primary"><i class="fa fa-user-plus"></i>&nbsp;&nbsp;&nbsp;Invite</a>
                
                <button type="submit" class="btn btn-primary" name="download" value="<?= $data["id"] ?>" style="color:#000;background-color: white;
                height: 40px;"><i class="fa fa-download"></i>&nbsp;&nbsp;&nbsp;Download </button>
                <?php               }
                ?>
                <div   class="fb-share-button"
                  data-href="https://pitchar.io/facebook-share.php?project=<?php echo $token;?>&user=<?= $user_name ?>"
                  data-layout="button" data-size="large">
                </div>
                
              </form>
            </div>
          </div>
        </section>
        <!-- Main content -->
        <section class="content">
          <!-- /.row -->
          <!-- Main row -->
          <div class="container">
            <div class="col-md-4">
              <?php $getProjectImage=mysqli_query($conn,"SELECT * FROM tbl_project_image WHERE token='$token'");
              $getActImage=mysqli_fetch_array($getProjectImage);
              
              ?>
              <a  href="<?= (!empty($getActImage["image"])) ? 'uploads/imgs/'.$getActImage["image"] : '#' ; ?>" class="<?= (!empty($getActImage["image"])) ? '#' : 'emptyFile' ; ?>" >
                
                <div class="panel panel-default">
                  <div class="cur">
                    <div class="main">
                      <img height="305px" width="100%" src="<?= (!empty($getActImage["image"])) ? 'uploads/imgs/'.$getActImage["image"] : 'dist/img/eye.png' ; ?>">
                    </div>
                  </div>
                  <div class="panel-footer"id="pn"><strong>View Image</strong><br>
                    <span>Click Here to view</span>
                    <span> <i class="fa fa-image pull-right"></i></span>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-md-4">
              <?php  $getExt= substr($data["docs"],-3); ?>
              <?php if ($getExt=='doc' OR $getExt=='doc' OR $getExt=='DOC' OR $getExt=='DOCX' ): ?>
              <a href="uploads/docs/<?= $data["docs"] ?>" download="" class="<?= (!empty($data["docs"])) ? '#' : 'emptyFile' ; ?>">
                <div class="panel panel-default">
                  <div class="cur">
                    <div class="main">
                      <img height="305px" width="100%" src="dist/img/eye.png">
                    </div>
                  </div>
                  <div class="panel-footer"id="pn"><strong>Click Here to Download Doc</strong><br>
                    <span>Doc File Can't Be preview</span>
                    <span> <i class="fa fa-file pull-right"></i></span>
                  </div>
                </div>
              </a>
              <?php else: ?>
              <a href="<?= (!empty($data["docs"])) ? 'uploads/docs/'.$data["docs"] : '#' ; ?>" class="<?= (!empty($data["docs"])) ? '#' : 'emptyFile' ; ?>">
                <div class="panel panel-default">
                  <div class="cur">
                    
                    <div class="main">
                      <?php if (empty($data["docs"])) { ?>
                      <div class="main">
                        <img height="305px" width="100%" src="dist/img/eye.png">
                      </div>
                      <?php } if(!empty($data["docs"])){ ?>
                      <iframe id="viewer" frameborder="0" scrolling="no" src="<?= (!empty($data["docs"])) ? 'uploads/docs/'.$data["docs"] : 'dist/img/eye.png' ; ?>" width="100%" height="300px" ></iframe>
                      <?php } ?>
                      
                    </div>
                    
                  </div>
                  <div class="panel-footer"id="pn"><strong>View PDF Document</strong><br>
                    <span>Click Here to view</span>
                    <span> <i class="fa fa-file pull-right"></i></span>
                  </div>
                </div>
              </a>
              <?php endif ?>
            </div>
            <div class="col-md-4">
              <?php   $modelFile=$data["objfile"];
              $fileType= substr($modelFile,-3);
              if ($fileType=="fbx" || $fileType=="FBX") { ?>
              <div class="panel panel-default">
                <div class="cur">
                  <div class="main">
                    <img height="305px" width="100%" src="dist/img/eye.png">
                  </div>
                </div>
                <div class="panel-footer"id="pn"><strong> fbx File</strong><br>
                  <span>Download project to view model</span>
                  <span> <i class="fa fa-object-ungroup pull-right"></i></span>
                </div>
              </div>
              
              <?php }
              else {
              ?>
              <a <?= (!empty($data["objfile"])) ? "href='obj-viewer.php?token=$token'" : '' ; ?>" style="cursor: pointer;" class="<?= (!empty($data["objfile"])) ? '#' : 'emptyFile' ; ?>" target="_blank">
                <div class="panel panel-default">
                  <div class="cur">
                    <?php
                    if(empty($data["objfile"])){ ?>
                    <div class="main">
                      <img height="305px" width="100%" src="dist/img/eye.png">
                    </div>
                    <?php } else { ?>
                    <div class="main">
                      <iframe height="300px" width="100%" src="obj-viewer.php?token=<?= $token; ?>"></iframe>
                    </div>
                    <?php } ?>
                  </div>
                  <div class="panel-footer"id="pn"><strong>View 3D Model</strong><br>
                    <span>Click Here to view</span>
                    <span> <i class="fa fa-object-ungroup pull-right"></i></span>
                  </div>
                </div>
              </a>
              <?php } ?>
            </div>
          </div>
          <!-- 2ND Container -->
          <section class="content">
            <!-- /.row -->
            <!-- Main row -->
            <div class="container">
              <div class="col-md-4">
                <?php $getProjectImage=mysqli_query($conn,"SELECT * FROM assets WHERE authtoken='$token'");
                $getActImage=mysqli_fetch_array($getProjectImage);
                ?>
                <a  href="<?= (!empty($getActImage["objthumbnail"])) ? $getActImage["objthumbnail"] : '#' ; ?>" class="<?= (!empty($getActImage["objthumbnail"])) ? '#' : 'emptyFile' ; ?>" >
                  
                  <div class="panel panel-default">
                    <div class="cur">
                      <div class="main">
                        <img height="305px" width="100%" src="<?= (!empty($getActImage["objthumbnail"])) ? $getActImage["objthumbnail"] : 'dist/img/eye.png' ; ?>">
                      </div>
                    </div>
                    <div class="panel-footer"id="pn"><strong>View OBJ/FBX Thumbnail</strong><br>
                      <span>Click Here to view</span>
                      <span> <i class="fa fa-image pull-right"></i></span>
                    </div>
                  </div>
                </a>
              </div>
              <?php $getProjectAudio=mysqli_query($conn,"SELECT * FROM media WHERE authtoken='$token'");
              $getActAudio=mysqli_fetch_array($getProjectAudio);
              ?>
              <div class="col-md-4">
                <a href="<?= $getActAudio["audio"] ?>" download="" class="<?= (!empty($getActAudio["audio"])) ? '#' : 'emptyFile' ; ?>">
                  <div class="panel panel-default">
                    <div class="cur">
                      <div class="main">
                        <img height="305px" width="100%" src="dist/img/eye.png">
                        <audio controls style="position: absolute;left: 16px;bottom: 88px; width: 91%;">
                          <source id="audiosrc" src="<?php echo $getActAudio["audio"]?>" type="audio/mp3">
                        </audio>
                      </div>
                    </div>
                    <div class="panel-footer"id="pn"><strong>Click Here to Download Audio</strong><br>
                      <span>Download Audio</span>
                      <span> <i class="fa fa-music pull-right"></i></span>
                    </div>
                  </div>
                </a>
                
              </div>
              <div class="col-md-4">
                <a href="<?= $getActAudio["thumbnail"] ?>" download="" class="<?= (!empty($getActAudio["thumbnail"])) ? '#' : 'emptyFile' ; ?>">
                  <div class="panel panel-default">
                    <div class="cur">
                      <div class="main">
                        <img height="305px" width="100%" src="<?php echo (!empty($getActAudio["thumbnail"])) ? $getActAudio["thumbnail"] : 'dist/img/eye.png' ;?>">
                      </div>
                    </div>
                    <div class="panel-footer"id="pn"><strong>Click Here to Download Video Thumbnail</strong><br>
                      <span>Download Video</span>
                      <span> <i class="fa fa-video-camera pull-right"></i></span>
                    </div>
                  </div>
                </a>
                
              </div>
            </div>
            <!-- End 2ND Container -->
            <div class="container">
              <div class="col-md-12">
                <div class="panel panel-default"id="m">
                  <div class="panel-body cur">
                    <?php if (!empty($data["video"])): ?>
                    <video width="100%" height="100%" controls>
                      <source src="uploads/video/<?php echo $data["video"]; ?>" type="video/mp4">
                      Your browser does not support the video tag.
                    </video>
                    <?php else: ?>
                    <img class="emptyFile" src="https://pitchar.io/dist/img/eye.png" id="videoPlaceholder" height="600px" width="100%">
                    <?php endif ?>
                  </div>
                  <div class="panel-footer"><strong>Video</strong> <?php if (!empty($data["video"])): ?>
                    <small><a href="vr-video.php?token=<?php echo $token;?>">View in 360 <i class="fa fa-eye"></i> </a></small>
                    <?php endif ?>
                    <span> <i class="fa fa-video-camera pull-right"></i></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="container">
              <div class="col-md-12">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">  Notes</h3>
                    <span> <i  style="    margin-top: -12px;" class="fa fa-pencil-square-o pull-right"></i></span>
                  </div>
                  <div class="panel-body">
                    <?php echo (empty($data["notes"])) ? "No Notes Attached to This Project" : $data["notes"] ; ?>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.row (main row) -->
          </section>
          <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php include'footer.php';?>
        <!-- Control Sidebar -->
        
        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
        immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
      </div>
      <!-- ./wrapper -->
      <!-- jQuery 3 -->
      <script src="bower_components/jquery/dist/jquery.min.js"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <!-- jQuery UI 1.11.4 -->
      <script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
      <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
      <script>
      $.widget.bridge('uibutton', $.ui.button);
      </script>
      <!-- Bootstrap 3.3.7 -->
      <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
      <!-- Morris.js charts -->
      <script src="bower_components/raphael/raphael.min.js"></script>
      <script src="bower_components/morris.js/morris.min.js"></script>
      <!-- Sparkline -->
      <script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
      <!-- jvectormap -->
      <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
      <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
      <!-- jQuery Knob Chart -->
      <script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
      <!-- daterangepicker -->
      <script src="bower_components/moment/min/moment.min.js"></script>
      <script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
      <!-- datepicker -->
      <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
      <!-- Bootstrap WYSIHTML5 -->
      <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
      <!-- Slimscroll -->
      <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
      <!-- FastClick -->
      <script src="bower_components/fastclick/lib/fastclick.js"></script>
      <!-- AdminLTE App -->
      <script src="dist/js/adminlte.min.js"></script>
      <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
      <script src="dist/js/pages/dashboard.js"></script>
      <!-- AdminLTE for demo purposes -->
      <script src="dist/js/demo.js"></script>
      <script type="text/javascript">
      $(".emptyFile").click(function() {
      swal("Oops", "No File Attached to This Media!", "info");
      });
      $(".favorite").click(function(){
      $.ajax({
      url: "assets/_php/favorite.php",
      type:"POST",
      async:false,
      data:{
      "done" : 1,
      "pid" : '<?php echo $token; ?> ',
      "uid": '<?php echo $getEmail; ?>',
      "name":'<?php echo $projectName?>'
      },
      success:function(data){
      //displaydata();
      //$("#like").val('');
      var getFav=$('.favorite').val();
      if (getFav=="0") {
      swal("Success!", "Project Added To Favorites!", "success");
      $("#favourite").val('1');
      $("#favourite").css({
      color: '#367fa9'
      });
      
      }
      if (getFav=="1") {
      swal("Success!", "Project Removed To Favorites!", "success");
      $("#favourite").val('0');
      $("#favourite").css({
      color: '#000'
      });
      
      }
      }
      });
      });
      
      
      
      </script>
    </body>
  </html>