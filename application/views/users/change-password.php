<!--
   This page for change password .
   This page can see user and administrator.
-->
<div class="container-fluid" id="wrap">
	<!-- Form info -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading"> Change your password </div>
				<div class="panel-body">
					<div class="col-lg-12">
						 <?php echo validation_errors(); ?>
                        <?php 
                        $attributes = array('id' => 'frmUserForm', 'class' => 'form-horizontal');
                        echo form_open('users/changepassword', $attributes);?>
							<input type="hidden" name="id" value="<?php echo $user_id; ?>" required />
                            <input type="password" autocomplete="off" placeholder="Old Password" id="oldpassword" name="oldpassword" class="input-lg form-control">
                            <input type="password" autocomplete="off" placeholder="New Password" id="password1" name="password1" class="input-lg form-control">
                            <input type="password" autocomplete="off" placeholder="Repeat New Password" id="password2" name="password2" class="input-lg form-control">
                            <input id="btn-submit" type="submit" value="Change Password" data-loading-text="Changing Password..." class="col-xs-12 btn btn-primary btn-load btn-lg">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>