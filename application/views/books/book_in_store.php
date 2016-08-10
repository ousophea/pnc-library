<!--
   This page for show list of book .
   This page can see only administrator.
-->
<div class="container-fluid" id="wrap">
		<div class="row">
			<div class="col-xs-12  ">
		      <h3 class="page-header text-danger">
			  <a href="#">
				<i class="fa fa-book"></i>&nbsp;List all books in store
				</a>
			 </h3>
		   </div>
		</div>
		<p class="clearfix"></p>
		<div class="row-fluid">
		   <div class="row">
			<p class="clearfix"></p>
		   </div>
		   <div class="row">
			  <!-- /.panel-heading -->
				   <div class=" table-responsive dataTable_wrapper" >
					   <table id="dataTables-books" class="table table-striped table-bordered table-hover nowrap compact  ui-shadow" >
								<thead>
									<tr class="table-row">
										<th>Barcode</th>
										<th>Title EN/KH</th>
										<th>Category</th>
										<th>status</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									 foreach($count_books as $books){
									?>
									<tr>
										<td><?php echo $books->b_barcode;?></td>
										<td><a href="<?php echo base_url();?>bookcategory">
										<?php echo $books->b_title_en." ".$books->b_title_kh;?></a></td>
										<td><?php echo $books->cat_name;?></td>								
										<td><?php echo $books->sta_name;?>
											&nbsp;
										<?php
											$booking = $books->sta_name;
											if ($booking == 'Vacant') {
										?>
											  <a href="<?php echo base_url('BorrowBook/borrowById/'.$books->b_id);?>" >
												<span class="label label-success" ><i class="fa fa-cog"></i>&nbsp;Borrow</span>
											  </a>
										<?php
											}
										?>
										</td>   
									</tr>  
									<?php 
										}
									?>
							</tbody>            
					   </table>
					</div><!-- /.table-responsive -->               
		   </div>	
	</div>
<script type="text/javascript">
$(document).ready(function() {
    //Transform the HTML table in a fancy datatable
    $('#dataTables-books').dataTable({
         stateSave: true,
         "pageLength": 10,
         //"scrollX": true,
         "columnDefs": [
			{ targets: [0, 0], dataTable: true,"width": "60px"},
			{ targets: [1, 1], dataTable: true}
         ],
		 "order": [[ 3, "asc" ]]
    }); 
});
</script>