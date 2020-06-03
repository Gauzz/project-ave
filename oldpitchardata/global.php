<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Admin Dashboard</title>
      <!-- Tell the browser to be responsive to screen width -->
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
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
      <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
	  <style>.btn-danger {
    background-color: black;
    border-color: black;
    width: 100px;
	    margin-top: 20px;
}

      .bg-teal-gradient{background:white !important;}
    
</style>
   </head>
   <body class="hold-transition skin-blue sidebar-mini">
      <div class="wrapper">
         <header class="main-header">
            <!-- Logo -->
            <a href="index.php" class="logo">
               <!-- mini logo for sidebar mini 50x50 pixels -->
               <span class="logo-mini"><b>A</b>M</span>
               <!-- logo for regular state and mobile devices -->
               <span class="logo-lg"><b>Admin</b></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
               <!-- Sidebar toggle button-->
               <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
               <span class="sr-only">Toggle navigation</span>
               </a>
               <div class="navbar-custom-menu">
                  <ul class="nav navbar-nav">
                     <!-- Messages: style can be found in dropdown.less-->
                     <!-- User Account: style can be found in dropdown.less -->
                     <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                        <span class="hidden-xs">PITCHAR.IO</span>
                        </a>
                        <ul class="dropdown-menu">
                           <!-- User image -->
                           <li class="user-header">
                              <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                              <p>
                                 Alexander Pierce - Web Developer
                                 <small>Member since Nov. 2012</small>
                              </p>
                           </li>
                           <!-- Menu Body -->
                          
                           <!-- Menu Footer-->
                           <li class="user-footer">
                              <div class="pull-left">
                                 <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
                              </div>
                              <div class="pull-right">
                                 <a href="#" class="btn btn-default btn-flat">Sign out</a>
                              </div>
                           </li>
                        </ul>
                     </li>
                     <!-- Control Sidebar Toggle Button -->
                  </ul>
               </div>
            </nav>
         </header>
         <!-- Left side column. contains the logo and sidebar -->
         <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
               <!-- Sidebar user panel -->
               <div class="user-panel">
                  <div class="pull-left image">
                     <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                  </div>
                  <div class="pull-left info">
                     <p>PITCHAR.IO</p>
                     <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                  </div>
               </div>
               <!-- search form -->
               <form action="#" method="get" class="sidebar-form">
                  <div class="input-group">
                     <input type="text" name="q" class="form-control" placeholder="Search...">
                     <span class="input-group-btn">
                     <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                     </button>
                     </span>
                  </div>
               </form>
               <!-- /.search form -->
               <!-- sidebar menu: : style can be found in sidebar.less -->
               <ul class="sidebar-menu" data-widget="tree">
                  <li class="header">MAIN NAVIGATION</li>
                  <li class="active"><a href="add-project.php"><i class="fa fa-home"></i>  AR Projects</a></li>
				   <li><a href="student.php"><i class="fa fa-user"></i> Students</a></li>
				  <li class="treeview">
                     <a href="#"> 
                     <i class="fa fa-star"></i> <span> Favorites</span>  
                     </a>
                  </li>
				  <li class="treeview">
                     <a href="#"> 
                     <i class="fa fa-globe"></i> <span> Help</span>  
                     </a>
                  </li>
                
                 
                
               </ul>
            </section>
            <!-- /.sidebar -->
         </aside>
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <div class="row">
                  <div class="col-md-6">
                     <h2>
                      Search Results
                     </h2>
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
                        <div class="box-footer no-border">
                           <div class="row">
                             <div class="col-lg-12">
								<div class="col-lg-4 fon">
								<a href="#">
									<i class="fa fa-graduation-cap"></i>
									
									</a>
								</div>
								<div class="col-lg-6 fon">
								<a href="#">
									<strong> Subject Filter</strong>
									
									</a>
								</div>
								<div class="col-lg-2">
								<a href="#">
									<i class="fa fa-ellipsis-h"></i>
									
									</a>
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
                        <div class="box-footer no-border">
                           <div class="row">
                              <div class="col-lg-12">
								<div class="col-lg-4 fon">
								<a href="#">
									<i class="fa fa-font"></i>
									
									</a>
								</div>
								<div class="col-lg-6 fon">
								<a href="#">
									<strong> Language Filter</strong>
									
									</a>
								</div>
								<div class="col-lg-2">
								<a href="#">
									<i class="fa fa-ellipsis-h"></i>
									
									</a>
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
           
                  <!-- right col -->
               </div>
<div class="row">
                 
                  <section class="col-lg-6 connectedSortable ui-sortable">
                     <!-- solid sales graph -->
                     <div class="box box-solid bg-teal-gradient">
                        <div class="box-header ui-sortable-handle" style="cursor: move;">
                          
                          
                           <div class="box-tools pull-right">
                              <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                              </button>
                              <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                              </button>
                           </div>
                        </div>
                       
                        <!-- /.box-body -->
                        <div class="box-footer no-border">
                           <div class="row">
                              <div class="col-lg-12">
								<div class="col-lg-3">
									<a href="view-global.php"><img src="dist/img/user2-160x160.jpg" class="stimg"></a>
									
								</div>
								<div class="col-lg-7 col-lg-offset-1" id="stdetails">
									<a href="view-global.php"><h3>Project Name</h3></a>
									<p>Subject Name</p>
									<p>Language</p>
									<div class="">
									<a class="btn btn-social-icon btn-instagram"><i class="fa fa-file"></i></a>
									<a class="btn btn-social-icon btn-twitter"><i class="fa fa-image"></i></a>
									<a class="btn btn-social-icon btn-facebook"><i class="fa fa-cube"></i></a>
									
									
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
          <section class="col-lg-6 connectedSortable ui-sortable">
                     <!-- solid sales graph -->
                     <div class="box box-solid bg-teal-gradient">
                        <div class="box-header ui-sortable-handle" style="cursor: move;">
                          
                          
                           <div class="box-tools pull-right">
                              <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                              </button>
                              <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                              </button>
                           </div>
                        </div>
                       
                        <!-- /.box-body -->
                        <div class="box-footer no-border">
                           <div class="row">
                              <div class="col-lg-12">
								<div class="col-lg-3">
									<a href="view-global.php"><img src="dist/img/user2-160x160.jpg" class="stimg"></a>
									
								</div>
								<div class="col-lg-7 col-lg-offset-1" id="stdetails">
									<a href="view-global.php"><h3>Project Name</h3></a>
									<p>Subject Name</p>
									<p>Language</p>
									<div class="">
									<a class="btn btn-social-icon btn-instagram"><i class="fa fa-file"></i></a>
									<a class="btn btn-social-icon btn-twitter"><i class="fa fa-image"></i></a>
									<a class="btn btn-social-icon btn-facebook"><i class="fa fa-cube"></i></a>
									
									
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
				  
                  <!-- right col -->
               </div>
			   <div class="row">
               <section class="col-lg-6 connectedSortable ui-sortable">
                     <!-- solid sales graph -->
                     <div class="box box-solid bg-teal-gradient">
                        <div class="box-header ui-sortable-handle" style="cursor: move;">
                          
                          
                           <div class="box-tools pull-right">
                              <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                              </button>
                              <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                              </button>
                           </div>
                        </div>
                       
                        <!-- /.box-body -->
                        <div class="box-footer no-border">
                           <div class="row">
                              <div class="col-lg-12">
								<div class="col-lg-3">
									<a href="view-global.php"><img src="dist/img/user2-160x160.jpg" class="stimg"></a>
									
								</div>
								<div class="col-lg-7 col-lg-offset-1" id="stdetails">
									<a href="view-global.php"><h3>Project Name</h3></a>
									<p>Subject Name</p>
									<p>Language</p>
									<div class="">
									<a class="btn btn-social-icon btn-instagram"><i class="fa fa-file"></i></a>
									<a class="btn btn-social-icon btn-twitter"><i class="fa fa-image"></i></a>
									<a class="btn btn-social-icon btn-facebook"><i class="fa fa-cube"></i></a>
									
									
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
            <section class="col-lg-6 connectedSortable ui-sortable">
                     <!-- solid sales graph -->
                     <div class="box box-solid bg-teal-gradient">
                        <div class="box-header ui-sortable-handle" style="cursor: move;">
                          
                          
                           <div class="box-tools pull-right">
                              <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                              </button>
                              <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                              </button>
                           </div>
                        </div>
                       
                        <!-- /.box-body -->
                        <div class="box-footer no-border">
                           <div class="row">
                              <div class="col-lg-12">
								<div class="col-lg-3">
									<a href="view-global.php"><img src="dist/img/user2-160x160.jpg" class="stimg"></a>
									
								</div>
								<div class="col-lg-7 col-lg-offset-1" id="stdetails">
									<a href="view-global.php"><h3>Project Name</h3></a>
									<p>Subject Name</p>
									<p>Language</p>
									<div class="">
									<a class="btn btn-social-icon btn-instagram"><i class="fa fa-file"></i></a>
									<a class="btn btn-social-icon btn-twitter"><i class="fa fa-image"></i></a>
									<a class="btn btn-social-icon btn-facebook"><i class="fa fa-cube"></i></a>
									
									
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
				  
                  <!-- right col -->
               </div>
			   <div class="row">
             <section class="col-lg-6 connectedSortable ui-sortable">
                     <!-- solid sales graph -->
                     <div class="box box-solid bg-teal-gradient">
                        <div class="box-header ui-sortable-handle" style="cursor: move;">
                          
                          
                           <div class="box-tools pull-right">
                              <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                              </button>
                              <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                              </button>
                           </div>
                        </div>
                       
                        <!-- /.box-body -->
                        <div class="box-footer no-border">
                           <div class="row">
                              <div class="col-lg-12">
								<div class="col-lg-3">
									<a href="view-global.php"><img src="dist/img/user2-160x160.jpg" class="stimg"></a>
									
								</div>
								<div class="col-lg-7 col-lg-offset-1" id="stdetails">
									<a href="view-global.php"><h3>Project Name</h3></a>
									<p>Subject Name</p>
									<p>Language</p>
									<div class="">
									<a class="btn btn-social-icon btn-instagram"><i class="fa fa-file"></i></a>
									<a class="btn btn-social-icon btn-twitter"><i class="fa fa-image"></i></a>
									<a class="btn btn-social-icon btn-facebook"><i class="fa fa-cube"></i></a>
									
									
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
            <section class="col-lg-6 connectedSortable ui-sortable">
                     <!-- solid sales graph -->
                     <div class="box box-solid bg-teal-gradient">
                        <div class="box-header ui-sortable-handle" style="cursor: move;">
                          
                          
                           <div class="box-tools pull-right">
                              <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                              </button>
                              <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                              </button>
                           </div>
                        </div>
                       
                        <!-- /.box-body -->
                        <div class="box-footer no-border">
                           <div class="row">
                              <div class="col-lg-12">
								<div class="col-lg-3">
									<a href="view-global.php"><img src="dist/img/user2-160x160.jpg" class="stimg"></a>
									
								</div>
								<div class="col-lg-7 col-lg-offset-1" id="stdetails">
									<a href="view-global.php"><h3>Project Name</h3></a>
									<p>Subject Name</p>
									<p>Language</p>
									<div class="">
									<a class="btn btn-social-icon btn-instagram"><i class="fa fa-file"></i></a>
									<a class="btn btn-social-icon btn-twitter"><i class="fa fa-image"></i></a>
									<a class="btn btn-social-icon btn-facebook"><i class="fa fa-cube"></i></a>
									
									
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
				  
                  <!-- right col -->
				  <div class="col-lg-12">
				  <div class="col-sm-5"><div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div></div><div class="col-sm-7"><div class="dataTables_paginate paging_simple_numbers" id="example2_paginate"><ul class="pagination"><li class="paginate_button previous disabled" id="example2_previous"><a href="#" aria-controls="example2" data-dt-idx="0" tabindex="0">Previous</a></li><li class="paginate_button active"><a href="#" aria-controls="example2" data-dt-idx="1" tabindex="0">1</a></li><li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="2" tabindex="0">2</a></li><li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="3" tabindex="0">3</a></li><li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="4" tabindex="0">4</a></li><li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="5" tabindex="0">5</a></li><li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="6" tabindex="0">6</a></li><li class="paginate_button next" id="example2_next"><a href="#" aria-controls="example2" data-dt-idx="7" tabindex="0">Next</a></li></ul></div></div></div>
               </div>
		
               <!-- /.row (main row) -->
            </section>
			
            <!-- /.content -->
         </div>
		 
         <!-- /.content-wrapper -->
         <?php include'footer.php'?>
         <!-- Control Sidebar -->
         <aside class="control-sidebar control-sidebar-dark">
            <!-- Create the tabs -->
            <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
               <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
               <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
               <!-- Home tab content -->
               <div class="tab-pane" id="control-sidebar-home-tab">
                  <h3 class="control-sidebar-heading">Recent Activity</h3>
                  <ul class="control-sidebar-menu">
                     <li>
                        <a href="javascript:void(0)">
                           <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                           <div class="menu-info">
                              <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                              <p>Will be 23 on April 24th</p>
                           </div>
                        </a>
                     </li>
                     <li>
                        <a href="javascript:void(0)">
                           <i class="menu-icon fa fa-user bg-yellow"></i>
                           <div class="menu-info">
                              <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                              <p>New phone +1(800)555-1234</p>
                           </div>
                        </a>
                     </li>
                     <li>
                        <a href="javascript:void(0)">
                           <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
                           <div class="menu-info">
                              <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                              <p>nora@example.com</p>
                           </div>
                        </a>
                     </li>
                     <li>
                        <a href="javascript:void(0)">
                           <i class="menu-icon fa fa-file-code-o bg-green"></i>
                           <div class="menu-info">
                              <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                              <p>Execution time 5 seconds</p>
                           </div>
                        </a>
                     </li>
                  </ul>
                  <!-- /.control-sidebar-menu -->
                  <h3 class="control-sidebar-heading">Tasks Progress</h3>
                  <ul class="control-sidebar-menu">
                     <li>
                        <a href="javascript:void(0)">
                           <h4 class="control-sidebar-subheading">
                              Custom Template Design
                              <span class="label label-danger pull-right">70%</span>
                           </h4>
                           <div class="progress progress-xxs">
                              <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                           </div>
                        </a>
                     </li>
                     <li>
                        <a href="javascript:void(0)">
                           <h4 class="control-sidebar-subheading">
                              Update Resume
                              <span class="label label-success pull-right">95%</span>
                           </h4>
                           <div class="progress progress-xxs">
                              <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                           </div>
                        </a>
                     </li>
                     <li>
                        <a href="javascript:void(0)">
                           <h4 class="control-sidebar-subheading">
                              Laravel Integration
                              <span class="label label-warning pull-right">50%</span>
                           </h4>
                           <div class="progress progress-xxs">
                              <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                           </div>
                        </a>
                     </li>
                     <li>
                        <a href="javascript:void(0)">
                           <h4 class="control-sidebar-subheading">
                              Back End Framework
                              <span class="label label-primary pull-right">68%</span>
                           </h4>
                           <div class="progress progress-xxs">
                              <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                           </div>
                        </a>
                     </li>
                  </ul>
                  <!-- /.control-sidebar-menu -->
               </div>
               <!-- /.tab-pane -->
               <!-- Stats tab content -->
               <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
               <!-- /.tab-pane -->
               <!-- Settings tab content -->
               <div class="tab-pane" id="control-sidebar-settings-tab">
                  <form method="post">
                     <h3 class="control-sidebar-heading">General Settings</h3>
                     <div class="form-group">
                        <label class="control-sidebar-subheading">
                        Report panel usage
                        <input type="checkbox" class="pull-right" checked>
                        </label>
                        <p>
                           Some information about this general settings option
                        </p>
                     </div>
                     <!-- /.form-group -->
                     <div class="form-group">
                        <label class="control-sidebar-subheading">
                        Allow mail redirect
                        <input type="checkbox" class="pull-right" checked>
                        </label>
                        <p>
                           Other sets of options are available
                        </p>
                     </div>
                     <!-- /.form-group -->
                     <div class="form-group">
                        <label class="control-sidebar-subheading">
                        Expose author name in posts
                        <input type="checkbox" class="pull-right" checked>
                        </label>
                        <p>
                           Allow the user to show his name in blog posts
                        </p>
                     </div>
                     <!-- /.form-group -->
                     <h3 class="control-sidebar-heading">Chat Settings</h3>
                     <div class="form-group">
                        <label class="control-sidebar-subheading">
                        Show me as online
                        <input type="checkbox" class="pull-right" checked>
                        </label>
                     </div>
                     <!-- /.form-group -->
                     <div class="form-group">
                        <label class="control-sidebar-subheading">
                        Turn off notifications
                        <input type="checkbox" class="pull-right">
                        </label>
                     </div>
                     <!-- /.form-group -->
                     <div class="form-group">
                        <label class="control-sidebar-subheading">
                        Delete chat history
                        <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                        </label>
                     </div>
                     <!-- /.form-group -->
                  </form>
               </div>
               <!-- /.tab-pane -->
            </div>
         </aside>
         <!-- /.control-sidebar -->
         <!-- Add the sidebar's background. This div must be placed
            immediately after the control sidebar -->
         <div class="control-sidebar-bg"></div>
      </div>
      <!-- ./wrapper -->
      <!-- jQuery 3 -->
      <script src="bower_components/jquery/dist/jquery.min.js"></script>
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
   </body>
</html>