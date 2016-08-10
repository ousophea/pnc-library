<!--
   This page for list all user .
   This page can see only administrator.
-->
<?php
?>
<div class="container-fluid" id="wrap">
   <div class="col-lg-12">
		<h3 class="page-header text-danger">
		<a href="#" data-toggle="popover" 
			title="users" 
			data-trigger="hover"
			data-content="List all users in table.">
			<i class="fa fa-users"></i>&nbsp;Users In Library
			</a>
		</h3>
		 <button onclick="window.history.back();" type="button" class="btn btn-danger pull-right"><span class="glyphicon glyphicon-chevron-left">Back</span></button>
	</div>
	<p class="clearfix"></p>
			<div class="row-fluid">
				<div class="col-xs-12 table-responsive">
					<table  class="display table  table-bordered table-hover ui-shadow" id="users" >
						<thead>
							<tr class="table-row">
								<th>Firstname</th>
								<th>Lastname</th>
								<th>Email</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($users as $users_item): ?>
							<tr>
								<td><?php echo $users_item['firstname'] ?></td>
								<td><?php echo $users_item['lastname'] ?></td>
								<td><a href="mailto:<?php echo $users_item['email']; ?>"><?php echo $users_item['email']; ?></a></td>
							</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
		</div>
	<div class="row-fluid">
		<div class="col-xs-12">&nbsp;</div>
	</div>
</div>
<div id="frmResetPwd" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3>Reset password</h3>
            </div>
            <div id="frmResetPwdBody" class="modal-body"></div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<div class="modal hide" id="frmModalAjaxWait" data-backdrop="static" data-keyboard="false">
        <div class="modal-header">
            <h1>Please wait</h1>
        </div>
        <div class="modal-body">
            <img src="<?php echo base_url();?>assets/images/loading.gif"  align="middle">
        </div>
 </div>
<link href="<?php echo base_url();?>assets/datatable/media/css/jquery.dataTables.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>assets/datatable/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootbox.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    //Transform the HTML table in a fancy datatable
    $('#users').dataTable({
		stateSave: true
    });
    $('.confirm-delete').click(function() {
        var id = $(this).data('id');
        bootbox.confirm("Are you sure that you want to delete this user?", function(result) {
            if (result) {
                document.location = '<?php echo base_url();?>users/delete/' + id;
            }
        });
    });
    $('.reset-pwd').click(function() {
        var id = $(this).data('id');
        $('#frmModalAjaxWait').modal('show');
        $("#frmResetPwdBody").load('<?php echo base_url();?>users/reset/' + id, function(){
            $('#frmModalAjaxWait').modal('hide');
            $('#frmResetPwd').modal('show'); 
        });
    });
    $('#frmResetPwd').on('hidden', function() {
        $(this).removeData('modal');
    });
	 $('[data-toggle="popover"]').popover();   
});
</script>