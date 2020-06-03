                <?php
 

                  if (isset($_POST["metaSearch"])) {
                          $search_text=$_POST["search_text"];
                        
                  }


               ?>
               <style type="text/css">
                  .skin-blue .main-header .navbar .sidebar-toggle:hover {
                      background-color: transparent; 

                  }


 

                  @media (min-width:320px)  {.nav>li>a {
    position: relative;
    display: block;
    padding: 0px 0px;
}  }
                  @media (min-width:480px)  { .nav>li>a {
    position: relative;
    display: block;
    padding: 0px 0px;
}}
                  @media (min-width:600px)  {.nav>li>a {
    position: relative;
    display: block;
    padding: 15px 15px;
}}


 
.googleTranslate{
 float: right;
    /* position: absolute; */
    position: relative;
    right: -20%;
    top: 15px;
    padding: 0 !important;
}

.formstyle{
  display: inline-block;width: 70%;
}

@media (max-width: 1199.98px) { 

.googleTranslate{
    float: right;
    /* position: absolute; */
    position: relative;
    right: -10%;
    top: -25px;
    padding: 0 !important;
}

.formstyle{
  display: inline-block;width: 70%;height: 0;
}

 }


 @media (min-width: 576px) and (max-width: 768px) { 
  .googleTranslate{
    float: right;
    /* position: absolute; */
    position: relative;
    right: -10%;
    top: -25px;
    padding: 0 !important;
}

.formstyle{
  display: inline-block;width: 62%;height: 0;
}
  }


  @media (max-width: 575.98px) {  
  .googleTranslate{
    float: right;
    /* position: absolute; */
    position: relative;
    right: -15%;
    top: 25px;
    padding: 0 !important;
}

.formstyle{
  display: inline-block;width: 75%;height: 0;
}

   }


      .goog-te-banner-frame.skiptranslate {
            display: none !important;
        } 
     
        .goog-te-menu-frame {
        max-width:100% !important; 
        }
        .goog-te-menu2 { 
        max-width: 100% !important;
        overflow-x: scroll !important;
        box-sizing:border-box !important; 
        height:auto !important; 
        }

 

 



                  
               </style>
               <script type="text/javascript">
 function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                autoDisplay: false,
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE
            }, 'google_translate_element');
            function changeGoogleStyles() {
                if($('.goog-te-menu-frame').contents().find('.goog-te-menu2').length) {
                    $('.goog-te-menu-frame').contents().find('.goog-te-menu2').css({
                        'max-width':'100%',
                        'overflow-x':'auto',
                        'box-sizing':'border-box',
                        'height':'auto'
                    });
                } else {
                    setTimeout(changeGoogleStyles, 50);
                }
            }
            changeGoogleStyles();
        }
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

            <nav class="navbar navbar-static-top">
            <form method="GET" action="web-search.php" class="formstyle" >
            <input required="" type="search" placeholder="Search AR Projects Worldwide" class="header-search" name="query" style="border:none;margin-top: 10px;width: 75%;border-bottom-right-radius: 0;border-top-right-radius: 0;  outline-color: transparent;">
            

            <button type="submit" name="<?php echo sha1($status); ?>" id="search-btn" class="sr"><i class="fa fa-search"></i>
                           </button>
                           <div class="googleTranslate" id="google_translate_element"></div>
               </form>

          
               <!-- Sidebar toggle button-->
               <a href="#" style="color: #43425D" class="sidebar-toggle" data-toggle="push-menu" role="button">
               <span class="sr-only">Toggle navigation</span>
               </a>
               <div class="navbar-custom-menu">
                  <ul class="nav navbar-nav">
                     <!-- Messages: style can be found in dropdown.less-->
                     <!-- User Account: style can be found in dropdown.less -->
                     <li class="dropdown user user-menu">

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="uploads/user_profile_pic/<?php echo (!empty($getDisplayPic)) ? $getDisplayPic : "avatar-placeholder.png" ; ?>" class="user-image" alt="User Image">
                        <span class="hidden-xs"> <?= $user_name;?></span>
                        </a>
                        <ul class="dropdown-menu">
                           <!-- User image -->
                           <li class="user-header">
                              <img src="uploads/user_profile_pic/<?php echo (!empty($getDisplayPic)) ? $getDisplayPic : "avatar-placeholder.png" ; ?>" class="img-circle" alt="User Image">
                               <p style="text-transform: capitalize;">
                                 <?= $user_name;?> - <?= $status; ?>
                              </p>
                           </li>
                           <!-- Menu Body -->
                           <!-- Menu Footer-->
                           <li class="user-footer">
                              <div class="pull-left">
                                 <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
                              </div>
                              <div class="pull-right">
                                 <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                              </div>
                           </li>
                        </ul>
                     </li>
                     <!-- Control Sidebar Toggle Button -->
                  </ul>
               </div>
            </nav>
         