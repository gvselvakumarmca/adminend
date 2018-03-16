<div class="breadcrumbs ace-save-state" id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-home home-icon"></i>
			Admin Console
		</li>
		<li>
			<i class="ace-icon fa fa-file-o home-icon"></i>
			<a href="<?php echo base_url(); ?>news">Manage News</a>
		</li>
		<li class="active">Create New News</li>
	</ul><!-- /.breadcrumb -->
</div>

<div class="page-content">

	<div class="page-header">
		<h1>
			Create New News
		</h1>
	</div><!-- /.page-header -->

	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->

<div class="row">
	<div class="col-xs-12">
	 <?php
		if($this->session->flashdata('add_news_message') != '')
		{
			?>
			<div class="alert alert-success">
				<button type='button' class='close' data-dismiss='alert'>×</button>
				<?php echo $this->session->flashdata('add_news_message');?>
			</div>
			<?php
		}
		?>
		<form class="form-horizontal" name="createnews" id="createnews" action="<?php echo base_url('admin/savenews/');?>" method="post">
			
			<div class="form-group <?php if(form_error('category') != ''){echo 'has-error';}?>">
				<label class="control-label col-md-3 col-xs-12" for="category">Lawyer *</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<select class="form-control col-md-7 col-xs-12" name="lawyer" id="lawyer" data-placeholder="Select lawyer">
						<option value=""></option>
						<?php
						if(!empty($lawfirm))
						{
							foreach ($lawfirm as $lawyer)
							{
								?>
								<option value="<?php echo $lawyer['user_id'];?>"><?php echo $lawyer['lawyername']." / ".$lawyer['name'];?></option>
								<?php
							}
						}
						?>
					</select>
					<?php echo form_error('lawyer', '<div class="help-block" for="lawyer">','</div>');?>
				</div>
			</div>
			<div class="form-group <?php if(form_error('title') != ''){echo 'has-error';}?>">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">News Title *</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" name="title" id="title" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('title');?>">
					<?php echo form_error('title', '<div class="help-block" for="title">','</div>');?>
				</div>
			</div>
			<div class="form-group <?php if(form_error('content') != ''){echo 'has-error';}?>">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="content">The Article *</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<textarea name="content" id="content" class="form-control col-md-7 col-xs-12" rows="15"><?php echo set_value('content');?></textarea>
					<?php echo form_error('content', '<div class="help-block" for="content">','</div>');?>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="notify">&nbsp;</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<label><input type="checkbox" name="notify" id="notify" class="form-field-checkbox" value="1"><span class="notify"> Notify me by email when a user comments on this article</span></label>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-3 col-md-6 col-sm-6 col-xs-12">
					<a href="<?php echo base_url('admin/news/');?>" class="btn btn-default btn-lg">List</a>
					<input type="submit" name="save" class="btn btn-primary btn-lg" value="Save">
					<input type="submit" name="save_add" class="btn btn-primary btn-lg" value="Save and Add">
				</div>
			</div>
		</form>
	</div>
</div>

			<!-- PAGE CONTENT ENDS -->
		</div><!-- /.col -->
	</div><!-- /.row -->
</div><!-- /.page-content -->

<link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
<script type="text/javascript" src="assets/js/select2.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.validate.min.js"></script>

<script type="text/javascript">
$(function(){
	$('select').select2({allowClear: true});

	var validate = $('#createnews').validate({
		rules: {
			lawyer: {
				required: true
			},
			title: {
				required: true
			},
			content: {
				required: true
			}
		},
		messages: {
			lawyer: {
				required: 'The lawyer field cannot be left blank'
			},
			title: {
				required: 'The title field cannot be left blank'
			},
			content: {
				required: 'The content field cannot be left blank'
			}
		},
		errorElement: 'div',
		errorClass: 'help-block',
		errorPlacement: function(error, element) {
			$(error).appendTo(element.parent());
		},
		highlight: function(element) {
			$(element).parent().closest('.form-group').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).parent().closest('.form-group').removeClass('has-error');
		},
		submitHandler: function() {
			document.createnews.submit();
		}
	});
});
</script>