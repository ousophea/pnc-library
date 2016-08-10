<!--
   This page for show information user and book that borrowed .
   This page can see user and administrator.
-->
<br/>  
<div class="row">
  <div class="col-sm-12">
        <!--panel-->
	<h3 class="page-header text-danger">
		<a href="#" data-toggle="popover" 
			title="profile" 
			data-trigger="hover"
			data-content="your profile">
			<i class="fa fa-user"></i>&nbsp;Welcome to my account
		</a>
	</h3>
</div>
</div>
<p class="clearfix"></p>
<div class="row">
   <div class="col-xs-6">
		<div class="box box-solid box-success  panel-lg table-header">
	    <div class="box-header">
			<div class="box-title"></div>
		</div>
		<div class="box-body">
			<p class="text-center text-info">PNC Library Account</p>
		</div>
		<div class="box-footer">
			<a href="<?php echo base_url();?>" class="btn btn-success pull-right btn-xs">Edit Profile</a>
			<button onclick="window.history.back();" type="button" class="btn btn-warning btn-xs">Cancel</button>
		</div>
   </div>
   </div>
   <div class="col-xs-6">
		 <div class="box box-solid box-primary  panel-lg table-header">
	    <div class="box-header">
			<div class="box-title"></div>
		</div>
		<div class="box-body">
			<p class="text-center text-success">PNC Library User Profile</p>
		</div>
		<div class="box-footer">
			<a href="<?php echo base_url();?>" class="btn btn-success pull-right btn-xs">Edit Profile</a>
			<button onclick="window.history.back();" type="button" class="btn btn-warning btn-xs">Cancel</button>
		</div>
   </div>
   </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    //Transform the HTML table in a fancy datatable
	$('[data-toggle="popover"]').popover();  
});
</script>