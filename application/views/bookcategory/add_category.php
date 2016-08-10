<!--
   This page for show form add new category .
   This page can see only administrator.
-->
<p class="clearfix"></p>
<p class="clearfix"></p>
<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header text-danger">
			<a href="#" data-toggle="popover" title="Books" data-trigger="hover"data-content="You want add book label.">
				<i class="fa fa-book"></i>&nbsp;Add new Category
			</a>
		</h3>
	</div>
</div>
<p class="clearfix"></p>
<p class="clearfix"></p>
<div class="panel panel-default panel-xs">
	<div class="panel-heading">
	  	<div class="panel-title text-center">Add Category </div>
	</div>
	<div class="panel-body">       
	<div class="row">
		<div class="col-xs-12 ">
		<!-- form info -->
			<form role="form" action=" <?php echo base_url('BookCategory/addcategory'); ?>" method="post">
				<div class="form-group">
				<!-- category name -->
					<label for="usr">Category name</label>
					<input type="text" name="catname" class="form-control" id="usr" placeholder="Enter category name" value="<?php echo set_value('catname'); ?>"  required>
					<span class="text-danger">
						<?php echo form_error('catname'); ?>
					</span>
				</div>
				<div class="form-group">
				<!-- category name -->
					<label for="usr">Category Id</label>
					<input type="text" name="categoryid" class="form-control" id="usr" placeholder="Enter category ID" value="<?php echo set_value('categoryid'); ?>"  required>
					<span class="text-danger">
						<?php echo form_error('categoryid'); ?>
					</span>
				</div>	
				<div class="form-group">
				<!-- form comment -->
					<label for="comment">Comment:</label>
					<textarea name="comment" class="form-control" id="comment" placeholder="English description" value="<?php echo set_value('comment'); ?>"></textarea>	
				</div>
		</div>
	</div>    
	</div>
	<div class="panel-footer">
		<!-- for buttons insert or cancel -->
		<div class="form-group">
			<button onclick="window.history.back();" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-chevron-left">Back</span></button>
			<button id="send" type="submit" class=" pull-right btn btn-primary"><span class="glyphicon glyphicon-save"></span>&nbsp;Save</button> 
		</div>
	</div>
</form>
</div>
<!-- for form style -->
<!--
  This script to show popup
-->
<script type="text/javascript">
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});
</script>