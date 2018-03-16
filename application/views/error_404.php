<?php
if($this->access_library->login_status() == TRUE)
{
	?>
<div class="breadcrumbs ace-save-state" id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-home home-icon"></i>
			<a href="javascript:void(0);">Error</a>
		</li>

		<li class="active">404</li>
	</ul><!-- /.breadcrumb -->
</div>
	<?php
}
?>
<div class="page-content">

	<div class="page-header">
		<h1>
			Page Not Found
		</h1>
	</div><!-- /.page-header -->

	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->

<div class="row">
	<div class="col-xs-12" style="font-size: 15px;">
		The server returned a 404 response. Did you type the URL? You may have typed the address (URL) incorrectly.<br>
Check it to make sure you've got the exact right spelling, capitalization, etc.
	</div>
</div>
			<!-- PAGE CONTENT ENDS -->
		</div><!-- /.col -->
	</div><!-- /.row -->
</div><!-- /.page-content -->


