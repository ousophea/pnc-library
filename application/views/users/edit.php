<!--
   This page for edit user profile .
   This page can see only administrator.
-->
<div class="container-fluid" id="wrap">
	<div class="panel panel-default panel-sm header-table">
		<div class="panel-heading">
			<div class="panel-title">Change profile</div>
		</div>
		<div class="panel-body">
			<div class="row-fluid">
				<div class="col-md-12">
					<h1 class="page-header">Edit user profile</h1>
					<?php echo validation_errors(); ?>
					<?php 
					$attributes = array('id' => 'frmUserForm', 'class' => 'form-horizontal');
					echo form_open('users/edit/' . $users_item['id'], $attributes);?>
					<input type="hidden" name="id" value="<?php echo $users_item['id']; ?>" required /><br />
					<div class="form-group">
						<label for="firstname" class="col-sm-2 control-label">Firstname</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="firstname" value="<?php echo $users_item['firstname']; ?>" required />
						</div>
					</div>
						<div class="form-group">
							<label for="lastname" class="col-sm-2 control-label">Lastname</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="lastname" value="<?php echo $users_item['lastname']; ?>" required />
							</div>
						</div>
						<div class="form-group">
							<label for="login" class="col-sm-2 control-label">Login</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="login" name="login" value="<?php echo $users_item['login']; ?>" required />
								<div class="alert alert-info" role="alert" id="lblLoginAlert">
									<button type="button" class="close" onclick="$('#lblLoginAlert').hide();"><span aria-hidden="true">&times;</span></button>
									This username is not available.
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="email" class="col-sm-2 control-label">E-mail</label>
							<div class="col-sm-10">
								<input type="email" class="form-control" id="email" name="email" value="<?php echo $users_item['email']; ?>" required />
							 </div>
						</div>
						<!-- User role is only available if the connected user is an admin of the system -->
						  <?php if ($is_admin === TRUE) { ?>		  
							<div class="form-group">
								<label for="role[]" class="col-sm-2 control-label">Role</label>
								<div class="col-sm-10">
									<select class="form-control" name="role[]" multiple="multiple" size="2">
									<?php foreach ($roles as $roles_item): ?>
										<option value="<?php echo $roles_item['id'] ?>" <?php if ((((int)$roles_item['id']) & ((int) $users_item['role']))) echo "selected" ?>><?php echo $roles_item['name'] ?></option>
									<?php endforeach ?>
									</select>
								</div>
							</div>
						   <?php } ?>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button id="send" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk glyphicon-white"></span>&nbsp;Update user</button>
								&nbsp;
								<a href="<?php echo base_url();?>users" class="btn btn-danger pull-right"><span class="glyphicon glyphicon-floppy-remove glyphicon-white"></span>&nbsp;Cancel</a>
							 </div>
						</div>
						<?php if ($users_item['id'] === $this->session->userdata('id')) { ?>		  
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<a href="<?php echo base_url();?>users/changepassword" class="btn btn-info " role="button">Change password</a>
								</div>
							</div>
						<?php } else if ($is_admin === TRUE) { ?>		  
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<a href="<?php echo base_url();?>users/resetpassword/<?php echo $users_item['id'];?>" class="btn btn-info" role="button">Reset user password</a>
								</div>
							</div>
						<?php }  ?>	
						
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootbox.min.js"></script>
<script type="text/javascript">
    function validate_form() {
        result = false;
        var fieldname = "";
        if ($('#firstname').val() == "") fieldname = "firstname";
        if ($('#lastname').val() == "") fieldname = "lastname";
        if ($('#login').val() == "") fieldname = "login";
        if ($('#email').val() == "") fieldname = "email";
        if ($('#password').val() == "") fieldname = "password";
        if (fieldname == "") {
            return true;
        } else {
            bootbox.alert("The field " + fieldname + " is mandatory.");
            return false;
        }
    }
    $(function () {
        $("#lblLoginAlert").hide();
        //Check if the username already exists
        $("#login").change(function() {
            if ($("#login").val() != '<?php echo $users_item['login']; ?>') {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url();?>connection/check/login",
                    data: { login: $("#login").val() }
                    })
                    .done(function( msg ) {
                        if (msg == "true") {
                            $("#lblLoginAlert").hide();
                        } else {
                            $("#lblLoginAlert").show();
                        }
                    });
                } else {
                    $("#lblLoginAlert").hide();
                }
        }); 
        $('#send').click(function() {
            if ($("#login").val() != '<?php echo $users_item['login']; ?>') {
                if (validate_form()) {
                    $.ajax({
                    type: "POST",
                    url: "<?php echo base_url();?>connection/check/login",
                    data: { login: $("#login").val() }
                    })
                    .done(function( msg ) {
                        if (msg == "true") {
                            $("#target").submit();
                        } else {
                            bootbox.alert("Username already exists.");
                        }
                    });
                }
             } 	else 
					{
						$("#target").submit();
					}
        });
    });
</script>