<div class="breadcrumbs ace-save-state" id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-file-o home-icon"></i>
			Pages
		</li>
	</ul><!-- /.breadcrumb -->
</div>

<div class="page-content">

	<div class="page-header">
		<h1>
			Page List
			<a href="<?php echo base_url('admin/addEditPages/');?>" class="btn btn-primary btn-sm pull-right">
				<i class="fa fa-plus"></i>&nbsp;<b>Create</b>
			</a>
		</h1>
	</div><!-- /.page-header -->

	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->

<div class="row">
	<div class="col-xs-12">
		<?php
		if($this->session->flashdata('page_msg') != '')
		{
			?>
			<div class="alert alert-success">
				<button type='button' class='close' data-dismiss='alert'>×</button>
				<?php echo $this->session->flashdata('page_msg');?>
			</div>
			<?php
		}
		?>
		<table id="pages-table" class="table  table-bordered table-hover">
			<thead>
				<tr>
					<th>Page Name</th>
					<th>Language</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if(!empty($pages))
				{
					foreach($pages as $page)
					{
						?>
						<tr>
							<td><?php echo $page['page_name'];?></td>
							<td><?php echo $page['language'];?></td>
							<td class="text-center"><a href="<?php echo base_url('admin/addEditPages/'.$page['page_id']);?>"><i class="fa fa-pencil"></i> Edit</a></td>
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

<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
$(function(){
	var table = $('#pages-table').DataTable({
		bAutoWidth: false,
		"aaSorting": [],
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