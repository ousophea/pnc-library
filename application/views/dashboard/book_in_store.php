<!--
   This page for show list of book .
   This page can see only administrator.
-->
<div class="container-fluid" id="wrap">
		<div class="row">
			<div class="col-xs-12  ">
		      <h3 class="page-header text-danger">
			  <a href="#">
				<i class="fa fa-book"></i>&nbsp;All books in store
				</a>
			 </h3>
			  <button onclick="window.history.back();" type="button" class="btn btn-danger pull-right"><span class="glyphicon glyphicon-chevron-left">Back</span></button>
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
										<th>Book Name</th>
										<th>Author</th>
										<th>Category</th>
										<th>Label</th>
										<th>status</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									 foreach($book_info as $books){
									?>
									<tr>
										<td><?php echo $books->b_barcode;?></td>
										<td>

											<a href="#" data-toggle="popover" 
								                  title="<?php echo "Author: "." ".$books->b_author; ?>" 
								                  data-trigger="hover"
								                  data-content="<?php echo "Description: "." ".$books->b_description; ?>">
								                  &nbsp;<?php echo $books->b_title_en.$books->b_title_kh;?>
								            </a>
										</td>
										<td><?php echo $books->b_author;?></td>								
										<td><?php echo $books->cat_name;?></td>								
										<td><?php echo $books->categoryId."-".$books->b_label;?></td>								
										<td><?php echo $books->sta_name;?></td>   
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
    $('[data-toggle="popover"]').popover(); 
});
</script>