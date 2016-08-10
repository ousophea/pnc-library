<!--
   This page for show list all categories .
   This page can see only administrator.
-->
<p class="clearfix"></p>
<p class="clearfix"></p>
<div class="row">
   	<div class="col-xs-12  ">
		  <h3 class="page-header text-danger">
			  <a href="#" data-toggle="popover" 
				title="Books" 
				data-trigger="hover"
				data-content="List all categories in table.">
				<i class="fa fa-book"></i>&nbsp;Books categories
			</a>
		</h3>
	</div>
</div>
<p class="clearfix"></p>
<p class="clearfix"></p>     
<div class="row">
  <div class="col-xs-12">
    <a href="<?php echo base_url('BookCategory/addCategory'); ?>"><button data-content="you want to add new category." data-trigger="hover" data-toggle="popover" id="send" type="submit" title="Category" class="btn-sm pull-left btn btn-primary"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;Add Category</button></a> 
    <br>
  	 <!-- /.panel-heading -->
      <div class="panel-body">
           <div class="dataTable_wrapper">
               <table class="table table-striped table-bordered table-hover nowrap compact ui-shadow" id="dataTables-books">
              <!-- header table -->
                   <thead>
                        <tr class="table-row">
                            <th>ID</th>
                            <th>Category</th>
                            <th>Comment</th>
                            <th>Action</th>
                        </tr>
                    </thead>
              <!-- body table -->
                    <tbody>
						<?php 
						  foreach ($category as $value) {
						?>
							<tr class="odd">
							  	<td><?php echo $value->category_id ?></td>  
							  	<td><?php echo $value->cat_name ?></td>  
								<td><?php echo $value->cat_comment ?></td>  
							  <td data-order="1">
								<span class="pull-right text-danger">
								  <a  href="<?php echo base_url('BookCategory/editCategory/'.$value->cat_id);?>"  data-placement="left"  data-content="you want to edit label now" data-trigger="hover" title="Edit label" data-toggle="popover" ><span class="glyphicon glyphicon-pencil text-success"></span></a>
								  &nbsp;
								  <a href="<?php echo base_url('BookCategory/delete/'.$value->cat_id);?>" onclick="return confirm('Are you sure you want to delete this item?');" data-id="1" title="Delete label"  data-placement="left"  data-content="you want to delete label now" data-trigger="hover" data-toggle="popover"><span class="glyphicon glyphicon-trash text-danger"></span></a>
								  </span>
							  </td>
							</tr>
						<?php
						  }
						?>
                    </tbody>
               	</table>
            </div>
        </div>        
            </div>
        </div>        
  </div> 
</div>
<!-- form style search, pagenation, sorter, list number of category -->
  	<script type="text/javascript">
		$(document).ready(function() {
		    //Transform the HTML table in a fancy datatable
		    $('#dataTables-books').dataTable({
		        stateSave: true,
		        "pageLength": 10,
		        //"scrollX": true,
		        "columnDefs": [
		            { "width": "60px", "targets": 0 }
		        ]
		    });
			$('[data-toggle="popover"]').popover();   
		});
	</script>