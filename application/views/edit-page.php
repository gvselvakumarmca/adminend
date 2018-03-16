<div class="breadcrumbs ace-save-state" id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-file-o home-icon"></i>
			<a href="<?php echo base_url('admin/page');?>">Pages</a>
		</li>
		<li class="active">Edit Page</li>
	</ul><!-- /.breadcrumb -->
</div>

<div class="page-content">

	<div class="page-header">
		<h1>
			Edit Page
		</h1>
	</div><!-- /.page-header -->

	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->

<div class="row">
	<div class="col-xs-12">
		<form class="form-horizontal" name="editPage" id="editPage" action="<?php echo base_url('admin/savePage/'.$page['id']);?>" method="post">
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="pagename">Name *</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" name="pagename" id="pagename" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('pagename', $page['name']);?>">
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="pagecontent">Page Content *</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<textarea name="pagecontent" id="pagecontent" class="form-control col-md-7 col-xs-12" rows="20"><?php echo set_value('pagecontent', $page['content']);?></textarea>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-md-3 col-xs-12" for="language">Language</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<select class="form-control col-md-7 col-xs-12" name="language" id="language" data-placeholder="Select language">
						<option value=""></option>
						<?php
						if(!empty($languages))
						{
							foreach ($languages as $language)
							{
								?>
								<option value="<?php echo $language['id'];?>"><?php echo $language['name'];?></option>
								<?php
							}
						}
						?>
					</select>
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-offset-3 col-md-6 col-sm-6 col-xs-12">
					<a href="<?php echo base_url('admin/page/');?>" class="btn btn-default btn-lg">List</a>
					<button type="submit" class="btn btn-primary btn-lg">Save</button>
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

	var validate = $('#editPage').validate({
		rules: {
			pagename: {
				required: true
			},
			pagecontent: {
				required: true
			}
		},
		messages: {
			pagename: {
				required: 'The Name field cannot be left blank'
			},
			pagecontent: {
				required: 'The Content field cannot be left blank'
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
			document.editPage.submit();
		}
	});
});
</script>