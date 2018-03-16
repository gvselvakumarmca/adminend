<div class="breadcrumbs ace-save-state" id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-home home-icon"></i>
			Admin Console
		</li>
		<li class="active">Manage News</li>
	</ul><!-- /.breadcrumb -->
</div>

<div class="page-content">

	<div class="page-header">
		<h1>
			Manage News 
			<a href="<?php echo base_url('admin/createnews/');?>" class="btn btn-primary btn-sm pull-right">
				<i class="fa fa-plus"></i>&nbsp;<b>Create</b>
			</a>
			
		</h1>
	</div><!-- /.page-header -->

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
			<!-- PAGE CONTENT BEGINS -->

			<div class="row">
				<div class="col-xs-12">
					<table id="news-table" class="table  table-bordered table-hover">
						<thead>
							<tr>
								<th width="15%">Lawyer</th>
								<th width="20%">Title</th>
								<th width="35%">Content</th>
								<th width="15%">Comment notification</th>
								<th width="10%">Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if(!empty($news))
							{
								foreach($news as $row)
								{
									?>
									<tr>
										<td><?php echo $row['lawyername'];?></td>
										<td><?php echo $row['headline'];?></td>
										<td><?php if(strlen($row['content']) > 120)echo substr($row['content'],0,120).'..'; else echo $row['content']; ?></td>
										<td><?php if($row['notify'] == '1') echo 'Yes'; else 'No';?></td>
										<td class="text-center"><a href="<?php echo base_url('admin/editnews/'.$row['id']);?>"><i class="fa fa-pencil" title="Edit"></i></a>&nbsp;&nbsp;<a href="javascript:delete_rec('<?php echo $row['id']; ?>');"><i class="fa fa-trash" title="Delete"></i></a></td>
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
	var table = $('#news-table').DataTable({
		bAutoWidth: false,
		"aaSorting": [],
		 "iDisplayLength": 25,
        "aLengthMenu":[25, 50, 100, 200, 500],
		"aoColumnDefs":
		[
			{
				"bSortable": false,
				"aTargets":[ 4 ]
			}
		],
	});
});

function delete_rec(id){
	if (confirm('Are you sure you want to delete this news?')) {
		$.ajax({
	            type: "POST",
	            url: "<?php echo base_url('admin/newsdelete');?>",
	            data: {id:id},
	            success: function(data) {
	                location.reload();
	              
	            },
	            error: function() {}
	    });
	}
}
</script>