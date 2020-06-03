<?php
include 'secure_session.php';
if (!isset($_GET["pid"]) OR empty($_GET["pid"])) {
    header("Location:index.php");
 }

 if (isset($_GET["pid"]) OR !empty($_GET["pid"]) ) {
    # code...
     $getProjectToken=$_GET["pid"];
   $fetchProject=mysqli_query($conn,"SELECT * FROM tbl_std_project WHERE token='$getProjectToken'");
   $getProject=mysqli_fetch_array($fetchProject);
    $UserEmail=$getProject["email"];
    $projectToken=$getProject["token"];

    if ($UserEmail!=$getEmail) {
        header("Location:index.php");
    }

  } 





  

// if(isset($_POST["publish"])){
//            $pname=mysqli_real_escape_string($conn, $_POST["project_name"]);
//            $sub=mysqli_real_escape_string($conn, $_POST["subject"]);
//            $OwnSub=mysqli_real_escape_string($conn, $_POST["ownsub"]);
//            $book=mysqli_real_escape_string($conn, $_POST["book"]);
//            $userbook=mysqli_real_escape_string($conn, $_POST["userbook"]);
  
  
  
//             $getSubject = ($sub=="more") ? $OwnSub : $sub ;
            
//             $getBook = (!empty($userbook)) ? $userbook : $book ;
//            $cnt=$_POST["cnt"];
//         //image
        
//             //   $valid_formats = array("jpg", "png", "gif", "bmp","jpeg");  
//             //   $name = $_FILES['images']['name'];
//             // 	$size = $_FILES['images']['size'];
//             // 	if(strlen($name)) {
//             // 		list($txt, $ext) = explode(".", $name);
//             // 		if(in_array($ext,$valid_formats)) {
//             // 			if($size<(1024*1024)) {
//             // 				  $image_name = time().".".$ext;
//             // 				$tmp = $_FILES['images']['tmp_name'];
//             // 				move_uploaded_file($tmp, "uploads/imgs/".$image_name);
//             // }
//             // }
//             // }   

//            $errors = array();
//             $uploadedFiles = array();
//             $extension = array("jpeg","jpg","png");
//             $bytes = 1024;
//             $KB = 1024;
//             $totalBytes = $bytes * $KB;
//             $UploadFolder = "uploads/imgs/";
             
//             $counter = 0;
             
//             foreach($_FILES["images"]["tmp_name"] as $key=>$tmp_name){
//                 $temp = $_FILES["images"]["tmp_name"][$key];
//                 $name = $_FILES["images"]["name"][$key];
                 
//                 if(empty($temp))
//                 {
//                     break;
//                 }
                 
//                 $counter++;
//                 $UploadOk = true;
                 
//                 if($_FILES["images"]["size"][$key] > $totalBytes)
//                 {
//                     $UploadOk = false;
//                     array_push($errors, $name." file size is larger than the 1 MB.");
//                 }
                 
//                 $ext = pathinfo($name, PATHINFO_EXTENSION);
//                 if(in_array($ext, $extension) == false){
//                     $UploadOk = false;
//                     array_push($errors, $name." is invalid file type.");
//                 }
                 
//                 if(file_exists($UploadFolder."/".$name) == true){
//                     $UploadOk = false;
//                     array_push($errors, $name." file is already exist.");
//                 } 
//                  $getname=rand(10,100000000).$name;
//                 if($UploadOk == true){
//                     move_uploaded_file($temp,$UploadFolder."/".$getname);
//                     array_push($uploadedFiles, $getname);
//                 }
//             }
             
//             if($counter>0){
//                 if(count($uploadedFiles)>0){
//                     foreach($uploadedFiles as $fileName)
//                     {
                         
                     
//                     mysqli_query($conn,"INSERT INTO tbl_project_image(image,token)VALUES('$fileName','$token')") ;

//                     }
                            
                   
//                 }                               
//             }
            
            
            
            
//         //   $img= $_FILES["images"];
//         //   $imgname= $_FILES["images"]["name"];
//         //   $tempname= $_FILES["images"]["tmp_name"];
//         //   move_uploaded_file($tempname, "uploads/imgs/".$imgname);
           
           
//         //docs
//            $doc= $_FILES["myPDF"];
//            $docname= $_FILES["myPDF"]["name"];
//            $doctempname= $_FILES["myPDF"]["tmp_name"];
//            move_uploaded_file($doctempname, "uploads/docs/".$docname);
//         //video
//            $video= $_FILES["files"];
//            $videoname= $_FILES["files"]["name"];
//            $videotempname= $_FILES["files"]["tmp_name"];
//            move_uploaded_file($videotempname, "uploads/video/".$videoname);


//            $valid_formats = array("obj");  
//               $name = $_FILES['modelobj']['name'];
//               $size = $_FILES['modelobj']['size'];
//               if(strlen($name)) {
//                 list($txt, $ext) = explode(".", $name);
//                 if(in_array($ext,$valid_formats)) {
//                   if($size<(10240*10240)) {
//                       $obj_name = time().".".$ext;
//                     $tmp = $_FILES['modelobj']['tmp_name'];
//                     move_uploaded_file($tmp, "uploads/obj/".$obj_name);
//             }
//             }
//             }  


//              $valid_formatsmtl = array("mtl");  
//               $namemtl = $_FILES['modelmtl']['name'];
//               $sizemtl = $_FILES['modelmtl']['size'];
//               if(strlen($namemtl)) {
//                 list($txt, $ext) = explode(".", $namemtl);
//                 if(in_array($ext,$valid_formatsmtl)) {
//                   if($sizemtl<(10240*10240)) {
//                       $mtl_name = time().".".$ext;
//                     $tmp = $_FILES['modelmtl']['tmp_name'];
//                     move_uploaded_file($tmp, "uploads/mtl/".$mtl_name);
//             }
//             }
//             }  


//         //obj
//            //  $obj= $_FILES["files"];
//            // $objname= $_FILES["files"]["name"];
//            // $objtempname= $_FILES["files"]["tmp_name"];
//            // //move_uploaded_file($videotempname, "uploads/video/".$videoname);
//            // move_uploaded_file($objtempname, time() . "_{$objname}");

//            $notes=mysqli_real_escape_string($conn, $_POST["notes"]);
//            $year=mysqli_real_escape_string($conn, $_POST["year"]);
//            $calender=mysqli_real_escape_string($conn, $_POST["calender"]);
           
//            $sub_query=mysqli_query($conn,"INSERT INTO tbl_std_project(name,token,project_name,email,subject,language,year,book,image,objfile,mtlfile,video,notes,docs,country,submit_time,calender)VALUES('$user_name','$token','$pname','$getEmail','$getSubject','$cnt','$year','$getBook','1','$obj_name','$mtl_name','$videoname','$notes','$docname','$country',NOW(),'$calender')");
//            $getBooks = mysqli_query($conn,"SELECT * FROM books WHERE book='$userbook'");
//            $countBooks=mysqli_num_rows($getBooks);
//            if ($countBooks=="0") {
//              mysqli_query($conn,"INSERT INTO books(book)VALUES('$userbook')");
//            }

//            $getAllSubject=mysqli_query($conn,"SELECT * FROM subject WHERE subject='$getSubject'");
//            $countSubject=mysqli_num_rows($getAllSubject);
//            if ($countSubject=="0") {
//              mysqli_query($conn,"INSERT INTO subject(subject)VALUES('$getSubject')");
//            }




 
//           if($sub_query){
              
//               header("Location:view-global.php?project=$token");
//           }
           
//         }
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Create new Project</title>
      <!-- Tell the browser to be responsive to screen width -->
      <?php include 'favicon.php'; ?>
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
      <link rel="stylesheet" type="text/css" href="assets/lightbox/css/simplelightbox.css">
      <!-- lightbox -->

      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
       <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
		 <form method="POST" enctype="multipart/form-data"> 
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <div class="row">
                  <div class="col-md-6">
                    <input type="text" value="<?= $getProject['project_name'] ?>" class="form-control" style="margin-top:  20px;" placeholder="Project Name" name="project_name" required="true" >


                  </div>
                  <!-- <div class="col-md-3">
                     <input type="date" class="form-control" name="calender" style="margin-top:  20px;">
                  </div> -->
                  <div class="col-md-2 ">
                     <button type="submit" style="margin-top:  20px;"  name="publish" class="btn btn-primary">Publish</button> 
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
                  <section class="col-lg-3 connectedSortable">
                     <!-- solid sales graph -->
                     <div class="box box-solid bg-teal-gradient">
                        <!-- /.box-body -->
                        <div class="box-footer no-border" id="frm">
                           <div class="row">
                              <div class="col-lg-12">
                                 <div class="col-lg-2 fon">
                                    <a href="#">
                                    <i class="fa fa-graduation-cap"></i>
                                    </a>
                                 </div>
                                 <div class="col-lg-10 fon">
                                  <select required name="subject" class="form-control" id="choosesubject">
                                        <option value="" selected  ><?php  echo $getSub=$getProject["subject"]; ?></option>
                                        <option data-check="true" value="more" >(+) Add Your Own</option>
										<?php

$subject = mysqli_query($conn,"SELECT * FROM subject WHERE NOT subject='$getSub'");

while ( $subject_new = mysqli_fetch_array($subject)) 
{
 ?>
  <option value="<?= $subject_new["subject"];?>"><?= $subject_new["subject"];?></option>

  <?php } ?>
									     

										</select>
 

                        <div id="ifYes" style="display: none;margin-top: 10px;">
                           <input type="text" id="car" name="ownsub" class="form-control" placeholder="Add Your Own" /> 
                        </div>
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

                  <section class="col-lg-3 connectedSortable">
                     <!-- solid sales graph -->
                     <div class="box box-solid bg-teal-gradient">
                        <!-- /.box-body -->
                        <div class="box-footer no-border"id="frm">
                           <div class="row">
                              <div class="col-lg-12">
                                 <div class="col-lg-2 fon">
                                    <a href="#">
                                    <i class="fa fa-language"></i>
                                    </a>
                                 </div>
                                 <div class="col-lg-10 fon">
                                  <select required="true" name="cnt" style="color:#000;" class="form-control">  
     
     <option value="<?= $getProject["language"];?>"><?php echo $getProject["language"]; ?></option>
    <option value="Afrikaans">Afrikaans</option>
    <option value="Albanian">Albanian</option>
    <option value="Amharic">Amharic</option>
    <option value="Arabic">Arabic</option>
    <option value="Armenian">Armenian</option>
    <option value="Azerbaijani">Azerbaijani</option>
    <option value="Basque">Basque</option>
    <option value="Belarusian">Belarusian</option>
    <option value="Bengali">Bengali</option>
    <option value="Bosnian">Bosnian</option>
    <option value="Bulgarian">Bulgarian</option>
    <option value="Catalan">Catalan</option>
    <option value="Cebuano">Cebuano</option>
    <option value="Chichewa">Chichewa</option>
    <option value="Chinese">Chinese</option>
    <option value="Corsican">Corsican</option>
    <option value="Croatian">Croatian</option>
    <option value="Czech">Czech</option>
    <option value="Danish">Danish</option>
    <option value="Dutch">Dutch</option>
    <option value="English">English</option>
    <option value="Esperanto">Esperanto</option>
    <option value="Estonian">Estonian</option>
    <option value="Filipino">Filipino</option>
    <option value="Finnish">Finnish</option>
    <option value="French">French</option>
    <option value="Frisian">Frisian</option>
    <option value="Galician">Galician</option>
    <option value="Georgian">Georgian</option>
    <option value="German">German</option>
    <option value="Greek">Greek</option>
    <option value="Gujarati">Gujarati</option>
    <option value="Haitian Creole">Haitian Creole</option>
    <option value="Hausa">Hausa</option>
    <option value="Hawaiian">Hawaiian</option>
    <option value="Hebrew">Hebrew</option>
    <option value="Hindi">Hindi</option>
    <option value="Hmong">Hmong</option>
    <option value="Hungarian">Hungarian</option>
    <option value="Icelandic">Icelandic</option>
    <option value="Igbo">Igbo</option>
    <option value="Indonesian">Indonesian</option>
    <option value="Irish">Irish</option>
    <option value="Italian">Italian</option>
    <option value="Japanese">Japanese</option>
    <option value="Javanese">Javanese</option>
    <option value="Kannada">Kannada</option>
    <option value="Kazakh">Kazakh</option>
    
    <option value="Khmer">Khmer</option>
    <option value="Korean">Korean</option>
    <option value="Kurdish">Kurdish (Kurmanji)</option>
    <option value="Kyrgyz">Kyrgyz</option>
    <option value="Lao">Lao</option>
    <option value="Latin">Latin</option>
    <option value="Latvian">Latvian</option>
    <option value="Lithuanian">Lithuanian</option>
    <option value="Luxembourgish">Luxembourgish</option>
    <option value="Macedonian">Macedonian</option>
    <option value="Malagasy">Malagasy</option>
    <option value="Malay">Malay</option>
    <option value="Malayalam">Malayalam</option>
    <option value="Maltese">Maltese</option>
    <option value="Maori">Maori</option>
    <option value="Marathi">Marathi</option>
    <option value="Mongolian">Mongolian</option>
    <option value="Myanmar (Burmese)">Myanmar (Burmese)</option>
    <option value="Nepali">Nepali</option>
    <option value="Norwegian">Norwegian</option>
    <option value="Pashto">Pashto</option>
    <option value="Persian">Persian</option>
    <option value="Polish">Polish</option>
    <option value="Portuguese">Portuguese</option>
    <option value="Punjabi">Punjabi</option>
    
    <option value="Romanian">Romanian</option>
    <option value="Russian">Russian</option>
    <option value="Samoan">Samoan</option>
    <option value="Scots">Scots Gaelic</option>
    <option value="Serbian">Serbian</option>
    <option value="Sesotho">Sesotho</option>
    <option value="Shona">Shona</option>
    <option value="Sindhi">Sindhi</option>
    <option value="Sinhala">Sinhala</option>
    <option value="Slovak">Slovak</option>
    <option value="Slovenian">Slovenian</option>
    <option value="Somali">Somali</option>
    <option value="Spanish">Spanish</option>
    <option value="Sundanese">Sundanese</option>
    <option value="Swahili">Swahili</option>
    <option value="Swedish">Swedish</option>
    <option value="Tajik">Tajik</option>
    <option value="Tamil">Tamil</option>
    <option value="Telugu">Telugu</option>
    <option value="Thai">Thai</option>
    <option value="Turkish">Turkish</option>
    <option value="Ukrainian">Ukrainian</option>
    <option value="Urdu">Urdu</option>
    <option value="Uzbek">Uzbek</option>
    <option value="Vietnamese">Vietnamese</option>
    <option value="Welsh">Welsh</option>
    <option value="Xhosa">Xhosa</option>
    <option value="Yiddish">Yiddish</option>
    <option value="Yoruba">Yoruba</option>
    <option value="Zulu">Zulu</option>
    </select>   
    
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
                  
                    <section class="col-lg-3 connectedSortable">
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
                                    <input type="date" class="form-control" name="calender"  >
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

                  <section class="col-lg-3 connectedSortable">
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

                                  <select required name="book" class="form-control" id="chooseBook">
                                        <option value="<?= $getProject['book']; ?>" selected  > <?= $getProject['book']; ?></option>
                                        <option data-check="true" value="more" >(+) Add Your Own</option>
  <?php 
$books = mysqli_query($conn,"SELECT * FROM books WHERE NOT book='".$getProject['book']."' ");
while ($book_data = mysqli_fetch_array($books)) 
{ ?>  
                                <option value="<?= $book_data["book"]; ?>"><?= $book_data["book"]; ?></option>
 <?php } ?>
                       

                    </select>
 

                        <div id="InputBook" style="display: none;margin-top: 10px;">
                           <input required type="text" id="car" name="ownsub" class="form-control" placeholder="Add Your Own" /> 
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
<?php $fetchImages=mysqli_query($conn,"SELECT * FROM tbl_project_image WHERE token='$projectToken'");
       $getImages=mysqli_fetch_array($fetchImages); 

if (empty($getImages["image"])): ?>
    <img onclick="openfileDialog();" style="cursor: pointer;" width="100%" height="280px" src="dist/img/main-icon.png"  id="output"/>
 <?php endif ?>
 <?php if (!empty($getImages["image"])): ?>
  <?php
  $i=0;
  $fetchImages=mysqli_query($conn,"SELECT * FROM tbl_project_image WHERE token='$projectToken'");
   while ($getAllImg=mysqli_fetch_array($fetchImages)) { 
      $i++;
    
   ?>
    <a <?php echo ($i>1)? "style='display:none;'":"style='display:block;'"?>  href="uploads/imgs/<?= $getAllImg["image"]?>">
      <img  style="cursor: pointer;" width="100%" height="280px" src="uploads/imgs/<?= $getAllImg["image"]?>"  id="output"/>
    </a>
  <?php } ?>
 <?php endif ?>
                                               
                                               
                           </div>
                        </div>
                        <div class="panel-footer"id="pn"><strong>Upload Image</strong><br>
						  <input id="fileLoader" style="display: none;" multiple  type="file" accept="image/*" onchange="loadFile(event)" name="images[]" >
                           <span>Supports PNG/Jpeg</span>
                           <span> <i class="fa fa-image pull-right"></i></span>
						  
                        </div>
                     </div>
                  </div>
                  
                    <div class="col-md-4" id="doc">
                     <div class="panel panel-default" >
                      <?php if (empty($getProject["docs"])): ?>
                          <img id="upload-button" class="img-responsive" src="dist/img/main-icon.png">
                      <?php endif ?>
                      <?php if (!empty($getProject["docs"])): ?>
                          <iframe  height="275px" width="100%" src="uploads/docs/<?php echo $getProject["docs"]; ?>"></iframe>
                      <?php endif ?>
                      
                      <!--   <button type="button" id="upload-button">Select PDF</button>  -->
                        <input name="myPDF" type="file" id="file-to-upload" />

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


                        <div class="panel-footer" id="pn"><strong >Upload Document</strong><br>
                          
                           <span>Supports PDF</span>
                           <span> <i class="fa fa-image pull-right"></i></span>
						    
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
                           <div  class="main">
                            <?php if (empty($getProject["objfile"])) { ?>
                              <img   src="dist/img/main-icon.png" width="100%" height="280px">
                            <?php } if (!empty($getProject["objfile"])) { ?>
                              <iframe   height="275px" width="100%" src="obj-viewer.php?token=<?= $getProject["token"]; ?>"></iframe>
                            <?php } ?>

                           </div>
                        </div>
                        <div  class="panel-footer uploadModel" id="pn" ><strong style="cursor: pointer;" onclick="openfileobj()">Upload New Model</strong><br>
                          <input type="file" style="display: none;" id="uploadobj" name="modelobj" accept=".obj" class="form-control">
                       <!--    <input type="file" name="modelmtl" accept=".mtl"  class="form-control"> -->
                           <span>Supports OBJ</span>
                    
                           <span> <i class="fa fa-image pull-right"></i></span>
                        </div>

                     </div>
                  </div>
               </div>
               <div class="container">
                  <div class="col-md-12">

                     <div class="panel panel-default" id="m">
                        <div class="panel-body" style="padding: 0;cursor: pointer;" id="videoFileUpload1">
                          
                              <video id="videoPlayer"  width="100%" controls>
  <source src="uploads/video/<?php echo $getProject["video"]; ?>" id="video_here">
    Your browser does not support HTML5 video.
</video>
                        </div>
                        <div class="panel-footer" id="videoFileUpload"><strong>Upload video</strong><br>
                           <span>Supports Mp4</span>
                           <input type="file" name="files" style="display: none;" id="FileUpload4" class="file_multi_video" accept="video/*">
                           <span> <i class="fa fa-image pull-right"></i></span>
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
</script> 


 
                  
          
                  </div>
               </div>
               <!-- /.row (main row) -->
               
                <div class="container">
                  <div class="col-md-12">
                     <div class="panel panel-default" > 
                        <div class="panel-body">   
                            <textarea required class="form-control" name="notes" placeholder="Writer Your Notes Here..."></textarea>
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


      <!-- ./wrapper -->
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
      <!-- lightbox -->

      <script src="dist/js/demo.js"></script>
      <script type="text/javascript">
        
                                 function openfileDialog() {
                                    $("#fileLoader").click();
                                    }

                                    function openfileobj() {
                                    $("#uploadobj").click();
                                    }


      </script>

      <!-- For Pdf Preview -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
 <script type="text/javascript" src="js/pdf.worker.js"></script>   
 <script type="text/javascript" src="js/pdf.js"></script>     
   
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
    if(['application/pdf'].indexOf($("#file-to-upload").get(0).files[0].type) == -1) {
        alert('Error : Not a PDF');
        return;
    }

  $("#upload-button").hide();

  // Send the object url of the pdf
  showPDF(URL.createObjectURL($("#file-to-upload").get(0).files[0]));
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

</script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
      <script src="assets/lightbox/js/simple-lightbox.js"></script>
<script type="text/javascript">
$(function(){
    var $gallery = $('.main a').simpleLightbox();

    $gallery.on('show.simplelightbox', function(){
      console.log('Requested for showing');
    })
    .on('shown.simplelightbox', function(){
      console.log('Shown');
    })
    .on('close.simplelightbox', function(){
      console.log('Requested for closing');
    })
    .on('closed.simplelightbox', function(){
      console.log('Closed');
    })
    .on('change.simplelightbox', function(){
      console.log('Requested for change');
    })
    .on('next.simplelightbox', function(){
      console.log('Requested for next');
    })
    .on('prev.simplelightbox', function(){
      console.log('Requested for prev');
    })
    .on('nextImageLoaded.simplelightbox', function(){
      console.log('Next image loaded');
    })
    .on('prevImageLoaded.simplelightbox', function(){
      console.log('Prev image loaded');
    })
    .on('changed.simplelightbox', function(){
      console.log('Image changed');
    })
    .on('nextDone.simplelightbox', function(){
      console.log('Image changed to next');
    })
    .on('prevDone.simplelightbox', function(){
      console.log('Image changed to prev');
    })
    .on('error.simplelightbox', function(e){
      console.log('No image found, go to the next/prev');
      console.log(e);
    });
  });

</script>

   
 
   </body>
</html>