<!--
   This page for show information user and book that borrowed .
   This page can see user and administrator.
-->
<br/>  
<div class="row">
  <div class="col-xs-12">
        <!--panel-->
	<h3 class="page-header text-danger text-capitalize">
			<i class="fa fa-file-text-o"></i>&nbsp;User State Detail:&nbsp;&nbsp;<span class="text-success"><?php echo $_GET['name'];?></span>
	</h3>
	<button onclick="window.history.back();" type="button" class="btn btn-danger pull-right"><span class="glyphicon glyphicon-chevron-left">Back</span></button>
</div>
</div>
<p class="clearfix"></p>
  <div class="row">
    <div class="table-responsive">
		<table class="table table-bordered table-striped table-hover nowrap compact ui-shadow" id="borrow_list">
		   <thead>
		        <tr class="table-row">
					<th>Barcode</th>
					<th>Book Name</th>
					<th>Comment</th>
					<th>Borrowed Date</th>
					<th>Check in Date</th>
					<th>Returned Date</th>
					<th>Condition</th>
					<th>Action</th>
				</tr>
		   </thead>
		   <tbody>
		    <?php foreach($borrow_info as $row) { ?>
				
				 <?php if($row->id == ($this->uri->segment(3))){ ?>
					<tr>
						<td><?php echo $row->b_barcode;?></td>
						<td><?php echo $row->b_title_en;?><?php echo $row->b_title_kh;?></td>
						<td><?php echo $row->bor_comment; ?></td> 
						<td><?php echo $row->bor_borrow_date;?></td>
						<td><?php echo $row->bor_chechin_date;?></td>
						<td><?php echo $row->bor_return_date;?></td>
						<td><?php echo $row->con_name;?></td>
						<td><?php
							if( $row->bor_chechin_date == null)
							{ 
								echo "<p class='text-danger'>Borrowing</p>";
							}
							else if($row->bor_chechin_date != null)
							{
								echo "<p class='text-success'>Returned</p>";
							}?>
						</td>
					</tr>
				 <?php } ?>
				
			<?php } ?>
		   </tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#borrow_list').DataTable();
} );

</script>