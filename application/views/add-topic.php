<div class="breadcrumbs ace-save-state" id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-home home-icon"></i>
			Admin Console
		</li>
		<li>
			<i class="ace-icon fa fa-file-o home-icon"></i>
			<a href="<?php echo base_url(); ?>topics">Manage Topics</a>
		</li>
		<li class="active">Create New Topic</li>
	</ul><!-- /.breadcrumb -->
</div>

<div class="page-content">

	<div class="page-header">
		<h1>
			Create New Topic
		</h1>
	</div><!-- /.page-header -->

	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->

<div class="row">
	<div class="col-xs-12">
	 <?php
		if($this->session->flashdata('add_topic_message') != '')
		{
			?>
			<div class="alert alert-success">
				<button type='button' class='close' data-dismiss='alert'>×</button>
				<?php echo $this->session->flashdata('add_topic_message');?>
			</div>
			<?php
		}
		?>
		<form class="form-horizontal" name="createTopic" id="createTopic" action="<?php echo base_url('admin/saveTopic/');?>" method="post">
			
			<div class="form-group <?php if(form_error('category') != ''){echo 'has-error';}?>">
				<label class="control-label col-md-3 col-xs-12" for="category">Category *</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<select class="form-control col-md-7 col-xs-12" name="category" id="category" data-placeholder="Select category">
						<option value=""></option>
						<?php
						if(!empty($categories))
						{
							foreach ($categories as $category)
							{
								?>
								<option value="<?php echo $category['id'];?>"><?php echo $category['name'];?></option>
								<?php
							}
						}
						?>
					</select>
					<?php echo form_error('category', '<div class="help-block" for="category">','</div>');?>
				</div>
			</div>
			<div class="form-group <?php if(form_error('topic_name') != ''){echo 'has-error';}?>">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="topic_name">Topic Name *</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" name="topic_name" id="topic_name" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('topic_name');?>">
					<?php echo form_error('topic_name', '<div class="help-block" for="topic_name">','</div>');?>
				</div>
			</div>
			<div class="form-group <?php if(form_error('url') != ''){echo 'has-error';}?>">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="url">Topic URL *</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" name="url" id="url" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('url');?>">
					<?php echo form_error('url', '<div class="help-block" for="url">','</div>');?>
				</div>
			</div>
			<div class="form-group <?php if(form_error('seo_text') != ''){echo 'has-error';}?>">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="seo_text">Topic SEO Text *</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" name="seo_text" id="seo_text" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('seo_text');?>">
					<?php echo form_error('seo_text', '<div class="help-block" for="seo_text">','</div>');?>
				</div>
			</div>
			<div class="form-group <?php if(form_error('seo_text') != ''){echo 'has-error';}?>">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="search_keywords">Search Keywords</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" name="search_keywords" id="search_keywords" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('search_keywords');?>">
					<?php echo form_error('search_keywords', '<div class="help-block" for="search_keywords">','</div>');?>
				</div>
			</div>
			<div class="form-group <?php if(form_error('seo_text') != ''){echo 'has-error';}?>">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" name="description" id="description" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('description');?>">
					<?php echo form_error('description', '<div class="help-block" for="description">','</div>');?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-3 col-md-6 col-sm-6 col-xs-12">
					<a href="<?php echo base_url('admin/topics/');?>" class="btn btn-default btn-lg">List</a>
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

	var validate = $('#createTopic').validate({
		rules: {
			category: {
				required: true
			},
			topic_name: {
				required: true
			},
			url: {
				required: true
			},
			seo_text: {
				required: true
			}
		},
		messages: {
			category: {
				required: 'The Category field cannot be left blank'
			},
			topic_name: {
				required: 'The Topic Name field cannot be left blank'
			},
			url: {
				required: 'The Topic URL field cannot be left blank'
			},
			seo_text: {
				required: 'The Topic SEO Text field cannot be left blank'
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
			document.createTopic.submit();
		}
	});
});
</script>