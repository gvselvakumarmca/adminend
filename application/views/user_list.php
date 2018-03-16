<div class="breadcrumbs ace-save-state" id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-home home-icon"></i>
			Admin Console
		</li>
		<li class="active">Manage Users</li>
	</ul><!-- /.breadcrumb -->
</div>
<div class="page-content">
	<div class="page-header">
		<h1>
			User List
		</h1>
	</div><!-- /.page-header -->
	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<div class="row">
				<div class="col-xs-12">
					<div class="panel panel-default">
						<div class="panel-heading"><strong>Filters</strong></div>
						<div class="panel-body">
							<form class="form-horizontal" name="filter" id="filter" action="" method="post">
								<table class="filter-table">
									<tbody>
										<tr>
										<td>
											<div class="form-group">
												<label class="control-label col-md-4 col-sm-4 col-xs-12" for="lawfirm">User Name</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input type="text" name="username" id="username" class="form-control col-md-7 col-xs-12" value="">
												</div>
											</div>
										</td>
										<td>
											<div class="form-group">
												<label class="control-label col-md-4 col-sm-4 col-xs-12" for="email">Email</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<input type="text" name="email" id="email" class="form-control col-md-7 col-xs-12" value="">
												</div>
											</div>
										</td>
										</tr>
										<tr>
										<td>
											<div class="form-group">
												<label class="control-label col-md-4 col-sm-4 col-xs-12" >Registration Date</label>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<span class="input-icon input-icon-right">
															<input type="text" name="date" id="date" class="form-control date-picker" placeholder="mm/dd/yyyy">
															<i class="ace-icon fa fa-calendar open-daterangepicker"></i>
													</span>
												</div>
											</div>
										</td>
										<td>
											<div class="form-group pull-right">
												<div class="col-xs-12">
													<button type="submit" class="btn btn-primary"><i class="ace-icon fa fa-search"></i> Apply Filter</button>
													<button  class="btn btn-primary  clear_filter"><i class="ace-icon fa fa-trash"></i> Clear Filter</button>
												</div>
											</div>
										</td>	
										</tr>
									</tbody>
								</table>
							</form>
						</div><!-- panel-body -->
					</div><!-- panel -->
				</div><!-- col -->
			</div><!-- row -->
			<div class="row">
				<div class="col-xs-12">
					<table id="user-table" class="table  table-bordered table-hover">
						<thead>
							<tr>
								<th width="8%">ID</th>
								<th width="12%">Username</th>
								<th width="15%">Email</th>
								<th width="14%">Created at</th>
								<th width="14%">Last login</th>
								<th width="11%">Referrer URL</th>
								<th width="15%">Balance</th>
								<th width="10%">Is Active</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
			<!-- PAGE CONTENT ENDS -->
		</div><!-- /.col -->
	</div><!-- /.row -->
</div><!-- /.page-content -->
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datepicker3.min.css">
<script defer src="assets/js/jquery.dataTables.min.js"></script>
<script defer src="assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script defer type="text/javascript" src="assets/js/bootstrap-datepicker.min.js"></script>
<script defer type="text/javascript" src="assets/js/jquery.maskedinput.min.js"></script>
<script type="text/javascript">
$(function(){
	$.mask.definitions['~']='[+-]';
	$('#date').mask('99/99/9999');
	var table = $('#user-table').DataTable({
		bAutoWidth: false,
		"aaSorting": [],
		"cache": true,
        "bStateSave": true,
        "iDisplayLength": 25,
        "aLengthMenu":[25, 50, 100, 200, 500],
        "autoWidth": false,
        "bProcessing": true,
        "bServerSide": true,
        "responsive": true,
        "aoColumnDefs":
		[
			{
				"bSortable": false,
				"aTargets":[ 4 ]
			},
			
		],
		"columns": [
			{ "width": "8%", "targets": 0 },
			{ "width": "12%", "targets": 1 },
			{ "width": "15%", "targets": 2 },
			{ "width": "14%", "targets": 3 },
			{ "width": "14%", "targets": 4 },
			{ "width": "11%", "targets": 5 },
			{ "width": "15%", "targets": 6 },
			{ "width": "10%", "targets": 7 },
		],
        "sAjaxSource": "<?php echo base_url('admin/UserManagementList');?>",
        "fnServerParams": function ( aoData ) {
        	aoData.push(
        			{"name" : "username", "value" : $("#username").val()},
        			{"name" : "email", "value" : $("#email").val()},
        			{"name" : "date", "value" : $('#date').val()}
        		);
        },
        "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull )
        {

        }
	});

	$('#date').datepicker({
		format: 'mm/dd/yyyy',
		endDate: '0d',
		autoclose: true,
	});
	

	$(document).on('submit', '#filter', function(e){
		e.preventDefault();
		table.draw();
	});
});
$(document).on('change', '.is_active', function(e){
		e.preventDefault();
		var id = $(this).val();
		 	if(!$(this).is(':checked')){
               var val = 0;
            }else{
            	var val = 1;
            } 
            
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/UserActive');?>",
            data: {id:id,val:val},
            success: function(data) {
                
              
            },
            error: function() {}
        });
	});
$(".clear_filter").click(function(){
 $('#filter')[0].reset();
});

$(document).ready(function() {
	$(document).on("click",'.edit-balance',function(){
		$("#user-table").find('input[type="text"]').hide();
    	var dad = $(this).parent('td');
        dad.find('.balance-label,.edit-balance').hide();
        dad.find('input[type="text"]').show().focus();
    });

});

 $(document).on("keypress keyup blur",".balance-text",function (event) {
         
	$(this).val($(this).val().replace(/[^0-9\.]/g,''));
   
});

    $(document).on("focusout keypress",'.balance-text',function(e){
    	 if (e.type == "focusout" || e.which == 13) {
		    	var dad = $(this).parent('td');
		        var val = dad.find('input[type="text"]').val();
		        if(val == '')val = 0;
		        var idtext = dad.find('input[type="text"]').attr('id');
		        var array = idtext.split("_");
		        $.ajax({
		            type: "POST",
		            url: "<?php echo base_url('admin/UserBalance');?>",
		            data: {id:array[1],val:val},
		            success: function(data) {
		                
		              dad.find('.balance-label').text(parseFloat(val).toFixed(2));
		            },
		            error: function() {}
		        });

		        $(this).hide();
		        dad.find('.balance-label,.edit-balance').show();
		}
    });

</script>
<style type="text/css">
.balance-text{display:none;}
 #user-table tbody tr td:nth-child(5){
	text-align: center;
}
.edit-balance{cursor:pointer;}
.dataTable > thead > tr > th[class*="sorting_disabled"] {
	color: #707070;
	}
.filter-table th,.filter-table td{width:30%;}
@media screen and (max-width: 967px) {
.filter-table th,.filter-table td{width:100%;display:block;}
}
 #user-table{
	table-layout: fixed; 
  	word-wrap:break-word;
}
.balance-text{
	width:90%;
}
</style>