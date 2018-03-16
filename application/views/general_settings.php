<div class="breadcrumbs ace-save-state" id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-home home-icon"></i>
			Admin Console
		</li>
		<li class="active">Manage General Settings</li>
	</ul><!-- /.breadcrumb -->
</div>
<div class="page-content">
	<div class="page-header">
		<h1>
			Manage Site Variables 
		</h1>
	</div><!-- /.page-header -->
	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<?php
		if($this->session->flashdata('settings_msg') != '')
		{
			?>
			<div class="alert alert-success">
				<button type='button' class='close' data-dismiss='alert'>×</button>
				<?php echo $this->session->flashdata('settings_msg');?>
			</div>
			<?php
		}
		?>
			<div class="row">
				<div class="col-xs-12">
					<table id="general-table" class="table  table-bordered table-hover">
						<thead>
							<tr>
								<th>Name</th>
								<th>Value</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if(!empty($general_settings))
							{
								foreach($general_settings as $general_setting)
								{
									?>
									<tr>
										<td><?php echo $general_setting['name'];?></td>
										<td><?php echo $general_setting['value'];?></td>
										<td class="text-center"><a href="<?php echo base_url('admin/editvalue/'.$general_setting['id']);?>"><i class="fa fa-pencil"></i> Edit</a></td>
									</tr>
									<?php
								}
							}
							?>
						</tbody>
					</table>
				</div>
			</div>

			<!-- PAGE CONTENT ENDS -->
		</div><!-- /.col -->
	</div><!-- /.row -->
</div><!-- /.page-content -->
<script defer src="assets/js/jquery.dataTables.min.js"></script>
<script defer src="assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
$(function(){
	var table = $('#general-table').DataTable({
		bAutoWidth: false,
		"aaSorting": [],
		 "iDisplayLength": 25,
        "aLengthMenu":[25, 50, 100, 200, 500],
		"aoColumnDefs":
		[
			{
				"bSortable": false,
				"aTargets":[ 2 ]
			}
		],
	});
});
</script>