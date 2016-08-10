<!--
   This page for show information user and book that borrowed .
   This page can see user and administrator.
-->
<br/>  
<div class="row">
  <div class="col-xs-12">
        <!--panel-->
	<h3 class="page-header text-danger">
		<a href="#" data-toggle="popover" 
			title="users" 
			data-trigger="hover"
			data-content="your information in library">
			<i class="fa fa-user"></i>&nbsp;Account state
		</a>
	</h3>
</div>
</div>
<p class="clearfix"></p>
<div class="row">
    <div class="col-xs-4 ">
		<!--panel-->
		 <div class="box box-solid box-success">
		<div class="box-header">
			<div class="box-title">
				<h5 class="text-center"><i class="fa fa-reply"></i>&nbsp;<i class="fa fa-bank"></i>&nbsp;Borrowing</h5>
			</div>
		</div>
		<div class="box-body">
		   <h3 class="text-center text-info">
			<?php echo $borrwing; ?>
		   </h3>
		</div>
   </div>
	</div>
    <div class="col-xs-4">
		<!--panel-->
		 <div class="box box-solid box-warning">
		<div class="box-header">
			<div class="box-title">
				<h5 class="text-center"><i class="fa fa-reply-all"></i>&nbsp;<i class="fa fa-bank"></i>&nbsp;All Borrowed</h5>
			</div>
		</div>
		<div class="box-body">
		   <h3 class="text-center text-success">
		   		<?php echo $allBorrow; ?>
		   </h3>
		</div>
   </div>
	</div>
      <div class="col-xs-4">
		<!--panel-->
		 <div class="box box-solid box-primary ">
		<div class="box-header">
			<div class="box-title">
				<h5 class="text-center"><i class="fa fa-share"></i>&nbsp;<i class="fa fa-bank"></i>&nbsp;Returned</h5>
			</div>
		</div>
		<div class="box-body">
		   <h3 class="text-center text-danger">
		   		<?php echo $returned; ?>
		   </h3>
		</div>
   </div>
	</div>
  </div> 
  <div class="row">
    <div class="table-responsive">
		<table class="table table-bordered table-striped table-hover nowrap compact  ui-shadow" id="table-borrow">
		   <thead>
		        <tr class="table-row">
					<th>ID</th>
					<th>Book Name</th>
					<th>Borrowed Date</th>
					<th>Deatline</th>
					<th>Returned date</th>
					<th>Return status</th>
					<th>Action</th>
				</tr>
		   </thead>
		   <tbody>
		   	<?php foreach ($allBorrows as $value) { ?>
				<tr>
					<td><?php echo $value->bor_id; ?></td>
					<td><?php echo $value->b_title_en." ".$value->b_title_kh; ?></td>
					<td><?php echo $value->bor_borrow_date; ?></td>
					<td><?php echo $value->bor_return_date; ?></td>
					<td><?php echo $value->bor_chechin_date ?></td>
					<td><?php echo $value->bor_status; ?></td>
					<td>
						<?php 
							if ($value->bor_chechin_date>0) {
								echo "<p class='text-primary'>Returned</p>";
							}else{
								echo "<p class='text-danger'>Not yet</p>";
							}
						?>
					</td>
				</tr>
			<?php } ?>
		   </tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    //Transform the HTML table in a fancy datatable
    $('#table-borrow').dataTable({
         stateSave: true,
         "pageLength": 10,
         //"scrollX": true,
         "columnDefs": [
			{ targets: [0, 0], dataTable: true,"width": "60px"},
			{ targets: [1, 1], dataTable: true},
			{ targets: [5, 5], dataTable: false}
         ]
    });
	$('[data-toggle="popover"]').popover();  
});
</script>