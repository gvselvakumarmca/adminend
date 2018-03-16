<body class="login-layout">
	<div class="main-container">
		<div class="main-content">
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1">
					<div class="login-container">

<div class="center">
	<h1>
		<img src="assets/images/logo.png" alt="logo">
	</h1>
</div>

<div class="space-6"></div>

<div class="position-relative">

	<div id="login-box" class="login-box visible widget-box no-border">
		<div class="widget-body">
			<div class="widget-main">
				<h4 class="header blue lighter bigger">
					Please Enter Your Information
				</h4>
				<?php
				if($login_error != '')
				{
					?>
					<div class="alert alert-danger"><button type='button' class='close' data-dismiss='alert'>×</button><?php echo $login_error;?>
					</div>
					<?php
				}
				?>
				<form method="post" name="f_guard_signin" id="f_guard_signin">
					<fieldset>
						<div class="form-group <?php if(form_error('username') != '') {echo 'has-error';}?>">
							<label for="username" class="control-label">Username</label>
							<input type="text" name="username" id="username" class="form-control" placeholder="Username" value="<?php echo set_value('username');?>">
							<?php echo form_error('username', '<div class="help-block" for="username">','</div>');?>
						</div>

						<div class="form-group <?php if(form_error('password') != '') {echo 'has-error';}?>">
							<label for="password" class="control-label">Password</label>
							<input type="password" name="password" name="password" class="form-control" placeholder="Password">
							<?php echo form_error('password', '<div class="help-block" for="password">','</div>');?>
						</div>
						
						<div class="space"></div>

						<div class="clearfix">
							<button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
								<i class="ace-icon fa fa-key"></i>
								<span class="bigger-110">Login</span>
							</button>
						</div>

						<div class="space-4"></div>
					</fieldset>
				</form>

			</div><!-- /.widget-main -->

		</div><!-- /.widget-body -->
	</div><!-- /.login-box -->
</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript" src="assets/js/jquery.validate.min.js"></script>
<script type="text/javascript">
$(function(){
	var validate = $('#f_gard_signin').validate({
		rules: {
			username: {
				required: true
			},
			password: {
				required: true
			}
		},
		messages: {
			username: {
				required: 'The Username field cannot be left blank'
			},
			password: {
				required: 'The Password field cannot be left blank'
			}
		},
		errorElement: 'div',
		errorClass: 'help-block',
		errorPlacement: function(error, element) {
			$(error).appendTo(element.parent());
		},
		highlight: function(element) {
			$(element).parent('.form-group').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).parent('.form-group').removeClass('has-error');
		},
		submitHandler: function() {
			document.f_guard_signin.submit();
		}
	});
});
</script>