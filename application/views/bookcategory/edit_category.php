<!--
   This page for show form edit category .
   This page can see only administrator.
-->
<p class="clearfix"></p>
<p class="clearfix"></p>
<div class="row">
	<div class="col-lg-12  ">
		<h3 class="page-header text-danger">
			<a href="#" data-toggle="popover" 
				title="Books" 
				data-trigger="hover"
				data-content="You can update book Category by form below.">
				<i class="fa fa-book"></i>&nbsp;Update Category
			</a>
		</h3>
	</div>
</div>
<p class="clearfix"></p>
<p class="clearfix"></p>
<div class="panel panel-default panel-xs">
    <div class="panel-heading">
		<div class="panel-title text-center">Update Category</div>
	</div>
	<div class="panel-body">
		<div class="row">
	<div class="col-sm-12 ">
	<!-- form  info -->
	  	<form role="form" action=" <?php echo base_url('BookCategory/update'); ?>" method="post">
		    <div class="form-group">
		      	<label for="usr">Category name:<i class="text-danger">*</i></label>
		      	<input type="text" name="catname" class="form-control" id="usr" value="<?php echo $result->cat_name; ?>" required>
		      	<input type="hidden" name="id" value="<?php echo $result->cat_id ?>">
		    </div>
		    <div class="form-group">
				<!-- category name -->
					<label for="usr">Category Id</label>
					<input type="text" name="categoryid" class="form-control" id="usr" placeholder="Enter category ID" value="<?php echo $result->categoryId; ?>"  required>
					<span class="text-danger">
						<?php echo form_error('categoryid'); ?>
					</span>
				</div>
		    <!-- form comment -->
		    <div class="form-group">
		      	<label for="comment">Comment:</label>
		      	<textarea name="comment" class="form-control" id="comment">
		      		<?php echo $result->cat_comment ?>
		      	</textarea>
		    </div>
	</div>
</div>
	</div>
	<div class="panel-footer">
		<!-- for buttons edit or cancel -->
		<div class="form-group">
			<button onclick="window.history.back();" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-chevron-left">Back</span></button>
            <button id="send" type="submit" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-floppy-disk "></span>&nbsp;Save Change</button> 	
        </div>
	</div>
	</form>
</div>  
<!-- style form -->
<script type="text/javascript">
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});
</script>