
<!--
   This page for show form add new category .
   This page can see only administrator.
-->
<p class="clearfix"></p>
<p class="clearfix"></p>
<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header text-danger">
			<a href="#" data-toggle="popover" title="Books" data-trigger="hover"data-content="You can add category by form below.">
				<i class="fa fa-book"></i>&nbsp;add new category
			</a>

		</h3>

	</div>
</div>
<p class="clearfix"></p>
<p class="clearfix"></p>
<div class="panel panel-default panel-xs">
	<div class="panel-heading">
	  	<div class="panel-title text-center">Add Category</div>
	</div>
	<div class="panel-body">       
	<div class="row">
		<div class="col-xs-12 ">
		<!-- form info -->
			<form role="form" action=" <?php echo base_url('ReturnBook/doUpdate'); ?>" method="post">
				<div class="form-group">
				<!-- category name -->
					<label for="usr"><?php echo 'Borrower: '.$return->firstname.' '.$return->lastname ?></label>
					<br>
					<label for="usr"><?php echo 'Title: '.$return->b_title_en.' '.$return->b_title_kh ?></label>
				</div>
				<div class="form-group">
				<!-- select label -->
					<label for="sel1">Select condition:</label>
					<select name="label" class="form-control" id="sel1" value="">
						<?php foreach ($condtion as $key) { ?>
							<option><?php echo $key->con_name; ?></option>
						<?php } ?>
				  </select>
				  <input type="hidden" name="id" value="<?php echo $return->bor_id ?>">
				  <input type="hidden" name="bId" value="<?php echo $return->books_b_id ?>">
				</div>	
				<div class="form-group">
				<!-- form comment -->
					<label for="comment">Comment:</label>
					<textarea name="comment" class="form-control" id="comment" placeholder="English description" value=""></textarea>	
				</div>
		</div>
	</div>    
	</div>
	<div class="panel-footer">
		<!-- for buttons insert or cancel -->
		<div class="form-group">
			<button onclick="window.history.back();" type="button" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-chevron-left">Back</span></button>
			<button id="send" type="submit" class=" pull-right btn btn-success btn-sm"><span class="glyphicon glyphicon-save"></span>&nbsp;Save</button> 
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