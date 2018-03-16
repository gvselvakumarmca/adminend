<div class="breadcrumbs ace-save-state" id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-home home-icon"></i>
			Admin Console
		</li>
		<li class="active">Manage Topics</li>
	</ul><!-- /.breadcrumb -->
</div>

<div class="page-content">

	<div class="page-header">
		<h1>
			Manage Topics 
			<a href="<?php echo base_url('admin/createtopic/');?>" class="btn btn-primary btn-sm pull-right">
				<i class="fa fa-plus"></i>&nbsp;<b>Create</b>
			</a>
			
		</h1>
	</div><!-- /.page-header -->

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
			<!-- PAGE CONTENT BEGINS -->

			<div class="row">
				<div class="col-xs-12">
					<table id="topic-table" class="table  table-bordered table-hover">
						<thead>
							<tr>
								<th width="15%">Category</th>
								<th width="10%">Topic Name</th>
								<th width="10%">Topic URL</th>
								<th width="15%">Topic SEO Text</th>
								<th width="15%">Search Keywords</th>
								<th width="15%">Description</th>
								<th width="8%">Order</th>
								<th width="12%">Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if(!empty($topics))
							{
								foreach($topics as $topic)
								{
									?>
									<tr>
										<td><?php echo $topic['category'];?></td>
										<td><?php echo $topic['name'];?></td>
										<td><?php echo $topic['url'];?></td>
										<td><?php echo $topic['seo_text'];?></td>
										<td><?php echo $topic['search_keywords'];?></td>
										<td><?php echo $topic['description'];?></td>
										<td>
										<?php if(array_key_exists($topic['category_id'], $c_count)) $count =  $c_count[$topic['category_id']]; ?>
											<select class="form-control fn_order" name="order" id="order_<?php echo $topic['id']; ?>" >
												<?php for ($i=1;$i<=$count;$i++){
													?>
													<option value="<?php echo $i;?>" <?php if($i == $topic['order']) echo 'selected'; ?>><?php echo $i;?></option>
												<?php } ?>
											</select>
										</td>
										<td class="text-center"><a href="<?php echo base_url('admin/edittopic/'.$topic['id']);?>"><i class="fa fa-pencil" title="Edit"></i></a>&nbsp;&nbsp;<a href="javascript:delete_rec('<?php echo $topic['id']; ?>');"><i class="fa fa-trash" title="Delete"></i></a></td>
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
	var table = $('#topic-table').DataTable({
		bAutoWidth: false,
		"aaSorting": [],
		 "iDisplayLength": 25,
        "aLengthMenu":[25, 50, 100, 200, 500],
		"aoColumnDefs":
		[
			{
				"bSortable": false,
				"aTargets":[ 6,7 ]
			}
		],
	});
});

function delete_rec(id){
	if (confirm('Are you sure you want to delete this topic?')) {
		$.ajax({
	            type: "POST",
	            url: "<?php echo base_url('admin/topicdelete');?>",
	            data: {id:id},
	            success: function(data) {
	                location.reload();
	              
	            },
	            error: function() {}
	    });
	}
}
$(document).on("change",'.fn_order',function(){
	var ids = $(this).attr("id");
	var arr = ids.split("_");
	var id = arr[1];
	var val = $(this).val();
	$.ajax({
        type: "POST",
        url: "<?php echo base_url('admin/topicorder');?>",
        data: {id:id,val:val},
        success: function(data) {
            location.reload();
        }
    });
});
</script>