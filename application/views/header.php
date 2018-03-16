<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Globe - <?php echo $title;?></title>
		<base href="<?php echo base_url();?>">
		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<link rel="icon" href="assets/images/favicon.png" sizes="16x16" type="image/png">
		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="assets/css/ace.min.css" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" />
		<![endif]-->
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="assets/css/custom.css" />
		<!--[if !IE]> -->
		<script src="assets/js/jquery-2.1.4.min.js"></script>
		<!-- <![endif]-->

		<!--[if IE]>
		<script src="assets/js/jquery-1.11.3.min.js"></script>
		<![endif]-->

		
		<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	
<?php
if($this->access_library->login_status() == TRUE)
{
	?>
<body class="no-skin">
	<div id="navbar" class="navbar navbar-default ace-save-state">
		<div class="navbar-container ace-save-state" id="navbar-container">
			<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
				<span class="sr-only">Toggle sidebar</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

			<div class="navbar-header pull-left">
				<a href="<?php echo base_url('admin');?>" class="navbar-brand">
					<small>Globe</small>
				</a>
			</div>

			<div class="navbar-buttons navbar-header pull-right" role="navigation">
				<ul class="nav ace-nav">
					<li class="light-blue dropdown-modal">
						<a data-toggle="dropdown" href="#" class="dropdown-toggle">
							<img class="nav-user-photo" src="assets/images/avatars/avatar2.png" alt="" />
							<span class="user-info">
								<small>Welcome,</small>
								<?php echo $this->session->username;?>
							</span>
							<i class="ace-icon fa fa-caret-down"></i>
						</a>
						<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
							<li>
								<a href="<?php echo base_url('admin/logout');?>"><i class="ace-icon fa fa-power-off"></i>Logout</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div><!-- /.navbar-container -->
	</div>


	<div class="main-container ace-save-state" id="main-container">
		<script type="text/javascript">
			try{ace.settings.loadState('main-container')}catch(e){}
		</script>

		<div id="sidebar" class="sidebar responsive ace-save-state">
			<script type="text/javascript">
				try{ace.settings.loadState('sidebar')}catch(e){}
			</script>
			<ul class="nav nav-list">
				<li class="<?php if($page_name == 'dashboard'){echo 'open';}?>">
					<a href="#" >
						<i class="menu-icon fa fa-tachometer"></i>
						<span class="menu-text"> Dashboard </span>
					</a>					
				</li>

				<li class="<?php if($page_name == 'admin'){echo 'open';}?>">
					<a href="#" class="dropdown-toggle">
						<i class="menu-icon fa fa-user"></i>
						<span class="menu-text"> Admin Console </span>
						<b class="arrow fa fa-angle-down"></b>
					</a>
					<b class="arrow"></b>

					<ul class="submenu">
						<li class="<?php if(isset($sub_page) && $sub_page == 'general_settings'){echo 'active';}?>">
							<a href="<?php echo base_url('manageprices');?>">Manage General Settings</a>
						</li>
						<li class="<?php if(isset($sub_page) && $sub_page == 'users'){echo 'active';}?>">
							<a href="<?php echo base_url('UserManagement');?>">Manage Users</a>
						</li>
						<li class="<?php if(isset($sub_page) && $sub_page == 'topics'){echo 'active';}?>">
							<a href="<?php echo base_url('topics');?>">Manage Topics</a>
						</li>
						<li class="<?php if(isset($sub_page) && $sub_page == 'news'){echo 'active';}?>">
							<a href="<?php echo base_url('news');?>">Manage News</a>
						</li>
						<li class="<?php if(isset($sub_page) && $sub_page == 'contact'){echo 'active';}?>">
							<a href="<?php echo base_url('contact');?>">Manage Contact Forms</a>
						</li>
						
					</ul>
				</li>

				<li class="<?php if($page_name == 'page') {echo 'active';}?>">
					<a href="<?php echo base_url('admin/page');?>">
						<i class="menu-icon fa fa-file-o"></i>
						<span class="menu-text"> Page </span>
					</a>
				</li>
			</ul><!-- /.nav-list -->
			<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
				<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
			</div>
		</div>

		<div class="main-content">
			<div class="main-content-inner">

		
	<?php
}
?>