<?php 
include '../../conn.php';
if (isset($_POST["createProject"])) {
  $projectName=$_POST["project_name"];
      //Education
   if(isset($_POST["fooby"][1][0])){
       $getEdu=$_POST["fooby"][1][0];
   }

   if(isset($_POST["ownEdu"]) AND empty($_POST["fooby"][1][0])){
       $getEdu=$_POST["ownEdu"];
   }

   // Entr
   if(isset($_POST["fooby"][2][0])){
       $getEntr=$_POST["fooby"][2][0];
   }
   if(isset($_POST["ownEntr"]) AND empty($_POST["fooby"][2][0])){
       $getEntr=$_POST["ownEntr"];
   }
   // Book
   if(isset($_POST["fooby"][3][0])){
       $getBook=$_POST["fooby"][3][0];
   }
   if(isset($_POST["ownBook"]) AND empty($_POST["fooby"][3][0])){
       $getBook=$_POST["ownBook"];
   }
   // Mag
   if(isset($_POST["fooby"][4][0])){
       $getMag=$_POST["fooby"][4][0];
   }
   if(isset($_POST["ownMag"]) AND empty($_POST["fooby"][4][0])){
       $getMag=$_POST["ownMag"];
   }
   if(isset($_POST["setcountry"])){
        $getCountry= $_POST["setcountry"];
   }
   if(empty($_POST["setcountry"])){
       $getCountry="India";
   }
   $getTitle=$_POST["title"];
   if (isset($_POST["weekstart"])) {
      $getWeekStart_Str=$_POST["weekstart"];
        $Str_mod=substr($getWeekStart_Str,4,11);
         $getWeekStart=date('Y-m-d', strtotime($Str_mod));
    }

    if ($getWeekStart=="1970-01-01") {
       $getWeekStart="";
    }

    if (isset($_POST["weekend"])) {
        $getWeekEnd_Str=$_POST["weekend"];
        $Str_mod_end=substr($getWeekEnd_Str,4,11);
         $getWeekEnd=date('Y-m-d', strtotime($Str_mod_end));
    }

    if ($getWeekEnd=="1970-01-01") {
      $getWeekEnd="";
    }

    if (isset($_POST["grade"]) AND $_POST["grade"]!='more') {
         $grade=$_POST["grade"];
     }

     if(isset($_POST["grade"])=='more'){
          $grade=$_POST["owngrade"];
     }

      function generateRandomString($length = 12) {
          $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
          $charactersLength = strlen($characters);
          $randomString = '';
          for ($i = 0; $i < $length; $i++) {
              $randomString .= $characters[rand(0, $charactersLength - 1)];
          }
          return $randomString;

      }
      $token=generateRandomString();

           $errors = array();
            $uploadedFiles = array();
            $extension = array("jpeg","jpg","png");
            $bytes = 1024;
            $KB = 1024;
            $totalBytes = $bytes * $KB;
            $UploadFolder = "../../uploads/imgs/";
             
            $counter = 0;
             
            foreach($_FILES["images"]["tmp_name"] as $key=>$tmp_name){
                $temp = $_FILES["images"]["tmp_name"][$key];
                $name = $_FILES["images"]["name"][$key];
                 
                if(empty($temp))
                {
                    break;
                }
                 
                $counter++;
                $UploadOk = true;
                 
                if($_FILES["images"]["size"][$key] > $totalBytes)
                {
                    $UploadOk = false;
                    array_push($errors, $name." file size is larger than the 1 MB.");
                }
                 
                $ext = pathinfo($name, PATHINFO_EXTENSION);
                if(in_array($ext, $extension) == false){
                    $UploadOk = false;
                    array_push($errors, $name." is invalid file type.");
                }
                 
                if(file_exists($UploadFolder."/".$name) == true){
                    $UploadOk = false;
                    array_push($errors, $name." file is already exist.");
                } 
                 $getname=rand(10,100000000).$name;
                if($UploadOk == true){
                    move_uploaded_file($temp,$UploadFolder."/".$getname);
                    array_push($uploadedFiles, $getname);
                }
            }
            $imageUrlPath = 'https://pitchar.io/uploads/imgs/'.$getname;
             
            if($counter>0){
                if(count($uploadedFiles)>0){
                  $i=0;
                    foreach($uploadedFiles as $fileName)
                    {
                         
                     $i++;
                    mysqli_query($conn,"INSERT INTO tbl_project_image(image,token,cnt)VALUES('$fileName','$token','$i')") ;

                    }
                            
                   
                }                               
            }

         //DOC
            $valid_formats = array("pdf","doc","DOC","docx");  
              $doc = $_FILES['myPDF']['name'];
              $sizedoc = $_FILES['myPDF']['size'];
              if(strlen($doc)) {
                list($txt, $ext) = explode(".", $doc);
                if(in_array($ext,$valid_formats)) {
                  if($sizedoc<(10240*10240)) {
                      $nameOfDoc = time().".".$ext;
                    $tmp = $_FILES['myPDF']['tmp_name'];
                    move_uploaded_file($tmp, "../../uploads/docs/".$nameOfDoc);
            }
            }
            }      

          //mp4
            $valid_formats = array("mp4");  
              $namevid = $_FILES['files']['name'];
              $sizevid = $_FILES['files']['size'];
              if(strlen($namevid)) {
                list($txt, $ext) = explode(".", $namevid);
                if(in_array($ext,$valid_formats)) {
                  if($sizevid<(10240*10240)) {
                      $vidname = time().".".$ext;
                    $tmp = $_FILES['files']['tmp_name'];
                    move_uploaded_file($tmp, "../../uploads/video/".$vidname);
                $videoUrlPath = 'https://pitchar.io/uploads/video/'.$vidname;
            }
            }
            }  


        //Obj,fbx
            $valid_formats = array("obj","fbx");  
              $name = $_FILES['modelobj']['name'];
              $size = $_FILES['modelobj']['size'];
              if(strlen($name)) {
                list($txt, $ext) = explode(".", $name);
                if(in_array($ext,$valid_formats)) {
                  if($size<(10240*10240)) {
                      $obj_name = time().".".$ext;
                    $tmp = $_FILES['modelobj']['tmp_name'];
                    move_uploaded_file($tmp, "../../uploads/obj/".$obj_name);
                    $shortObFbx = substr($name, -4);
                    $objurlpath = ($shortObFbx==".obj") ? 'https://pitchar.io/uploads/obj/'.$obj_name : '' ;
                    $fbxurlpath = ($shortObFbx==".fbx") ? 'https://pitchar.io/uploads/obj/'.$obj_name : '' ;
            }
            }
            }

        //Mtl
            $valid_formatsmtl = array("mtl");  
              $namemtl = $_FILES['modelmtl']['name'];
              $sizemtl = $_FILES['modelmtl']['size'];
              if(strlen($namemtl)) {
                list($txt, $ext) = explode(".", $namemtl);
                if(in_array($ext,$valid_formatsmtl)) {
                  if($sizemtl<(10240*10240)) {
                      $mtl_name = time().".".$ext;
                    $tmp = $_FILES['modelmtl']['tmp_name'];
                    move_uploaded_file($tmp, "../../uploads/mtl/".$mtl_name);
                    $mtlUrlPath = 'https://pitchar.io/uploads/obj/'.$mtl_name;
            }
            }
            } 
        //ZIP
            $valid_formatsmtl = array("zip");  
              $zip = $_FILES['zipfile']['name'];
              if(strlen($zip)) {
                list($txt, $ext) = explode(".", $zip);
                if(in_array($ext,$valid_formatsmtl)) {
                      $zipname = time().".".$ext;
                    $ziptmp = $_FILES['zipfile']['tmp_name'];
                    move_uploaded_file($ziptmp, "../../uploads/zip/".$zipname);
            }
            } 

            //objThumb
            $valid_formats = array("png","jpeg","jpg");  
              $objThumb = $_FILES['objThumbnail']['name'];
              $sizeobj = $_FILES['objThumbnail']['size'];
              if(strlen($objThumb)) {
                list($txt, $ext) = explode(".", $objThumb);
                if(in_array($ext,$valid_formats)) {
                  if($sizeobj<(10240*10240)) {
                      $objThumbnailName = time().".".$ext;
                    $tmp = $_FILES['objThumbnail']['tmp_name'];
                    move_uploaded_file($tmp, "../../uploads/objThumbnail/".$objThumbnailName);
                    $getObjThumbnail = 'https://pitchar.io/uploads/objThumbnail/'.$objThumbnailName;
            }
            }
            }  


            //audioFile
            $valid_formats = array("mp3","wav","ogg");  
              $audio = $_FILES['audio']['name'];
              $audioSize = $_FILES['audio']['size'];
              if(strlen($audio)) {
                list($txt, $ext) = explode(".", $audio);
                if(in_array($ext,$valid_formats)) {
                  if($audioSize<(10240*10240)) {
                      $audioName = time().".".$ext;
                    $tmp = $_FILES['audio']['tmp_name'];
                    move_uploaded_file($tmp, "../../uploads/audio/".$audioName);
                    $getAudioName = 'https://pitchar.io/uploads/audio/'.$audioName;
            }
            }
            }  


            //videoThumbnail
            $valid_formats = array("png","jpeg","jpg");  
              $videoThumb = $_FILES['videoThumb']['name'];
              $videoSize = $_FILES['videoThumb']['size'];
              if(strlen($videoThumb)) {
                list($txt, $ext) = explode(".", $videoThumb);
                if(in_array($ext,$valid_formats)) {
                  if($videoSize<(10240*10240)) {
                      $videoThumbName = time().".".$ext;
                    $tmp = $_FILES['videoThumb']['tmp_name'];
                    move_uploaded_file($tmp, "../../uploads/videoThumbnail/".$videoThumbName);
                    $getVideoThumbnail = 'https://pitchar.io/uploads/videoThumbnail/'.$videoThumbName;
            }
            }
            }  


            $getNotes=$_POST["notes"];
            $getEmail=$_POST["email"];
            $user_name=$_POST["username"];

           $queryInsert=mysqli_query($conn,"INSERT INTO tbl_std_project(name,token,project_name,email,subject,book,image,objfile,mtlfile,video,notes,docs,country,submit_time,calender,start_date,end_date,education,magaz,grade,zipfile)VALUES('$user_name','$token','$projectName','$getEmail','$getEntr','$getBook','1','$obj_name','$mtl_name','$vidname','$getNotes','$nameOfDoc','$getCountry',NOW(),'$getTitle','$getWeekStart','$getWeekEnd','$getEdu','$getMag','$grade','$zipname')");



           if ($queryInsert) {
            // Add New Assets
               $queryAssets=mysqli_query($conn,"INSERT INTO assets(authtoken,objthumbnail,obj,mtl,fbx,image,name)VALUES('$token','$getObjThumbnail','$objurlpath','$mtlUrlPath','$fbxurlpath','$imageUrlPath','$projectName')");

              // // Add New Media
               $queryMedia=mysqli_query($conn,"INSERT INTO media(authtoken,video,thumbnail,audio,name)VALUES('$token','$videoUrlPath','$getVideoThumbnail','$getAudioName','$projectName')");

            // Add New education
              $addEdu=mysqli_query($conn,"SELECT * FROM education WHERE name='$getEdu'");
              $countEdu=mysqli_num_rows($addEdu);
              if ($countEdu==0 AND !empty($getEdu)) {
                mysqli_query($conn,"INSERT INTO education(name,user_by)VALUES('$getEdu','$user_name')");
              }
            // Add New book
              $addBook=mysqli_query($conn,"SELECT * FROM books WHERE book='$getBook'");
              $countBook=mysqli_num_rows($addBook);
              if($countBook==0 AND !empty($getBook)){
                mysqli_query($conn,"INSERT INTO books(Book)VALUES('$getBook')");
              }
              // Add New ENTR
              $addEntr=mysqli_query($conn,"SELECT * FROM subject WHERE subject='$getEntr'");
              $countEntr=mysqli_num_rows($addEntr);
              if ($countEntr==0 AND !empty($getEntr)) {
                mysqli_query($conn,"INSERT INTO subject(subject)VALUES('$getEntr')");
              }
              // Add New Magz
              $addMag=mysqli_query($conn,"SELECT * FROM magazine WHERE name='$getMag'");
              $countMag=mysqli_num_rows($addMag);
              if ($countMag==0 AND !empty($getMag)) {
                  mysqli_query($conn,"INSERT INTO magazine(name,insert_by)VALUES('$getMag','$user_name')");
              }
             exit(json_encode(["response" => ["code" => "1" ,"msg" => "Project Created Successfully"]]));
           }
           else{
             exit(json_encode(["response" => ["code" => "0" ,"msg" => "Something Went Wrong Please try Again later!"]]));

           }

}

?>