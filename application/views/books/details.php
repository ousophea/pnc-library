<!--
   This page for show detail user information.
   This page can see user and administrator.
-->
<div class="container-fluid" id="wrap">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">PNC Staff team</h1>
		</div>
	</div>
	<!-- Form info -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading"> Team information </div>
				<div class="panel-body">
					<div class="col-lg-12">
						<form role="form">
							<div class="form-group">
								<label>Name</label>
								<p class="form-control-static">PNC Staff team</p>
							</div>
							<div class="form-group">
								<label>Description</label>
								<p class="form-control-static">This is the PNC staff team. This team is dedicated to regroups all staff members to play the official PNC league</p>
							</div>
							<div class="form-group">
								<label>Creation Date</label>
								<p class="form-control-static">01/01/2016</p>
							</div>
							<div class="form-group">
								<label>Captains</label>
								<p />
								<span class="tag label label-default">
								<span>Benoit</span>
								<a><span class="remove glyphicon glyphicon-remove-sign glyphicon-white"></span></a>
								</span>
								<span class="tag label label-default">
								<span>Maneth</span>
								<a><span class="remove glyphicon glyphicon-remove-sign glyphicon-white"></span></a>
								</span>
							</div>
						</form>
					</div>

				</div>
			</div>
		</div>
	</div>
	<!-- Members table -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading"> Team information </div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">

							<div class="dataTable_wrapper">
								<table class="table table-striped table-bordered table-hover" id="dataTables-members">
									<thead>
										<tr>
											<th>First Name</th>
											<th>Last Name</th>
											<th>Prefered position</th>
											<th>Join date</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
										<tr class="odd">
											<td>
												<button type="button" class="btn btn-link" onclick="showUserInfos(1)">Benoit</button>								
											</td>
											<td>Pitet</td>
											<td>Defense</td>
											<td>01/02/2016</td>
											<td class="center">
												<button type="button" class="btn btn-default" onclick="askToExcludeMember(1,1)">Exclude</button>
											</td>
										</tr>
										<tr class="even">
											<td>
												<button type="button" class="btn btn-link" onclick="showUserInfos(1)">Benjamin</button>								
											</td>
											<td>Ballet</td>
											<td>Striker</td>
											<td>01/03/2016</td>
											<td class="center">
												<button type="button" class="btn btn-default" onclick="askToExcludeMember(1,1)">Exclude</button>
												<button type="button" class="btn btn-default disabled">Promote as captain</button>
											</td>
										</tr>
										<tr class="odd">
											<td>
												<button type="button" class="btn btn-link" onclick="showUserInfos(1)">Saroem</button>								
											</td>
											<td>Rum</td>
											<td>Goal Keeper</td>
											<td>01/03/2016</td>
											<td class="center">
												<button type="button" class="btn btn-default" onclick="askToExcludeMember(1,1)">Exclude</button>
												<button type="button" class="btn btn-default disabled">Promote as captain</button>
											</td>
										</tr>
										<tr class="even">
											<td>
												<button type="button" class="btn btn-link" onclick="showUserInfos(1)">Maneth</button>								
											</td>
											<td>Min</td>
											<td>Striker</td>
											<td>01/03/2016</td>
											<td class="center">
												<button type="button" class="btn btn-default" onclick="askToExcludeMember(1,1)">Exclude</button>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<!-- /.table-responsive -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- Pending members -->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading"> Pending Members </div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12">
						<ul class="list-group">
							<li class="list-group-item">
								<button type="button" class="btn btn-link" onclick="showUserInfos(1)">John Munger</button>								
								<span class="pull-right">
								<button type="button" class="btn btn-xs btn-info btn-circle"><span class="fa fa-check"></span></button>
								<button type="button" class="btn btn-xs btn-warning btn-circle"><span class="fa fa-times"></span></button>    
								</span>								                
							</li>
							<li class="list-group-item">
								<button type="button" class="btn btn-link" onclick="showUserInfos(1)">Jonathan Faucher</button>
								<span class="pull-right">
									<button type="button" class="btn btn-info btn-circle"><i class="fa fa-check"></i></button>
									<button type="button" class="btn btn-warning btn-circle"><i class="fa fa-times"></i></button>    
								</span>								                
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    //Transform the HTML table in a fancy datatable
    $('#dataTables-members').dataTable({
        stateSave: true,
		paging: false,
		searching: false,
		bInfo : false
    });
});
function showUserInfos(userId) {
    $.ajax({
       url : '<?php echo base_url();?>users/info/' + userId, // url to the view
       success : function(html, status){ // success request
           // open the dialog box with user information
           bootbox.alert({
           title: "User information",
           message: '' + html,  
           });
       },
       error : function(result, status, error){
           console.log(error);
       }
    });
}
function askToExcludeMember(userId, teamId) {
    bootbox.confirm("Are you sure you want to exclude this member?", function(result) {
        if (result)
        {
            //TODO exclude the member
        } 
    }); 
}
</script>