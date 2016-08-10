<!--
   This page for show information user and book that borrowed .
   This page can see user and administrator.
-->
<br/>  
<div class="row">
  <div class="col-xs-12">
        <!--panel-->
	<h3 class="page-header text-danger">
		<a href="#">
			<i class="fa fa-users"></i>&nbsp;Users state
		</a>
	</h3>
</div>
</div>
<p class="clearfix"></p>
  <div class="row">
    <div class="table-responsive">
		<table class="table table-bordered table-striped table-hover nowrap compact ui-shadow" id="table-userstate">
		   <thead>
		        <tr class="table-row">
					<th>ID</th>
					<th>User name</th>
					<th>Borrowing</th>
					<th>Returned</th>
				</tr>
		   </thead>
		   <tbody>
				
		      <?php
				  foreach($user_info as $rows){ 
					
				?>
				<tr>
					<td><?php echo $rows->id;?></td>
					<td>
						<a href="<?php echo base_url();?>borrowbook/borrowlist/<?php echo $rows->id;echo '?name='; echo $rows->firstname; ?>">
							<?php echo $rows->firstname;?>
						</a>
					</td>
					<td>
						<?php 					
							echo $rows->count_borrowing;
						?>
					</td>
					<td>
						<?php 
							   echo $rows->count_return;
						?>
					</td>
				</tr>
				<?php }?>
		   </tbody>
		</table>
	</div>
</div>
<script type="text/javascript">

$(document).ready(function() {
    $('#table-userstate').DataTable({
		"order": [[ 3, "asc" ]]
	});
	
} );
</script>