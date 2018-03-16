<div class="breadcrumbs ace-save-state" id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-home home-icon"></i>
			Admin Console
		</li>
		<li class="active">Manage Contacts</li>
	</ul><!-- /.breadcrumb -->
</div>

<div class="page-content">

	<div class="page-header">
		<h1>
			Contact Forms List
		</h1>
	</div><!-- /.page-header -->

	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->

<div class="row">
	<div class="col-xs-12">
		<table id="contact-table" class="table  table-bordered table-hover">
			<thead>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Comment</th>
					<th>IP Address</th>
					<th>Created At</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if(!empty($contact))
				{
					foreach($contact as $row)
					{
						?>
						<tr>
							<td><?php echo $row['name'];?></td>
							<td><?php echo $row['email'];?></td>
							<td><?php echo $row['comment'];?></td>
							<td><?php echo $row['ip_address'];?></td>
							<td><?php echo date('d M Y H:i', strtotime($row['created_at'])); ?></td>
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
	var table = $('#contact-table').DataTable({
		bAutoWidth: false,
		"aaSorting": [],
		 "iDisplayLength": 25,
        "aLengthMenu":[25, 50, 100, 200, 500],
		
	});
});
</script>