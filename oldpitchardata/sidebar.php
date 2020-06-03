<?php 
  $getFile = "$_SERVER[REQUEST_URI]";
 

 ?>
            <section class="sidebar">
               <!-- Sidebar user panel -->
               <div class="user-panel">
                  <div class="pull-left image">
                     <img src="uploads/user_profile_pic/<?php echo (!empty($getDisplayPic)) ? $getDisplayPic : "avatar-placeholder.png" ; ?>" class="img-circle" alt="User Image">
                  </div>
                  <div class="pull-left info">
                     <p><?php echo  $user_name;?></p>
                     <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                  </div>
               </div>
               <!-- search form -->
    <!--            <form action="#" method="get" class="sidebar-form">
                  <div class="input-group">
                     <input type="text" name="q" class="form-control" placeholder="Search...">
                     <span class="input-group-btn">
                     <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                     </button>
                     </span>
                  </div>
               </form> -->
               <!-- /.search form -->
               <!-- sidebar menu: : style can be found in sidebar.less -->
               <ul class="sidebar-menu" data-widget="tree">
                  <li class="header">MAIN NAVIGATION</li>
                 <!--  <li ><a href="index.php"><i class="fa fa-home"id="fahome"></i>  PITCHAR Projects</a></li> -->

                  
                 <li   class="<?php echo ($getFile=="/dashboard.php") ? "active" : " " ; ?> "><a href="dashboard.php"><i <?php echo ($getFile=="/dashboard.php") ? "style='color:#fff !important;'" : " " ; ?>  class="fa fa-home"id="fahome"></i> <span> PITCHAR.IO Projects</span></a></li>
<?php  
                    if($status=="student"){ ?>
                    <!--Show Nothing-->
               
<?php } 
                    if($status=="teacher"){ ?>
                    <li class="<?php echo ($getFile=="/student.php") ? "active" : " " ; ?>"><a href="student.php"><i class="fa fa-user"id="fahome" <?php echo ($getFile=="/student.php") ? "style='color:#fff !important;'" : " " ; ?>></i> Students</a></li>    
<?php               }

?>
                 
                        

                  
                  <li class="<?php echo ($getFile=="/favorites.php") ? "active" : " " ; ?>"><a href="favorites.php"><i class="fa fa-star"id="fahome" <?php echo ($getFile=="/favorites.php") ? "style='color:#fff !important;'" : " " ; ?>></i> <span> Favorites</span></a></li>
                  <li class="<?php echo ($getFile=="/share-with-you.php") ? "active" : " " ; ?>"><a href="share-with-you.php"><i <?php echo ($getFile=="/share-with-you.php") ? "style='color:#fff !important;'" : " " ; ?> class="fa fa-share" id="fahome"></i> <span> Shared with you</span></a></li>
                  <li class="<?php echo ($getFile=="/myProjects.php") ? "active" : " " ; ?>"><a href="myProjects.php"><i class="fa fa-inbox"id="fahome" <?php echo ($getFile=="/myProjects.php") ? "style='color:#fff !important;'" : " " ; ?>></i> <span> My Project</span></a></li>
                  <li class="treeview">
                     <a href="#"> 
                     <i class="fa fa-globe"id="fahome"></i> <span> Help</span>  
                     </a>
                  </li>
               </ul>
            </section>