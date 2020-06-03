<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'secure_session.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Create new Project</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
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
    <link rel="stylesheet" href="css/niceCountry.css">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Multi dropdown -->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/multilevel-dropdown.css"/>
    <link rel="stylesheet" type="text/css" href="css/default.css" />
    <link rel="stylesheet" type="text/css" href="css/component.css" />
    <?php include 'favicon.php'; ?>
    
    <link href='css/fullcalendar.css' rel='stylesheet' />
    <link href='css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
    <script src="js/moment.min.js"></script>
    <script src="js/fullcalendar.js"></script>
    
    <script src="js/modernizr.custom.js"></script>
    <script src="js/niceCountry.js"></script>
    <script type="text/javascript">
    
    $(document).ready(function() {
    $('#calendar').fullCalendar({
    header: {
    left: 'prev,next today',
    center: 'title',
    right: 'month'
    },
    defaultDate: '<?php echo date("Y-m-d"); ?>',
    navLinks: true, // can click day/week names to navigate views
    selectable: true,
    selectHelper: false,
    select: function(start, end) {
    var title = ' ';
    var eventData;
    if (title) {
    eventData = {
    title: title,
    start: start,
    end: end
    };
    $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
    }
    $('#calendar').fullCalendar('unselect');
    $("#week-title").val(title);
    $("#week-start").val(start);
    $("#week-end").val(end);
    
    },
    editable: false,
    eventLimit: 1 // allow "more" link when too many events
    
    });
    });
    </script>
    
    
    <style>.btn-danger {
    background-color: black;
    border-color: black;
    width: 100px;
    margin-top: 20px;
    }
    #upload-button {
    
    display: block;
    height: 280px;
    width: 100%;
    
    }
    #file-to-upload {
    display: none;
    }
    #pdf-main-container {
    width: 348px;
    margin: 0px auto;
    }
    #pdf-loader {
    display: none;
    text-align: center;
    color: #999999;
    font-size: 13px;
    line-height: 100px;
    height: 100px;
    }
    #pdf-contents {
    display: none;
    }
    #pdf-meta {
    overflow: hidden;
    margin: 0 0 0px 0;
    }
    #pdf-buttons {
    float: left;
    }
    #page-count-container {
    float: right;
    }
    #pdf-current-page {
    display: inline;
    }
    #pdf-total-pages {
    display: inline;
    }
    #pdf-canvas {
    height: 275px;
    width: 348px;
    }
    #page-loader {
    height: 100px;
    line-height: 100px;
    text-align: center;
    display: none;
    color: #999999;
    font-size: 13px;
    }
    .btns-left{
    background: transparent;
    border: none;
    outline-color: transparent;
    position: absolute;
    top: 40%;
    }
    .btns-right{
    background: transparent;
    border: none;
    outline-color: transparent;
    position: absolute;
    top: 40%;
    right: 5%;
    }
    #calendar {
    max-width: 900px;
    margin: 0 auto;
    }
    .datepicker-days{
    display: none;
    }
    .choose-week{
    width: 100%;
    background: #fff;
    border-color: #ccc;
    color: #555;
    }
    .choose-week:hover{
    width: 100%;
    background: #fff;
    border-color: #ccc;
    color: #555;
    }
    .saving{
    color: #000;
    position: absolute;
    height: 100%;
    background: #fff;
    z-index: 99999;
    width: 100%;
    opacity: 0.5;
    display: none;
    }
    .saving p{
    margin-top: 22%;
    font-size: 42px;
    color: #555;
    text-align: center;
    }
    @keyframes blink {
    /**
    * At the start of the animation the dot
    * has an opacity of .2
    */
    0% {
    opacity: .2;
    }
    /**
    * At 20% the dot is fully visible and
    * then fades out slowly
    */
    20% {
    opacity: 1;
    }
    /**
    * Until it reaches an opacity of .2 and
    * the animation can start again
    */
    100% {
    opacity: .2;
    }
    }
    .saving span {
    /**
    * Use the blink animation, which is defined above
    */
    animation-name: blink;
    /**
    * The animation should take 1.4 seconds
    */
    animation-duration: 1.4s;
    /**
    * It will repeat itself forever
    */
    animation-iteration-count: infinite;
    /**
    * This makes sure that the starting style (opacity: .2)
    * of the animation is applied before the animation starts.
    * Otherwise we would see a short flash or would have
    * to set the default styling of the dots to the same
    * as the animation. Same applies for the ending styles.
    */
    animation-fill-mode: both;
    }
    .saving span:nth-child(2) {
    /**
    * Starts the animation of the third dot
    * with a delay of .2s, otherwise all dots
    * would animate at the same time
    */
    animation-delay: .2s;
    }
    .saving span:nth-child(3) {
    /**
    * Starts the animation of the third dot
    * with a delay of .4s, otherwise all dots
    * would animate at the same time
    */
    animation-delay: .4s;
    }
    </style>
    <!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    -->
    <script type="text/javascript">
    $(function() {
    $('select').change(function(evt) {
    console.log($('select option:selected').data('check'));
    $('select option:selected').data('check') ?
    $('#ifYes').show() : $('#ifYes').hide();
    });
    });
    </script>
    <script type="text/javascript">
    var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
    var output = document.getElementById('output');
    output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
    };
    </script>
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <div class="saving">
        <p>Saving<span>.</span><span>.</span><span>.</span></p>
      </div>
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
        <form method="POST" enctype="multipart/form-data" id="projectCreate">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <div class="row">
              <div class="col-md-6">
                <input type="text" required=""  class="form-control project-name" style="margin-top:  20px;" placeholder="Project Name" name="project_name" id="projectName"  >
              </div>
              <!-- <div class="col-md-3">
                <input type="date" class="form-control" name="calender" style="margin-top:  20px;">
              </div> -->
              <div class="col-md-3">
                <div class="niceCountryInputSelector niceCountrycss" style="margin-top:  20px; z-index: 9;background: white;" data-selectedcountry="IN" data-showspecial="false" data-showflags="true" data-i18nall="All selected"
                  data-i18nnofilter="No selection" data-i18nfilter="Filter" data-onchangecallback="onChangeCallback" />
                </div>
                <input type="hidden"   name="setcountry" id="setcountry">
              </div>
              <div>
                <button type="submit" name="test" class="btn btn-primary pull-right publish-btn" style="margin-right: 20px;margin-top: 20px;">Publish</button>
                <input type="hidden" name="createProject" value="true">
                <input type="hidden" name="email" value="<?php echo $getEmail; ?>">
                <input type="hidden" name="username" value="<?php echo $user_name; ?>">
                
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
              
              <section class="col-lg-4 connectedSortable">
                <!-- solid sales graph -->
                <div class="box box-solid bg-teal-gradient">
                  <!-- /.box-body -->
                  <div class="box-footer no-border incrheight"id="frm">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="col-lg-2 col-md-2 fon">
                          <a href="#">
                            <i class="fa fa-language"></i>
                          </a>
                        </div>
                        <div class="col-lg-10 col-md-10 fon">
                          <div class="container demo-1">
                            <!-- Codrops top bar -->
                            
                            <div class="main clearfix">
                              <div class="column">
                                <div id="dl-menu" class="dl-menuwrapper">
                                  <input type="button" class="dl-trigger form-control" name="" value="Choose Group">
                                  <ul class="dl-menu">
                                    <li>
                                      <a href="#">Education</a>
                                      <ul class="dl-submenu">
                                        <li ><a class="get-edu" href="javascript:void(0)" data-value="add-edu">Add Your Own+</a></li>
                                        <?php
                                        $eduQuery=mysqli_query($conn,"SELECT * FROM education");
                                        while ($getEduData=mysqli_fetch_array($eduQuery)) {
                                        
                                        ?>
                                        
                                        <li><a class="get-edu" href="javascript:void(0)" data-value="<?= $getEduData["name"];?>">
                                          <input type="checkbox" class="checkboxs edu-check" id="edu<?= $getEduData["id"];?>" value="<?= $getEduData["name"];?>" name="fooby[1][]" /> <label style="font-weight: normal;" for="edu<?= $getEduData["id"] ?>"><?= $getEduData["name"];?></label></a></li>
                                          <?php } ?>
                                          
                                          
                                        </ul>
                                      </li>
                                      <li>
                                        <a href="#">ENTR Entrepreneurship</a>
                                        <ul style="max-height: 500px;overflow-y: scroll;" class="dl-submenu">
                                          <form>
                                            <li ><a class="get-entr" href="javascript:void(0)" data-value="add-entr">Add Your Own+</a></li>
                                            
                                            <?php
                                            $subject = mysqli_query($conn,"SELECT * FROM subject");
                                            while ( $subject_new = mysqli_fetch_array($subject)) {
                                            ?>
                                            <li><a class="get-entr" href="javascript:void(0)" data-value="<?= $subject_new["subject"];?>" >
                                              
                                              <input type="checkbox" class="checkboxs entr-check" id="set<?= $subject_new["id"];?>" value="<?= $subject_new["subject"];?>" name="fooby[2][]" /> <label style="font-weight: normal;" for="set<?= $subject_new["id"] ?>"><?= $subject_new["subject"];?></label></a></li>
                                            <?php } ?>      </form>
                                          </ul>
                                        </li>
                                        <li>
                                          <a href="#">Books</a>
                                          <ul style="max-height: 500px;overflow-y: scroll;" class="dl-submenu">
                                            <li ><a class="get-book" href="javascript:void(0)" data-value="add-book">Add Your Own+</a></li>
                                            <?php
                                            $books = mysqli_query($conn,"SELECT * FROM books");
                                            while ($book_data = mysqli_fetch_array($books))
                                            { ?>
                                            
                                            <li><a class="get-book" data-value="<?= $book_data["book"];?>" href="javascript:void(0)">
                                              <input type="checkbox" class="checkboxs book-check" id="radio<?= $book_data["id"];?>" value="<?= $book_data["book"];?>" name="fooby[3][]" /> <label style="font-weight: normal;" for="radio<?= $book_data["id"] ?>"><?= $book_data["book"];?></label> </a></li>
                                              <?php } ?>
                                              
                                            </ul>
                                          </li>
                                          <li>
                                            <a href="#">Magazines</a>
                                            <ul class="dl-submenu">
                                              <li ><a class="get-mag" href="javascript:void(0)" data-value="add-mag">Add Your Own+</a></li>
                                              <?php
                                              $fetchMag=mysqli_query($conn,"SELECT * FROM magazine");
                                              while($getmagData=mysqli_fetch_array($fetchMag))
                                              {
                                              ?>
                                              
                                              <li>
                                                <a class="get-mag" data-value="<?= $getmagData["name"];?>" href="javascript:void(0)">
                                                  <input type="checkbox" class="checkboxs mag-check" id="mag<?= $getmagData["id"];?>" value="<?= $getmagData["name"];?>" name="fooby[4][]" />
                                                  <label style="font-weight: normal;" for="mag<?= $getmagData["id"] ?>"><?= $getmagData["name"];?></label> </a></li>
                                                  <?php } ?>
                                                </ul>
                                              </li>
                                            </ul>
                                            </div><!-- /dl-menuwrapper -->
                                          </div>
                                        </div>
                                        </div><!-- /container -->
                                        
                                      </div>
                                      <input placeholder="Add Your Own Education"  class="form-control add-more-edu" style="display: none;    margin-top: 45px;"  type="text" name="ownEdu">
                                      <input placeholder="Add Your Own Entrepreneurship"  class="form-control add-more-entr" style="display: none;    margin-top: 45px;"  type="text" name="ownEntr">
                                      <input placeholder="Add Your Own Book"  class="form-control add-more-book" style="display: none;    margin-top: 45px;"  type="text" name="ownBook">
                                      <input placeholder="Add Your Own Magazines"  class="form-control add-more-mag" style="display: none;    margin-top: 45px;"  type="text" name="ownMag">
                                    </div>
                                  </div>
                                  <!-- /.row -->
                                </div>
                                <!-- /.box-footer -->
                              </div>
                              <!-- /.box -->
                              <!-- /.box -->
                            </section>
                            
                            <section class="col-lg-4 connectedSortable">
                              <!-- solid sales graph -->
                              <div class="box box-solid bg-teal-gradient">
                                <!-- /.box-body -->
                                <div class="box-footer no-border"id="frm">
                                  <div class="row">
                                    <div class="col-lg-12">
                                      <div class="col-lg-2 fon">
                                        <a href="#">
                                          <i class="fa fa-calendar"></i>
                                        </a>
                                      </div>
                                      <div class="col-lg-10 fon">
                                        <!--   <input type="week" class="form-control" name="calender"  > -->
                                        <button type="button" class="btn   choose-week" data-toggle="modal" data-target="#exampleModal">
                                        Choose Week</button>
                                        <input type="hidden" name="title" id="week-title">
                                        <input type="hidden" name="weekstart" id="week-start">
                                        <input type="hidden" name="weekend" id="week-end">
                                      </div>
                                      
                                      
                                      
                                    </div>
                                  </div>
                                  <!-- /.row -->
                                </div>
                                <!-- /.box-footer -->
                              </div>
                              <!-- /.box -->
                              <!-- /.box -->
                            </section>
                            <section class="col-lg-4 connectedSortable">
                              <!-- solid sales graph -->
                              <div class="box box-solid bg-teal-gradient">
                                <!-- /.box-body -->
                                <div class="box-footer no-border"id="frm">
                                  <div class="row">
                                    <div class="col-lg-12">
                                      <div class="col-lg-2 fon">
                                        <a href="#">
                                          <i class="fa fa-book"></i>
                                        </a>
                                      </div>
                                      <div class="col-lg-10 fon">
                                        <select  name="grade" class="form-control" id="chooseBook">
                                          <option value="" selected disabled> Grade</option>
                                          <option data-check="true" value="more" >(+) Add Your Own</option>
                                          
                                          
                                          <optgroup label="KINDERGARTEN +5">
                                            <option data-check="true" value="more" >(+) Add Your Own</option>
                                            <option data-check="true" value="KINDERGARTEN" >KINDERGARTEN</option>
                                            
                                          </optgroup>
                                          <option value="1 – 12 ELEMENTARY SCHOOL">KG - 4th PRIMARY SCHOOL</option>
                                          <option value="1 – 12 MIDDLE SCHOOL">5 – 9th MIDDLE SCHOOL</option>
                                          <option value="1 – 12 HIGH SCHOOL">10th – 12th HIGH SCHOOL</option>
                                          <option value="UNIVERSITY +">UNIVERSITY +</option>
                                          
                                        </select>
                                        
                                        <div id="InputBook" style="display: none;margin-top: 10px;">
                                          <input   type="text" id="car" name="owngrade" class="form-control" placeholder="Add Your Own Grade" />
                                        </div>
                                      </div>
                                      <script type="text/javascript">
                                      $("#chooseBook").change(function(){
                                      var val=$("#chooseBook").val();
                                      //alert(val);
                                      if(val=="more"){
                                      $("#InputBook").show();
                                      
                                      }
                                      if(val!="more"){
                                      $("#InputBook").hide();
                                      $("#car").val('')
                                      
                                      }
                                      });
                                      </script>
                                      
                                      
                                    </div>
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
                          <div class="container">
                            <div class="col-md-4">
                              <div class="panel panel-default">
                                <div class="">
                                  <div class="main">
                                    <img onclick="openfileDialog();" style="cursor: pointer;" width="100%" height="280px" src="dist/img/main-icon.png"  id="output"/>
                                  </div>
                                </div>
                                <div class="panel-footer"id="pn"><strong>Upload Image </strong><br>
                                  <input id="fileLoader" style="display: none;" multiple  type="file" accept="image/*" onchange="loadFile(event)" name="images[]" >
                                  <span>Supports PNG/Jpeg</span>
                                  <span> <i class="fa fa-image pull-right"></i></span>
                                  
                                </div>
                              </div>
                            </div>
                            
                            <div class="col-md-4" id="doc">
                              <div class="panel panel-default">
                                <img id="upload-button" class="img-responsive" src="dist/img/main-icon.png">
                                <!--   <button type="button" id="upload-button">Select PDF</button>  -->
                                <input name="myPDF" type="file" id="file-to-upload" accept=".pdf,.doc" />
                                <div id="pdf-main-container">
                                  <div id="pdf-loader">Loading document ...</div>
                                  <div id="pdf-contents">
                                    <div id="pdf-meta">
                                      <div id="pdf-buttons">
                                        <button type="button" class="btns-left" id="pdf-prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
                                        <button type="button" class="btns-right" id="pdf-next"><i class="fa fa-chevron-right" aria-hidden="true"></i></button>
                                      </div>
                                      <!-- <div id="page-count-container">Page <div id="pdf-current-page"></div> of <div id="pdf-total-pages"></div></div> -->
                                    </div>
                                    <canvas id="pdf-canvas" width="400"></canvas>
                                    <div id="page-loader">Loading page ...</div>
                                  </div>
                                </div>
                                <div class="panel-footer" id="pn"><strong id="uploadDoc">Upload Document</strong><br>
                                  
                                  <span>Supports PDF,DOC</span>
                                  <span> <i class="fa fa-file pull-right"></i></span>
                                  
                                  <script type="text/javascript">
                                  
                                  
                                  function PreviewImage() {
                                  pdffile=document.getElementById("uploadPDF").files[0];
                                  pdffile_url=URL.createObjectURL(pdffile);
                                  $('#viewer').attr('src',pdffile_url);
                                  }
                                  </script>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="panel panel-default">
                                <div class="">
                                  <div class="main">
                                    <img onclick="openfileobj();" src="dist/img/main-icon.png" width="100%" height="280px">
                                  </div>
                                </div>
                                <div class="panel-footer"id="pn"><strong>Upload Model</strong> <small>(Supports OBJ,FBX)</small><br>
                                  <input type="file" style="display: none;" id="uploadobj" name="modelobj" accept=".obj,.fbx" class="form-control">
                                  <input type="file" id="uplaodmtl" name="modelmtl" style="display: none" accept=".mtl"  class="form-control">
                                  <input type="file" id="zipuploader" name="zipfile" style="display: none" accept=".zip" >
                                  <span onclick="openmtl();" class="text-info" style="cursor: pointer;">Upload MTL</span>
                                  <span onclick="openzip();" class="text-info" style="cursor: pointer;">Upload ZIP</span>
                                  
                                  
                                  <span > <i class="fa fa-object-ungroup pull-right"></i></span>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- 2nd Container -->
                          <div class="container">
                            <div class="col-md-4">
                              <div class="panel panel-default">
                                <div class="">
                                  <div class="main">
                                    <img onclick="objthumbnail();" style="cursor: pointer;" width="100%" height="280px" src="dist/img/main-icon.png"  id="blah"/>
                                  </div>
                                </div>
                                <div class="panel-footer"id="pn"><strong>Upload OBJ/FBX Thumbnail </strong><br>
                                  <input id="objThumb" style="display: none;" type="file" accept="image/*"  onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" name="objThumbnail" >
                                  <span>Supports PNG/Jpeg</span>
                                  <span> <i class="fa fa-image pull-right"></i></span>
                                  
                                </div>
                              </div>
                            </div>
                            
                            <div class="col-md-4">
                              <div class="panel panel-default">
                                <div class="main">
                                  <img onclick="audioFile();" style="cursor: pointer;" width="100%" height="280px" src="dist/img/main-icon.png"  id="blah"/>
                                  <audio controls style="position: absolute;left: 16px;bottom: 88px; width: 91%;">
                                    <source id="audiosrc" src="" type="audio/mp3">
                                  </audio>
                                  <input id="audioselect" style="display: none;" type="file" accept="audio/*" name="audio" >
                                </div>
                                <div class="panel-footer" id="pn"><strong id="uploadDoc">Upload Audio</strong><br>
                                  
                                  <span>Supports Mp3,WAV,OGG</span>
                                  <span> <i class="fa fa-music pull-right"></i></span>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="panel panel-default">
                                <div class="">
                                  <div class="main">
                                    <img onclick="videoThumbFile();" id="videothumb" src="dist/img/main-icon.png" width="100%" height="280px" style="cursor: pointer;">
                                  </div>
                                </div>
                                <div class="panel-footer"id="pn"><strong>Upload Video Thumbnail</strong> <small></small><br>
                                  <input type="file" style="display: none;" id="videoThumb" name="videoThumb" accept="image/*" onchange="document.getElementById('videothumb').src = window.URL.createObjectURL(this.files[0])" class="form-control">
                                  <span>Supports PNG/Jpeg</span>
                                  <span > <i class="fa fa-video-camera pull-right"></i></span>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- end 2nd Container -->
                          <div class="container">
                            <div class="col-md-12">
                              <div class="panel panel-default" id="m">
                                <div class="panel-body" style="padding: 0;cursor: pointer;" id="videoFileUpload1">
                                  <img src="https://pitchar.io/dist/img/main-icon.png" id="videoPlaceholder" height="600px" width="100%">
                                  <video id="videoPlayer" style="display: none;" width="100%" controls>
                                    <source src="" id="video_here">
                                    Your browser does not support HTML5 video.
                                  </video>
                                </div>
                                <div class="panel-footer" id="videoFileUpload"><strong>Upload Video</strong><br>
                                  <span>Supports Mp4</span>
                                  <input type="file" name="files" style="display: none;" id="FileUpload4" class="file_multi_video" accept="video/*">
                                  <span> <i class="fa fa-file-video-o pull-right"></i></span>
                                </div>
                              </div>
                              
                              
                              <!-- <div id="videoFileUpload1">Select</div> -->
                              <!--<input type="file" name="file[]" style="display: none;" id="FileUpload4" class="file_multi_video" accept="video/*">-->
                              
                              <script type="text/javascript">
                              $(function () {
                              var fileupload = $("#FileUpload4");
                              var filePath = $("#spnFilePath1");
                              var image = $("#videoFileUpload1");
                              image.click(function () {
                              fileupload.click();
                              });
                              fileupload.change(function () {
                              var fileName = $(this).val().split('\\')[$(this).val().split('\\').length - 1];
                              filePath.html("<b>Selected File: </b>" + fileName);
                              $("#videoPlaceholder").hide();
                              $("#videoPlayer").show();
                              });
                              });
                              $(document).on("change", ".file_multi_video", function(evt) {
                              var $source = $('#video_here');
                              $source[0].src = URL.createObjectURL(this.files[0]);
                              $source.parent()[0].load();
                              });
                              $(document).on("change", "#audioselect", function(evt) {
                              var $source = $('#audiosrc');
                              $source[0].src = URL.createObjectURL(this.files[0]);
                              $source.parent()[0].load();
                              });
                              </script>
                              
                              
                              
                            </div>
                          </div>
                          <!-- /.row (main row) -->
                          
                          <div class="container">
                            <div class="col-md-12">
                              <div class="panel panel-default" >
                                <div class="panel-body">
                                  
                                  <textarea   class="form-control" name="notes" placeholder="Writer Your Notes Here..."></textarea>
                                </div>
                              </div>
                            </div>
                          </div>
                        </section>
                        <!-- /.content -->
                      </form>
                    </div>
                    <!-- /.content-wrapper -->
                    <?php include'footer.php';?>
                    <!-- Control Sidebar -->
                    
                    <!-- /.control-sidebar -->
                    <!-- Add the sidebar's background. This div must be placed
                    immediately after the control sidebar -->
                    <div class="control-sidebar-bg"></div>
                  </div>
                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Select Date</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div id='calendar'></div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- ./wrapper -->
                  <!--       <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script> -->
                  <script type="text/javascript" src="js/multilevel-dropdown.js"></script>
                  <script>
                  $('.multilevel-dropdown').multilevelDropdown().on('change', function (event) {
                  console.log($(this).val());
                  });
                  </script>
                  <!-- jQuery 3 -->
                  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
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
                  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                  
                  <script type="text/javascript">
                  
                  function openfileDialog() {
                  $("#fileLoader").click();
                  }
                  function openfileobj() {
                  $("#uploadobj").click();
                  }
                  
                  function openmtl() {
                  $("#uplaodmtl").click();
                  }
                  function openzip() {
                  $("#zipuploader").click();
                  }
                  function objthumbnail() {
                  $("#objThumb").click();
                  }
                  function audioFile() {
                  $("#audioselect").click();
                  }
                  
                  function videoThumbFile() {
                  $("#videoThumb").click();
                  }
                  </script>
                  <!-- For Pdf Preview -->
                  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script> -->
                  
                  
                  <script type="text/javascript" src="js/pdf.worker.js"></script>
                  <script type="text/javascript" src="js/pdf.js"></script>
                  <!--     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
                  <script src="js/jquery.dlmenu.js"></script>
                  <script>
                  $(function() {
                  $( '#dl-menu' ).dlmenu();
                  });
                  $(".hello").click(function(){
                  var vals=$(this).data("value");
                  alert(vals);
                  $(".dl-trigger").click();
                  });
                  </script>
                  
                  <script>
                  var __PDF_DOC,
                  __CURRENT_PAGE,
                  __TOTAL_PAGES,
                  __PAGE_RENDERING_IN_PROGRESS = 0,
                  __CANVAS = $('#pdf-canvas').get(0),
                  __CANVAS_CTX = __CANVAS.getContext('2d');
                  function showPDF(pdf_url) {
                  $("#pdf-loader").show();
                  PDFJS.getDocument({ url: pdf_url }).then(function(pdf_doc) {
                  __PDF_DOC = pdf_doc;
                  __TOTAL_PAGES = __PDF_DOC.numPages;
                  
                  // Hide the pdf loader and show pdf container in HTML
                  $("#pdf-loader").hide();
                  $("#pdf-contents").show();
                  $("#pdf-total-pages").text(__TOTAL_PAGES);
                  // Show the first page
                  showPage(1);
                  }).catch(function(error) {
                  // If error re-show the upload button
                  $("#pdf-loader").hide();
                  $("#upload-button").show();
                  
                  alert(error.message);
                  });;
                  }
                  function showPage(page_no) {
                  __PAGE_RENDERING_IN_PROGRESS = 1;
                  __CURRENT_PAGE = page_no;
                  // Disable Prev & Next buttons while page is being loaded
                  $("#pdf-next, #pdf-prev").attr('disabled', 'disabled');
                  // While page is being rendered hide the canvas and show a loading message
                  $("#pdf-canvas").hide();
                  $("#page-loader").show();
                  // Update current page in HTML
                  $("#pdf-current-page").text(page_no);
                  
                  // Fetch the page
                  __PDF_DOC.getPage(page_no).then(function(page) {
                  // As the canvas is of a fixed width we need to set the scale of the viewport accordingly
                  var scale_required = __CANVAS.width / page.getViewport(1).width;
                  // Get viewport of the page at required scale
                  var viewport = page.getViewport(scale_required);
                  // Set canvas height
                  __CANVAS.height = viewport.height;
                  var renderContext = {
                  canvasContext: __CANVAS_CTX,
                  viewport: viewport
                  };
                  
                  // Render the page contents in the canvas
                  page.render(renderContext).then(function() {
                  __PAGE_RENDERING_IN_PROGRESS = 0;
                  // Re-enable Prev & Next buttons
                  $("#pdf-next, #pdf-prev").removeAttr('disabled');
                  // Show the canvas and hide the page loader
                  $("#pdf-canvas").show();
                  $("#page-loader").hide();
                  });
                  });
                  }
                  // Upon click this should should trigger click on the #file-to-upload file input element
                  // This is better than showing the not-good-looking file input element
                  $("#upload-button").on('click', function() {
                  $("#file-to-upload").trigger('click');
                  });
                  // When user chooses a PDF file
                  $("#file-to-upload").on('change', function() {
                  // Validate whether PDF
                  var fileInput = document.getElementById('file-to-upload');
                  var filename = fileInput.files[0].name;
                  var sp=filename.split(".");
                  if (sp[1]=='pdf') {
                  if(['application/pdf'].indexOf($("#file-to-upload").get(0).files[0].type) == -1) {
                  alert('Error : Not a PDF');
                  return;
                  }
                  $("#upload-button").hide();
                  // Send the object url of the pdf
                  showPDF(URL.createObjectURL($("#file-to-upload").get(0).files[0]));
                  }
                  if (sp[1]=='doc' || sp[1]=='docx' || sp[1]=='DOC' || sp[1]=='DOCX') {
                  $("#uploadDoc").text('Doc File Uploaded');
                  }
                  });
                  // Previous page of the PDF
                  $("#pdf-prev").on('click', function() {
                  if(__CURRENT_PAGE != 1)
                  showPage(--__CURRENT_PAGE);
                  });
                  // Next page of the PDF
                  $("#pdf-next").on('click', function() {
                  if(__CURRENT_PAGE != __TOTAL_PAGES)
                  showPage(++__CURRENT_PAGE);
                  });
                  $(".get_click").click(function(){
                  alert('moiz');
                  });
                  $(".getcontent").click(function(){
                  var getval=$(this).data("value");
                  $(".dl-trigger").val(getval);
                  //$(".dl-trigger").click();
                  });
                  function onChangeCallback(ctr){
                  console.log("The country was changed: " + ctr);
                  //$("#selectionSpan").text(ctr);
                  }
                  $(document).ready(function () {
                  $(".niceCountryInputSelector").each(function(i,e){
                  new NiceCountryInput(e).init();
                  });
                  $(".chooseCountry").click(function(){
                  var getcountry= $(this).data("countryname");
                  $("#setcountry").val(getcountry);
                  });
                  // Education
                  $(".get-edu").click(function(){
                  var getEdu=$(this).data("value");
                  if (getEdu=="add-edu") {
                  $('.add-more-edu').show();
                  $('.edu-check').prop('checked', false);
                  }
                  if (getEdu!='add-edu') {
                  $('.add-more-edu').hide();
                  $('.add-more-edu').val('');
                  }
                  });
                  // Entr
                  $(".get-entr").click(function(){
                  var getEntr=$(this).data("value");
                  if (getEntr=='add-entr') {
                  $('.add-more-entr').show();
                  $('.entr-check').prop('checked',false);
                  }
                  if (getEntr!='add-entr') {
                  $('.add-more-entr').hide();
                  $('.add-more-entr').val('');
                  }
                  });
                  // book
                  $(".get-book").click(function(){
                  var getbook=$(this).data("value");
                  if (getbook=='add-book') {
                  $('.add-more-book').show();
                  $('.book-check').prop('checked',false);
                  }
                  if (getbook!='add-book') {
                  $('.add-more-book').hide();
                  $('.add-more-book').val('');
                  }
                  });
                  // mag
                  $(".get-mag").click(function(){
                  var getmag=$(this).data("value");
                  if (getmag=='add-mag') {
                  $('.add-more-mag').show();
                  $('.mag-check').prop('checked',false);
                  }
                  if (getmag!='add-mag') {
                  $('.add-more-mag').hide();
                  $('.add-more-mag').val('');
                  }
                  });
                  /*
                  $(".publish-btn").click(function(){
                  var getProjectName=$(".project-name").val();
                  if (getProjectName!="") {
                  $(".saving").show();
                  }
                  });*/
                  
                  });
                  $(".checkboxs").on('click', function() {
                  // in the handler, 'this' refers to the box clicked on
                  var $box = $(this);
                  if ($box.is(":checked")) {
                  // the name of the box is retrieved using the .attr() method
                  // as it is assumed and expected to be immutable
                  var group = "input:checkbox[name='" + $box.attr("name") + "']";
                  // the checked state of the group/box on the other hand will change
                  // and the current value is retrieved using .prop() method
                  $(group).prop("checked", false);
                  $box.prop("checked", true);
                  } else {
                  $box.prop("checked", false);
                  }
                  });
                  $("#projectCreate").on('submit',function(event) {
                  event.preventDefault();
                  $(".saving").show();
                  var formdata =new FormData(this);
                  $.ajax({
                  url: 'assets/_php/projectCreate.php',
                  type: 'POST',
                  dataType: 'json',
                  data:formdata,
                  processData:false,
                  cache:false,
                  contentType:false,
                  })
                  .done(function(data) {
                  if (data.response.code=='1') {
                  $(".saving").slideUp('slow');
                  setTimeout(function(){  swal('Success',data.response.msg,"success"); }, 1000);
                  window.location='dashboard.php';
                  
                  }
                  else{
                  $(".saving").slideUp('slow');
                  setTimeout(function(){  swal('Oh Snap',data.response.msg,"error"); }, 1000);
                  window.location='index.php';
                  }
                  console.log("success");
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