<div class="breadcrumbs ace-save-state" id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-home home-icon"></i>
			Admin Console
		</li>
		<li>
			<i class="ace-icon fa fa-file-o home-icon"></i>
			<a href="<?php echo base_url(); ?>LawyerManagement">User List</a>
		</li>
		<li class="active">View User Profile</li>
	</ul><!-- /.breadcrumb -->
</div>

<div class="page-content">

	<div class="page-header">
		<h1>
			View User Profile
		</h1>
	</div><!-- /.page-header -->

	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->

				<div class="row">
					<div class="col-xs-12">

						<div class="form-group">
							<label class="control-label col-md-2 col-sm-3 col-xs-12" for="name"><b>User Name</b></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<?php echo ': '.$user[0]['username']; ?>
							</div>
						</div>
						<div class="clearfix"></div>
						<hr/>
						
						<?php if($user[0]['name'] !=''){ ?>
						<div class="form-group">
							<label class="control-label col-md-2 col-sm-3 col-xs-12" for="values"><b>Name</b></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<?php echo ': '.$user[0]['name']; ?>
							</div>
						</div>
						<div class="clearfix"></div>
						<hr/>
						<?php } ?>
						<div class="form-group">
							<label class="control-label col-md-2 col-sm-3 col-xs-12" for="values"><b>Email</b></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<?php echo ': '.$user[0]['email']; ?>
							</div>
						</div>
						<div class="clearfix"></div>
						<hr/>
						<div class="form-group">
							<label class="control-label col-md-2 col-sm-3 col-xs-12" for="values"><b>Is Lawyer</b></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<?php if($user[0]['is_lawyer'] == 1) echo  ': Yes'; else echo ': No'; ?>
							</div>
						</div>
						<div class="clearfix"></div>
						<hr/>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-md-6 col-sm-6 col-xs-12">
						<a href="<?php echo base_url('UserManagement');?>" class="btn btn-default btn-lg">List</a>
						
					</div>
				</div>
			<!-- PAGE CONTENT ENDS -->
		</div><!-- /.col -->
	</div><!-- /.row -->
</div><!-- /.page-content -->

	